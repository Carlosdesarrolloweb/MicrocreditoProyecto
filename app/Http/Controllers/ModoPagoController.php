<?php

namespace App\Http\Controllers;

use App\Models\ModoPago;
use Illuminate\Http\Request;

class ModoPagoController extends Controller
{
    public function index()
    {
        $modosPago = ModoPago::all();

        return view('modos_pago.index', compact('modosPago'));
    }

    public function create()
    {
        return view('modos_pago.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'modalidad_pago' => 'required|unique:modo_pago|max:255'
        ]);

        ModoPago::create([
            'modalidad_pago' => $request->modalidad_pago
        ]);

        return redirect()->route('modos_pago.index')->with('success', 'Modo de pago agregado exitosamente.');
    }

    public function edit($id)
    {
        $modoPago = ModoPago::findOrFail($id);
        return view('modos_pago.edit', compact('modoPago'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'modalidad_pago' => 'required|unique:modo_pago|max:255'
        ]);

        $modoPago = ModoPago::findOrFail($id);
        $modoPago->update([
            'modalidad_pago' => $request->modalidad_pago
        ]);

        return redirect()->route('modos_pago.index')->with('success', 'Modo de pago actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $modoPago = ModoPago::findOrFail($id);
        $modoPago->delete();

        return redirect()->route('modosPago.index')->with('success', 'Modo de pago eliminado exitosamente.');
    }


}
