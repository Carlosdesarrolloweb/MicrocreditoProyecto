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
        $ganancias = GananciaDia::all(); // Obtener las ganancias diarias

        $gananciasMensuales = $ganancias->groupBy(function ($item) {
            // Convertir la cadena de fecha en un objeto DateTime
            $fecha = new \DateTime($item->fecha);

            // Agrupamos las ganancias por año y mes
            return $fecha->format('Y-m');
        })->map(function ($group) {
            // Sumar la columna ganancia para cada grupo
            $sumaGanancia = $group->sum('ganancia');

            // Obtener el año y mes del primer elemento en el grupo
            $fecha = new \DateTime($group->first()->fecha);
            $año = $fecha->format('Y');
            $mes = $fecha->format('F'); // Obtener el nombre del mes en inglés

            return [
                'año' => $año,
                'mes' => $mes,
                'ganancia' => $sumaGanancia
            ];
        })->values();

        return view('ganancia.ganancias-mensuales', compact('gananciasMensuales'));
    }

}
