<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class IndicadoresController extends Controller
{
    /** Escenas del recorrido (número => nombre). */
    private const ESCENAS = [1 => 'Reconocer', 2 => 'Entender', 3 => 'Hablar', 4 => 'Prevenir'];

    public function index(Request $request)
    {
        $filtros = $request->validate([
            'buscar'    => ['nullable', 'string', 'max:120'],
            'municipio' => ['nullable', 'string', 'max:100'],
            'rol'       => ['nullable', 'string', 'max:30'],
            'desde'     => ['nullable', 'date'],
            'hasta'     => ['nullable', 'date', 'after_or_equal:desde'],
        ]);

        /* ---------- Base filtrada: participantes ---------- */
        $base = DB::table('participantes as p');

        if (!empty($filtros['buscar'])) {
            $t = trim($filtros['buscar']);
            $base->where(function ($q) use ($t) {
                $q->where('p.nombre_completo', 'like', "%{$t}%")
                  ->orWhere('p.correo', 'like', "%{$t}%")
                  ->orWhere('p.institucion', 'like', "%{$t}%")
                  ->orWhere('p.municipio', 'like', "%{$t}%")
                  ->orWhere('p.zona', 'like', "%{$t}%");
            });
        }
        if (!empty($filtros['municipio'])) {
            $base->whereRaw('LOWER(TRIM(p.municipio)) = ?', [mb_strtolower(trim($filtros['municipio']))]);
        }
        if (!empty($filtros['rol'])) {
            $base->whereRaw('LOWER(TRIM(p.rol_familiar)) = ?', [mb_strtolower(trim($filtros['rol']))]);
        }
        if (!empty($filtros['desde'])) {
            $base->whereDate('p.created_at', '>=', $filtros['desde']);
        }
        if (!empty($filtros['hasta'])) {
            $base->whereDate('p.created_at', '<=', $filtros['hasta']);
        }

        /* ---------- Resumen de participantes ---------- */
        $resumen = (clone $base)->selectRaw('
            COUNT(*) as total,
            COALESCE(SUM(p.avatar_id IS NOT NULL), 0) as con_avatar,
            COALESCE(SUM(p.es_anonimo = 1), 0) as anonimos,
            COALESCE(SUM(p.acepta_datos = 1), 0) as aceptan_datos
        ')->first();

        $totalGeneral = DB::table('participantes')->count();

        /* ---------- Distribuciones (se agrupan sin importar mayúsculas ni espacios) ---------- */
        $agrupar = function (string $columna, int $limite = 8) use ($base) {
            // $columna es siempre un valor fijo escrito aquí, nunca dato del usuario.
            return (clone $base)
                ->selectRaw("COALESCE(NULLIF(LOWER(TRIM({$columna})), ''), 'sin dato') as clave, COUNT(*) as total")
                ->groupBy('clave')->orderByDesc('total')->limit($limite)->get()
                ->map(fn ($f) => (object) [
                    'etiqueta' => $f->clave === 'sin dato' ? 'Sin dato' : Str::title($f->clave),
                    'total'    => (int) $f->total,
                ]);
        };

        $porRol       = $agrupar('p.rol_familiar');
        $porMunicipio = $agrupar('p.municipio');
        $porZona      = $agrupar('p.zona', 6);

        $porAvatar = (clone $base)
            ->leftJoin('avatares as av', 'av.id', '=', 'p.avatar_id')
            ->selectRaw("COALESCE(av.nombre, 'Sin avatar') as etiqueta, COUNT(*) as total")
            ->groupBy('etiqueta')->orderByDesc('total')->get()
            ->map(fn ($f) => (object) ['etiqueta' => $f->etiqueta, 'total' => (int) $f->total]);

        $ordenEdad = ['Menos de 12', '12 a 17', '18 a 29', '30 a 44', '45 a 59', '60 o más', 'Sin dato'];
        $porEdad = (clone $base)->selectRaw("
            CASE WHEN p.edad IS NULL THEN 'Sin dato'
                 WHEN p.edad < 12 THEN 'Menos de 12'
                 WHEN p.edad < 18 THEN '12 a 17'
                 WHEN p.edad < 30 THEN '18 a 29'
                 WHEN p.edad < 45 THEN '30 a 44'
                 WHEN p.edad < 60 THEN '45 a 59'
                 ELSE '60 o más' END as etiqueta, COUNT(*) as total")
            ->groupBy('etiqueta')->get()
            ->map(fn ($f) => (object) ['etiqueta' => $f->etiqueta, 'total' => (int) $f->total])
            ->sortBy(fn ($f) => array_search($f->etiqueta, $ordenEdad))->values();

        /* ---------- Registros de los últimos 14 días ---------- */
        $diarioRaw = (clone $base)
            ->where('p.created_at', '>=', Carbon::today()->subDays(13))
            ->selectRaw('DATE(p.created_at) as dia, COUNT(*) as total')
            ->groupBy('dia')->pluck('total', 'dia');

        $dias = [];
        $conteosDias = [];
        for ($i = 13; $i >= 0; $i--) {
            $d = Carbon::today()->subDays($i);
            $dias[] = $d->format('d/m');
            $conteosDias[] = (int) ($diarioRaw[$d->format('Y-m-d')] ?? 0);
        }

        /* ---------- Avance en las escenas (tabla avance_escenas) ---------- */
        $hayAvance = Schema::hasTable('avance_escenas');
        $ids = fn () => (clone $base)->select('p.id');
        $avance = null;
        $porEscena = collect();

        if ($hayAvance) {
            $avance = DB::table('avance_escenas as a')
                ->whereIn('a.participante_id', $ids())
                ->selectRaw('COUNT(*) as escenas_completadas,
                             COUNT(DISTINCT a.participante_id) as personas,
                             COALESCE(SUM(a.medalla), 0) as medallas,
                             ROUND(AVG(a.aciertos / NULLIF(a.total_preguntas, 0) * 100), 1) as promedio')
                ->first();

            $porEscena = DB::table('avance_escenas as a')
                ->whereIn('a.participante_id', $ids())
                ->selectRaw('a.escena, COUNT(*) as personas,
                             COALESCE(SUM(a.medalla), 0) as medallas,
                             ROUND(AVG(a.aciertos / NULLIF(a.total_preguntas, 0) * 100), 1) as promedio')
                ->groupBy('a.escena')->get()->keyBy('escena');
        }

        /* ---------- Embudo: registro → avatar → escenas ---------- */
        $embudo = [
            ['etiqueta' => 'Se registraron',    'total' => (int) $resumen->total],
            ['etiqueta' => 'Eligieron avatar',  'total' => (int) $resumen->con_avatar],
        ];
        foreach (self::ESCENAS as $n => $nombre) {
            $embudo[] = [
                'etiqueta' => "Escena {$n} · {$nombre}",
                'total'    => (int) optional($porEscena->get($n))->personas,
            ];
        }

        /* ---------- Listado de participantes ---------- */
        $lista = (clone $base)->leftJoin('avatares as av', 'av.id', '=', 'p.avatar_id');

        if ($hayAvance) {
            $lista->leftJoinSub(
                DB::table('avance_escenas')
                    ->selectRaw('participante_id, COUNT(*) as escenas, SUM(xp) as xp, SUM(medalla) as medallas')
                    ->groupBy('participante_id'),
                'ap', 'ap.participante_id', '=', 'p.id'
            )->selectRaw('COALESCE(ap.escenas, 0) as escenas, COALESCE(ap.xp, 0) as xp, COALESCE(ap.medallas, 0) as medallas');
        } else {
            $lista->selectRaw('0 as escenas, 0 as xp, 0 as medallas');
        }

        $participantes = $lista->addSelect([
                'p.id', 'p.nombre_completo', 'p.es_anonimo', 'p.correo', 'p.institucion', 'p.edad',
                'p.rol_familiar', 'p.municipio', 'p.zona', 'p.created_at',
                'av.nombre as avatar', 'av.imagen as avatar_imagen',
            ])
            ->orderByDesc('p.created_at')
            ->paginate(15)
            ->withQueryString();

        /* ---------- Opciones de los filtros ---------- */
        $opcionesMunicipio = DB::table('participantes')->whereRaw("TRIM(COALESCE(municipio, '')) <> ''")
            ->selectRaw('DISTINCT LOWER(TRIM(municipio)) as valor')->orderBy('valor')->pluck('valor');
        $opcionesRol = DB::table('participantes')->whereRaw("TRIM(COALESCE(rol_familiar, '')) <> ''")
            ->selectRaw('DISTINCT LOWER(TRIM(rol_familiar)) as valor')->orderBy('valor')->pluck('valor');

        return view('admin.indicadores', [
            'filtros' => $filtros,
            'resumen' => $resumen,
            'totalGeneral' => $totalGeneral,
            'porRol' => $porRol,
            'porMunicipio' => $porMunicipio,
            'porZona' => $porZona,
            'porAvatar' => $porAvatar,
            'porEdad' => $porEdad,
            'dias' => $dias,
            'conteosDias' => $conteosDias,
            'hayAvance' => $hayAvance,
            'avance' => $avance,
            'porEscena' => $porEscena,
            'escenas' => self::ESCENAS,
            'embudo' => $embudo,
            'participantes' => $participantes,
            'opcionesMunicipio' => $opcionesMunicipio,
            'opcionesRol' => $opcionesRol,
        ]);
    }
}