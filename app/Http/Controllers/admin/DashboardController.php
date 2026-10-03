<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'participantes' => DB::table('participantes')->count(),

            'participantes_identificados' => DB::table('participantes')
                ->where('es_anonimo', 0)
                ->count(),

            'participantes_anonimos' => DB::table('participantes')
                ->where('es_anonimo', 1)
                ->count(),

            'usuarios' => DB::table('usuarios')
                ->where('activo', 1)
                ->count(),

            'contenidos' => DB::table('contenidos')
                ->where('activo', 1)
                ->count(),

            'quizzes' => DB::table('quizzes')
                ->where('activo', 1)
                ->count(),

            'intentos' => DB::table('intentos_quiz')->count(),

            'aprobados' => DB::table('intentos_quiz')
                ->where('aprobado', 1)
                ->count(),

            'certificados' => DB::table('certificados')
                ->where('estado', 'emitido')
                ->count(),

            'puntos' => (int) DB::table('puntos')->sum('puntos'),

            'insignias' => DB::table('participante_insignia')->count(),

            // NUEVO:
            // Cuenta todas las medallas obtenidas en las escenas.
            'medallas_escenas' => DB::table('avance_escenas')
                ->where('medalla', 1)
                ->count(),
        ];

        $stats['porcentaje_aprobacion'] = $stats['intentos'] > 0
            ? round(($stats['aprobados'] / $stats['intentos']) * 100, 1)
            : 0;

        $stats['progreso_promedio'] = round(
            (float) (DB::table('progreso')->avg('porcentaje_avance') ?? 0),
            1
        );

        $stats['participantes_completaron'] = DB::table('progreso')
            ->where('estado', 'completado')
            ->distinct()
            ->count('participante_id');

        /*
        |--------------------------------------------------------------------------
        | MEDALLAS Y PROGRESO DE ESCENAS
        |--------------------------------------------------------------------------
        |
        | Agrupamos por participante para mostrar:
        | - escenas completadas
        | - medallas obtenidas
        | - porcentaje de recorrido
        |
        | Actualmente el recorrido tiene 4 escenas.
        |
        */
        $totalEscenas = 4;

        $medallasEscenas = DB::table('avance_escenas as ae')
            ->leftJoin(
                'participantes as p',
                'p.id',
                '=',
                'ae.participante_id'
            )
            ->select(
                'ae.participante_id',
                DB::raw("
                    COALESCE(
                        NULLIF(p.nombre_completo, ''),
                        CONCAT('Participante #', ae.participante_id)
                    ) as nombre
                "),
                DB::raw('COUNT(DISTINCT ae.escena) as escenas_completadas'),
                DB::raw('SUM(CASE WHEN ae.medalla = 1 THEN 1 ELSE 0 END) as medallas')
            )
            ->groupBy(
                'ae.participante_id',
                'p.nombre_completo'
            )
            ->orderByDesc('medallas')
            ->orderByDesc('escenas_completadas')
            ->get()
            ->map(function ($item) use ($totalEscenas) {
                $item->total_escenas = $totalEscenas;

                $item->escenas_completadas = (int) $item->escenas_completadas;
                $item->medallas = (int) $item->medallas;

                return $item;
            });

        /*
        |--------------------------------------------------------------------------
        | ACTIVIDAD RECIENTE
        |--------------------------------------------------------------------------
        */

        $actividades = DB::table('registro_actividades as ra')
            ->leftJoin('usuarios as u', 'u.id', '=', 'ra.usuario_id')
            ->select(
                'ra.accion',
                'ra.tabla',
                'ra.descripcion',
                'ra.created_at',
                'u.nombre as usuario_nombre'
            )
            ->orderByDesc('ra.created_at')
            ->limit(8)
            ->get();

        if ($actividades->isEmpty()) {
            $actividades = DB::table('participantes')
                ->select(
                    DB::raw("'Nuevo participante' as accion"),
                    DB::raw("'participantes' as tabla"),
                    DB::raw("
                        CONCAT(
                            'Se registró ',
                            COALESCE(nombre_completo, 'un participante')
                        ) as descripcion
                    "),
                    'created_at',
                    DB::raw('nombre_completo as usuario_nombre')
                )
                ->orderByDesc('created_at')
                ->limit(8)
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | TOP INSTITUCIONES
        |--------------------------------------------------------------------------
        */

        $topInstituciones = DB::table('participantes')
            ->select(
                'institucion',
                DB::raw('COUNT(*) as total')
            )
            ->whereNotNull('institucion')
            ->where('institucion', '<>', '')
            ->groupBy('institucion')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TOP MUNICIPIOS
        |--------------------------------------------------------------------------
        */

        $topMunicipios = DB::table('participantes')
            ->select(
                'municipio',
                DB::raw('COUNT(*) as total')
            )
            ->whereNotNull('municipio')
            ->where('municipio', '<>', '')
            ->groupBy('municipio')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | PROGRESO POR TEMA
        |--------------------------------------------------------------------------
        */

        $progresoTemas = DB::table('progreso as p')
            ->join('temas as t', 't.id', '=', 'p.tema_id')
            ->select(
                't.titulo',
                DB::raw(
                    'ROUND(AVG(p.porcentaje_avance), 1) as promedio'
                )
            )
            ->groupBy(
                't.id',
                't.titulo'
            )
            ->orderBy('t.orden')
            ->limit(6)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'actividades',
            'topInstituciones',
            'topMunicipios',
            'progresoTemas',
            'medallasEscenas'
        ));
    }
}
