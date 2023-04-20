<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Interes;
use App\Models\ModoPago;
use App\Models\User;

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
            'garantia' => 'required|max:255',
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
        $Prestamo->garantia = $request->garantia;
        $Prestamo->cantidad_cuotas = $request->cantidad_cuotas;
        $Prestamo->monto_cancelado = $request->monto_cancelado;
        $Prestamo->monto_prestado = $request->monto_prestado;
        $Prestamo->id_cliente = $request->id_cliente;
        $Prestamo->id_usuario = $request->id_usuario;
        $Prestamo->id_interes = $idinteres;
        $Prestamo->id_modo_pago = $request->id_modo_pago;
        $Prestamo->fecha_prestamo = $request->fecha_prestamo;

        $Prestamo->save();

        // Prestamo::create($request->all());

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
            'garantia' => 'required|max:255',
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
        $prestamo->garantia = $request->garantia;
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
        $prestamo->delete();

        return redirect()->route('prestamos.index')
            ->with('success', 'Prestamo eliminado exitosamente.');
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
}
