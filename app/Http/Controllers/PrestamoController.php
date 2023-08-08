<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Interes;
use App\Models\ModoPago;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    public function index()
    {
        $prestamos = Prestamo::with(['cliente', 'usuario', 'interes', 'modoPago'])->get();
        return view('prestamos.index', compact('prestamos'));

    }

    public function create()
    {
        $clientes = Cliente::all();
        $intereses =  Interes::all();
        $modo_pago = ModoPago::all();
        $users = User::all();
        return view('prestamos.create',compact("clientes","intereses","modo_pago","users"));

    }

    public function store(Request $request)
    {

        $request->validate([
            'monto_prestamo' => 'required|numeric',
            'duracion_prestamo' => 'required|numeric',
            'calculo_cuota' => 'required|numeric',
            'ganancia' => 'required|max:255',
            'cantidad_cuotas' => 'required|numeric',
            'monto_cancelado' => 'required|numeric',
            'monto_prestado' => 'required|numeric',
            'id_cliente' => 'required|exists:clientes,id',
            'id_usuario' => 'required|exists:users,id',
            // 'id_interes' => 'required|exists:intereses,id',
            'id_modo_pago' => 'required|exists:modo_pago,id',
            'fecha_prestamo'=> 'required',
        ]);

        $interes=Interes::where('interes_prestamo',$request->id_interes)->first();
        $idinteres= $interes->id;

        $Prestamo=new Prestamo();
        $Prestamo->monto_prestamo = $request->monto_prestamo;
        $Prestamo->duracion_prestamo = $request->duracion_prestamo;
        $Prestamo->calculo_cuota = $request->calculo_cuota;
        $Prestamo->ganancia = $request->ganancia;
        $Prestamo->cantidad_cuotas = $request->cantidad_cuotas;
        $Prestamo->monto_cancelado = $request->monto_cancelado;
        $Prestamo->monto_prestado = $request->monto_prestado;
        $Prestamo->id_cliente = $request->id_cliente;
        $Prestamo->id_usuario = $request->id_usuario;
        $Prestamo->id_interes = $idinteres;
        $Prestamo->id_modo_pago = $request->id_modo_pago;
        $Prestamo->fecha_prestamo = $request->fecha_prestamo;
        $Prestamo->estado=false;
        $Prestamo->save();

            // Obténer los valores necesarios para el registro en la bitácora
        $clienteNombre = $Prestamo->cliente->nombre_cliente;
        $clienteApellido = $Prestamo->cliente->apellido_cliente;

        // Registro en la bitácora
        $usuarioId = Auth::id();
        $accion = 'Creación de préstamo - "Monto: ' . $Prestamo->monto_prestamo . ', Duración: ' . $Prestamo->duracion_prestamo . ' meses, Cliente: ' . $clienteNombre . ' ' . $clienteApellido . '"';
        $tablaAfectada = 'prestamo';
        DB::table('bitacora')->insert([
            'usuario_id' => $usuarioId,
            'accion' => $accion,
            'tabla_afectada' => $tablaAfectada,
            'fecha_registro' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        return redirect()->route('prestamos.create')
            ->with('success', 'Prestamo creado exitosamente.');
    }

    public function show($id)
    {
        $prestamo = Prestamo::with(['cliente', 'usuario', 'interes', 'modoPago'])->findOrFail($id);
        return view('prestamos.show', compact('prestamo'));
    }

    public function edit($id)
    {
        $prestamo = Prestamo::with(['cliente', 'usuario', 'interes', 'modoPago'])->findOrFail($id);
        return view('prestamos.edit', compact('prestamo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'monto_prestamo' => 'required|numeric',
            'duracion_prestamo' => 'required|numeric',
            'calculo_cuota' => 'required|numeric',
            'ganancia' => 'required|max:255',
            'cantidad_cuotas' => 'required|numeric',
            'monto_cancelado' => 'required|numeric',
            'monto_prestado' => 'required|numeric',
            'id_cliente' => 'required|exists:clientes,id',
            'id_usuario' => 'required|exists:users,id',
            // 'id_interes' => 'required|exists:intereses,id',
            'id_modo_pago' => 'required|exists:modo_pago,id',
            'fecha_prestamo'=> 'required',
        ]);

        $interes=Interes::where('interes_prestamo',$request->id_interes)->first();
        $idinteres= $interes->id;

        $prestamo = Prestamo::findOrFail($id);
        $prestamo->monto_prestamo = $request->monto_prestamo;
        $prestamo->duracion_prestamo = $request->duracion_prestamo;
        $prestamo->calculo_cuota = $request->calculo_cuota;
        $prestamo->ganancia = $request->ganancia;
        $prestamo->cantidad_cuotas = $request->cantidad_cuotas;
        $prestamo->monto_cancelado = $request->monto_cancelado;
        $prestamo->monto_prestado = $request->monto_prestado;
        $prestamo->id_cliente = $request->id_cliente;
        $prestamo->id_usuario = $request->id_usuario;
        $prestamo->id_interes = $idinteres;
        $prestamo->id_modo_pago = $request->id_modo_pago;
        $prestamo->fecha_prestamo = $request->fecha_prestamo;
        $prestamo->save();


        // $prestamo->update($request->all());

        return redirect()->route('prestamos.index')
            ->with('success', 'Prestamo actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $prestamo = Prestamo::findOrFail($id);
        $pagos = $prestamo->pagos;
        $montoPrestamo = $prestamo->monto_prestamo;
        $nombreCliente = $prestamo->cliente->nombre_cliente . ' ' . $prestamo->cliente->apellido_cliente;

        if ($prestamo->monto_cancelado == 0 && $pagos->isEmpty()) {

                // Registro en la bitácora
            $usuarioId = Auth::id();
            $accion = 'Eliminación de préstamo - "Monto: ' . $montoPrestamo . ', Cliente: ' . $nombreCliente . '"';
            $tablaAfectada = 'prestamo';
            DB::table('bitacora')->insert([
                'usuario_id' => $usuarioId,
                'accion' => $accion,
                'tabla_afectada' => $tablaAfectada,
                'fecha_registro' => DB::raw('CURRENT_TIMESTAMP')
            ]);
            $prestamo->delete();

            return redirect()->route('prestamos.index')
                ->with('success', 'Préstamo eliminado exitosamente.');
        } else {
            return redirect()->route('prestamos.index')
                ->with('error', 'No se puede eliminar el préstamo. Verifica que el monto cancelado sea 0 y que no haya pagos asociados al préstamo.');
        }
    }
    public function buscarPrestamo($cliente_id)
    {
    $prestamo = Prestamo::where('cliente_id', $cliente_id)->first();
    return response()->json(['id' => $prestamo->id, 'monto' => $prestamo->monto]);
    }
    public function getPrestamosByCliente($clienteId)
    {
    $prestamos = Prestamo::where('cliente_id', $clienteId)->with('pagos')->get();

    return view('prestamos.index', ['prestamos' => $prestamos]);
    }

     //dashboard

    public function clientesprestamo()
    {
         $clientes = Cliente::all();
         $cantidad_clientes = Cliente::count();
         $cantidad_clientes_con_prestamo = Cliente::has('prestamos')->count();


         return view('dashboard', compact('clientes', 'cantidad_clientes', 'cantidad_clientes_con_prestamo'));
    }
    public function obtenerDatosPrestamografico()
    {
    $datosPrestamo = Prestamo::select('fecha_prestamo', DB::raw('SUM(monto_prestado) as total_monto_prestado'))
        ->groupBy('fecha_prestamo')
        ->get();

    return response()->json($datosPrestamo);
    }

  /*   public function mostrarTarjeta()
    {
        $suma_monto_prestado = Prestamo::sum('monto_prestado');
        dd($suma_monto_prestado);
        return view('dashboard', compact('suma_monto_prestado'));
    } */

    public function obtenerRegistrosPorModoPago()
    {
        $registrosPorModoPago = Prestamo::with('modoPago')
            ->select('id_modo_pago', DB::raw('count(*) as cantidad_registros'))
            ->groupBy('id_modo_pago')
            ->get();

        $data = [];
        foreach ($registrosPorModoPago as $registro) {
            $data[] = [
                'modalidad_pago' => $registro->modoPago->modalidad_pago,
                'cantidad_registros' => $registro->cantidad_registros,
            ];
        }

        return response()->json($data);
    }
    public function obtenerEstadosPrestamos()
    {
        $estadosPrestamos = Prestamo::select(DB::raw('estado, count(*) as cantidad'))
            ->groupBy('estado')
            ->get();

        return response()->json($estadosPrestamos);
    }
}
