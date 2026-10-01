<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class EstadisticasController extends Controller
{
    private const ESCENAS = [1 => 'Reconocer', 2 => 'Entender', 3 => 'Hablar', 4 => 'Prevenir'];

    // Área aproximada de Armenia (la misma que usa el mapa)
    private const LAT = [4.48, 4.60];
    private const LNG = [-75.75, -75.60];

    public function index(Request $request)
    {
        $f = $request->validate([
            'desde' => ['nullable', 'date'],
            'hasta' => ['nullable', 'date', 'after_or_equal:desde'],
            'zona'  => ['nullable', 'string', 'max:100'],
            'rol'   => ['nullable', 'string', 'max:30'],
        ]);

        $desde = $f['desde'] ?? null;
        $hasta = $f['hasta'] ?? null;
        $zonaSeleccionada = mb_strtolower(trim($f['zona'] ?? ''));
        $rolSeleccionado  = mb_strtolower(trim($f['rol'] ?? ''));

        /* ---------- Base filtrada ---------- */
        $base = DB::table('participantes as p');
        if ($desde) $base->whereDate('p.created_at', '>=', $desde);
        if ($hasta) $base->whereDate('p.created_at', '<=', $hasta);
        if ($zonaSeleccionada !== '') $base->whereRaw('LOWER(TRIM(p.zona)) = ?', [$zonaSeleccionada]);
        if ($rolSeleccionado !== '')  $base->whereRaw('LOWER(TRIM(p.rol_familiar)) = ?', [$rolSeleccionado]);

        /* ---------- Totales ---------- */
        $res = (clone $base)->selectRaw('
            COUNT(*) as total,
            COALESCE(SUM(p.es_anonimo = 1), 0) as anonimos,
            COALESCE(SUM(p.avatar_id IS NOT NULL), 0) as con_avatar,
            COALESCE(SUM(p.latitud BETWEEN ? AND ? AND p.longitud BETWEEN ? AND ?), 0) as geo
        ', [self::LAT[0], self::LAT[1], self::LNG[0], self::LNG[1]])->first();

        $totalParticipantes  = (int) $res->total;
        $totalAnonimos       = (int) $res->anonimos;
        $totalConAvatar      = (int) $res->con_avatar;
        $totalGeolocalizados = (int) $res->geo;

        /* ---------- Tendencia: últimos 7 días contra los 7 anteriores (sin filtros) ---------- */
        $hoy = Carbon::today();
        $ultimos7 = DB::table('participantes')->where('created_at', '>=', $hoy->copy()->subDays(6))->count();
        $previos7 = DB::table('participantes')
            ->where('created_at', '>=', $hoy->copy()->subDays(13))
            ->where('created_at', '<', $hoy->copy()->subDays(6))->count();
        $tendencia = [
            'actual'    => $ultimos7,
            'previo'    => $previos7,
            'variacion' => $previos7 > 0 ? round((($ultimos7 - $previos7) / $previos7) * 100) : null,
        ];

        /* ---------- Puntos del mapa (se redondean a ~100 m para no señalar viviendas) ---------- */
        $puntosMapa = (clone $base)
            ->whereBetween('p.latitud', self::LAT)->whereBetween('p.longitud', self::LNG)
            ->select('p.latitud', 'p.longitud')->limit(5000)->get()
            ->map(fn ($r) => [round((float) $r->latitud, 3), round((float) $r->longitud, 3)])->values();

        /* ---------- Registros por día ---------- */
        $fin = $hasta ? Carbon::parse($hasta) : Carbon::today();
        $inicio = $desde ? Carbon::parse($desde) : $fin->copy()->subDays(29);
        if (abs($inicio->diffInDays($fin)) > 89) $inicio = $fin->copy()->subDays(89);

        $diarioRaw = (clone $base)
            ->whereDate('p.created_at', '>=', $inicio)->whereDate('p.created_at', '<=', $fin)
            ->selectRaw('DATE(p.created_at) as dia, COUNT(*) as total')->groupBy('dia')->pluck('total', 'dia');

        $dias = [];
        $conteosDias = [];
        for ($d = $inicio->copy(); $d->lte($fin); $d->addDay()) {
            $dias[] = $d->format('d/m');
            $conteosDias[] = (int) ($diarioRaw[$d->format('Y-m-d')] ?? 0);
        }

        /* ---------- Cuándo participan: hora y día de la semana ---------- */
        $horas = array_fill(0, 24, 0);
        foreach ((clone $base)->selectRaw('HOUR(p.created_at) as h, COUNT(*) as total')->groupBy('h')->pluck('total', 'h') as $h => $n) {
            $horas[(int) $h] = (int) $n;
        }
        $semana = array_fill(0, 7, 0); // Lun..Dom
        $mapaDia = [2 => 0, 3 => 1, 4 => 2, 5 => 3, 6 => 4, 7 => 5, 1 => 6]; // DAYOFWEEK: 1 = domingo
        foreach ((clone $base)->selectRaw('DAYOFWEEK(p.created_at) as d, COUNT(*) as total')->groupBy('d')->pluck('total', 'd') as $d => $n) {
            $semana[$mapaDia[(int) $d]] = (int) $n;
        }
        $nombresDia = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        /* ---------- Distribuciones ---------- */
        $agrupar = function (string $columna, int $limite = 8) use ($base) {
            return (clone $base)
                ->selectRaw("COALESCE(NULLIF(LOWER(TRIM({$columna})), ''), 'sin dato') as clave, COUNT(*) as total")
                ->groupBy('clave')->orderByDesc('total')->limit($limite)->get()
                ->map(fn ($r) => (object) [
                    'etiqueta' => $r->clave === 'sin dato' ? 'Sin dato' : Str::title($r->clave),
                    'total'    => (int) $r->total,
                ]);
        };
        $porRol = $agrupar('p.rol_familiar');

        $porAvatar = (clone $base)->leftJoin('avatares as av', 'av.id', '=', 'p.avatar_id')
            ->selectRaw("COALESCE(av.nombre, 'Sin avatar') as etiqueta, COUNT(*) as total")
            ->groupBy('etiqueta')->orderByDesc('total')->get()
            ->map(fn ($r) => (object) ['etiqueta' => $r->etiqueta, 'total' => (int) $r->total]);

        $ordenEdad = ['Menos de 12', '12 a 17', '18 a 29', '30 a 44', '45 a 59', '60 o más', 'Sin dato'];
        $porEdad = (clone $base)->selectRaw("
            CASE WHEN p.edad IS NULL THEN 'Sin dato' WHEN p.edad < 12 THEN 'Menos de 12'
                 WHEN p.edad < 18 THEN '12 a 17' WHEN p.edad < 30 THEN '18 a 29'
                 WHEN p.edad < 45 THEN '30 a 44' WHEN p.edad < 60 THEN '45 a 59'
                 ELSE '60 o más' END as etiqueta, COUNT(*) as total")
            ->groupBy('etiqueta')->get()
            ->map(fn ($r) => (object) ['etiqueta' => $r->etiqueta, 'total' => (int) $r->total])
            ->sortBy(fn ($r) => array_search($r->etiqueta, $ordenEdad))->values();

        /* ---------- Avance en las escenas ---------- */
        $hayAvance = Schema::hasTable('avance_escenas');
        $ids = fn () => (clone $base)->select('p.id');
        $avance = null;
        $porEscena = collect();

        if ($hayAvance) {
            $avance = DB::table('avance_escenas as a')->whereIn('a.participante_id', $ids())
                ->selectRaw('COUNT(*) as escenas, COUNT(DISTINCT a.participante_id) as personas, COALESCE(SUM(a.medalla), 0) as medallas')
                ->first();
            $porEscena = DB::table('avance_escenas as a')->whereIn('a.participante_id', $ids())
                ->selectRaw('a.escena, COUNT(*) as personas, COALESCE(SUM(a.medalla), 0) as medallas,
                             ROUND(AVG(a.aciertos / NULLIF(a.total_preguntas, 0) * 100), 1) as promedio')
                ->groupBy('a.escena')->get()->keyBy('escena');
        }

        $embudo = [
            ['etiqueta' => 'Se registraron',   'total' => $totalParticipantes],
            ['etiqueta' => 'Eligieron avatar', 'total' => $totalConAvatar],
        ];
        $escAciertos = [];
        $escMedallas = [];
        foreach (self::ESCENAS as $n => $nombre) {
            $fila = $porEscena->get($n);
            $embudo[] = ['etiqueta' => "Escena {$n} · {$nombre}", 'total' => (int) ($fila->personas ?? 0)];
            $escAciertos[] = (int) round((float) ($fila->promedio ?? 0));
            $escMedallas[] = (int) ($fila->medallas ?? 0);
        }

        /* ---------- Resumen por zona ---------- */
        $zonasQ = (clone $base)->selectRaw("
            COALESCE(NULLIF(LOWER(TRIM(p.zona)), ''), 'sin dato') as clave,
            COUNT(*) as total,
            COALESCE(SUM(p.es_anonimo = 1), 0) as anonimos,
            COALESCE(SUM(p.avatar_id IS NOT NULL), 0) as con_avatar");

        if ($hayAvance) {
            $zonasQ->leftJoinSub(
                DB::table('avance_escenas')->selectRaw('participante_id, COUNT(*) as escenas, SUM(medalla) as medallas')->groupBy('participante_id'),
                'ap', 'ap.participante_id', '=', 'p.id'
            )->selectRaw('COALESCE(SUM(ap.escenas), 0) as escenas, COALESCE(SUM(ap.medallas), 0) as medallas');
        } else {
            $zonasQ->selectRaw('0 as escenas, 0 as medallas');
        }

        $resumenZonas = $zonasQ->groupBy('clave')->orderByDesc('total')->get()->map(fn ($r) => (object) [
            'zona'       => $r->clave === 'sin dato' ? 'Sin dato' : Str::title($r->clave),
            'total'      => (int) $r->total,
            'anonimos'   => (int) $r->anonimos,
            'con_avatar' => (int) $r->con_avatar,
            'escenas'    => (int) $r->escenas,
            'medallas'   => (int) $r->medallas,
        ]);

        /* ---------- Hallazgos rápidos ---------- */
        $maxHora = max($horas);
        $maxDiaSemana = max($semana);
        $zonaLider = $resumenZonas->first();
        $rolLider = $porRol->first();
        $hallazgos = [
            ['bi-geo-alt-fill', 'Zona con más participantes',
                $zonaLider ? $zonaLider->zona : '—',
                $zonaLider ? $zonaLider->total.' registros' : 'Sin datos'],
            ['bi-clock-fill', 'Hora más activa',
                $maxHora > 0 ? sprintf('%02d:00', array_search($maxHora, $horas)) : '—',
                $maxHora > 0 ? $maxHora.' registros' : 'Sin datos'],
            ['bi-calendar-event-fill', 'Día más activo',
                $maxDiaSemana > 0 ? $nombresDia[array_search($maxDiaSemana, $semana)] : '—',
                $maxDiaSemana > 0 ? $maxDiaSemana.' registros' : 'Sin datos'],
            ['bi-people-fill', 'Rol más frecuente',
                $rolLider ? $rolLider->etiqueta : '—',
                $rolLider ? $rolLider->total.' personas' : 'Sin datos'],
        ];

        /* ---------- Actividad reciente (sin nombres) ---------- */
        $recientes = (clone $base)->leftJoin('avatares as av', 'av.id', '=', 'p.avatar_id')
            ->select('p.id', 'p.rol_familiar', 'p.zona', 'p.created_at', 'av.nombre as avatar', 'av.imagen as avatar_imagen')
            ->orderByDesc('p.created_at')->limit(8)->get();

        /* ---------- Opciones de filtros ---------- */
        $zonas = DB::table('participantes')->whereRaw("TRIM(COALESCE(zona, '')) <> ''")
            ->selectRaw('DISTINCT LOWER(TRIM(zona)) as valor')->orderBy('valor')->pluck('valor');
        $roles = DB::table('participantes')->whereRaw("TRIM(COALESCE(rol_familiar, '')) <> ''")
            ->selectRaw('DISTINCT LOWER(TRIM(rol_familiar)) as valor')->orderBy('valor')->pluck('valor');

        /* ---------- Datos para las gráficas ---------- */
        $graficas = [
            'dias'    => ['labels' => $dias, 'data' => $conteosDias],
            'rol'     => ['labels' => $porRol->pluck('etiqueta')->values(), 'data' => $porRol->pluck('total')->values()],
            'embudo'  => ['labels' => collect($embudo)->pluck('etiqueta')->values(), 'data' => collect($embudo)->pluck('total')->values()],
            'escenas' => ['labels' => array_values(self::ESCENAS), 'aciertos' => $escAciertos, 'medallas' => $escMedallas],
            'horas'   => ['labels' => array_map(fn ($h) => sprintf('%02d', $h), range(0, 23)), 'data' => $horas],
            'semana'  => ['labels' => ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'], 'data' => $semana],
            'edad'    => ['labels' => $porEdad->pluck('etiqueta')->values(), 'data' => $porEdad->pluck('total')->values()],
            'avatar'  => ['labels' => $porAvatar->pluck('etiqueta')->values(), 'data' => $porAvatar->pluck('total')->values()],
        ];

        return view('admin.estadisticas.index', compact(
            'desde', 'hasta', 'zonas', 'roles', 'zonaSeleccionada', 'rolSeleccionado',
            'totalParticipantes', 'totalAnonimos', 'totalConAvatar', 'totalGeolocalizados',
            'tendencia', 'puntosMapa', 'resumenZonas', 'hallazgos', 'recientes',
            'hayAvance', 'avance', 'graficas'
        ));
    }
}