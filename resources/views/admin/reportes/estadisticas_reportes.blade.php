@extends('admin.layouts.app')

@section('title', 'Reportes')
@section('page-title', 'Reportes')

@section('content')
@php
    $pct = fn ($n, $d) => $d > 0 ? round(($n / $d) * 100) : 0;
    $totalAvance = (int) ($avance->personas ?? 0);
    $totalMedallas = (int) ($avance->medallas ?? 0);
    $totalEscenas = (int) ($avance->escenas ?? 0);
    $totalPreguntas = (int) ($avance->preguntas ?? 0);
    $totalAciertos = (int) ($avance->aciertos ?? 0);
    $porcentajeAciertos = $pct($totalAciertos, $totalPreguntas);
    $hayFiltros = $desde || $hasta || $zonaSeleccionada !== '' || $rolSeleccionado !== '';
@endphp

<div class="container-fluid px-0 report-page">

    {{-- ENCABEZADO --}}
    <div class="report-header mb-4">
        <div>
            <div class="text-primary fw-semibold small mb-1">
                <i class="bi bi-file-earmark-bar-graph me-1"></i> CENTRO DE REPORTES
            </div>
            <h2 class="fw-bold mb-1">Reporte de participación</h2>
            <p class="text-muted mb-0">
                Un Sorbito Hoy, Un Problema Mañana
                · Armenia, Quindío
            </p>
        </div>

        <div class="report-actions">
            <a href="{{ route('admin.reportes.pdf', request()->query()) }}"
               class="btn btn-danger" target="_blank">
                <i class="bi bi-file-earmark-pdf me-1"></i> PDF
            </a>
            <a href="{{ route('admin.reportes.excel', request()->query()) }}"
               class="btn btn-success">
                <i class="bi bi-file-earmark-spreadsheet me-1"></i> Excel
            </a>
            <a href="{{ route('admin.reportes.csv', request()->query()) }}"
               class="btn btn-outline-primary">
                <i class="bi bi-filetype-csv me-1"></i> CSV
            </a>
            <button type="button" class="btn btn-outline-secondary" onclick="window.print()">
                <i class="bi bi-printer me-1"></i> Imprimir
            </button>
        </div>
    </div>

    {{-- FILTROS --}}
    <div class="card border-0 shadow-sm mb-4 no-print">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <div>
                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-funnel me-2 text-primary"></i>Filtros del reporte
                    </h5>
                    <p class="text-muted small mb-0">
                        Selecciona el periodo y las características que deseas analizar.
                    </p>
                </div>
                @if($hayFiltros)
                    <span class="badge rounded-pill text-bg-primary">
                        <i class="bi bi-check-circle me-1"></i> Filtros aplicados
                    </span>
                @endif
            </div>

            <form method="GET" action="{{ route('admin.estadisticas.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-6 col-md-2">
                        <label class="form-label fw-semibold">Desde</label>
                        <input type="date" name="desde" class="form-control" value="{{ $desde }}">
                    </div>

                    <div class="col-6 col-md-2">
                        <label class="form-label fw-semibold">Hasta</label>
                        <input type="date" name="hasta" class="form-control" value="{{ $hasta }}">
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label fw-semibold">Zona o barrio</label>
                        <select name="zona" class="form-select">
                            <option value="">Todas las zonas</option>
                            @foreach($zonas as $z)
                                <option value="{{ $z }}" @selected($zonaSeleccionada === $z)>
                                    {{ \Illuminate\Support\Str::title($z) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-2">
                        <label class="form-label fw-semibold">Rol familiar</label>
                        <select name="rol" class="form-select">
                            <option value="">Todos</option>
                            @foreach($roles as $r)
                                <option value="{{ $r }}" @selected($rolSeleccionado === $r)>
                                    {{ \Illuminate\Support\Str::title($r) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-search me-1"></i> Generar reporte
                        </button>
                        <a href="{{ route('admin.estadisticas.index') }}"
                           class="btn btn-outline-secondary" title="Limpiar filtros">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- INFORMACIÓN DEL REPORTE --}}
    <div class="report-meta card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <span class="meta-label">Periodo</span>
                    <strong>
                        @if($desde || $hasta)
                            {{ $desde ?: 'Inicio' }} — {{ $hasta ?: 'Actualidad' }}
                        @else
                            Todos los registros
                        @endif
                    </strong>
                </div>
                <div class="col-12 col-md-4">
                    <span class="meta-label">Zona</span>
                    <strong>{{ $zonaSeleccionada ? \Illuminate\Support\Str::title($zonaSeleccionada) : 'Todas las zonas' }}</strong>
                </div>
                <div class="col-12 col-md-4">
                    <span class="meta-label">Rol familiar</span>
                    <strong>{{ $rolSeleccionado ? \Illuminate\Support\Str::title($rolSeleccionado) : 'Todos' }}</strong>
                </div>
            </div>
        </div>
    </div>

    {{-- RESUMEN EJECUTIVO --}}
    <div class="section-title">
        <div>
            <span>01</span>
            <div>
                <h4>Resumen ejecutivo</h4>
                <p>Indicadores principales de participación.</p>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        @php
            $resumenKpis = [
                ['bi-people-fill', 'Participantes registrados', $totalParticipantes, null, 'blue'],
                ['bi-person-lock', 'Participaciones anónimas', $totalAnonimos, $pct($totalAnonimos, $totalParticipantes), 'gold'],
                ['bi-geo-alt-fill', 'Registros geolocalizados', $totalGeolocalizados, $pct($totalGeolocalizados, $totalParticipantes), 'green'],
                ['bi-emoji-smile-fill', 'Participantes con avatar', $totalConAvatar, $pct($totalConAvatar, $totalParticipantes), 'purple'],
                ['bi-signpost-split-fill', 'Personas con avance', $totalAvance, $pct($totalAvance, $totalParticipantes), 'blue'],
                ['bi-trophy-fill', 'Medallas obtenidas', $totalMedallas, null, 'gold'],
            ];
        @endphp

        @foreach($resumenKpis as [$icon, $label, $value, $percentage, $color])
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="summary-card {{ $color }}">
                    <div class="summary-icon"><i class="bi {{ $icon }}"></i></div>
                    <div class="flex-grow-1">
                        <div class="summary-label">{{ $label }}</div>
                        <div class="summary-value">{{ number_format($value) }}</div>
                        @if($percentage !== null)
                            <div class="small text-muted">{{ $percentage }}% del total</div>
                            <div class="progress mt-2">
                                <div class="progress-bar" style="width:{{ $percentage }}%"></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- RESULTADOS EDUCATIVOS --}}
    <div class="section-title">
        <div>
            <span>02</span>
            <div>
                <h4>Resultados educativos</h4>
                <p>Avance registrado en las escenas y evaluaciones.</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="metric-box">
                        <span>Personas con avance</span>
                        <strong>{{ number_format($totalAvance) }}</strong>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="metric-box">
                        <span>Escenas completadas</span>
                        <strong>{{ number_format($totalEscenas) }}</strong>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="metric-box">
                        <span>Preguntas respondidas</span>
                        <strong>{{ number_format($totalPreguntas) }}</strong>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="metric-box">
                        <span>Aciertos</span>
                        <strong>{{ number_format($totalAciertos) }}</strong>
                        <small>{{ $porcentajeAciertos }}% de acierto</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- HALLAZGOS --}}
    @if(!empty($hallazgos))
        <div class="section-title">
            <div>
                <span>03</span>
                <div>
                    <h4>Hallazgos principales</h4>
                    <p>Aspectos relevantes identificados en el periodo consultado.</p>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            @foreach($hallazgos as [$icono, $titulo, $valor, $detalle])
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="finding-card">
                        <div class="finding-icon"><i class="bi {{ $icono }}"></i></div>
                        <div>
                            <div class="finding-title">{{ $titulo }}</div>
                            <div class="finding-value">{{ $valor }}</div>
                            <div class="finding-detail">{{ $detalle }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- PARTICIPACIÓN POR ZONA --}}
    <div class="section-title">
        <div>
            <span>04</span>
            <div>
                <h4>Participación por zona</h4>
                <p>Distribución de participantes según la zona registrada.</p>
            </div>
        </div>
        <button type="button" id="exportar-zonas" class="btn btn-sm btn-outline-primary no-print">
            <i class="bi bi-download me-1"></i> CSV
        </button>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-0">
            @if($resumenZonas->isEmpty())
                <div class="text-center text-muted py-5">
                    No hay registros para los filtros seleccionados.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="tabla-zonas">
                        <thead>
                            <tr>
                                <th class="ps-4">Zona o barrio</th>
                                <th class="text-end">Participantes</th>
                                <th class="text-end">% total</th>
                                <th class="text-end">Anónimos</th>
                                <th class="text-end">Con avatar</th>
                                <th class="text-end">Escenas</th>
                                <th class="text-end pe-4">Medallas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resumenZonas as $fila)
                                <tr>
                                    <td class="ps-4 fw-semibold">{{ $fila->zona }}</td>
                                    <td class="text-end">{{ number_format($fila->total) }}</td>
                                    <td class="text-end">{{ $pct($fila->total, $totalParticipantes) }}%</td>
                                    <td class="text-end">{{ number_format($fila->anonimos) }}</td>
                                    <td class="text-end">{{ number_format($fila->con_avatar) }}</td>
                                    <td class="text-end">{{ number_format($fila->escenas) }}</td>
                                    <td class="text-end pe-4">{{ number_format($fila->medallas) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- CONCLUSIÓN --}}
    <div class="section-title">
        <div>
            <span>05</span>
            <div>
                <h4>Conclusión del reporte</h4>
                <p>Resumen general para seguimiento administrativo.</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4 conclusion-card">
        <div class="card-body p-4">
            <p class="mb-2">
                Durante el periodo consultado se registraron
                <strong>{{ number_format($totalParticipantes) }}</strong> participantes.
                De ellos,
                <strong>{{ number_format($totalAvance) }}</strong>
                presentan avance en el contenido educativo.
            </p>
            <p class="mb-2">
                Se registraron
                <strong>{{ number_format($totalMedallas) }}</strong> medallas,
                con {{ number_format($totalPreguntas) }} preguntas respondidas
                y {{ number_format($totalAciertos) }} respuestas acertadas.
            </p>
            <p class="mb-0 text-muted">
                Este reporte corresponde exclusivamente a los filtros seleccionados
                y puede descargarse en PDF, Excel o CSV para su archivo y seguimiento.
            </p>
        </div>
    </div>

    {{-- ACTIVIDAD RECIENTE --}}
    @if(isset($recientes))
        <div class="section-title">
            <div>
                <span>06</span>
                <div>
                    <h4>Actividad reciente</h4>
                    <p>Últimos registros asociados al periodo consultado.</p>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Participante</th>
                                <th>Rol familiar</th>
                                <th>Zona</th>
                                <th>Avatar</th>
                                <th class="pe-4">Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recientes as $r)
                                <tr>
                                    <td class="ps-4 fw-semibold">#{{ $r->id }}</td>
                                    <td>{{ $r->rol_familiar ? \Illuminate\Support\Str::title($r->rol_familiar) : 'No registrado' }}</td>
                                    <td>{{ $r->zona ? \Illuminate\Support\Str::title(trim($r->zona)) : 'No registrada' }}</td>
                                    <td>{{ $r->avatar ?: 'Sin avatar' }}</td>
                                    <td class="pe-4">
                                        {{ \Carbon\Carbon::parse($r->created_at)->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        No hay actividad reciente.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <div class="report-footer">
        <span>Generado desde el panel administrativo</span>
        <span>{{ now()->format('d/m/Y H:i') }}</span>
    </div>
</div>

<style>
.report-page {
    color:#172b4d;
}
.report-header {
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:20px;
}
.report-actions {
    display:flex;
    flex-wrap:wrap;
    gap:8px;
}
.report-meta {
    border-left:4px solid #2878d0 !important;
}
.meta-label {
    display:block;
    font-size:.75rem;
    text-transform:uppercase;
    letter-spacing:.04em;
    color:#667085;
    margin-bottom:4px;
}
.section-title {
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:15px;
    margin:28px 0 14px;
}
.section-title > div:first-child {
    display:flex;
    align-items:center;
    gap:12px;
}
.section-title > div:first-child > span {
    width:34px;
    height:34px;
    display:grid;
    place-items:center;
    border-radius:10px;
    background:#edf4ff;
    color:#2878d0;
    font-weight:800;
    font-size:.8rem;
}
.section-title h4 {
    font-size:1.05rem;
    font-weight:800;
    margin:0;
}
.section-title p {
    margin:2px 0 0;
    color:#667085;
    font-size:.82rem;
}
.summary-card {
    height:100%;
    display:flex;
    align-items:center;
    gap:15px;
    padding:20px;
    border-radius:16px;
    background:#fff;
    box-shadow:0 .125rem .35rem rgba(0,0,0,.08);
    border-left:4px solid #2878d0;
}
.summary-card.gold { border-left-color:#d9a52e; }
.summary-card.green { border-left-color:#239b78; }
.summary-card.purple { border-left-color:#7046b5; }
.summary-icon {
    width:50px;
    height:50px;
    border-radius:14px;
    display:grid;
    place-items:center;
    background:#edf4ff;
    color:#2878d0;
    font-size:1.35rem;
    flex-shrink:0;
}
.summary-card.gold .summary-icon { background:#fff6df; color:#b78112; }
.summary-card.green .summary-icon { background:#e5f7f0; color:#168260; }
.summary-card.purple .summary-icon { background:#f0e9ff; color:#7046b5; }
.summary-label {
    color:#667085;
    font-size:.82rem;
    font-weight:600;
}
.summary-value {
    font-size:1.9rem;
    line-height:1.2;
    font-weight:800;
    margin:3px 0;
}
.progress {
    height:6px;
    background:#edf0f4;
}
.summary-card .progress-bar {
    background:#2878d0;
}
.summary-card.gold .progress-bar { background:#d9a52e; }
.summary-card.green .progress-bar { background:#239b78; }
.summary-card.purple .progress-bar { background:#7046b5; }
.metric-box {
    padding:18px;
    background:#f8fafc;
    border-radius:14px;
    border:1px solid #edf0f4;
    height:100%;
}
.metric-box span {
    display:block;
    color:#667085;
    font-size:.8rem;
    font-weight:600;
}
.metric-box strong {
    display:block;
    font-size:1.7rem;
    margin-top:4px;
}
.metric-box small {
    color:#667085;
}
.finding-card {
    display:flex;
    align-items:center;
    gap:13px;
    height:100%;
    padding:17px;
    background:#fff;
    border-radius:15px;
    box-shadow:0 .125rem .3rem rgba(0,0,0,.07);
}
.finding-icon {
    width:44px;
    height:44px;
    border-radius:12px;
    display:grid;
    place-items:center;
    background:#edf4ff;
    color:#2878d0;
    flex-shrink:0;
}
.finding-title {
    font-size:.78rem;
    color:#667085;
    font-weight:600;
}
.finding-value {
    font-size:1.15rem;
    font-weight:800;
}
.finding-detail {
    font-size:.75rem;
    color:#667085;
}
.table thead th {
    background:#f8fafc;
    color:#475467;
    font-size:.78rem;
    text-transform:uppercase;
    letter-spacing:.02em;
    white-space:nowrap;
}
.conclusion-card {
    border-left:4px solid #239b78 !important;
}
.report-footer {
    display:flex;
    justify-content:space-between;
    border-top:1px solid #e5e7eb;
    padding:15px 0;
    color:#98a2b3;
    font-size:.78rem;
}
@media(max-width:768px) {
    .report-header {
        flex-direction:column;
    }
    .report-actions {
        width:100%;
    }
    .report-actions .btn {
        flex:1;
    }
}
@media print {
    .no-print,
    .admin-sidebar,
    .sidebar,
    .navbar,
    nav,
    header .btn,
    .report-actions {
        display:none !important;
    }
    .report-page {
        width:100% !important;
    }
    .card,
    .summary-card,
    .finding-card {
        box-shadow:none !important;
        break-inside:avoid;
    }
    .section-title {
        break-after:avoid;
    }
    body {
        background:#fff !important;
    }
}
</style>

<script>
(function () {
    const boton = document.getElementById('exportar-zonas');
    const tabla = document.getElementById('tabla-zonas');

    if (!boton || !tabla) return;

    boton.addEventListener('click', function () {
        const filas = Array.from(tabla.querySelectorAll('tr'));

        const csv = filas.map(function (fila) {
            return Array.from(fila.children)
                .map(function (celda) {
                    return '"' + celda.innerText
                        .trim()
                        .replace(/\s+/g, ' ')
                        .replace(/"/g, '""') + '"';
                })
                .join(';');
        }).join('\r\n');

        const blob = new Blob(
            ['\ufeff' + csv],
            { type: 'text/csv;charset=utf-8;' }
        );

        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');

        a.href = url;
        a.download = 'reporte-participantes-por-zona.csv';

        document.body.appendChild(a);
        a.click();
        a.remove();

        URL.revokeObjectURL(url);
    });
})();
</script>
@endsection
