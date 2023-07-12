<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GananciaDia;
use App\Models\Prestamo;

class GananciasController extends Controller
{
    public function mostrarFormularioEfectivo()
    {
        {
            $ganancias = GananciaDia::orderBy('fecha', 'desc')->get();

            // Obtén los préstamos relacionados utilizando la relación en el modelo GananciaDia
            $prestamos = Prestamo::whereIn('fecha_prestamo', $ganancias->pluck('fecha'))->get();

            return view('ganancia.create', compact('ganancias', 'prestamos'));
        }
    }

    public function actualizarEfectivo(Request $request)
    {
        $request->validate([
            'efectivo' => 'required|numeric',
        ]);

        $gananciaDia = GananciaDia::where('fecha', date('Y-m-d'))->first();

        if ($gananciaDia) {
            $gananciaDia->efectivo = $request->efectivo;
            $gananciaDia->save();
        } else {
            $gananciaDia = new GananciaDia();
            $gananciaDia->efectivo = $request->efectivo;
            $gananciaDia->monto = 0;
            $gananciaDia->fecha = date('Y-m-d');
            $gananciaDia->save();
        }

        $ganancias = GananciaDia::orderBy('fecha', 'desc')->get();
        $sumaMontoPrestado = Prestamo::sum('monto_prestado');
        $sumaMontoCancelado = Prestamo::sum('monto_cancelado');
        $totalMontoPrestado = $sumaMontoPrestado - $sumaMontoCancelado;

        return view('ganancia.create', compact('ganancias', 'totalMontoPrestado', 'sumaMontoPrestado', 'sumaMontoCancelado'))
            ->with('success', 'Efectivo actualizado correctamente');
    }
}
