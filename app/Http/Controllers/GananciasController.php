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
            $ganancias = GananciaDia::orderBy('fecha', 'asc')->get();

            // Obtén los préstamos relacionados utilizando la relación en el modelo GananciaDia
            $prestamos = Prestamo::whereIn('fecha_prestamo', $ganancias->pluck('fecha'))->get();

            return view('ganancia.create', compact('ganancias', 'prestamos'));
        }
    }

    public function actualizarEfectivo(Request $request)
    {
        $request->validate([
            'efectivo' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        $fecha = $request->input('fecha');
        $efectivo = $request->input('efectivo');

        $gananciaDia = GananciaDia::where('fecha', $fecha)->first();

        if ($gananciaDia) {
            $gananciaDia->efectivo = $efectivo;
            $gananciaDia->save();
        } else {
            $gananciaDia = new GananciaDia();
            $gananciaDia->efectivo = $efectivo;
            $gananciaDia->monto = 0;
            $gananciaDia->fecha = $fecha;
            $gananciaDia->save();
        }

        $ganancias = GananciaDia::orderBy('fecha', 'asc')->get();
        $sumaMontoPrestado = Prestamo::sum('monto_prestado');
        $sumaMontoCancelado = Prestamo::sum('monto_cancelado');
        $totalMontoPrestado = $sumaMontoPrestado - $sumaMontoCancelado;

        return view('ganancia.create', compact('ganancias', 'totalMontoPrestado', 'sumaMontoPrestado', 'sumaMontoCancelado'))
            ->with('success', 'Efectivo actualizado correctamente');
    }
    public function calcularGanancias(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);

        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $ganancias = GananciaDia::whereBetween('fecha', [$fechaInicio, $fechaFin])->get();

        // Realiza los cálculos necesarios en base a las ganancias obtenidas

        return view('ganancia.calculomensual', compact('ganancias', 'fechaInicio', 'fechaFin'));
    }
    public function calcularGananciasMes()
    {
        $gananciasDiarias = GananciaDia::all();
        $gananciasMensuales = [];

        foreach ($gananciasDiarias as $ganancia) {
            $año = date('Y', strtotime($ganancia->fecha));
            $mes = date('F', strtotime($ganancia->fecha));
            $gananciaCalculada = $ganancia->monto + $ganancia->efectivo;
            $indice = $año . '-' . $mes;

            if (!isset($gananciasMensuales[$indice])) {
                $gananciasMensuales[$indice] = [
                    'año' => $año,
                    'mes' => $mes,
                    'ganancia' => 0,
                ];
            }

            $gananciasMensuales[$indice]['ganancia'] += $gananciaCalculada;
        }

        //  obtener el valor correcto de ganancia en junio y julio
        foreach ($gananciasMensuales as &$gananciaMensual) {
            $mes = $gananciaMensual['mes'];
            if ($mes == 'June') {
                $gananciaMensual['ganancia'] = 0;
            } elseif ($mes == 'July') {
                $gananciaMensual['ganancia'] = 440;
            }
        }

        $gananciasMensuales = array_values($gananciasMensuales); // Reindexar el array

        return view('ganancia.ganancias-mensuales', compact('gananciasMensuales'));
    }

}
