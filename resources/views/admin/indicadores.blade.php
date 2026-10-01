@extends('admin.layouts.app')

@section('title', 'Indicadores de participación')
@section('page-title', 'Indicadores de participación')

@section('content')
<style>
    .ind-wrap{--ind-blue:#15276a;--ind-green:#1e9b62;--ind-gold:#f1c40f;--ind-muted:#64748b;color:#1e293b}
    .ind-wrap *{box-sizing:border-box}
    .ind-head{display:flex;justify-content:space-between;align-items:flex-start;gap:18px;flex-wrap:wrap;margin-bottom:22px}
    .ind-head h1{font-size:clamp(1.55rem,2vw,2rem);font-weight:800;color:var(--ind-blue);margin:0 0 5px}
    .ind-head p{margin:0;color:var(--ind-muted)}
    .ind-tag{background:#e8f6ef;color:#167449;border-radius:999px;padding:8px 12px;font-size:.8rem;font-weight:700}
    .ind-kpis{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin-bottom:18px}
    .ind-card{background:#fff;border:1px solid #e7edf4;border-radius:17px;padding:19px;box-shadow:0 5px 18px rgba(21,39,106,.045);min-width:0}
    .ind-kpi{display:flex;gap:13px;align-items:center}
    .ind-icon{width:47px;height:47px;display:grid;place-items:center;border-radius:14px;font-size:1.25rem;flex-shrink:0}
    .ind-icon.blue{background:#e8eeff;color:#2447a5}.ind-icon.green{background:#e3f7ed;color:#14804a}.ind-icon.gold{background:#fff5ce;color:#a87900}.ind-icon.purple{background:#f0e9ff;color:#7046b5}
    .ind-label{font-size:.84rem;color:#64748b;margin-bottom:5px}.ind-value{font-size:1.75rem;line-height:1.1;font-weight:800;color:#15276a}.ind-sub{font-size:.78rem;color:#64748b;margin-top:5px}
    .ind-grid{display:grid;grid-template-columns:minmax(0,1.45fr) minmax(280px,1fr);gap:18px;margin-bottom:18px}
    .ind-dist{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px;margin-bottom:18px}
    .ind-stack{display:flex;flex-direction:column;gap:18px;min-width:0}
    .ind-card h2{font-size:1.05rem;font-weight:800;color:var(--ind-blue);margin:0 0 16px}
    .ind-filters{display:grid;grid-template-columns:2fr 1.2fr 1.2fr 1fr 1fr auto;gap:10px;align-items:end;margin-bottom:16px}
    .ind-field label{display:block;font-size:.78rem;font-weight:700;color:#475569;margin-bottom:6px}
    .ind-field input,.ind-field select{width:100%;min-width:0;border:1px solid #dbe3ed;border-radius:10px;padding:10px 11px;background:#fff;color:#1e293b;outline:none}
    .ind-field input:focus,.ind-field select:focus{border-color:#4772d5;box-shadow:0 0 0 3px rgba(71,114,213,.12)}
    .ind-btn{border:0;border-radius:10px;padding:11px 15px;background:var(--ind-green);color:#fff;font-weight:800;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;justify-content:center;white-space:nowrap}
    .ind-btn:hover{background:#167c4d;color:#fff}.ind-btn.secondary{background:#eef2f7;color:#334155}
    .ind-table-wrap{overflow-x:auto} .ind-table{width:100%;border-collapse:collapse;min-width:780px;font-size:.86rem}
    .ind-table th{text-align:left;padding:12px 11px;background:#f6f8fc;color:#526078;font-size:.74rem;text-transform:uppercase;letter-spacing:.035em;white-space:nowrap}
    .ind-table td{padding:13px 11px;border-bottom:1px solid #edf1f6;vertical-align:top}
    .ind-table tbody tr:hover{background:#fafcff}
    .ind-person{font-weight:800;color:#1e293b}.ind-small{font-size:.77rem;color:#64748b;margin-top:4px;overflow-wrap:anywhere}
    .ind-pill{display:inline-flex;align-items:center;gap:5px;border-radius:999px;padding:5px 9px;font-size:.74rem;font-weight:800;white-space:nowrap}
    .ind-pill.ok{background:#e2f7eb;color:#167749}.ind-pill.no{background:#fff0e8;color:#b45309}.ind-pill.neutral{background:#edf2f7;color:#475569}.ind-pill.gold{background:#fff5ce;color:#8a6500}
    .ind-av{display:flex;align-items:center;gap:9px}
    .ind-av img{width:34px;height:34px;border-radius:50%;object-fit:cover;object-position:top center;background:#e8eeff;border:2px solid #fff;box-shadow:0 1px 5px rgba(21,39,106,.2)}
    .ind-mini{width:90px;height:7px;border-radius:999px;background:#eef2f7;overflow:hidden;margin-top:6px}
    .ind-mini span{display:block;height:100%;background:linear-gradient(90deg,#3f74dc,#1e9b62)}
    .ind-bars{display:flex;flex-direction:column;gap:13px}.ind-bar-row{display:grid;grid-template-columns:minmax(90px,1fr) 2fr 38px;gap:10px;align-items:center;font-size:.82rem}.ind-bar-label{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:#475569}.ind-track{height:10px;border-radius:999px;background:#eef2f7;overflow:hidden}.ind-fill{height:100%;border-radius:999px;background:linear-gradient(90deg,#1e9b62,#52c98a)}.ind-fill.blue{background:linear-gradient(90deg,#3f74dc,#7aa3f0)}.ind-bar-num{text-align:right;font-weight:800;color:#15276a}
    .ind-note{border-radius:12px;background:#f1f6ff;border:1px solid #dce8ff;color:#405477;padding:12px 14px;font-size:.8rem;line-height:1.5;margin-top:14px}
    .ind-note.warn{background:#fff8e6;border-color:#f3e0a8;color:#6b5210}
    .ind-empty{text-align:center;padding:26px 16px;color:#64748b}.ind-empty strong{display:block;color:#334155;margin-bottom:5px}
    .ind-pagination{padding-top:16px}
    .ind-mini-table{width:100%;border-collapse:collapse;font-size:.84rem}
    .ind-mini-table th{text-align:left;font-size:.72rem;text-transform:uppercase;color:#526078;padding:0 6px 8px;letter-spacing:.03em}
    .ind-mini-table td{padding:9px 6px;border-top:1px solid #edf1f6}
    @media(max-width:1100px){.ind-kpis{grid-template-columns:repeat(2,minmax(0,1fr))}.ind-filters{grid-template-columns:repeat(3,minmax(0,1fr))}.ind-grid{grid-template-columns:1fr}.ind-dist{grid-template-columns:repeat(2,minmax(0,1fr))}}
    @media(max-width:640px){.ind-kpis{grid-template-columns:1fr 1fr;gap:9px}.ind-card{padding:14px}.ind-kpi{align-items:flex-start;gap:9px}.ind-icon{width:38px;height:38px;border-radius:11px;font-size:1rem}.ind-value{font-size:1.4rem}.ind-label{font-size:.76rem}.ind-filters{grid-template-columns:1fr 1fr}.ind-filters .wide{grid-column:1/-1}.ind-head{margin-bottom:16px}.ind-dist{grid-template-columns:1fr}}
</style>

@php
    $total        = (int) $resumen->total;
    $pct          = fn ($n, $d) => $d > 0 ? round(($n / $d) * 100) : 0;
    $totalEscenas = count($escenas);
    $sinAvance    = !$hayAvance || !($avance->escenas_completadas ?? 0);
    $hayFiltros   = collect($filtros)->filter()->isNotEmpty();

    $kpis = [
        ['blue',   'fa-users',           'Participantes registrados',  number_format($total),
            $hayFiltros ? 'Con los filtros · '.number_format($totalGeneral).' en total' : 'Total en la plataforma'],
        ['green',  'fa-face-smile',      'Eligieron su avatar',        number_format((int) $resumen->con_avatar),
            $pct($resumen->con_avatar, $total).'% de los registrados'],
        ['gold',   'fa-user-secret',     'Participación anónima',      number_format((int) $resumen->anonimos),
            $pct($resumen->anonimos, $total).'% prefirió no dar su nombre'],
        ['purple', 'fa-shield-halved',   'Aceptaron el tratamiento de datos', number_format((int) $resumen->aceptan_datos),
            $pct($resumen->aceptan_datos, $total).'% de los registrados'],
        ['blue',   'fa-person-walking',  'Personas con avance',        number_format((int) ($avance->personas ?? 0)),
            'Completaron al menos una escena'],
        ['green',  'fa-flag-checkered',  'Escenas completadas',        number_format((int) ($avance->escenas_completadas ?? 0)),
            'De '.number_format($total * $totalEscenas).' posibles'],
        ['gold',   'fa-medal',           'Medallas ganadas',           number_format((int) ($avance->medallas ?? 0)),
            'Acertaron todo el cuestionario de una escena'],
        ['purple', 'fa-bullseye',        'Aciertos promedio',          number_format((float) ($avance->promedio ?? 0), 1).'%',
            'En los cuestionarios de las escenas'],
    ];

    $bloques = [
        ['Por rol familiar',          'fa-people-roof',   $porRol],
        ['Por municipio',             'fa-location-dot',  $porMunicipio],
        ['Por zona o barrio',         'fa-map-pin',       $porZona],
        ['Avatares más elegidos',     'fa-masks-theater', $porAvatar],
        ['Por grupo de edad',         'fa-cake-candles',  $porEdad],
    ];

    $maxDia = max(1, max($conteosDias ?: [0]));
@endphp

<div class="ind-wrap">
    <div class="ind-head">
        <div>
            <h1>Indicadores de participación</h1>
            <p>Quiénes participan, desde dónde, cómo avanzan por las escenas y qué resultados obtienen.</p>
        </div>
        <span class="ind-tag"><i class="fa-solid fa-chart-line me-1"></i> Datos consultados desde MySQL</span>
    </div>

    {{-- ====== AVISO DE AVANCE ====== --}}
    @if(!$hayAvance)
        <div class="ind-note warn" style="margin:0 0 18px"><strong>Falta la tabla de avance.</strong> Ejecuta <code>php artisan migrate</code> para crear <code>avance_escenas</code>. Mientras tanto, los indicadores de escenas y medallas aparecerán en cero.</div>
    @elseif($sinAvance)
        <div class="ind-note warn" style="margin:0 0 18px"><strong>Aún no hay avances de escenas guardados.</strong> Se registrarán automáticamente cuando los participantes terminen el cuestionario de cada escena.</div>
    @endif

    {{-- ====== KPIs ====== --}}
    <div class="ind-kpis">
        @foreach($kpis as [$color, $icono, $etiqueta, $valor, $sub])
            <div class="ind-card ind-kpi">
                <div class="ind-icon {{ $color }}"><i class="fa-solid {{ $icono }}"></i></div>
                <div>
                    <div class="ind-label">{{ $etiqueta }}</div>
                    <div class="ind-value">{{ $valor }}</div>
                    <div class="ind-sub">{{ $sub }}</div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ====== FILTROS ====== --}}
    <div class="ind-card" style="margin-bottom:18px">
        <h2><i class="fa-solid fa-filter me-2"></i>Filtrar participantes</h2>
        <form method="GET" action="{{ route('admin.indicadores') }}" class="ind-filters">
            <div class="ind-field wide"><label for="buscar">Buscar por nombre, correo, institución o ubicación</label><input id="buscar" name="buscar" value="{{ $filtros['buscar'] ?? '' }}" placeholder="Nombre, correo, barrio..."></div>
            <div class="ind-field"><label for="municipio">Municipio</label><select id="municipio" name="municipio"><option value="">Todos</option>@foreach($opcionesMunicipio as $m)<option value="{{ $m }}" @selected(mb_strtolower($filtros['municipio'] ?? '') === $m)>{{ \Illuminate\Support\Str::title($m) }}</option>@endforeach</select></div>
            <div class="ind-field"><label for="rol">Rol familiar</label><select id="rol" name="rol"><option value="">Todos</option>@foreach($opcionesRol as $r)<option value="{{ $r }}" @selected(mb_strtolower($filtros['rol'] ?? '') === $r)>{{ \Illuminate\Support\Str::title($r) }}</option>@endforeach</select></div>
            <div class="ind-field"><label for="desde">Registro desde</label><input type="date" id="desde" name="desde" value="{{ $filtros['desde'] ?? '' }}"></div>
            <div class="ind-field"><label for="hasta">Registro hasta</label><input type="date" id="hasta" name="hasta" value="{{ $filtros['hasta'] ?? '' }}"></div>
            <button class="ind-btn" type="submit"><i class="fa-solid fa-magnifying-glass me-2"></i>Filtrar</button>
        </form>
        <a class="ind-btn secondary" href="{{ route('admin.indicadores') }}"><i class="fa-solid fa-rotate-left me-2"></i>Limpiar filtros</a>
    </div>

    <div class="ind-grid">
        {{-- ====== LISTADO ====== --}}
        <section class="ind-card">
            <h2><i class="fa-solid fa-users me-2"></i>Participantes recientes</h2>
            @if($participantes->count())
                <div class="ind-table-wrap"><table class="ind-table"><thead><tr><th>Participante</th><th>Rol y edad</th><th>Ubicación</th><th>Avatar</th><th>Avance</th><th>Registro</th></tr></thead><tbody>
                @foreach($participantes as $p)
                    <tr>
                        <td>
                            <div class="ind-person">{{ $p->es_anonimo ? 'Participante anónimo #'.$p->id : ($p->nombre_completo ?: 'Sin nombre') }}</div>
                            @unless($p->es_anonimo)
                                @if($p->correo)<div class="ind-small">{{ $p->correo }}</div>@endif
                                @if($p->institucion)<div class="ind-small">{{ $p->institucion }}</div>@endif
                            @endunless
                        </td>
                        <td>{{ $p->rol_familiar ? \Illuminate\Support\Str::title($p->rol_familiar) : 'No registrado' }}<div class="ind-small">{{ $p->edad ? $p->edad.' años' : 'Edad no registrada' }}</div></td>
                        <td>{{ $p->municipio ? \Illuminate\Support\Str::title(trim($p->municipio)) : 'No registrado' }}<div class="ind-small">{{ $p->zona ?: 'Zona no registrada' }}</div></td>
                        <td>
                            @if($p->avatar)
                                <div class="ind-av"><img src="{{ asset('build/img/avatars/'.trim($p->avatar_imagen)) }}" alt="" loading="lazy"><span>{{ $p->avatar }}</span></div>
                            @else
                                <span class="ind-pill neutral">Sin elegir</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ (int) $p->escenas }}/{{ $totalEscenas }}</strong> <span class="ind-small">escenas</span>
                            <div class="ind-mini"><span style="width:{{ min(100, ($p->escenas / max(1, $totalEscenas)) * 100) }}%"></span></div>
                            <div class="ind-small">{{ (int) $p->xp }} XP @if((int) $p->medallas)· <span class="ind-pill gold"><i class="fa-solid fa-medal"></i> {{ (int) $p->medallas }}</span>@endif</div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
                </tbody></table></div>
                <div class="ind-pagination">{{ $participantes->links() }}</div>
            @else
                <div class="ind-empty"><i class="fa-regular fa-folder-open fa-2x mb-3"></i><strong>No hay participantes que coincidan</strong>Prueba quitando algún filtro.</div>
            @endif
        </section>

        <div class="ind-stack">
            {{-- ====== EMBUDO ====== --}}
            <section class="ind-card">
                <h2><i class="fa-solid fa-filter-circle-dollar me-2" style="display:none"></i><i class="fa-solid fa-route me-2"></i>Recorrido de los participantes</h2>
                <div class="ind-bars">
                    @foreach($embudo as $paso)
                        <div class="ind-bar-row" title="{{ $pct($paso['total'], $total) }}% de los registrados">
                            <div class="ind-bar-label">{{ $paso['etiqueta'] }}</div>
                            <div class="ind-track"><div class="ind-fill blue" style="width:{{ $total > 0 ? min(100, ($paso['total'] / $total) * 100) : 0 }}%"></div></div>
                            <div class="ind-bar-num">{{ $paso['total'] }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="ind-note">Cada barra muestra cuántas personas llegaron a ese paso, comparado con los que se registraron.</div>
            </section>

            {{-- ====== POR ESCENA ====== --}}
            <section class="ind-card">
                <h2><i class="fa-solid fa-layer-group me-2"></i>Resultados por escena</h2>
                <table class="ind-mini-table">
                    <thead><tr><th>Escena</th><th>Personas</th><th>Aciertos</th><th>Medallas</th></tr></thead>
                    <tbody>
                    @foreach($escenas as $n => $nombre)
                        @php $fila = $porEscena->get($n); @endphp
                        <tr>
                            <td><strong>{{ $n }}.</strong> {{ $nombre }}</td>
                            <td>{{ (int) ($fila->personas ?? 0) }}</td>
                            <td>{{ $fila ? number_format((float) $fila->promedio, 0).'%' : '—' }}</td>
                            <td>{{ (int) ($fila->medallas ?? 0) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>

            {{-- ====== REGISTROS POR DÍA ====== --}}
            <section class="ind-card">
                <h2><i class="fa-solid fa-chart-column me-2"></i>Registros · últimos 14 días</h2>
                <div style="height:175px;display:flex;align-items:flex-end;gap:4px;padding-top:12px;border-bottom:1px solid #e8edf4">
                    @foreach($conteosDias as $i => $cantidad)
                        <div title="{{ $dias[$i] }}: {{ $cantidad }} registros" style="flex:1;display:flex;flex-direction:column;justify-content:flex-end;align-items:center;height:100%;gap:5px;min-width:0">
                            <span style="font-size:.68rem;font-weight:800;color:#15276a">{{ $cantidad ?: '' }}</span>
                            <div style="width:min(22px,90%);height:{{ $cantidad > 0 ? max(5, ($cantidad / $maxDia) * 115) : 3 }}px;background:linear-gradient(180deg,#3f74dc,#1e9b62);border-radius:6px 6px 2px 2px"></div>
                            <span style="font-size:.6rem;color:#64748b;white-space:nowrap;{{ $i % 2 ? 'visibility:hidden' : '' }}">{{ $dias[$i] }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="ind-small" style="margin-top:12px">Respeta los filtros de arriba. Cuenta los participantes por fecha de registro.</div>
            </section>
        </div>
    </div>

    {{-- ====== DISTRIBUCIONES ====== --}}
    <div class="ind-dist">
        @foreach($bloques as [$titulo, $icono, $datos])
            @php $max = max(1, (int) $datos->max('total')); @endphp
            <section class="ind-card">
                <h2><i class="fa-solid {{ $icono }} me-2"></i>{{ $titulo }}</h2>
                <div class="ind-bars">
                    @forelse($datos as $fila)
                        <div class="ind-bar-row" title="{{ $pct($fila->total, $total) }}% de los participantes">
                            <div class="ind-bar-label">{{ $fila->etiqueta }}</div>
                            <div class="ind-track"><div class="ind-fill" style="width:{{ min(100, ($fila->total / $max) * 100) }}%"></div></div>
                            <div class="ind-bar-num">{{ $fila->total }}</div>
                        </div>
                    @empty
                        <div class="ind-empty">Sin datos todavía.</div>
                    @endforelse
                </div>
                @if($titulo === 'Por municipio' || $titulo === 'Por zona o barrio')
                    <div class="ind-note">La ubicación es la que cada persona escribió al registrarse. Si hay escrituras distintas de un mismo lugar, aparecen por separado.</div>
                @endif
            </section>
        @endforeach
    </div>
</div>
@endsection