<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garantia;
use App\Models\Cliente;
use App\Models\Prestamo;
use App\Models\Foto;

class GarantiaController extends Controller
{
    public function create()
    {
        $clientes = Cliente::all();
        return view('garantias.create', compact('clientes'));


    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'garantia' => 'required|max:255',
            'Valor_Prenda' => 'required|max:255',
            'Detalle_Prenda' => 'required|max:255',
            'id_cliente' => 'required',
            'foto' => 'required|image|max:2048'
        ]);

        $prestamo = Prestamo::where('id_cliente', $request->id_cliente)->first();

        $garantia = new Garantia();
        $garantia->garantia = $validated['garantia'];
        $garantia->Valor_Prenda = $validated['Valor_Prenda'];
        $garantia->Detalle_Prenda = $validated['Detalle'];
        $garantia->id_cliente = $validated['id_cliente'];
        $garantia->id_prestamo = $prestamo->id;
        $garantia->save();

        $foto = new Foto();
        $foto->nombre = $request->file('foto')->getClientOriginalName();
        $foto->url = $request->file('foto')->store('public/fotos');
        $foto->id_garantia = $garantia->id;
        $foto->save();

        return redirect()->route('garantias.index')->with('success', 'Garantía creada exitosamente.');
    }

    public function index()
    {
        $garantias = Garantia::all();
        return view('garantias.index', compact('garantias'));
    }
    public function getDatosPrestamo($clienteId) {
        $prestamo = Prestamo::where('cliente_id', $clienteId)->first();
        return response()->json($prestamo);
    }
}
