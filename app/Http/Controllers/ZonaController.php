<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Illuminate\Http\Request;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zonas = Zona::all();
        return view('zona.index', compact('zonas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zona.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cod_zona' => 'required|unique:zonas',
            'nombre_zona' => 'required',
        ]);

        // Busca una zona con el mismo código
        $zona = Zona::where('cod_zona', $request->cod_zona)->first();

        if ($zona) {
            return redirect()->back()
                             ->withInput($request->input())
                             ->with('success', 'Ya existe una zona con este código.')
                             ->with('zona', $zona);
        }

        // Crea la zona
        Zona::create([
            'cod_zona' => $request->cod_zona,
            'nombre_zona' => $request->nombre_zona,
        ]);

        return redirect()->route('zonas.index')
                         ->with('success', 'Zona creada exitosamente.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function show(Zona $zona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zona = Zona::find($id);
        return view('zona.edit', ['zona' => $zona]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $zona = Zona::findOrFail($id);
        $zona->cod_zona = $request->cod_zona;
        $zona->nombre_zona = $request->nombre_zona;
        $zona->save();

        return redirect()->route('zonas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zona $zona)
    {
        //
    }
    public function buscarZona($cod_zona)
    {
    $zona = Zona::where('cod_zona', $cod_zona)->first();

    if ($zona) {
        return response()->json(['nombre_zona' => $zona->nombre_zona]);
    }

    return response()->json(['nombre_zona' => '']);
    }

    public function getByName(Request $request)
    {
    $zona = Zona::where('cod_zona', $request->cod_zona)->first();

    return response()->json($zona);
    }
}
