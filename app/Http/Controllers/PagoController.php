<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pago;
use App\Models\Cliente;
use App\Models\Prestamo;

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
        // dd($request);
        // Crear un nuevo pago
        $pago = new Pago();
        $pago->id_prestamo=$request->id_prestamo;
        $pago->fecha_pago = $request->fecha_pago;
        $pago->estado = $request->cuota >= $request->monto_pago ? true : false;
        $pago->Numero_Cuota = $request->Numero_Cuota;
        $pago->monto_pago  = $request->monto_pago ;
        $pago->descripcion = $request->descripcion;

        $pago->save();

        $prestamo = Prestamo::findOrFail($request->id_prestamo);
        $montoactual=$prestamo->monto_cancelado;
        $prestamo->monto_cancelado=($montoactual+$request->monto_pago);
        $prestamo->save();


        // Redirigir al usuario a la página de detalles del pago recién creado
        // return redirect()->route('pagos.show', $pago->id);
        return redirect()->route('pagos.index');
    }
    public function obtenerPorCliente($clienteId)
    {
    $prestamo = Prestamo::where('id_cliente', $clienteId)->first();

    return response()->json(['prestamo' => $prestamo,'cuota'=>$this->suma($prestamo->id)]);
  /*       'monto' => $prestamo->monto,
        'cuota' => $prestamo->cuota,
        'numero_cuota' => $prestamo->numero_cuota, */
    }

    public function suma($id_prestamo)
    {
        return intval(Pago::where('id_prestamo',$id_prestamo)->sum('id_prestamo'))+1;
    }
    public function index()
{
    $pagos = Pago::all();
    return view('pagos.index', compact('pagos'));
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
    $montoanterior= $pago->monto_pago;
    // Actualizar los datos del pago
    $pago->monto_pago = $request->monto_pago;
    $pago->descripcion = $request->descripcion;

    $pago->save();

    $prestamo = Prestamo::findOrFail($pago->id_prestamo);
    $montoanteriorcancelado= $prestamo->monto_cancelado;
    $montoactualizado= $montoanteriorcancelado-$montoanterior;
    $montocorregido= $montoactualizado + $request->monto_pago;
    // Actualizar el monto_cancelado en el prestamo correspondiente
    // $prestamo = $pago->prestamo;
    $prestamo->monto_cancelado = $montocorregido;
    $prestamo->save();

    // Redirigir al usuario a la página de detalles del pago actualizado
    return redirect()->route('pagos.index', $pago->id);
}
}
