<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    public function index()
    {
        $prestamos = DB::table('prestamo')->get();
        return view('prestamos.index', ['prestamos' => $prestamos]);
    }

    public function create()
    {
        $clientes = DB::table('cliente')->get();
        return view('prestamos.create', ['clientes' => $clientes]);
    }

    public function store(Request $request)
    {
        DB::table('prestamo')->insert([
            'monto_prestamo' => $request->input('monto_prestamo'),
            'duracion_prestamo' => $request->input('duracion_prestamo'),
            'calculo_cuota' => $request->input('calculo_cuota'),
            'garantia' => $request->input('garantia'),
            'cantidad_cuotas' => $request->input('cantidad_cuotas'),
            'monto_pagado' => $request->input('monto_pagado'),
            'id_cliente' => $request->input('id_cliente'),
        ]);

        return redirect()->route('prestamos.index')
                         ->with('success','Préstamo creado satisfactoriamente');
    }

    public function edit($id)
    {
        $prestamo = DB::table('prestamo')->where('id', $id)->first();
        $clientes = DB::table('cliente')->get();
        return view('prestamos.edit', ['prestamo' => $prestamo, 'clientes' => $clientes]);
    }

    public function update(Request $request, $id)
    {
        DB::table('prestamo')->where('id', $id)->update([
            'monto_prestamo' => $request->input('monto_prestamo'),
            'duracion_prestamo' => $request->input('duracion_prestamo'),
            'calculo_cuota' => $request->input('calculo_cuota'),
            'garantia' => $request->input('garantia'),
            'cantidad_cuotas' => $request->input('cantidad_cuotas'),
            'monto_pagado' => $request->input('monto_pagado'),
            'id_cliente' => $request->input('id_cliente'),
        ]);

        return redirect()->route('prestamos.index')
                         ->with('success','Préstamo actualizado satisfactoriamente');
    }

    public function destroy($id)
    {
        DB::table('prestamo')->where('id', $id)->delete();
        return redirect()->route('prestamos.index')
                         ->with('success','Préstamo eliminado satisfactoriamente');
    }
}
