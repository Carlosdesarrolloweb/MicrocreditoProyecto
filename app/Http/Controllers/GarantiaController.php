<?php

namespace App\Http\Controllers;

use App\Models\Garantia;
use App\Models\Cliente;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GarantiaController extends Controller
{
    public function create()
    {
        $clientes = Cliente::all();
        $prestamos = Prestamo::all();

        return view('garantias.create', compact('clientes', 'prestamos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'garantia' => 'required|string|max:255',
            'Valor_Prenda' => 'required|string|max:255',
            'Detalle_Prenda' => 'required|string|max:255',
            'id_cliente' => 'required|integer|exists:clientes,id',
            'id_prestamo' => 'required|integer',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $garantia = Garantia::create($request->all());

        // Verificar si se subió una foto
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $filename = $garantia->cliente->Carnet_cliente . '/' . time() . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('public/garantias/' . $garantia->cliente->Carnet_cliente, $image, $filename);

            // Actualizar el campo de la foto en la garantía
            $garantia->id_foto = $filename;
            $garantia->save();
        }

        return redirect()->route('garantias.index')->with('success', 'Garantía creada exitosamente.');
    }
    public function getPrestamosCliente(Cliente $cliente)
    {
        $ids_prestamos_con_garantia = Garantia::pluck('id_prestamo')->toArray();

        $prestamos = $cliente->prestamos()
            ->select('id', 'monto_prestamo')
            ->whereNotIn('id', $ids_prestamos_con_garantia)
            ->get();

        return $prestamos;

    }

}
