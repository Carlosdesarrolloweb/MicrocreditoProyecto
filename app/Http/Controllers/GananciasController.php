<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GananciasController extends Controller
{
    public function calcularDeuda(Request $request)
    {
        $deuda_general = $request->input('deuda_general');
        $dinero_efectivo = $request->input('dinero_efectivo');

        // Realiza los cálculos necesarios
        $total = $deuda_general + $dinero_efectivo;

        // Retorna la vista con los resultados de los cálculos
        return view('ganancia.create', compact('total'));
    }
}
