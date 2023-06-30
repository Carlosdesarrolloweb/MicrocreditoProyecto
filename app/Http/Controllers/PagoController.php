<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pago;
use App\Models\Cliente;
use App\Models\Prestamo;
use Illuminate\Support\Facades\Auth;
use App\Models\GananciaDia;
use App\Models\PagosGanancia;

class PagoController extends Controller
{
    public function create()
    {
        $clientes = Cliente::all();

        return view('pagos.create', compact('clientes'));
    }
    public function getPrestamo(Request $request)
    {
        $prestamo = Prestamo::where('id_cliente', $request->cliente_id)
                            ->where('estado', 1)
                            ->first();

        return response()->json([
            'monto' => $prestamo->monto,
            'cuotas' => $prestamo->cuotas,
        ]);
    }
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'id_prestamo'=> 'required',
            'fecha_pago' => 'required',
            'Numero_Cuota' => 'required|integer',
            'monto_pago' => 'required',
            'descripcion' => 'required'
        ]);

        // Crear un nuevo pago
        $pago = new Pago();
        $pago->id_prestamo = $request->id_prestamo;
        $pago->fecha_pago = $request->fecha_pago;
        $pago->estado = $request->Numero_Cuota >= $request->monto_pago ? true : false;
        $pago->Numero_Cuota = $request->Numero_Cuota;
        $pago->monto_pago  = $request->monto_pago;
        $pago->descripcion = $request->descripcion;
        $pago->save();

        $prestamo = Prestamo::findOrFail($request->id_prestamo);
        $montoactual = $prestamo->monto_cancelado;
        $prestamo->monto_cancelado = $montoactual + $request->monto_pago;

        if ($prestamo->monto_cancelado == $prestamo->monto_prestado) {
            $prestamo->estado = true;
        }

        $prestamo->save();

        // Registro en la bitácora
        $usuarioId = Auth::id();
        $accion = 'Registro de pago - "Monto: ' . $pago->monto_pago . ', Número de cuota: ' . $pago->Numero_Cuota . ', Cliente: ' . $prestamo->cliente->nombre_cliente . ' ' . $prestamo->cliente->apellido_cliente . '"';
        $tablaAfectada = 'pagos';
        DB::table('bitacora')->insert([
            'usuario_id' => $usuarioId,
            'accion' => $accion,
            'tabla_afectada' => $tablaAfectada,
            'fecha_registro' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        // Registro en la tabla ganancia_dia
        $fechaPago = date('Y-m-d', strtotime($pago->fecha_pago));
        $gananciaDia = GananciaDia::firstOrNew(['fecha' => $fechaPago]);
        $gananciaDia->monto += $pago->monto_pago;
        $gananciaDia->save();

        // Registro en la tabla pagos_ganancia
        $pagosGanancia = new PagosGanancia();
        $pagosGanancia->id_pago = $pago->id;
        $pagosGanancia->id_ganancia_dia = $gananciaDia->id;
        $pagosGanancia->save();

        return redirect()->route('pagos.index');
    }
    public function obtenerPorCliente($clienteId)
    {
        $prestamo = Prestamo::where('id_cliente', $clienteId)->where('estado', 0)->first();

        return response()->json(['prestamo' => $prestamo,'cuota'=>$this->suma($prestamo->id)]);

    }


    public function suma($id_prestamo)
    {
        return intval(Pago::where('id_prestamo',$id_prestamo)->count('id_prestamo'))+1;
    }
    public function index()
    {
        $pagos = Pago::all();
        $clientes = Cliente::all(); // Obténgo todos los clientes

        return view('pagos.index', compact('pagos', 'clientes'));

    }
    public function edit($id)
    {
        $pago = Pago::findOrFail($id);
        $clientes = Cliente::all();
        $prestamo = Prestamo::findOrFail($pago->id_prestamo);

        return view('pagos.edit', compact('pago', 'clientes', 'prestamo'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'monto_pago' => 'required',
            'descripcion' => 'required'
        ]);

        // Encontrar el pago a actualizar
        $pago = Pago::findOrFail($id);
        $montoAnterior = $pago->monto_pago;

        // Actualizar los datos del pago
        $pago->monto_pago = $request->monto_pago;
        $pago->descripcion = $request->descripcion;
        $pago->save();

        $prestamo = Prestamo::findOrFail($pago->id_prestamo);
        $montoAnteriorCancelado = $prestamo->monto_cancelado;
        $montoActualizado = $montoAnteriorCancelado - $montoAnterior;
        $montoCorregido = $montoActualizado + $request->monto_pago;

        // Actualizar el monto_cancelado en el prestamo correspondiente
        $prestamo->monto_cancelado = $montoCorregido;
        $prestamo->save();

        // Registro en la bitácora
        $nombreCliente = $prestamo->cliente->nombre_cliente . ' ' . $prestamo->cliente->apellido_cliente;
        $usuarioId = Auth::id();
        $accion = 'Edición de pago - ID: ' . $id . ', Monto anterior: ' . $montoAnterior . ', Monto actual: ' . $pago->monto_pago . ', Cliente: ' . $nombreCliente . '"';
        $tablaAfectada = 'pagos';
        DB::table('bitacora')->insert([
            'usuario_id' => $usuarioId,
            'accion' => $accion,
            'tabla_afectada' => $tablaAfectada,
            'fecha_registro' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        // Actualizar en la tabla ganancia_dia
        $fechaPago = date('Y-m-d', strtotime($pago->fecha_pago));
        $gananciaDia = GananciaDia::firstOrNew(['fecha' => $fechaPago]);
        $gananciaDia->monto -= $montoAnterior;
        $gananciaDia->monto += $pago->monto_pago;
        $gananciaDia->save();

        // Actualizar en la tabla pagos_ganancia
        $pagosGanancia = PagosGanancia::where('id_pago', $pago->id)->first();
        if ($pagosGanancia) {
            $pagosGanancia->id_ganancia_dia = $gananciaDia->id;
            $pagosGanancia->save();
        }

        // Redirigir al usuario a la página de detalles del pago actualizado
        return redirect()->route('pagos.index', $pago->id);
    }


        //revisar esta pendiente
    public function obtenerPagosPorCliente($clienteId)
    {
        $cliente = Cliente::find($clienteId);

        if ($cliente) {
            $pagos = Pago::whereHas('prestamo', function ($query) use ($clienteId) {
                $query->where('id_cliente', $clienteId);
            })->get();

            return response()->json(['pagos' => $pagos]);
        }

        // Manejar el caso en el que no se encuentre el cliente
        return response()->json(['error' => 'Cliente no encontrado'], 404);
    }
}
