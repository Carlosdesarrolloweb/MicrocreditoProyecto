<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function index()
    {
        $prestamos = Prestamo::with(['cliente', 'usuario', 'interes', 'modoPago'])->get();
        return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        return view('prestamos.create');
    }

    public function store(Request $request)
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
