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
            'id_interes' => 'required|exists:intereses,id',
            'id_modo_pago' => 'required|exists:modo_pago,id',
        ]);

/*         $Prestamo=new Prestamo();
        $Prestamo->monto_prestamo = $request->monto_prestamo;
        $Prestamo->duracion_prestamo = $request->duracion_prestamo;
        $Prestamo->calculo_cuota = $request->calculo_cuota;
        $Prestamo->cantidad_cuotas = $request->cantidad_cuotas;
        $Prestamo->garantia = $request->garantia;
        $Prestamo->monto_prestado = $request->monto_prestado;
        $Prestamo->monto_cancelado = $request->monto_cancelado;
        $Prestamo->id_cliente = $request->id_cliente;
        $Prestamo->id_usuario = $request->id_usuario;
        $Prestamo->id_interes = $request->id_interes;
        $Prestamo->id_modo_pago = $request->id_modo_pago;


        $Prestamo->save(); */

        Prestamo::create($request->all()); 

        return redirect()->route('prestamos.index')
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
            'monto_prestado' => 'required|numeric',
            'id_cliente' => 'required|exists:clientes,id',
            'id_usuario' => 'required|exists:usuarios,id',
            'id_interes' => 'required|exists:intereses,id',
            'id_modo_pago' => 'required|exists:modos_pago,id',
        ]);

        $prestamo = Prestamo::findOrFail($id);
        $prestamo->update($request->all());

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
}
