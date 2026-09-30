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
    .ind-card h2{font-size:1.05rem;font-weight:800;color:var(--ind-blue);margin:0 0 16px}
    .ind-filters{display:grid;grid-template-columns:2fr 1.3fr 1.2fr 1fr 1fr auto;gap:10px;align-items:end;margin-bottom:16px}
    .ind-field label{display:block;font-size:.78rem;font-weight:700;color:#475569;margin-bottom:6px}
    .ind-field input,.ind-field select{width:100%;min-width:0;border:1px solid #dbe3ed;border-radius:10px;padding:10px 11px;background:#fff;color:#1e293b;outline:none}
    .ind-field input:focus,.ind-field select:focus{border-color:#4772d5;box-shadow:0 0 0 3px rgba(71,114,213,.12)}
    .ind-btn{border:0;border-radius:10px;padding:11px 15px;background:var(--ind-green);color:#fff;font-weight:800;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;justify-content:center;white-space:nowrap}
    .ind-btn:hover{background:#167c4d;color:#fff}.ind-btn.secondary{background:#eef2f7;color:#334155}
    .ind-table-wrap{overflow-x:auto} .ind-table{width:100%;border-collapse:collapse;min-width:950px;font-size:.86rem}
    .ind-table th{text-align:left;padding:12px 11px;background:#f6f8fc;color:#526078;font-size:.74rem;text-transform:uppercase;letter-spacing:.035em;white-space:nowrap}
    .ind-table td{padding:13px 11px;border-bottom:1px solid #edf1f6;vertical-align:top}
    .ind-table tbody tr:hover{background:#fafcff}
    .ind-person{font-weight:800;color:#1e293b}.ind-small{font-size:.77rem;color:#64748b;margin-top:4px;overflow-wrap:anywhere}
    .ind-pill{display:inline-flex;align-items:center;border-radius:999px;padding:5px 9px;font-size:.74rem;font-weight:800;white-space:nowrap}
    .ind-pill.ok{background:#e2f7eb;color:#167749}.ind-pill.no{background:#fff0e8;color:#b45309}.ind-pill.neutral{background:#edf2f7;color:#475569}
    .ind-bars{display:flex;flex-direction:column;gap:13px}.ind-bar-row{display:grid;grid-template-columns:minmax(90px,1fr) 2fr 35px;gap:10px;align-items:center;font-size:.82rem}.ind-bar-label{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:#475569}.ind-track{height:10px;border-radius:999px;background:#eef2f7;overflow:hidden}.ind-fill{height:100%;border-radius:999px;background:linear-gradient(90deg,#1e9b62,#52c98a)}.ind-bar-num{text-align:right;font-weight:800;color:#15276a}
    .ind-note{border-radius:12px;background:#f1f6ff;border:1px solid #dce8ff;color:#405477;padding:12px 14px;font-size:.8rem;line-height:1.5;margin-top:14px}
    .ind-empty{text-align:center;padding:34px 16px;color:#64748b}.ind-empty strong{display:block;color:#334155;margin-bottom:5px}
    .ind-pagination{padding-top:16px}
    @media(max-width:1100px){.ind-kpis{grid-template-columns:repeat(2,minmax(0,1fr))}.ind-filters{grid-template-columns:repeat(3,minmax(0,1fr))}.ind-grid{grid-template-columns:1fr}}
    @media(max-width:640px){.ind-kpis{grid-template-columns:1fr 1fr;gap:9px}.ind-card{padding:14px}.ind-kpi{align-items:flex-start;gap:9px}.ind-icon{width:38px;height:38px;border-radius:11px;font-size:1rem}.ind-value{font-size:1.4rem}.ind-label{font-size:.76rem}.ind-filters{grid-template-columns:1fr 1fr}.ind-filters .wide{grid-column:1/-1}.ind-head{margin-bottom:16px}}
</style>

<div class="ind-wrap">
    <div class="ind-head">
        <div>
            <h1>Indicadores de participación</h1>
            <p>Consulta quién ha realizado las pruebas, sus resultados y la ubicación registrada.</p>
        </div>
        <span class="ind-tag"><i class="fa-solid fa-chart-line me-1"></i> Datos consultados desde MySQL</span>
    </div>

    <div class="ind-kpis">
        <div class="ind-card ind-kpi"><div class="ind-icon blue"><i class="fa-solid fa-users"></i></div><div><div class="ind-label">Participantes registrados</div><div class="ind-value">{{ number_format($totalParticipantes) }}</div><div class="ind-sub">Total de registros en la plataforma</div></div></div>
        <div class="ind-card ind-kpi"><div class="ind-icon green"><i class="fa-solid fa-clipboard-check"></i></div><div><div class="ind-label">Intentos encontrados</div><div class="ind-value">{{ number_format($resumen->total_intentos ?? 0) }}</div><div class="ind-sub">Según los filtros aplicados</div></div></div>
        <div class="ind-card ind-kpi"><div class="ind-icon gold"><i class="fa-solid fa-user-check"></i></div><div><div class="ind-label">Personas con prueba</div><div class="ind-value">{{ number_format($resumen->participantes_con_prueba ?? 0) }}</div><div class="ind-sub">Participantes únicos en el resultado</div></div></div>
        <div class="ind-card ind-kpi"><div class="ind-icon purple"><i class="fa-solid fa-bullseye"></i></div><div><div class="ind-label">Promedio de resultados</div><div class="ind-value">{{ number_format((float)($resumen->promedio_porcentaje ?? 0), 1) }}%</div><div class="ind-sub">Aprobación: {{ number_format($tasaAprobacion, 1) }}%</div></div></div>
    </div>

    <div class="ind-card" style="margin-bottom:18px">
        <h2><i class="fa-solid fa-filter me-2"></i>Filtrar resultados</h2>
        <form method="GET" action="{{ route('admin.indicadores') }}" class="ind-filters">
            <div class="ind-field wide"><label for="buscar">Buscar participante, institución o prueba</label><input id="buscar" name="buscar" value="{{ $filtros['buscar'] ?? '' }}" placeholder="Nombre, correo, institución..."></div>
            <div class="ind-field"><label for="quiz_id">Prueba</label><select id="quiz_id" name="quiz_id"><option value="">Todas las pruebas</option>@foreach($quizzes as $quiz)<option value="{{ $quiz->id }}" @selected((string)($filtros['quiz_id'] ?? '') === (string)$quiz->id)>{{ $quiz->titulo }}</option>@endforeach</select></div>
            <div class="ind-field"><label for="municipio">Municipio</label><select id="municipio" name="municipio"><option value="">Todos</option>@foreach($municipios as $municipio)<option value="{{ $municipio }}" @selected(($filtros['municipio'] ?? '') === $municipio)>{{ $municipio }}</option>@endforeach</select></div>
            <div class="ind-field"><label for="desde">Desde</label><input type="date" id="desde" name="desde" value="{{ $filtros['desde'] ?? '' }}"></div>
            <div class="ind-field"><label for="hasta">Hasta</label><input type="date" id="hasta" name="hasta" value="{{ $filtros['hasta'] ?? '' }}"></div>
            <button class="ind-btn" type="submit"><i class="fa-solid fa-magnifying-glass me-2"></i>Filtrar</button>
        </form>
        <a class="ind-btn secondary" href="{{ route('admin.indicadores') }}"><i class="fa-solid fa-rotate-left me-2"></i>Limpiar filtros</a>
    </div>

    <div class="ind-grid">
        <section class="ind-card">
            <h2><i class="fa-solid fa-clock-rotate-left me-2"></i>Intentos recientes</h2>
            @if($intentos->count())
                <div class="ind-table-wrap"><table class="ind-table"><thead><tr><th>Participante</th><th>Prueba</th><th>Ubicación registrada</th><th>Resultado</th><th>Fecha</th></tr></thead><tbody>
                @foreach($intentos as $intento)
                    <tr>
                        <td><div class="ind-person">{{ $intento->es_anonimo ? 'Participante anónimo #'.$intento->participante_id : ($intento->nombre_completo ?: 'Sin nombre') }}</div>
                            @unless($intento->es_anonimo)<div class="ind-small">{{ $intento->correo ?: 'Sin correo' }}</div>@endunless
                            <div class="ind-small">{{ $intento->institucion ?: 'Institución no registrada' }}{{ $intento->grado ? ' · '.$intento->grado : '' }}</div>
                        </td>
                        <td>{{ $intento->quiz_titulo }}<div class="ind-small">Intento #{{ $intento->numero_intento }}</div></td>
                        <td>{{ $intento->municipio ?: 'No registrado' }}<div class="ind-small">{{ $intento->zona ?: 'Zona no registrada' }}</div></td>
                        <td><strong>{{ number_format((float)$intento->porcentaje, 1) }}%</strong><div class="ind-small">Puntaje: {{ rtrim(rtrim(number_format((float)$intento->puntaje, 2, '.', ''), '0'), '.') }}</div><div style="margin-top:5px"><span class="ind-pill {{ $intento->aprobado ? 'ok' : 'no' }}">{{ $intento->aprobado ? 'Aprobado' : 'No aprobado' }}</span></div></td>
                        <td>{{ $intento->finalizado_en ? \Carbon\Carbon::parse($intento->finalizado_en)->format('d/m/Y H:i') : ($intento->registrado_en ? \Carbon\Carbon::parse($intento->registrado_en)->format('d/m/Y H:i') : '—') }}<div class="ind-small">{{ $intento->finalizado_en ? 'Finalizado' : 'Registro del intento' }}</div></td>
                    </tr>
                @endforeach
                </tbody></table></div>
                <div class="ind-pagination">{{ $intentos->links() }}</div>
            @else
                <div class="ind-empty"><i class="fa-regular fa-folder-open fa-2x mb-3"></i><strong>No hay intentos que coincidan</strong>Cuando los participantes realicen pruebas registradas en el sistema, aparecerán aquí.</div>
            @endif
        </section>

        <div style="display:flex;flex-direction:column;gap:18px">
            <section class="ind-card">
                <h2><i class="fa-solid fa-location-dot me-2"></i>Intentos por municipio</h2>
                @php $maxMunicipio = max(1, (int)($porMunicipio->max('total') ?? 0)); @endphp
                @forelse($porMunicipio as $fila)
                    <div class="ind-bars" style="margin-bottom:13px"><div class="ind-bar-row"><div class="ind-bar-label" title="{{ $fila->etiqueta }}">{{ $fila->etiqueta }}</div><div class="ind-track"><div class="ind-fill" style="width:{{ min(100, ((int)$fila->total / $maxMunicipio) * 100) }}%"></div></div><div class="ind-bar-num">{{ $fila->total }}</div></div></div>
                @empty
                    <div class="ind-empty">Aún no hay intentos para agrupar por municipio.</div>
                @endforelse
                <div class="ind-note"><strong>Nota sobre la ubicación:</strong> el municipio y la zona provienen de los datos guardados del participante. La base de datos actual no registra una ubicación independiente en el momento exacto de cada prueba.</div>
            </section>

            <section class="ind-card">
                <h2><i class="fa-solid fa-chart-column me-2"></i>Actividad de pruebas · últimos 6 meses</h2>
                @php $maxMes = max(1, max($conteosMeses ?: [0])); @endphp
                <div style="height:175px;display:flex;align-items:flex-end;gap:10px;padding-top:12px;border-bottom:1px solid #e8edf4">
                    @foreach($conteosMeses as $i => $cantidad)
                        <div title="{{ $meses[$i] }}: {{ $cantidad }} intentos" style="flex:1;display:flex;flex-direction:column;justify-content:flex-end;align-items:center;height:100%;gap:6px;min-width:0">
                            <span style="font-size:.75rem;font-weight:800;color:#15276a">{{ $cantidad }}</span>
                            <div style="width:min(38px,85%);height:{{ $cantidad > 0 ? max(5, ($cantidad / $maxMes) * 115) : 3 }}px;background:linear-gradient(180deg,#3f74dc,#1e9b62);border-radius:7px 7px 2px 2px"></div>
                            <span style="font-size:.7rem;color:#64748b;white-space:nowrap">{{ $meses[$i] }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="ind-small" style="margin-top:12px">Conteo general de intentos por fecha de registro, sin aplicar los filtros de la tabla.</div>
            </section>
        </div>
    </div>
</div>
@endsection
