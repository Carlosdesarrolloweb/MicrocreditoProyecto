<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Prestamo;
use App\Models\Cliente;
use App\Models\DetallePago;
use Illuminate\Support\Facades\DB;



class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::paginate(10);;
        return view('pagos.index', compact('pagos'));
    }

    public function create()
    {
        $prestamos = Prestamo::all();
        $clientes = Cliente::all();
        return view('pagos.create', compact('prestamos', 'clientes'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'prestamo_id' => 'required|exists:prestamos,id',
            'fecha_pago' => 'required',
            'monto' => 'required|numeric',
        ]);

        DB::transaction(function () use ($request) {
            $pago = new Pago();
            $pago->id_prestamo = $request->prestamo_id;
            $pago->id_usuario = auth()->id();
            $pago->fecha_pago = $request->fecha_pago;
            $pago->monto = $request->monto;
            $pago->save();
        });

        return redirect()->route('pagos.index')->with('status', 'Pago registrado correctamente.');
    }
/*     public function store(Request $request)
{
    $pago = new Pago;
    $pago->id_prestamo = $request->input('id_prestamo');
    $pago->id_usuario = $request->input('id_usuario');
    $pago->save();

    $detalle_pago = new DetallePago;
    $detalle_pago->fecha_pago = now();
    $detalle_pago->monto = $request->input('monto');
    $detalle_pago->id_prestamo = $request->input('id_prestamo');
    $detalle_pago->id_pago = $pago->id;
    $detalle_pago->save();

    return redirect()->route('prestamos.index')->with('success', 'Pago registrado exitosamente');
} */

    public function getPrestamosByCliente($clienteId)
    {
        $prestamos = Prestamo::where('id_cliente', $clienteId)->get();

        return response()->json(['prestamos' => $prestamos]);
    }
    public function obtenerPrestamos(Request $request)
{
    $clienteId = $request->input('cliente_id');
    $prestamos = Prestamo::where('id_cliente', $clienteId)->get();

    return response()->json($prestamos);

}
}