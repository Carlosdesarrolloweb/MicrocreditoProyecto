<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciudad;
use App\Models\Zona;

class CiudadController extends Controller
{
    public function index()
    {

    $zonas = Zona::all();
    $ciudades = Ciudad::with('zona')->get();

    return view('ciudades.create', compact('zonas', 'ciudades'));
    }

    public function store(Request $request)
    {
        $ciudad = Ciudad::create([
            'cod_ciudad' => $request->cod_ciudad,
            'nombre_ciudad' => $request->nombre_ciudad,
            'zona_id' => $request->zona_id
        ]);

        return redirect()->route('ciudades.create');
    }
    public function create()
{
    $zonas = Zona::all();
    $ciudades = Ciudad::all();


    // Pasar las zonas a la vista
    return view('ciudad.create', compact('zonas', 'ciudades'));
}

public function edit($id)
{
    $ciudad = Ciudad::findOrFail($id);
    $zonas = Zona::all();

    return view('ciudad.edit', compact('ciudad', 'zonas'));
}

public function update(Request $request, $id)
{
    $ciudad = Ciudad::findOrFail($id);

    $ciudad->cod_ciudad = $request->cod_ciudad;
    $ciudad->nombre_ciudad = $request->nombre_ciudad;
    $ciudad->zona_id = $request->zona_id;

    $ciudad->save();

    return redirect()->route('ciudades.create');
}
public function obtenerCiudades()
{
    $ciudades = Ciudad::all();

    $data = [];
    foreach ($ciudades as $ciudad) {
        $data[] = [
            'nombre_ciudad' => $ciudad->nombre_ciudad,
        ];
    }

    return response()->json($data);
}
public function obtenerPrestamosPorCiudad()
{
    $ciudades = Ciudad::withCount('prestamos')->get();

    $data = [];
    foreach ($ciudades as $ciudad) {
        $data[] = [
            'nombre_ciudad' => $ciudad->nombre_ciudad,
            'cantidad_prestamos' => $ciudad->prestamos_count,
        ];
    }

    return response()->json($data);
}

}
