<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Prestamo;
use App\Models\Cliente;
use App\Models\DetallePago;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class PagoController extends Controller
{
    public function create()
    {
        $clientes = Cliente::all();
        return view('pagos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $pago = new Pago();
        $pago->id_prestamo = $request->input('id_prestamo');
        $pago->id_usuario = Auth::user()->id;
        $pago->monto_pago = $request->input('monto_pago');
        $pago->save();

        $prestamo = Prestamo::find($request->input('id_prestamo'));
        $prestamo->monto_cancelado += $request->input('monto_pago');
        $prestamo->cantidad_cuotas--;
        $prestamo->save();

        $cliente = $prestamo->cliente;
        $cliente->monto_deuda -= $request->input('monto_pago');
        $cliente->save();

        return redirect()->back()->with('success', 'Pago registrado correctamente.');
    }
}
