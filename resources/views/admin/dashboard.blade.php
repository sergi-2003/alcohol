@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<style>
    .dashboard-wrap { display:flex; flex-direction:column; gap:24px; }
    .welcome-card {
        position:relative; overflow:hidden; padding:28px 30px; border-radius:20px;
        background:linear-gradient(135deg,#0d47a1 0%,#1565c0 55%,#1976d2 100%);
        color:#fff; box-shadow:0 12px 30px rgba(13,71,161,.16);
    }
    .welcome-card:after { content:""; position:absolute; width:230px; height:230px; right:-70px; top:-100px; border-radius:50%; background:rgba(255,255,255,.10); }
    .welcome-card h2 { margin:0 0 7px; font-size:25px; font-weight:800; }
    .welcome-card p { margin:0; max-width:760px; color:rgba(255,255,255,.88); }
    .welcome-meta { margin-top:18px; display:flex; flex-wrap:wrap; gap:10px; }
    .welcome-pill { padding:7px 12px; border:1px solid rgba(255,255,255,.20); border-radius:999px; background:rgba(255,255,255,.10); font-size:13px; }

    .section-title { display:flex; justify-content:space-between; align-items:center; gap:15px; margin-bottom:13px; }
    .section-title h3 { margin:0; font-size:18px; color:#172033; font-weight:800; }
    .section-title span { color:#718096; font-size:13px; }

    .stats-grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:16px; }
    .stat-card { background:#fff; border:1px solid #e7edf5; border-radius:17px; padding:19px; box-shadow:0 5px 18px rgba(30,41,59,.05); }
    .stat-top { display:flex; justify-content:space-between; align-items:flex-start; gap:12px; }
    .stat-label { color:#64748b; font-size:13px; font-weight:700; }
    .stat-value { margin-top:5px; color:#172033; font-size:28px; font-weight:850; line-height:1.1; }
    .stat-icon { width:42px; height:42px; display:grid; place-items:center; border-radius:12px; background:#eef5ff; color:#1565c0; font-size:17px; }
    .stat-foot { margin-top:12px; color:#718096; font-size:12px; }
    .stat-foot strong { color:#334155; }

    .grid-2 { display:grid; grid-template-columns:1.35fr .9fr; gap:20px; }
    .grid-3 { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:20px; }
    .panel { background:#fff; border:1px solid #e7edf5; border-radius:18px; padding:21px; box-shadow:0 5px 18px rgba(30,41,59,.045); }

    .progress-row { margin-bottom:17px; }
    .progress-head { display:flex; justify-content:space-between; gap:10px; margin-bottom:7px; font-size:13px; }
    .progress-head span:first-child { color:#334155; font-weight:700; }
    .progress-head span:last-child { color:#64748b; font-weight:700; }
    .bar { height:9px; border-radius:99px; background:#edf2f7; overflow:hidden; }
    .bar > span { display:block; height:100%; border-radius:99px; background:linear-gradient(90deg,#1565c0,#2f80ed); }

    .mini-list { display:flex; flex-direction:column; gap:12px; }
    .mini-item { display:flex; justify-content:space-between; gap:15px; align-items:center; padding:11px 0; border-bottom:1px solid #edf1f6; }
    .mini-item:last-child { border-bottom:0; padding-bottom:0; }
    .mini-name { min-width:0; color:#334155; font-size:13px; font-weight:700; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .mini-count { min-width:30px; text-align:right; color:#1565c0; font-weight:800; }
    .empty { padding:20px 0; color:#94a3b8; text-align:center; font-size:13px; }

    .activity-list { display:flex; flex-direction:column; }
    .activity-item { display:flex; gap:13px; padding:14px 0; border-bottom:1px solid #edf1f6; }
    .activity-item:last-child { border-bottom:0; }
    .activity-dot { flex:0 0 36px; width:36px; height:36px; display:grid; place-items:center; border-radius:11px; background:#eef5ff; color:#1565c0; }
    .activity-main { min-width:0; flex:1; }
    .activity-main strong { display:block; color:#253046; font-size:13px; }
    .activity-main p { margin:3px 0 0; color:#64748b; font-size:12px; }
    .activity-date { margin-top:3px; color:#94a3b8; font-size:11px; }

    .quick-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:12px; }
    .quick-action { display:flex; align-items:center; gap:10px; padding:13px; border:1px solid #e6edf6; border-radius:13px; color:#334155; text-decoration:none; transition:.18s ease; }
    .quick-action:hover { transform:translateY(-2px); border-color:#b9d2f5; background:#f8fbff; color:#1565c0; }
    .quick-action i { color:#1565c0; }

    @media(max-width:1050px){ .stats-grid{grid-template-columns:repeat(2,1fr)} .grid-2,.grid-3{grid-template-columns:1fr} }
    @media(max-width:650px){ .stats-grid,.quick-grid{grid-template-columns:1fr} .welcome-card{padding:23px} }
</style>

<div class="dashboard-wrap">
    <div class="welcome-card">
        <h2>Bienvenido, {{ Auth::user()->nombre }}</h2>
        <p>Consulta en un solo lugar la participación, los contenidos, las evaluaciones y el progreso de <strong>MI DECISIÓN</strong>.</p>
        <div class="welcome-meta">
            <span class="welcome-pill"><i class="fa-solid fa-users"></i> {{ number_format($stats['participantes']) }} participantes</span>
            <span class="welcome-pill"><i class="fa-solid fa-book-open"></i> {{ number_format($stats['contenidos']) }} contenidos activos</span>
            <span class="welcome-pill"><i class="fa-solid fa-chart-line"></i> {{ $stats['progreso_promedio'] }}% progreso promedio</span>
        </div>
    </div>

    <section>
        <div class="section-title">
            <h3>Resumen general</h3>
            <span>Datos consultados directamente de la base de datos</span>
        </div>
        <div class="stats-grid">
            <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Participantes</div><div class="stat-value">{{ number_format($stats['participantes']) }}</div></div><div class="stat-icon"><i class="fa-solid fa-users"></i></div></div><div class="stat-foot"><strong>{{ $stats['participantes_identificados'] }}</strong> identificados · <strong>{{ $stats['participantes_anonimos'] }}</strong> anónimos</div></div>
            <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Usuarios administrativos</div><div class="stat-value">{{ number_format($stats['usuarios']) }}</div></div><div class="stat-icon"><i class="fa-solid fa-user-shield"></i></div></div><div class="stat-foot">Usuarios activos del sistema</div></div>
            <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Contenidos activos</div><div class="stat-value">{{ number_format($stats['contenidos']) }}</div></div><div class="stat-icon"><i class="fa-solid fa-book-open"></i></div></div><div class="stat-foot">Material educativo disponible</div></div>
            <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Quizzes activos</div><div class="stat-value">{{ number_format($stats['quizzes']) }}</div></div><div class="stat-icon"><i class="fa-solid fa-clipboard-question"></i></div></div><div class="stat-foot"><strong>{{ number_format($stats['intentos']) }}</strong> intentos registrados</div></div>
            <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Aprobación</div><div class="stat-value">{{ $stats['porcentaje_aprobacion'] }}%</div></div><div class="stat-icon"><i class="fa-solid fa-circle-check"></i></div></div><div class="stat-foot">{{ number_format($stats['aprobados']) }} intentos aprobados</div></div>
            <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Certificados emitidos</div><div class="stat-value">{{ number_format($stats['certificados']) }}</div></div><div class="stat-icon"><i class="fa-solid fa-certificate"></i></div></div><div class="stat-foot">Certificados actualmente emitidos</div></div>
            <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Puntos acumulados</div><div class="stat-value">{{ number_format($stats['puntos']) }}</div></div><div class="stat-icon"><i class="fa-solid fa-star"></i></div></div><div class="stat-foot">Puntos registrados en gamificación</div></div>
            <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Insignias obtenidas</div><div class="stat-value">{{ number_format($stats['insignias']) }}</div></div><div class="stat-icon"><i class="fa-solid fa-award"></i></div></div><div class="stat-foot"><strong>{{ $stats['participantes_completaron'] }}</strong> participantes con temas completados</div></div>
            <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Medallas de escenas</div><div class="stat-value">{{ number_format($stats['medallas_escenas'] ?? 0) }}</div></div><div class="stat-icon"><i class="fa-solid fa-medal"></i></div></div><div class="stat-foot">Medallas obtenidas en las escenas del recorrido</div></div>
        </div>
    </section>

    <div class="grid-2">
        <div class="panel">
            <div class="section-title"><h3>Progreso por tema</h3><span>Promedio de avance</span></div>
            @forelse($progresoTemas as $tema)
                <div class="progress-row">
                    <div class="progress-head"><span>{{ $tema->titulo }}</span><span>{{ $tema->promedio }}%</span></div>
                    <div class="bar"><span style="width: {{ min(100, max(0, (float)$tema->promedio)) }}%"></span></div>
                </div>
            @empty
                <div class="empty">Todavía no hay registros de progreso.</div>
            @endforelse
        </div>

        <div class="panel">
            <div class="section-title"><h3>Participación</h3><span>Distribución actual</span></div>
            <div class="progress-row"><div class="progress-head"><span>Identificados</span><span>{{ $stats['participantes'] ? round($stats['participantes_identificados'] / $stats['participantes'] * 100, 1) : 0 }}%</span></div><div class="bar"><span style="width:{{ $stats['participantes'] ? ($stats['participantes_identificados'] / $stats['participantes'] * 100) : 0 }}%"></span></div></div>
            <div class="progress-row"><div class="progress-head"><span>Anónimos</span><span>{{ $stats['participantes'] ? round($stats['participantes_anonimos'] / $stats['participantes'] * 100, 1) : 0 }}%</span></div><div class="bar"><span style="width:{{ $stats['participantes'] ? ($stats['participantes_anonimos'] / $stats['participantes'] * 100) : 0 }}%"></span></div></div>
            <div class="progress-row"><div class="progress-head"><span>Progreso promedio</span><span>{{ $stats['progreso_promedio'] }}%</span></div><div class="bar"><span style="width:{{ min(100, max(0, $stats['progreso_promedio'])) }}%"></span></div></div>
        </div>
    </div>

    <div class="grid-3">
        <div class="panel"><div class="section-title"><h3>Instituciones</h3><span>Top 5</span></div><div class="mini-list">@forelse($topInstituciones as $item)<div class="mini-item"><span class="mini-name">{{ $item->institucion }}</span><span class="mini-count">{{ $item->total }}</span></div>@empty<div class="empty">Sin datos.</div>@endforelse</div></div>
        <div class="panel"><div class="section-title"><h3>Municipios</h3><span>Top 5</span></div><div class="mini-list">@forelse($topMunicipios as $item)<div class="mini-item"><span class="mini-name">{{ $item->municipio }}</span><span class="mini-count">{{ $item->total }}</span></div>@empty<div class="empty">Sin datos.</div>@endforelse</div></div>
        <div class="panel"><div class="section-title"><h3>Actividad reciente</h3><span>Últimos movimientos</span></div><div class="activity-list">@forelse($actividades as $actividad)<div class="activity-item"><div class="activity-dot"><i class="fa-solid fa-bolt"></i></div><div class="activity-main"><strong>{{ $actividad->accion }}</strong><p>{{ $actividad->descripcion ?: ($actividad->usuario_nombre ?: 'Movimiento registrado') }}</p><div class="activity-date">{{ \Carbon\Carbon::parse($actividad->created_at)->diffForHumans() }}</div></div></div>@empty<div class="empty">No hay actividad registrada todavía.</div>@endforelse</div></div>
    </div>

    <div class="panel">
        <div class="section-title">
            <h3>Progreso de escenas</h3>
            <span>Medallas y avance registrados</span>
        </div>

        @if(isset($medallasEscenas) && $medallasEscenas->count())
            <div class="mini-list">
                @foreach($medallasEscenas as $escena)
                    @php
                        $totalEscenas = max(1, (int) ($escena->total_escenas ?? 4));
                        $completadas = min(
                            $totalEscenas,
                            max(0, (int) ($escena->escenas_completadas ?? 0))
                        );
                        $medallas = max(0, (int) ($escena->medallas ?? 0));
                        $porcentaje = min(
                            100,
                            max(0, round(($completadas / $totalEscenas) * 100))
                        );
                    @endphp

                    <div style="padding:14px 0;border-bottom:1px solid #edf1f6;">
                        <div style="display:flex;justify-content:space-between;gap:12px;align-items:center;margin-bottom:8px;">
                            <div style="min-width:0;">
                                <div style="font-weight:800;color:#253046;font-size:13px;">
                                    {{ $escena->nombre ?: ('Participante #' . $escena->participante_id) }}
                                </div>

                                <div style="color:#94a3b8;font-size:11px;margin-top:3px;">
                                    {{ $completadas }}/{{ $totalEscenas }} escenas completadas
                                    · {{ $porcentaje }}% del recorrido
                                </div>
                            </div>

                            <div style="display:flex;gap:8px;align-items:center;white-space:nowrap;">
                                <span style="font-size:12px;font-weight:800;color:#1565c0;">
                                    {{ $medallas }}
                                    medalla{{ $medallas == 1 ? '' : 's' }}
                                </span>
                                <i class="fa-solid fa-medal" style="color:#d4a72c;"></i>
                            </div>
                        </div>

                        <div class="bar">
                            <span style="width:{{ $porcentaje }}%"></span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty">
                Todavía no hay registros de avance en las escenas.
            </div>
        @endif
    </div>

    <div class="panel">
        <div class="section-title"><h3>Acciones rápidas</h3><a href="{{ route('admin.indicadores') }}" style="font-size:13px;text-decoration:none;color:#1565c0;font-weight:700;">Ver indicadores</a></div>
        <div class="quick-grid">
            <a href="{{ route('admin.usuarios.create') }}" class="quick-action"><i class="fa-solid fa-user-plus"></i><span>Crear usuario</span></a>
            <a href="{{ route('admin.contenidos.create') }}" class="quick-action"><i class="fa-solid fa-file-circle-plus"></i><span>Crear contenido</span></a>
            <a href="{{ route('admin.temas.create') }}" class="quick-action"><i class="fa-solid fa-book-open"></i><span>Crear tema</span></a>
            <a href="{{ route('admin.estadisticas.index') }}" class="quick-action"><i class="fa-solid fa-chart-column"></i><span>Ver reportes</span></a>
        </div>
    </div>
</div>
@endsection
