@extends('admin.layouts.app')

@section('title', 'Estadísticas y mapa de calor')
@section('page-title', 'Estadísticas y mapa de calor')

@section('content')
<div class="container-fluid px-0 statistics-page">
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Estadísticas de participación</h2>
            <p class="text-muted mb-0">Un Sorbito Hoy, Un Problema Mañana · Armenia, Quindío</p>
        </div>
        <span class="badge rounded-pill text-bg-primary px-3 py-2">Panel administrativo</span>
    </div>

    <form method="GET" action="{{ route('admin.estadisticas.index') }}" class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-3">
                    <label for="desde" class="form-label fw-semibold">Desde</label>
                    <input type="date" id="desde" name="desde" class="form-control" value="{{ $desde }}">
                </div>
                <div class="col-12 col-md-3">
                    <label for="hasta" class="form-label fw-semibold">Hasta</label>
                    <input type="date" id="hasta" name="hasta" class="form-control" value="{{ $hasta }}">
                </div>
                <div class="col-12 col-md-3">
                    <label for="zona" class="form-label fw-semibold">Zona o barrio</label>
                    <select id="zona" name="zona" class="form-select">
                        <option value="">Todas las zonas</option>
                        @foreach($zonas as $zona)
                            <option value="{{ $zona }}" @selected($zonaSeleccionada === $zona)>{{ $zona }}</option>
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

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card stat-card stat-blue h-100 border-0 shadow-sm"><div class="card-body d-flex justify-content-between align-items-center">
                <div><div class="stat-label">Participantes registrados</div><div class="stat-number">{{ number_format($totalParticipantes) }}</div><div class="small text-muted">Según los filtros aplicados</div></div>
                <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            </div></div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card stat-card stat-gold h-100 border-0 shadow-sm"><div class="card-body d-flex justify-content-between align-items-center">
                <div><div class="stat-label">Participaciones anónimas</div><div class="stat-number">{{ number_format($totalAnonimos) }}</div><div class="small text-muted">Sin datos personales de identidad</div></div>
                <div class="stat-icon"><i class="bi bi-person-lock"></i></div>
            </div></div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card stat-card stat-green h-100 border-0 shadow-sm"><div class="card-body d-flex justify-content-between align-items-center">
                <div><div class="stat-label">Registros geolocalizados</div><div class="stat-number">{{ number_format($totalGeolocalizados) }}</div><div class="small text-muted">Coordenadas dentro del área urbana aproximada</div></div>
                <div class="stat-icon"><i class="bi bi-geo-alt-fill"></i></div>
            </div></div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4 overflow-hidden">
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
            <p class="small text-muted mt-3 mb-0">El área de coordenadas es aproximada y sirve para excluir puntos muy alejados; no representa el límite oficial del municipio.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 px-4 pt-4">
            <h5 class="fw-bold mb-1">Participantes por zona</h5>
            <p class="text-muted small mb-0">Resumen agrupado por el sector registrado en el formulario.</p>
        </div>
        <div class="card-body px-0 pt-2">
            @if($resumenZonas->isEmpty())
                <div class="text-center text-muted py-4">No hay registros para los filtros seleccionados.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light"><tr><th class="ps-4">Zona o barrio</th><th class="text-end pe-4">Participantes</th></tr></thead>
                        <tbody>
                        @foreach($resumenZonas as $fila)
                            <tr><td class="ps-4">{{ $fila->zona }}</td><td class="text-end pe-4"><span class="badge rounded-pill text-bg-primary">{{ number_format($fila->total) }}</span></td></tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<style>
    .statistics-page .stat-card { border-radius: 16px; }
    .statistics-page .stat-blue { border-left: 4px solid #2878d0 !important; }
    .statistics-page .stat-gold { border-left: 4px solid #d9a52e !important; }
    .statistics-page .stat-green { border-left: 4px solid #239b78 !important; }
    .statistics-page .stat-label { color: #667085; font-size: .9rem; font-weight: 600; }
    .statistics-page .stat-number { font-size: clamp(1.8rem, 3vw, 2.35rem); line-height: 1.25; font-weight: 800; color: #172b4d; margin: 7px 0; }
    .statistics-page .stat-icon { width: 52px; height: 52px; border-radius: 14px; display:flex; align-items:center; justify-content:center; background:#edf4ff; color:#2878d0; font-size:1.5rem; flex-shrink:0; }
    .statistics-page .stat-gold .stat-icon { background:#fff6df; color:#b78112; }
    .statistics-page .stat-green .stat-icon { background:#e5f7f0; color:#168260; }
    #mapa-calor { width:100%; height:min(62vh, 560px); min-height:340px; border-radius:12px; background:#edf2f7; z-index:1; }
    .legend-dot { display:inline-block; width:11px; height:11px; border-radius:50%; margin-right:5px; }
    .legend-dot.low { background:#247bb5; } .legend-dot.medium { background:#ff9d2e; } .legend-dot.high { background:#df1e26; }
    @media(max-width:576px) { #mapa-calor { min-height:300px; height:48vh; } }
</style>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.heat@0.2.0/dist/leaflet-heat.js"></script>
<script>
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
        // Mayor radio y opacidad para que las concentraciones sean visibles incluso con pocos registros.
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

    // Recalcular dimensiones tras renderizar el layout administrativo.
    setTimeout(() => mapa.invalidateSize(), 300);
    window.addEventListener('resize', () => mapa.invalidateSize());
})();
</script>
@endsection
