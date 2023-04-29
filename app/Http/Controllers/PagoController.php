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
            'id_cliente' => 'required',
            'id_prestamo'=> 'required',
            // 'monto' => 'required',
            // 'cuota' => 'required',
            'fecha_pago' => 'required',
            'estado' => 'required|boolean',
            'Numero_Cuota' => 'required|integer',
            'monto_pago' => 'required',
            'descripcion' => 'required'

        ]);

        // Crear un nuevo pago
        $pago = new Pago();
        $pago->id_cliente = $request->id_cliente;
        $pago->id_prestamo=$request->id_prestamo;
        $pago->fecha_pago = $request->fecha_pago;
        $pago->estado = $request->cuota >= $request->monto_pago ? true : false;
        $pago->Numero_Cuota = $request->Numero_Cuota;
        $pago->monto_pago  = $request->monto_pago ;
        $pago->descripcion = $request->descripcion;

        $pago->save();

        // Redirigir al usuario a la página de detalles del pago recién creado
        return redirect()->route('pagos.show', $pago->id);
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
}
