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
            'id_cliente' => 'required|exists:clientes,id',
            'monto' => 'required',
            'cuota' => 'required',
            'fecha_pago' => 'required',
            'estado' => 'required|boolean',
            'numero_cuota' => 'required|integer',
        ]);

        // Crear un nuevo pago
        $pago = new Pago();
        $pago->cliente_id = $request->id_cliente;
        $pago->monto = $request->monto;
        $pago->cuota = $request->cuota;
        $pago->fecha_pago = $request->fecha_pago;
        $pago->estado = $request->estado;
        $pago->numero_cuota = $request->numero_cuota;
        $pago->save();

        // Redirigir al usuario a la página de detalles del pago recién creado
        return redirect()->route('pagos.show', $pago->id);
    }
    public function obtenerPorCliente($clienteId)
{
    $prestamo = Prestamo::where('id_cliente', $clienteId)->get();

    return response()->json(['prestamo' => $prestamo]);
  /*       'monto' => $prestamo->monto,
        'cuota' => $prestamo->cuota,
        'numero_cuota' => $prestamo->numero_cuota, */





}
}
