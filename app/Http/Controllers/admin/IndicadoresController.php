<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndicadoresController extends Controller
{
    public function index(Request $request)
    {
        $filtros = $request->validate([
            'buscar' => ['nullable', 'string', 'max:120'],
            'quiz_id' => ['nullable', 'integer'],
            'municipio' => ['nullable', 'string', 'max:100'],
            'desde' => ['nullable', 'date'],
            'hasta' => ['nullable', 'date', 'after_or_equal:desde'],
        ]);

        $base = DB::table('intentos_quiz as iq')
            ->join('participantes as p', 'p.id', '=', 'iq.participante_id')
            ->join('quizzes as q', 'q.id', '=', 'iq.quiz_id');

        if (!empty($filtros['buscar'])) {
            $termino = trim($filtros['buscar']);
            $base->where(function ($query) use ($termino) {
                $query->where('p.nombre_completo', 'like', "%{$termino}%")
                    ->orWhere('p.correo', 'like', "%{$termino}%")
                    ->orWhere('p.institucion', 'like', "%{$termino}%")
                    ->orWhere('q.titulo', 'like', "%{$termino}%")
                    ->orWhere('p.municipio', 'like', "%{$termino}%");
            });
        }
        if (!empty($filtros['quiz_id'])) {
            $base->where('iq.quiz_id', $filtros['quiz_id']);
        }
        if (!empty($filtros['municipio'])) {
            $base->where('p.municipio', $filtros['municipio']);
        }
        if (!empty($filtros['desde'])) {
            $base->whereDate('iq.created_at', '>=', $filtros['desde']);
        }
        if (!empty($filtros['hasta'])) {
            $base->whereDate('iq.created_at', '<=', $filtros['hasta']);
        }

        $resumen = (clone $base)->selectRaw('
            COUNT(iq.id) as total_intentos,
            COUNT(DISTINCT iq.participante_id) as participantes_con_prueba,
            SUM(CASE WHEN iq.aprobado = 1 THEN 1 ELSE 0 END) as intentos_aprobados,
            ROUND(AVG(iq.porcentaje), 1) as promedio_porcentaje
        ')->first();

        $totalParticipantes = DB::table('participantes')->count();
        $tasaAprobacion = ($resumen->total_intentos ?? 0) > 0
            ? round((($resumen->intentos_aprobados ?? 0) / $resumen->total_intentos) * 100, 1)
            : 0;

        $intentos = (clone $base)
            ->select([
                'iq.id as intento_id', 'iq.numero_intento', 'iq.puntaje', 'iq.porcentaje',
                'iq.aprobado', 'iq.iniciado_en', 'iq.finalizado_en', 'iq.created_at as registrado_en',
                'p.id as participante_id', 'p.nombre_completo', 'p.es_anonimo', 'p.correo',
                'p.institucion', 'p.grado', 'p.municipio', 'p.zona', 'p.ubicacion_metodo',
                'q.titulo as quiz_titulo',
            ])
            ->orderByDesc('iq.created_at')
            ->paginate(15)
            ->withQueryString();

        // La ubicación disponible corresponde a la registrada para el participante.
        // El esquema actual no guarda una ubicación independiente por cada intento.
        $municipios = DB::table('participantes')
            ->whereNotNull('municipio')->where('municipio', '<>', '')
            ->select('municipio')->distinct()->orderBy('municipio')->pluck('municipio');

        $quizzes = DB::table('quizzes')->orderBy('titulo')->get(['id', 'titulo']);

        $porMunicipio = (clone $base)
            ->selectRaw("COALESCE(NULLIF(p.municipio, ''), 'No registrado') as etiqueta, COUNT(iq.id) as total")
            ->groupBy('etiqueta')->orderByDesc('total')->limit(8)->get();

        $inicioPeriodo = Carbon::now()->subMonths(5)->startOfMonth();
        $mensualRaw = DB::table('intentos_quiz')
            ->where('created_at', '>=', $inicioPeriodo)
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as periodo, COUNT(*) as total")
            ->groupBy('periodo')->pluck('total', 'periodo');

        $meses = [];
        $conteosMeses = [];
        $nombresMes = [1 => 'Ene', 2 => 'Feb', 3 => 'Mar', 4 => 'Abr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Ago', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dic'];
        for ($i = 5; $i >= 0; $i--) {
            $mes = Carbon::now()->startOfMonth()->subMonths($i);
            $clave = $mes->format('Y-m');
            $meses[] = $nombresMes[(int) $mes->format('n')] . ' ' . $mes->format('y');
            $conteosMeses[] = (int) ($mensualRaw[$clave] ?? 0);
        }

        return view('admin.indicadores', [
            'resumen' => $resumen,
            'totalParticipantes' => $totalParticipantes,
            'tasaAprobacion' => $tasaAprobacion,
            'intentos' => $intentos,
            'municipios' => $municipios,
            'quizzes' => $quizzes,
            'filtros' => $filtros,
            'porMunicipio' => $porMunicipio,
            'meses' => $meses,
            'conteosMeses' => $conteosMeses,
        ]);
    }
}
