<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Prestamo;
use App\Models\Pago;

class PagoController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        $pagos = Pago::all();

        return view('pagos.index', compact('clientes','pagos'));


    }

/*     public function getMontoCuota(Request $request)
    {
        $prestamo = Prestamo::where('id_cliente', $request->input('cliente_id'))->first();

        if (!$prestamo) {
            return response()->json(['error' => 'No se encontró un préstamo para este cliente. Por favor, ingrese un préstamo válido.'], 404);
        }

        $monto_cuota = $prestamo->monto_prestamo / $prestamo->cantidad_cuotas;

        return response()->json([
            'monto_cuota' => $monto_cuota,
        ]);
    } */



    public function getMontoCuota(Request $request)
{
    $prestamo = Prestamo::where('id_cliente', $request->input('cliente_id'))->first();

    if (!$prestamo) {
        return response()->json(['error' => 'No se encontró un préstamo para este cliente.'], 404);
    }

    return response()->json([
        'monto_cuota' => $prestamo->monto_prestamo / $prestamo->cantidad_cuotas,
    ]);
}
    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'prestamo_id' => 'required|exists:prestamos,id',
            'monto_pagado' => 'required|numeric',
            'fecha_pago' => 'required|date',
        ]);

        $pago = new Pago;
        $pago->id_cliente = $data['cliente_id'];
        $pago->id_prestamo = $data['prestamo_id'];
        $pago->monto_pagado = $data['monto_pagado'];
        $pago->fecha_pago = $data['fecha_pago'];
        $pago->save();

        return redirect()->route('pagos.index')->with('success', 'Pago registrado correctamente.');
    }

}
