@extends('admin.layouts.app')

@section('title', 'Estadísticas y mapa de calor')
@section('page-title', 'Estadísticas y mapa de calor')

@section('content')
@php
    $pct = fn ($n, $d) => $d > 0 ? round(($n / $d) * 100) : 0;
    $hayFiltros = $desde || $hasta || $zonaSeleccionada !== '' || $rolSeleccionado !== '';
    $maxZona = max(1, (int) $resumenZonas->max('total'));
    $variacion = $tendencia['variacion'];

    $kpis = [
        ['blue',  'bi-people-fill',       'Participantes registrados', number_format($totalParticipantes), null],
        ['gold',  'bi-person-lock',       'Participaciones anónimas',  number_format($totalAnonimos), $pct($totalAnonimos, $totalParticipantes)],
        ['green', 'bi-geo-alt-fill',      'Registros geolocalizados',  number_format($totalGeolocalizados), $pct($totalGeolocalizados, $totalParticipantes)],
        ['purple','bi-emoji-smile-fill',  'Eligieron su avatar',       number_format($totalConAvatar), $pct($totalConAvatar, $totalParticipantes)],
        ['blue',  'bi-signpost-split-fill','Personas con avance',      number_format((int) ($avance->personas ?? 0)), $pct((int) ($avance->personas ?? 0), $totalParticipantes)],
        ['gold',  'bi-trophy-fill',       'Medallas ganadas',          number_format((int) ($avance->medallas ?? 0)), null],
    ];
@endphp

<div class="container-fluid px-0 statistics-page">

    {{-- ===== Encabezado ===== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Estadísticas de participación</h2>
            <p class="text-muted mb-0">Un Sorbito Hoy, Un Problema Mañana · Armenia, Quindío</p>
        </div>
        <div class="d-flex flex-wrap gap-2 align-items-center">
            <span class="badge rounded-pill text-bg-light border px-3 py-2"><i class="bi bi-shield-lock me-1"></i>Datos agregados, sin identidades</span>
            <span class="badge rounded-pill text-bg-primary px-3 py-2">Panel administrativo</span>
        </div>
    </div>

    {{-- ===== Filtros ===== --}}
    <form method="GET" action="{{ route('admin.estadisticas.index') }}" class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-6 col-md-2">
                    <label for="desde" class="form-label fw-semibold">Desde</label>
                    <input type="date" id="desde" name="desde" class="form-control" value="{{ $desde }}">
                </div>
                <div class="col-6 col-md-2">
                    <label for="hasta" class="form-label fw-semibold">Hasta</label>
                    <input type="date" id="hasta" name="hasta" class="form-control" value="{{ $hasta }}">
                </div>
                <div class="col-12 col-md-3">
                    <label for="zona" class="form-label fw-semibold">Zona o barrio</label>
                    <select id="zona" name="zona" class="form-select">
                        <option value="">Todas las zonas</option>
                        @foreach($zonas as $z)
                            <option value="{{ $z }}" @selected($zonaSeleccionada === $z)>{{ \Illuminate\Support\Str::title($z) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <label for="rol" class="form-label fw-semibold">Rol familiar</label>
                    <select id="rol" name="rol" class="form-select">
                        <option value="">Todos</option>
                        @foreach($roles as $r)
                            <option value="{{ $r }}" @selected($rolSeleccionado === $r)>{{ \Illuminate\Support\Str::title($r) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1" type="submit"><i class="bi bi-funnel me-1"></i> Filtrar</button>
                    <a class="btn btn-outline-secondary" href="{{ route('admin.estadisticas.index') }}" title="Limpiar filtros"><i class="bi bi-arrow-counterclockwise"></i></a>
                </div>
            </div>
        </div>
    </form>

    @if(!$hayAvance)
        <div class="alert alert-warning border-0 shadow-sm"><i class="bi bi-info-circle me-1"></i> Falta la tabla <code>avance_escenas</code>. Ejecuta <code>php artisan migrate</code> para ver el avance y las medallas.</div>
    @endif

    {{-- ===== Indicadores principales ===== --}}
    <div class="row g-3 mb-4">
        @foreach($kpis as $i => [$color, $icono, $etiqueta, $valor, $porcentaje])
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card stat-card stat-{{ $color }} h-100 border-0 shadow-sm"><div class="card-body">
                    <div class="d-flex justify-content-between align-items-start gap-2">
                        <div class="min-w-0">
                            <div class="stat-label">{{ $etiqueta }}</div>
                            <div class="stat-number">{{ $valor }}</div>
                        </div>
                        <div class="stat-icon"><i class="bi {{ $icono }}"></i></div>
                    </div>

                    @if($porcentaje !== null)
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <div class="progress flex-grow-1" style="height:6px" role="progressbar" aria-valuenow="{{ $porcentaje }}" aria-valuemin="0" aria-valuemax="100"><div class="progress-bar" style="width:{{ $porcentaje }}%"></div></div>
                            <span class="small fw-semibold text-muted">{{ $porcentaje }}%</span>
                        </div>
                        <div class="small text-muted mt-1">del total de participantes</div>
                    @elseif($i === 0)
                        <div class="small mt-1">
                            @if($variacion === null)
                                <span class="text-muted">{{ $tendencia['actual'] }} nuevos en los últimos 7 días</span>
                            @else
                                <span class="trend {{ $variacion >= 0 ? 'up' : 'down' }}"><i class="bi {{ $variacion >= 0 ? 'bi-arrow-up-right' : 'bi-arrow-down-right' }}"></i> {{ abs($variacion) }}%</span>
                                <span class="text-muted">· {{ $tendencia['actual'] }} nuevos en 7 días (antes {{ $tendencia['previo'] }})</span>
                            @endif
                        </div>
                    @else
                        <div class="small text-muted mt-1">Acertaron todo el cuestionario de una escena</div>
                    @endif
                </div></div>
            </div>
        @endforeach
    </div>

    {{-- ===== Hallazgos rápidos ===== --}}
    <div class="row g-3 mb-4">
        @foreach($hallazgos as [$icono, $titulo, $valor, $detalle])
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="insight h-100">
                    <i class="bi {{ $icono }}"></i>
                    <div>
                        <div class="insight-title">{{ $titulo }}</div>
                        <div class="insight-value">{{ $valor }}</div>
                        <div class="insight-detail">{{ $detalle }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ===== Mapa + zonas ===== --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-header bg-white border-0 px-4 pt-4 pb-2">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <div><h5 class="fw-bold mb-1">Mapa de calor de Armenia</h5><p class="text-muted small mb-0">Las manchas de color muestran la concentración de registros geolocalizados; no identifican personas.</p></div>
                        <span class="badge rounded-pill bg-light text-dark border"><i class="bi bi-shield-lock me-1"></i>Sin datos personales</span>
                    </div>
                </div>
                <div class="card-body px-3 px-md-4 pb-4">
                    <div id="mapa-calor" role="region" aria-label="Mapa de calor de participantes en Armenia"></div>
                    <div id="mapa-sin-datos" class="alert alert-info mt-3 mb-0" style="display:none;"></div>
                    <div class="heat-legend mt-3 d-flex flex-wrap align-items-center gap-3 small text-muted">
                        <span><i class="legend-dot low"></i> Menor concentración</span>
                        <span><i class="legend-dot medium"></i> Concentración media</span>
                        <span><i class="legend-dot high"></i> Mayor concentración</span>
                    </div>
                    <p class="small text-muted mt-2 mb-0">Las coordenadas se redondean a unos 100 m y se excluyen puntos fuera del área urbana aproximada; no es el límite oficial del municipio.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">Zonas con más participación</h5>
                    <p class="text-muted small mb-3">Las 6 con más registros.</p>
                    @forelse($resumenZonas->take(6) as $k => $fila)
                        <div class="zone-row">
                            <span class="zone-rank">{{ $k + 1 }}</span>
                            <div class="flex-grow-1 min-w-0">
                                <div class="d-flex justify-content-between gap-2">
                                    <span class="zone-name">{{ $fila->zona }}</span>
                                    <span class="fw-bold">{{ $fila->total }}</span>
                                </div>
                                <div class="progress" style="height:7px"><div class="progress-bar" style="width:{{ ($fila->total / $maxZona) * 100 }}%"></div></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">No hay registros para los filtros seleccionados.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Gráficas: tendencia y rol ===== --}}
    <div class="row g-3 mb-3">
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm h-100"><div class="card-body p-4">
                <h5 class="fw-bold mb-1">Registros por día</h5>
                <p class="text-muted small mb-3">{{ $hayFiltros && ($desde || $hasta) ? 'Periodo seleccionado' : 'Últimos 30 días' }}</p>
                <div class="chart-box"><canvas id="g-dias" role="img" aria-label="Registros por día"></canvas></div>
            </div></div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100"><div class="card-body p-4">
                <h5 class="fw-bold mb-1">Rol familiar</h5>
                <p class="text-muted small mb-3">Quiénes participan</p>
                <div class="chart-box"><canvas id="g-rol" role="img" aria-label="Participantes por rol familiar"></canvas></div>
            </div></div>
        </div>
    </div>

    {{-- ===== Gráficas: recorrido y escenas ===== --}}
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100"><div class="card-body p-4">
                <h5 class="fw-bold mb-1">Recorrido de los participantes</h5>
                <p class="text-muted small mb-3">Cuántas personas llegan a cada paso</p>
                <div class="chart-box"><canvas id="g-embudo" role="img" aria-label="Embudo del recorrido"></canvas></div>
            </div></div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100"><div class="card-body p-4">
                <h5 class="fw-bold mb-1">Resultados por escena</h5>
                <p class="text-muted small mb-3">Aciertos promedio (%) y medallas ganadas</p>
                <div class="chart-box"><canvas id="g-escenas" role="img" aria-label="Resultados por escena"></canvas></div>
            </div></div>
        </div>
    </div>

    <!-- ===== Gráficas: cuándo participan ===== 
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm h-100"><div class="card-body p-4">
                <h5 class="fw-bold mb-1">¿A qué hora participan?</h5>
                <p class="text-muted small mb-3">Registros por hora del día (0 a 23 h)</p>
                <div class="chart-box sm"><canvas id="g-horas" role="img" aria-label="Registros por hora"></canvas></div>
            </div></div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm h-100"><div class="card-body p-4">
                <h5 class="fw-bold mb-1">Día de la semana</h5>
                <p class="text-muted small mb-3">Cuándo hay más actividad</p>
                <div class="chart-box sm"><canvas id="g-semana" role="img" aria-label="Registros por día de la semana"></canvas></div>
            </div></div>
        </div>
    </div>--}}-->

    {{-- ===== Gráficas: edad y avatar ===== --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100"><div class="card-body p-4">
                <h5 class="fw-bold mb-1">Grupos de edad</h5>
                <p class="text-muted small mb-3">Según la edad escrita en el registro</p>
                <div class="chart-box sm"><canvas id="g-edad" role="img" aria-label="Participantes por grupo de edad"></canvas></div>
            </div></div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100"><div class="card-body p-4">
                <h5 class="fw-bold mb-1">Avatares más elegidos</h5>
                <p class="text-muted small mb-3">El personaje que cada persona escoge</p>
                <div class="chart-box sm"><canvas id="g-avatar" role="img" aria-label="Avatares elegidos"></canvas></div>
            </div></div>
        </div>
    </div>

    {{-- ===== Tabla por zona + actividad reciente ===== --}}
    <div class="row g-3">
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 px-4 pt-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <div>
                            <h5 class="fw-bold mb-1">Participantes por zona</h5>
                            <p class="text-muted small mb-0">Resumen por el sector escrito en el formulario.</p>
                        </div>
                        <div class="d-flex gap-2">
                            <input type="search" id="buscar-zona" class="form-control form-control-sm" placeholder="Buscar zona..." aria-label="Buscar zona" style="min-width:170px">
                            <button type="button" id="exportar-zonas" class="btn btn-sm btn-outline-primary text-nowrap"><i class="bi bi-download me-1"></i>CSV</button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-2">
                    @if($resumenZonas->isEmpty())
                        <div class="text-center text-muted py-4">No hay registros para los filtros seleccionados.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="tabla-zonas">
                                <thead class="table-light"><tr>
                                    <th class="ps-4">Zona o barrio</th><th class="text-end">Participantes</th><th style="min-width:130px">% del total</th>
                                    <th class="text-end">Anónimos</th><th class="text-end">Con avatar</th><th class="text-end">Escenas</th><th class="text-end pe-4">Medallas</th>
                                </tr></thead>
                                <tbody>
                                @foreach($resumenZonas as $fila)
                                    <tr>
                                        <td class="ps-4 fw-semibold">{{ $fila->zona }}</td>
                                        <td class="text-end"><span class="badge rounded-pill text-bg-primary">{{ number_format($fila->total) }}</span></td>
                                        <td><div class="d-flex align-items-center gap-2"><div class="progress flex-grow-1" style="height:6px"><div class="progress-bar" style="width:{{ $pct($fila->total, $totalParticipantes) }}%"></div></div><span class="small text-muted">{{ $pct($fila->total, $totalParticipantes) }}%</span></div></td>
                                        <td class="text-end">{{ $fila->anonimos }}</td>
                                        <td class="text-end">{{ $fila->con_avatar }}</td>
                                        <td class="text-end">{{ $fila->escenas }}</td>
                                        <td class="text-end pe-4">{{ $fila->medallas }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100"><div class="card-body p-4">
                <h5 class="fw-bold mb-1">Actividad reciente</h5>
                <p class="text-muted small mb-3">Últimos registros, sin nombres.</p>
                @forelse($recientes as $r)
                    <div class="feed-row">
                        @if($r->avatar)
                            <img class="feed-av" src="{{ asset('build/img/avatars/'.trim($r->avatar_imagen)) }}" alt="" loading="lazy">
                        @else
                            <span class="feed-av empty"><i class="bi bi-person"></i></span>
                        @endif
                        <div class="min-w-0">
                            <div class="fw-semibold text-truncate">Participante #{{ $r->id }}{{ $r->rol_familiar ? ' · '.\Illuminate\Support\Str::title($r->rol_familiar) : '' }}</div>
                            <div class="small text-muted text-truncate">{{ $r->zona ? \Illuminate\Support\Str::title(trim($r->zona)) : 'Zona no registrada' }}{{ $r->avatar ? ' · '.$r->avatar : '' }}</div>
                        </div>
                        <span class="small text-muted text-nowrap ms-auto">{{ \Carbon\Carbon::parse($r->created_at)->locale('es')->diffForHumans(null, true, true) }}</span>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">Sin actividad para los filtros seleccionados.</div>
                @endforelse
            </div></div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<style>
    .statistics-page .min-w-0 { min-width: 0; }
    .statistics-page .stat-card { border-radius: 16px; }
    .statistics-page .stat-blue { border-left: 4px solid #2878d0 !important; }
    .statistics-page .stat-gold { border-left: 4px solid #d9a52e !important; }
    .statistics-page .stat-green { border-left: 4px solid #239b78 !important; }
    .statistics-page .stat-purple { border-left: 4px solid #7046b5 !important; }
    .statistics-page .stat-label { color: #667085; font-size: .9rem; font-weight: 600; }
    .statistics-page .stat-number { font-size: clamp(1.8rem, 3vw, 2.35rem); line-height: 1.2; font-weight: 800; color: #172b4d; margin: 6px 0; }
    .statistics-page .stat-icon { width: 52px; height: 52px; border-radius: 14px; display:flex; align-items:center; justify-content:center; background:#edf4ff; color:#2878d0; font-size:1.5rem; flex-shrink:0; }
    .statistics-page .stat-gold .stat-icon { background:#fff6df; color:#b78112; }
    .statistics-page .stat-green .stat-icon { background:#e5f7f0; color:#168260; }
    .statistics-page .stat-purple .stat-icon { background:#f0e9ff; color:#7046b5; }
    .statistics-page .stat-gold .progress-bar { background:#d9a52e; }
    .statistics-page .stat-green .progress-bar { background:#239b78; }
    .statistics-page .stat-purple .progress-bar { background:#7046b5; }
    .statistics-page .trend { font-weight: 700; padding: 2px 8px; border-radius: 99px; }
    .statistics-page .trend.up { background:#e5f7f0; color:#168260; }
    .statistics-page .trend.down { background:#fdecec; color:#b42318; }

    .statistics-page .insight { display:flex; gap:14px; align-items:center; padding:16px 18px; background:#fff; border-radius:16px; box-shadow:0 .125rem .25rem rgba(0,0,0,.075); }
    .statistics-page .insight > i { width:46px; height:46px; display:grid; place-items:center; border-radius:13px; background:#edf4ff; color:#2878d0; font-size:1.3rem; flex-shrink:0; }
    .statistics-page .insight-title { font-size:.8rem; font-weight:600; color:#667085; }
    .statistics-page .insight-value { font-size:1.25rem; font-weight:800; color:#172b4d; line-height:1.2; }
    .statistics-page .insight-detail { font-size:.78rem; color:#667085; }

    .statistics-page .zone-row { display:flex; align-items:center; gap:12px; margin-bottom:16px; }
    .statistics-page .zone-rank { width:28px; height:28px; display:grid; place-items:center; border-radius:50%; background:#edf4ff; color:#2878d0; font-weight:800; font-size:.8rem; flex-shrink:0; }
    .statistics-page .zone-name { font-weight:600; color:#344054; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }

    .statistics-page .feed-row { display:flex; align-items:center; gap:12px; padding:10px 0; border-bottom:1px solid #eef1f5; }
    .statistics-page .feed-row:last-child { border-bottom:0; }
    .statistics-page .feed-av { width:40px; height:40px; border-radius:50%; object-fit:cover; object-position:top center; background:#e8eeff; flex-shrink:0; }
    .statistics-page .feed-av.empty { display:grid; place-items:center; color:#7a8aa6; }

    .statistics-page .chart-box { position:relative; height:290px; }
    .statistics-page .chart-box.sm { height:240px; }
    .statistics-page .chart-empty { height:100%; display:grid; place-items:center; text-align:center; color:#98a2b3; font-size:.9rem; padding:20px; }

    #mapa-calor { width:100%; height:min(62vh, 560px); min-height:340px; border-radius:12px; background:#edf2f7; z-index:1; }
    .legend-dot { display:inline-block; width:11px; height:11px; border-radius:50%; margin-right:5px; }
    .legend-dot.low { background:#247bb5; } .legend-dot.medium { background:#ff9d2e; } .legend-dot.high { background:#df1e26; }
    @media(max-width:576px) { #mapa-calor { min-height:300px; height:48vh; } .statistics-page .chart-box { height:250px; } }
</style>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.heat@0.2.0/dist/leaflet-heat.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
/* ================= MAPA DE CALOR ================= */
(function () {
    const centroArmenia = [4.5339, -75.6811];
    const puntos = @json($puntosMapa);
    const contenedor = document.getElementById('mapa-calor');
    const aviso = document.getElementById('mapa-sin-datos');

    function mostrarAviso(mensaje, tipo = 'info') {
        if (!aviso) return;
        aviso.style.display = 'block';
        aviso.className = 'alert alert-' + tipo + ' mt-3 mb-0';
        aviso.textContent = mensaje;
    }

    if (!contenedor || typeof L === 'undefined') {
        mostrarAviso('No se pudo cargar Leaflet. Comprueba la conexión a internet o si el CDN está bloqueado.', 'warning');
        return;
    }

    const mapa = L.map(contenedor, { scrollWheelZoom: false }).setView(centroArmenia, 13.5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(mapa);

    const puntosValidos = Array.isArray(puntos) ? puntos.filter(p =>
        Array.isArray(p) && Number.isFinite(Number(p[0])) && Number.isFinite(Number(p[1])) &&
        Number(p[0]) >= 4.48 && Number(p[0]) <= 4.60 &&
        Number(p[1]) >= -75.75 && Number(p[1]) <= -75.60
    ) : [];

    if (!puntosValidos.length) {
        mostrarAviso('No hay coordenadas dentro del área urbana aproximada de Armenia para los filtros seleccionados. Revisa los campos latitud y longitud en la tabla participantes.', 'info');
    } else if (typeof L.heatLayer !== 'function') {
        mostrarAviso('Se cargó el mapa, pero no la biblioteca de calor. Recarga la página o comprueba si el CDN leaflet-heat está bloqueado.', 'warning');
    } else {
        L.heatLayer(puntosValidos, {
            radius: 42,
            blur: 30,
            minOpacity: 0.48,
            maxZoom: 17,
            max: 1.0,
            gradient: {
                0.15: '#247bb5',
                0.35: '#44b7a8',
                0.55: '#ffe34d',
                0.75: '#ff9d2e',
                1.0: '#df1e26'
            }
        }).addTo(mapa);
        aviso.style.display = 'none';
    }

    setTimeout(() => mapa.invalidateSize(), 300);
    window.addEventListener('resize', () => mapa.invalidateSize());
})();

/* ================= GRÁFICAS ================= */
(function () {
    const G = @json($graficas);

    if (typeof Chart === 'undefined') {
        document.querySelectorAll('.chart-box').forEach(c => {
            c.innerHTML = '<div class="chart-empty">No se pudo cargar la biblioteca de gráficas. Comprueba la conexión o si el CDN está bloqueado.</div>';
        });
        return;
    }

    Chart.defaults.font.family = getComputedStyle(document.body).fontFamily;
    Chart.defaults.color = '#475569';

    const azul = '#2878d0', verde = '#239b78', oro = '#d9a52e', morado = '#7046b5', rojo = '#d6453d';
    const paleta = [azul, verde, oro, morado, rojo, '#0ea5a4', '#f97316', '#94a3b8'];
    const enteros = { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#eef1f5' } };
    const sinRejilla = { grid: { display: false } };
    const suma = a => a.reduce((x, y) => x + Number(y), 0);

    function crear(id, tipo, data, extra) {
        const el = document.getElementById(id);
        if (!el) return;
        if (!data.datasets.some(d => suma(d.data) > 0)) {
            el.parentElement.innerHTML = '<div class="chart-empty">Sin datos para mostrar con estos filtros.</div>';
            return;
        }
        new Chart(el, {
            type: tipo,
            data: data,
            options: Object.assign({ responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }, extra || {})
        });
    }

    crear('g-dias', 'line', {
        labels: G.dias.labels,
        datasets: [{ label: 'Registros', data: G.dias.data, borderColor: azul, backgroundColor: 'rgba(40,120,208,.12)', fill: true, tension: .35, pointRadius: 3, pointBackgroundColor: azul }]
    }, { scales: { y: enteros, x: sinRejilla } });

    crear('g-rol', 'doughnut', {
        labels: G.rol.labels,
        datasets: [{ data: G.rol.data, backgroundColor: paleta, borderWidth: 2, borderColor: '#fff' }]
    }, { cutout: '62%', plugins: { legend: { display: true, position: 'bottom', labels: { boxWidth: 12, padding: 14 } } } });

    crear('g-embudo', 'bar', {
        labels: G.embudo.labels,
        datasets: [{ label: 'Personas', data: G.embudo.data, backgroundColor: [azul, '#4d8ed5', verde, verde, verde, verde], borderRadius: 8 }]
    }, { indexAxis: 'y', scales: { x: enteros, y: sinRejilla } });

    crear('g-escenas', 'bar', {
        labels: G.escenas.labels,
        datasets: [
            { label: 'Aciertos promedio (%)', data: G.escenas.aciertos, backgroundColor: azul, borderRadius: 8, yAxisID: 'y' },
            { label: 'Medallas', data: G.escenas.medallas, backgroundColor: oro, borderRadius: 8, yAxisID: 'y1' }
        ]
    }, {
        plugins: { legend: { display: true, position: 'bottom', labels: { boxWidth: 12 } } },
        scales: {
            x: sinRejilla,
            y: { beginAtZero: true, max: 100, grid: { color: '#eef1f5' }, title: { display: true, text: '%' } },
            y1: { beginAtZero: true, position: 'right', grid: { display: false }, ticks: { precision: 0 }, title: { display: true, text: 'Medallas' } }
        }
    });

    crear('g-horas', 'bar', {
        labels: G.horas.labels,
        datasets: [{ label: 'Registros', data: G.horas.data, backgroundColor: verde, borderRadius: 5 }]
    }, { scales: { y: enteros, x: sinRejilla } });

    crear('g-semana', 'bar', {
        labels: G.semana.labels,
        datasets: [{ label: 'Registros', data: G.semana.data, backgroundColor: morado, borderRadius: 6 }]
    }, { scales: { y: enteros, x: sinRejilla } });

    crear('g-edad', 'bar', {
        labels: G.edad.labels,
        datasets: [{ label: 'Personas', data: G.edad.data, backgroundColor: oro, borderRadius: 6 }]
    }, { scales: { y: enteros, x: sinRejilla } });

    crear('g-avatar', 'bar', {
        labels: G.avatar.labels,
        datasets: [{ label: 'Personas', data: G.avatar.data, backgroundColor: azul, borderRadius: 6 }]
    }, { indexAxis: 'y', scales: { x: enteros, y: sinRejilla } });
})();

/* ================= TABLA DE ZONAS: búsqueda y CSV ================= */
(function () {
    const tabla = document.getElementById('tabla-zonas');
    if (!tabla) return;

    const buscador = document.getElementById('buscar-zona');
    if (buscador) {
        buscador.addEventListener('input', () => {
            const q = buscador.value.trim().toLowerCase();
            tabla.querySelectorAll('tbody tr').forEach(tr => {
                tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        });
    }

    const boton = document.getElementById('exportar-zonas');
    if (boton) {
        boton.addEventListener('click', () => {
            const filas = Array.from(tabla.querySelectorAll('tr')).filter(tr => tr.style.display !== 'none');
            const csv = filas.map(tr => Array.from(tr.children)
                .map(c => '"' + c.innerText.trim().replace(/\s+/g, ' ').replace(/"/g, '""') + '"').join(';')).join('\r\n');
            const blob = new Blob(['\ufeff' + csv], { type: 'text/csv;charset=utf-8;' });
            const a = document.createElement('a');
            a.href = URL.createObjectURL(blob);
            a.download = 'participantes-por-zona.csv';
            document.body.appendChild(a);
            a.click();
            a.remove();
            URL.revokeObjectURL(a.href);
        });
    }
})();
</script>
@endsection