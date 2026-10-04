<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Exports\ReporteExportExcel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportesController extends Controller
{
    private function filtros(Request $request): array
    {
        return $request->validate([
            'desde' => ['nullable', 'date'],
            'hasta' => ['nullable', 'date', 'after_or_equal:desde'],
            'zona' => ['nullable', 'string', 'max:150'],
            'rol' => ['nullable', 'string', 'max:100'],
            'municipio' => ['nullable', 'string', 'max:150'],
            'estado' => ['nullable', 'in:todos,identificados,anonimos'],
            'buscar' => ['nullable', 'string', 'max:150'],
            'tipo' => ['nullable', 'in:general,participantes,escenas,ubicacion,medallas'],
        ]);
    }

    private function participantesQuery(array $filtros)
    {
        $q = DB::table('participantes as p')
            ->leftJoin('avatares as a', 'a.id', '=', 'p.avatar_id');

        if (!empty($filtros['desde'])) $q->whereDate('p.created_at', '>=', $filtros['desde']);
        if (!empty($filtros['hasta'])) $q->whereDate('p.created_at', '<=', $filtros['hasta']);
        if (!empty($filtros['zona'])) $q->whereRaw('LOWER(TRIM(p.zona)) = ?', [mb_strtolower(trim($filtros['zona']))]);
        if (!empty($filtros['rol'])) $q->whereRaw('LOWER(TRIM(p.rol_familiar)) = ?', [mb_strtolower(trim($filtros['rol']))]);
        if (!empty($filtros['municipio'])) $q->whereRaw('LOWER(TRIM(p.municipio)) = ?', [mb_strtolower(trim($filtros['municipio']))]);
        if (($filtros['estado'] ?? 'todos') === 'identificados') $q->where('p.es_anonimo', 0);
        if (($filtros['estado'] ?? 'todos') === 'anonimos') $q->where('p.es_anonimo', 1);
        if (!empty($filtros['buscar'])) {
            $s = trim($filtros['buscar']);
            $q->where(function ($w) use ($s) {
                $w->where('p.nombre_completo', 'like', "%{$s}%")
                    ->orWhere('p.numero_documento', 'like', "%{$s}%")
                    ->orWhere('p.correo', 'like', "%{$s}%")
                    ->orWhere('p.institucion', 'like', "%{$s}%");
            });
        }

        return $q;
    }

    private function datosParticipantes(array $filtros): array
    {
        $rows = $this->participantesQuery($filtros)
            ->leftJoinSub(
                DB::table('avance_escenas')
                    ->selectRaw('participante_id, COUNT(*) escenas, COALESCE(SUM(xp),0) xp, COALESCE(SUM(medalla),0) medallas, COALESCE(SUM(aciertos),0) aciertos, COALESCE(SUM(total_preguntas),0) total_preguntas')
                    ->groupBy('participante_id'),
                'ae', 'ae.participante_id', '=', 'p.id'
            )
            ->select(
                'p.id', 'p.nombre_completo', 'p.tipo_documento', 'p.numero_documento', 'p.edad',
                'p.institucion', 'p.grado', 'p.correo', 'p.telefono', 'p.rol_familiar',
                'p.municipio', 'p.zona', 'p.latitud', 'p.longitud', 'p.ubicacion_metodo',
                'p.es_anonimo', 'p.created_at', 'a.nombre as avatar',
                DB::raw('COALESCE(ae.escenas,0) as escenas'),
                DB::raw('COALESCE(ae.xp,0) as xp'),
                DB::raw('COALESCE(ae.medallas,0) as medallas'),
                DB::raw('COALESCE(ae.aciertos,0) as aciertos'),
                DB::raw('COALESCE(ae.total_preguntas,0) as total_preguntas')
            )
            ->orderByDesc('p.created_at')
            ->get();

        return $rows->map(function ($r) {
            $r->porcentaje_aciertos = (int)$r->total_preguntas > 0
                ? round(((int)$r->aciertos / (int)$r->total_preguntas) * 100, 1)
                : 0;
            return $r;
        })->all();
    }

    private function nombreArchivo(string $tipo, array $filtros, string $ext): string
    {
        return 'reporte-' . $tipo . '-' . now()->format('Y-m-d_H-i-s') . '.' . $ext;
    }

    public function index(Request $request)
    {
        return redirect()->route('admin.estadisticas.index', $request->query());
    }

    public function csv(Request $request): StreamedResponse
    {
        $f = $this->filtros($request);
        $rows = $this->datosParticipantes($f);
        $tipo = $f['tipo'] ?? 'general';
        $filename = $this->nombreArchivo($tipo, $f, 'csv');

        return response()->streamDownload(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, ['ID','Nombre','Tipo documento','Documento','Edad','Institución','Grado','Correo','Teléfono','Rol familiar','Municipio','Zona','Latitud','Longitud','Método ubicación','Estado','Avatar','Escenas','XP','Medallas','Aciertos','Preguntas','% aciertos','Fecha registro'], ';');
            foreach ($rows as $r) {
                fputcsv($out, [
                    $r->id, $r->nombre_completo, $r->tipo_documento, $r->numero_documento, $r->edad,
                    $r->institucion, $r->grado, $r->correo, $r->telefono, $r->rol_familiar,
                    $r->municipio, $r->zona, $r->latitud, $r->longitud, $r->ubicacion_metodo,
                    $r->es_anonimo ? 'Anónimo' : 'Identificado', $r->avatar, $r->escenas, $r->xp,
                    $r->medallas, $r->aciertos, $r->total_preguntas, $r->porcentaje_aciertos,
                    $r->created_at,
                ], ';');
            }
            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function excel(Request $request)
    {
        $f = $this->filtros($request);
        $rows = collect($this->datosParticipantes($f));
        $tipo = $f['tipo'] ?? 'general';

        return Excel::download(
            new ReporteExportExcel($rows),
            $this->nombreArchivo($tipo, $f, 'xlsx')
        );
    }

    public function pdf(Request $request)
    {
        $f = $this->filtros($request);
        $rows = $this->datosParticipantes($f);
        $tipo = $f['tipo'] ?? 'general';

        $resumen = [
            'total' => count($rows),
            'identificados' => collect($rows)->where('es_anonimo', false)->count(),
            'anonimos' => collect($rows)->where('es_anonimo', true)->count(),
            'con_avance' => collect($rows)->where('escenas', '>', 0)->count(),
            'medallas' => collect($rows)->sum('medallas'),
            'xp' => collect($rows)->sum('xp'),
        ];

        $pdf = Pdf::loadView('admin.reportes.pdf', [
            'rows' => $rows,
            'filtros' => $f,
            'resumen' => $resumen,
            'tipo' => $tipo,
        ])->setPaper('a4', 'landscape');

        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $this->nombreArchivo($tipo, $f, 'pdf') . '"',
            'Cache-Control' => 'private, no-store',
        ]);
    }
}
