<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'desde' => ['nullable', 'date'],
            'hasta' => ['nullable', 'date', 'after_or_equal:desde'],
            'zona'  => ['nullable', 'string', 'max:100'],
        ]);

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $zonaSeleccionada = $request->input('zona');

        // Área aproximada urbana de Armenia. Evita puntos muy alejados que
        // distorsionan la visualización; no representa un límite oficial.
        $latMin = 4.48;
        $latMax = 4.60;
        $lonMin = -75.75;
        $lonMax = -75.60;

        $base = DB::table('participantes')
            ->where('municipio', 'like', '%Armenia%');

        if ($desde) {
            $base->whereDate('created_at', '>=', $desde);
        }
        if ($hasta) {
            $base->whereDate('created_at', '<=', $hasta);
        }
        if ($zonaSeleccionada) {
            $base->where('zona', $zonaSeleccionada);
        }

        $totalParticipantes = (clone $base)->count();
        $totalAnonimos = (clone $base)->where('es_anonimo', 1)->count();

        $totalGeolocalizados = (clone $base)
            ->whereNotNull('latitud')
            ->whereNotNull('longitud')
            ->whereBetween('latitud', [$latMin, $latMax])
            ->whereBetween('longitud', [$lonMin, $lonMax])
            ->count();

        $zonas = DB::table('participantes')
            ->where('municipio', 'like', '%Armenia%')
            ->whereNotNull('zona')
            ->where('zona', '<>', '')
            ->select('zona')
            ->distinct()
            ->orderBy('zona')
            ->pluck('zona');

        $resumenZonas = (clone $base)
            ->select('zona', DB::raw('COUNT(*) as total'))
            ->whereNotNull('zona')
            ->where('zona', '<>', '')
            ->groupBy('zona')
            ->orderByDesc('total')
            ->get();

        // Solo coordenadas: no se exponen nombres, teléfonos ni otros datos personales.
        $puntosMapa = (clone $base)
            ->whereNotNull('latitud')
            ->whereNotNull('longitud')
            ->whereBetween('latitud', [$latMin, $latMax])
            ->whereBetween('longitud', [$lonMin, $lonMax])
            ->get(['latitud', 'longitud'])
            ->map(function ($registro) {
                return [
                    (float) $registro->latitud,
                    (float) $registro->longitud,
                    1.0,
                ];
            })
            ->values();

        return view('admin.estadisticas.index', compact(
            'desde',
            'hasta',
            'zonaSeleccionada',
            'totalParticipantes',
            'totalAnonimos',
            'totalGeolocalizados',
            'zonas',
            'resumenZonas',
            'puntosMapa'
        ));
    }
}
