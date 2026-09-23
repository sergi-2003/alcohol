<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $tema->titulo }} | MI DECISIÓN
    </title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>
        :root{--blue:#1769ff;--blue-dark:#0b2f5b;--blue-soft:#eaf2ff;--gold:#f4c542;--green:#13a673;--text:#17304d;--muted:#718096;--bg:#f5f8fc;--border:#e4eaf2;--white:#fff}
        *{box-sizing:border-box} html{scroll-behavior:smooth}
        body{margin:0;background:var(--bg);color:var(--text);font-family:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Arial,sans-serif}
        .site-nav{position:sticky;top:0;z-index:1000;background:rgba(255,255,255,.96);border-bottom:1px solid var(--border);backdrop-filter:blur(12px)}
        .nav-inner{max-width:1420px;min-height:70px;margin:auto;padding:6px 22px;display:flex;align-items:center;justify-content:space-between;gap:18px}
        .brand img{width:170px;height:62px;object-fit:contain}.back-link{display:inline-flex;align-items:center;gap:8px;padding:9px 14px;border:1px solid var(--border);border-radius:11px;color:var(--text);text-decoration:none;font-weight:800;background:#fff}.back-link:hover{color:var(--blue);border-color:#bcd2f3}
        .hero{background:linear-gradient(135deg,#092d55 0%,#145ca6 62%,#1769ff 100%);color:#fff}.hero-inner{max-width:1420px;margin:auto;padding:30px 22px 34px}.breadcrumb{display:flex;gap:8px;align-items:center;font-size:12px;opacity:.82;margin-bottom:16px}.breadcrumb a{color:#fff;text-decoration:none}.hero-title-row{display:flex;align-items:flex-start;justify-content:space-between;gap:24px}.topic-badge{display:inline-flex;align-items:center;gap:7px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.18);padding:6px 10px;border-radius:999px;font-size:11px;font-weight:900;margin-bottom:9px}.hero h1{font-size:clamp(2rem,4vw,3rem);line-height:1.03;font-weight:900;letter-spacing:-1px;margin:0 0 7px}.hero-desc{margin:0;max-width:760px;color:rgba(255,255,255,.82);font-size:14px;line-height:1.55}.hero-status{display:inline-flex;align-items:center;gap:7px;background:#e6faf3;color:#13865e;border-radius:999px;padding:9px 13px;font-size:11px;font-weight:900;white-space:nowrap}
        .learning-layout{max-width:1420px;margin:auto;padding:22px;display:grid;grid-template-columns:200px minmax(0,1fr) 230px;gap:16px;align-items:start}
        .side-card,.progress-card,.support-card,.tip-card{background:#fff;border:1px solid var(--border);border-radius:14px;box-shadow:0 5px 18px rgba(22,48,78,.045)}
        .left-sidebar{position:sticky;top:88px}.side-card{overflow:hidden}.side-title{padding:14px 14px 10px;font-weight:900;font-size:14px;color:var(--blue-dark)}.topic-list{padding:0 8px 10px}.topic-item{display:flex;align-items:center;gap:9px;width:100%;padding:9px 8px;margin:3px 0;border-radius:9px;text-decoration:none;color:#334c66;font-size:11px;font-weight:700;line-height:1.25}.topic-item:hover{background:#f0f5ff;color:var(--blue)}.topic-item.active{background:var(--blue);color:#fff}.topic-item.locked{color:#6d7d91;cursor:not-allowed}.topic-num{width:22px;height:22px;flex:0 0 22px;border-radius:50%;display:grid;place-items:center;background:#edf2f8;color:#456079;font-size:10px;font-weight:900}.topic-item.active .topic-num{background:#fff;color:var(--blue)}.topic-check{margin-left:auto;color:#16a673}.topic-lock{margin-left:auto;color:#75869a}.mini-note{margin:12px 8px 8px;padding:12px;border-radius:11px;background:#edf5ff;color:#31587e;font-size:10px;line-height:1.45}.mini-note i{font-size:24px;color:var(--blue);display:block;margin-bottom:5px}
        .main-content{min-width:0}.lesson{background:#fff;border:1px solid var(--border);border-radius:15px;overflow:hidden;box-shadow:0 7px 22px rgba(22,48,78,.05);margin-bottom:18px}.lesson-head{padding:18px 20px 14px;border-bottom:1px solid #edf1f6}.lesson-meta{display:flex;align-items:center;gap:10px}.lesson-number{width:32px;height:32px;border-radius:10px;background:var(--blue);color:#fff;display:grid;place-items:center;font-size:12px;font-weight:900}.lesson-title{font-size:20px;line-height:1.15;font-weight:900;color:var(--blue-dark);margin:0}.lesson-subtitle{font-size:11px;color:var(--muted);margin:3px 0 0}.lesson-body{padding:16px 20px 25px}.educational-text{font-size:13px;line-height:1.62;color:#314b67}.educational-text p{margin:0 0 12px}.educational-text h4{font-size:14px;font-weight:900;color:var(--blue-dark);margin:19px 0 7px}.main-image{width:100%;max-height:380px;object-fit:cover;border-radius:10px;margin:0 0 18px}
        .inline-image-group{display:grid;gap:10px;margin:14px 0 18px;align-items:stretch}.inline-image-group.count-1{grid-template-columns:minmax(240px,720px);justify-content:center}.inline-image-group.count-2{grid-template-columns:repeat(2,minmax(0,1fr))}.inline-image-group.count-3{grid-template-columns:repeat(3,minmax(0,1fr))}.inline-image-group.count-4,.inline-image-group.count-more{grid-template-columns:repeat(4,minmax(0,1fr))}.inline-image-card{min-width:0}.inline-educational-image{display:block;width:100%;height:190px;object-fit:cover;border-radius:10px;cursor:pointer;background:#eef3f8;transition:.2s ease}.inline-educational-image:hover{transform:translateY(-2px);box-shadow:0 9px 20px rgba(20,45,75,.15)}.inline-image-caption{text-align:center;color:var(--muted);font-size:10px;margin-top:5px}.media-heading{display:flex;align-items:center;gap:7px;color:var(--blue-dark);font-size:12px;font-weight:900;margin:18px 0 9px}.media-box{margin-top:20px}.video-wrapper{position:relative;width:100%;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:11px;background:#081b30}.video-wrapper iframe{position:absolute;inset:0;width:100%;height:100%;border:0}.iframe-wrapper{width:100%;border:1px solid var(--border);border-radius:11px;overflow:hidden;background:#fff}.iframe-wrapper iframe{width:100%;min-height:430px;border:0}.callout{padding:14px 16px;border-radius:11px;margin:16px 0;font-size:12px}.callout-blue{background:#edf5ff;border:1px solid #d7e7ff;color:#2d557d}.callout strong{display:block;margin-bottom:4px}.callout a{color:var(--blue);font-weight:800}
        .right-sidebar{position:sticky;top:88px;display:flex;flex-direction:column;gap:10px}.progress-card,.support-card,.tip-card{padding:13px}.progress-title{font-size:12px;font-weight:900;color:var(--blue-dark);margin-bottom:9px}.progress-line{display:flex;align-items:center;gap:7px}.progress-track{height:8px;background:#edf1f6;border-radius:99px;overflow:hidden;flex:1}.progress-fill{height:100%;background:var(--blue);border-radius:99px}.progress-count{font-size:9px;font-weight:800;color:#566a80;white-space:nowrap}.quote{margin:11px 0 0;padding:13px;border-radius:10px;background:#fff4cf;color:#5f5223;font-size:11px;line-height:1.45;font-weight:800}.remember-title{font-size:12px;font-weight:900;color:var(--blue-dark);margin-bottom:8px}.remember-list{padding:0;margin:0;list-style:none}.remember-list li{font-size:10px;line-height:1.4;color:#50657a;margin:7px 0;display:flex;gap:6px}.remember-list i{color:#2e5f91}.support-btn{display:flex;align-items:center;justify-content:center;gap:7px;width:100%;padding:10px 9px;border-radius:9px;text-decoration:none;font-size:11px;font-weight:900;margin-top:8px}.support-primary{background:var(--blue);color:#fff}.support-outline{border:1px solid var(--blue);color:var(--blue);background:#fff}.support-btn:hover{filter:brightness(.97);transform:translateY(-1px)}.tip-card{display:flex;gap:9px;align-items:flex-start}.tip-icon{font-size:24px;color:var(--gold)}.tip-card strong{font-size:10px;color:var(--blue-dark);display:block}.tip-card span{font-size:9px;color:var(--muted);line-height:1.4}
        .content-navigation{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin:6px 0 20px}.content-nav-btn{display:flex;align-items:center;gap:11px;min-height:58px;padding:11px 14px;border:1px solid #d8e4f3;border-radius:12px;background:#fff;color:var(--blue-dark);text-decoration:none;box-shadow:0 4px 14px rgba(22,48,78,.045);transition:.2s ease}.content-nav-btn:hover{border-color:#a9c7f3;color:var(--blue);transform:translateY(-2px);box-shadow:0 8px 20px rgba(22,48,78,.09)}.content-nav-btn.next{justify-content:flex-end;text-align:right;background:var(--blue);border-color:var(--blue);color:#fff}.content-nav-btn.next:hover{color:#fff;filter:brightness(.97)}.content-nav-icon{width:34px;height:34px;flex:0 0 34px;border-radius:10px;display:grid;place-items:center;font-size:16px;background:#edf4ff;color:var(--blue)}.content-nav-btn.next .content-nav-icon{background:rgba(255,255,255,.15);color:#fff}.content-nav-text{min-width:0}.content-nav-label{display:block;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:.35px;opacity:.72;margin-bottom:2px}.content-nav-title{display:block;font-size:12px;font-weight:900;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.content-navigation.single-next{grid-template-columns:1fr}.content-navigation.single-next .next{grid-column:1;max-width:50%;margin-left:auto}@media(max-width:560px){.content-navigation{grid-template-columns:1fr}.content-navigation.single-next .next{max-width:none}.content-nav-btn{min-height:54px}.content-nav-btn.next{justify-content:flex-start;text-align:left}}        .remember{margin:10px 0 20px;padding:16px;border-radius:12px;background:linear-gradient(135deg,#0b2e58,#1769c9);color:#fff;display:flex;gap:12px;align-items:center}.remember-icon{width:36px;height:36px;border-radius:10px;background:rgba(255,255,255,.12);display:grid;place-items:center}.remember strong{font-size:12px}.remember p{margin:2px 0 0;color:rgba(255,255,255,.75);font-size:10px}.empty{background:#fff;border:1px solid var(--border);border-radius:15px;text-align:center;padding:60px 20px}.empty i{font-size:40px;color:#9aabba}footer{text-align:center;color:#77879a;font-size:11px;padding:10px 20px 30px}
        @media(max-width:1150px){.learning-layout{grid-template-columns:190px minmax(0,1fr)}.right-sidebar{grid-column:1/-1;position:static;display:grid;grid-template-columns:repeat(3,1fr)}.right-sidebar .support-card{grid-column:span 1}.inline-image-group.count-4,.inline-image-group.count-more{grid-template-columns:repeat(3,minmax(0,1fr))}}
        @media(max-width:850px){.learning-layout{grid-template-columns:1fr}.left-sidebar{position:static}.topic-list{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:2px}.right-sidebar{grid-template-columns:1fr 1fr}.inline-image-group.count-3,.inline-image-group.count-4,.inline-image-group.count-more{grid-template-columns:repeat(2,minmax(0,1fr))}.hero-title-row{display:block}.hero-status{margin-top:14px}}
        @media(max-width:560px){.nav-inner{padding:5px 12px}.brand img{width:145px;height:55px}.back-link{font-size:11px;padding:8px 10px}.hero-inner{padding:22px 14px 27px}.learning-layout{padding:12px 10px;gap:10px}.lesson-head{padding:14px}.lesson-body{padding:13px 14px 20px}.lesson-title{font-size:17px}.educational-text{font-size:12px}.topic-list{grid-template-columns:1fr}.right-sidebar{display:flex}.inline-image-group.count-2,.inline-image-group.count-3,.inline-image-group.count-4,.inline-image-group.count-more{grid-template-columns:1fr}.inline-image-group.count-1{grid-template-columns:1fr}.inline-educational-image{height:220px}.main-image{max-height:280px}.progress-card,.support-card,.tip-card{padding:12px}}
    </style>

</head>


<body>

    @php
        /* Los temas de esta navegación vienen de la tabla temas.
           El administrador puede crear, ordenar, activar o desactivar temas. */
        $temasNavegacion = \App\Models\Tema::where('activo', true)
            ->orderBy('orden')
            ->orderBy('id')
            ->get();

        $indiceTemaActual = $temasNavegacion->search(function ($temaNav) use ($tema) {
            return (int) $temaNav->id === (int) $tema->id;
        });

        $indiceTemaActual = $indiceTemaActual === false ? 0 : $indiceTemaActual;
        $numeroTemaActual = $indiceTemaActual + 1;
        $totalTemas = $temasNavegacion->count();
        $progreso = $totalTemas > 0 ? round(($numeroTemaActual / $totalTemas) * 100) : 0;
    @endphp

    <nav class="site-nav">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="brand" aria-label="MI DECISIÓN">
                <img src="{{ asset('build/img/logo.WebP') }}" alt="MI DECISIÓN">
            </a>
            <a href="{{ route('aprende.index') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Volver a temas
            </a>
        </div>
    </nav>

    <header class="hero">
        <div class="hero-inner">
            <div class="breadcrumb">
                <a href="{{ route('home') }}"><i class="bi bi-house"></i> Inicio</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('aprende.index') }}">Temas</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ $tema->titulo }}</span>
            </div>

            <div class="hero-title-row">
                <div>
                    <div class="topic-badge">Contenido {{ $numeroTemaActual }} de {{ $totalTemas }}</div>
                    <h1>{{ $tema->titulo }}</h1>
                    <p class="hero-desc">
                        {{ $tema->descripcion_corta ?: 'Conoce información que puede ayudarte a reflexionar sobre tus decisiones y tu bienestar.' }}
                    </p>
                </div>
                <div class="hero-status">
                    <i class="bi bi-check-circle-fill"></i> Contenido disponible
                </div>
            </div>
        </div>
    </header>

    <div class="learning-layout">

        {{-- ========================= SIDEBAR IZQUIERDO ========================= --}}
        <aside class="left-sidebar">
            <div class="side-card">
                <div class="side-title">Alcohol y sus efectos</div>

                <div class="topic-list">
                    @forelse($temasNavegacion as $temaNavIndex => $temaNav)
                        @php
                            $esActual = (int) $temaNav->id === (int) $tema->id;
                            $estaBloqueado = $temaNavIndex > $indiceTemaActual;
                        @endphp

                        @if(!$estaBloqueado)
                            <a href="{{ route('aprende.tema', $temaNav) }}" class="topic-item {{ $esActual ? 'active' : '' }}">
                                <span class="topic-num">{{ $temaNavIndex + 1 }}</span>
                                <span>{{ $temaNav->titulo }}</span>
                                @if($esActual)
                                    <i class="bi bi-check-lg topic-check"></i>
                                @else
                                    <i class="bi bi-check-lg topic-check"></i>
                                @endif
                            </a>
                        @else
                            <span class="topic-item locked" aria-disabled="true">
                                <span class="topic-num">{{ $temaNavIndex + 1 }}</span>
                                <span>{{ $temaNav->titulo }}</span>
                                <i class="bi bi-lock-fill topic-lock"></i>
                            </span>
                        @endif
                    @empty
                        <div class="p-3 small text-muted">No hay temas publicados.</div>
                    @endforelse
                </div>

                <div class="mini-note">
                    <i class="bi bi-lightbulb"></i>
                    <strong>Pequeñas decisiones, grandes cambios</strong><br>
                    Infórmate también es una forma de cuidarte.
                </div>
            </div>
        </aside>

        {{-- ========================= CONTENIDO CENTRAL ========================= --}}
        <main class="main-content">

            @if($contenidos->count())

                @foreach($contenidos as $contenido)

                    @php
                        $parrafosContenido = preg_split(
                            "/\R\s*\R+/",
                            trim($contenido->contenido ?? '')
                        );

                        $imagenesPorPosicion = [];

                        foreach ($contenido->imagenes as $imagen) {
                            $config = $imagen->configuracion ?? [];
                            $posicion = (string) ($config['posicion'] ?? 'final');
                            $imagenesPorPosicion[$posicion][] = $imagen;
                        }
                    @endphp

                    <article class="lesson">

                        <div class="lesson-head">
                            <div class="lesson-meta">
                                <div class="lesson-number">{{ $contenido->orden }}</div>
                                <div>
                                    <h2 class="lesson-title">{{ $contenido->titulo }}</h2>
                                    <p class="lesson-subtitle">
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                        Contenido disponible
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="lesson-body">

                            @if($contenido->imagen)
                                <img
                                    src="{{ route('media.contenido', ['filename' => basename($contenido->imagen)]) }}"
                                    alt="{{ $contenido->titulo }}"
                                    class="main-image"
                                    loading="lazy"
                                >
                            @endif

                            @php
                                $renderGrupoImagenes = function ($imagenes) {
                                    $cantidad = count($imagenes);
                                    if (!$cantidad) return '';
                                };
                            @endphp

                            <div class="educational-text">

                                {{-- IMÁGENES AL INICIO --}}
                                @if(!empty($imagenesPorPosicion['inicio']))
                                    <div class="inline-image-group count-{{ min(count($imagenesPorPosicion['inicio']), 4) }} {{ count($imagenesPorPosicion['inicio']) > 4 ? 'count-more' : '' }}">
                                        @foreach($imagenesPorPosicion['inicio'] as $imagen)
                                            <div class="inline-image-card">
                                                <img
                                                    src="{{ route('media.recurso', ['filename' => basename($imagen->ruta)]) }}"
                                                    alt="{{ $imagen->titulo ?? 'Imagen educativa' }}"
                                                    class="inline-educational-image"
                                                    loading="lazy"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalImagen{{ $imagen->id }}"
                                                >
                                                @if($imagen->titulo)<div class="inline-image-caption">{{ $imagen->titulo }}</div>@endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @foreach($parrafosContenido as $indice => $parrafo)
                                    <p>{!! nl2br(e(trim($parrafo))) !!}</p>

                                    @php $posicionParrafo = (string) ($indice + 1); @endphp

                                    @if(!empty($imagenesPorPosicion[$posicionParrafo]))
                                        @php $imagenesSlot = $imagenesPorPosicion[$posicionParrafo]; @endphp
                                        <div class="inline-image-group count-{{ min(count($imagenesSlot), 4) }} {{ count($imagenesSlot) > 4 ? 'count-more' : '' }}">
                                            @foreach($imagenesSlot as $imagen)
                                                <div class="inline-image-card">
                                                    <img
                                                        src="{{ route('media.recurso', ['filename' => basename($imagen->ruta)]) }}"
                                                        alt="{{ $imagen->titulo ?? 'Imagen educativa' }}"
                                                        class="inline-educational-image"
                                                        loading="lazy"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalImagen{{ $imagen->id }}"
                                                    >
                                                    @if($imagen->titulo)<div class="inline-image-caption">{{ $imagen->titulo }}</div>@endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach

                                {{-- IMÁGENES AL FINAL --}}
                                @if(!empty($imagenesPorPosicion['final']))
                                    <div class="inline-image-group count-{{ min(count($imagenesPorPosicion['final']), 4) }} {{ count($imagenesPorPosicion['final']) > 4 ? 'count-more' : '' }}">
                                        @foreach($imagenesPorPosicion['final'] as $imagen)
                                            <div class="inline-image-card">
                                                <img
                                                    src="{{ route('media.recurso', ['filename' => basename($imagen->ruta)]) }}"
                                                    alt="{{ $imagen->titulo ?? 'Imagen educativa' }}"
                                                    class="inline-educational-image"
                                                    loading="lazy"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalImagen{{ $imagen->id }}"
                                                >
                                                @if($imagen->titulo)<div class="inline-image-caption">{{ $imagen->titulo }}</div>@endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                            </div>

                            {{-- MODALES DE IMÁGENES --}}
                            @foreach($contenido->imagenes as $imagen)
                                <div class="modal fade" id="modalImagen{{ $imagen->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content bg-dark border-0">
                                            <div class="modal-header border-0">
                                                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img
                                                    src="{{ route('media.recurso', ['filename' => basename($imagen->ruta)]) }}"
                                                    alt="{{ $imagen->titulo ?? 'Imagen educativa' }}"
                                                    class="img-fluid rounded"
                                                    style="max-height:80vh"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if($contenido->video_url)
                                @php
                                    $videoUrl = $contenido->video_url;
                                    $youtubeId = null;
                                    if (str_contains($videoUrl, 'youtube.com/watch?v=')) {
                                        parse_str(parse_url($videoUrl, PHP_URL_QUERY) ?? '', $youtubeParams);
                                        $youtubeId = $youtubeParams['v'] ?? null;
                                    } elseif (str_contains($videoUrl, 'youtu.be/')) {
                                        $youtubeId = trim(parse_url($videoUrl, PHP_URL_PATH), '/');
                                    }
                                @endphp

                                <div class="media-box">
                                    <div class="media-heading"><i class="bi bi-play-circle"></i> Video educativo</div>
                                    @if($youtubeId)
                                        <div class="video-wrapper">
                                            <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" title="{{ $contenido->titulo }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                        </div>
                                    @else
                                        <div class="callout callout-blue">
                                            <strong><i class="bi bi-info-circle me-1"></i> Video</strong>
                                            <a href="{{ $contenido->video_url }}" target="_blank" rel="noopener noreferrer">Ver video</a>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if($contenido->iframe)
                                <div class="media-box">
                                    <div class="media-heading"><i class="bi bi-window-stack"></i> Contenido interactivo</div>
                                    <div class="iframe-wrapper">{!! $contenido->iframe !!}</div>
                                </div>
                            @endif

                        </div>
                    </article>

                    {{-- =================================================
                         NAVEGACIÓN ENTRE CONTENIDOS/TEMAS
                         Usa el mismo orden que aparece en la barra izquierda.
                    ================================================== --}}

                    @php
                        $temaAnterior = $indiceTemaActual > 0
                            ? $temasNavegacion[$indiceTemaActual - 1]
                            : null;

                        $temaSiguiente = ($indiceTemaActual + 1) < $totalTemas
                            ? $temasNavegacion[$indiceTemaActual + 1]
                            : null;
                    @endphp

                    @if($temaAnterior || $temaSiguiente)

                        <div class="content-navigation {{ !$temaAnterior && $temaSiguiente ? 'single-next' : '' }}">

                            @if($temaAnterior)

                                <a
                                    href="{{ route('aprende.tema', $temaAnterior) }}"
                                    class="content-nav-btn"
                                    aria-label="Ir al contenido anterior"
                                >

                                    <span class="content-nav-icon">
                                        <i class="bi bi-arrow-left"></i>
                                    </span>

                                    <span class="content-nav-text">
                                        <span class="content-nav-label">
                                            Anterior
                                        </span>

                                        <span class="content-nav-title">
                                            {{ $temaAnterior->titulo }}
                                        </span>
                                    </span>

                                </a>

                            @endif


                            @if($temaSiguiente)

                                <a
                                    href="{{ route('aprende.tema', $temaSiguiente) }}"
                                    class="content-nav-btn next"
                                    aria-label="Ir al contenido siguiente"
                                >

                                    <span class="content-nav-text">
                                        <span class="content-nav-label">
                                            Siguiente
                                        </span>

                                        <span class="content-nav-title">
                                            {{ $temaSiguiente->titulo }}
                                        </span>
                                    </span>

                                    <span class="content-nav-icon">
                                        <i class="bi bi-arrow-right"></i>
                                    </span>

                                </a>

                            @endif

                        </div>

                    @endif


                @endforeach

            @else
                <div class="empty">
                    <i class="bi bi-journal-x"></i>
                    <h3 class="fw-bold mt-3">Próximamente</h3>
                    <p class="text-muted mb-0">Este tema todavía no tiene contenidos educativos disponibles.</p>
                </div>
            @endif

            @if($contenidos->count())
                <div class="remember">
                    <div class="remember-icon"><i class="bi bi-lightbulb"></i></div>
                    <div>
                        <strong>Recuerda</strong>
                        <p>Conocer la información es un paso importante para reflexionar sobre nuestras decisiones.</p>
                    </div>
                </div>
            @endif
        </main>

        {{-- ========================= SIDEBAR DERECHO ========================= --}}
        <aside class="right-sidebar">
            <div class="progress-card">
                <div class="progress-title">Tu progreso en este tema</div>
                <div class="progress-line">
                    <div class="progress-track"><div class="progress-fill" style="width:{{ $progreso }}%"></div></div>
                    <span class="progress-count">{{ $numeroTemaActual }} de {{ $totalTemas }}</span>
                </div>
                <div class="quote">“Cuidar tu mente hoy,<br>te da más opciones mañana.”</div>
            </div>

            <div class="support-card">
                <div class="remember-title"><i class="bi bi-lightbulb text-warning me-1"></i> Recuerda</div>
                <ul class="remember-list">
                    <li><i class="bi bi-check-circle-fill"></i><span>El alcohol puede afectar tu memoria, atención y decisiones.</span></li>
                    <li><i class="bi bi-check-circle-fill"></i><span>Tu cerebro sigue desarrollándose.</span></li>
                    <li><i class="bi bi-check-circle-fill"></i><span>Informarte también es una forma de cuidarte.</span></li>
                </ul>

                <a href="tel:141" class="support-btn support-primary">
                    <i class="bi bi-headset"></i>
                    <span>Buscar apoyo<br><small style="font-weight:600;opacity:.8">No estás solo</small></span>
                </a>

                <a href="tel:141" class="support-btn support-outline">
                    <i class="bi bi-telephone"></i>
                    <span>Línea #141<br><small style="font-weight:600;opacity:.8">Atención gratuita y confidencial</small></span>
                </a>
            </div>

            <div class="tip-card">
                <div class="tip-icon"><i class="bi bi-brain"></i></div>
                <div>
                    <strong>Tu cerebro tiene grandes planes.</strong>
                    <span>Elige hoy lo que te acerca a ellos.</span>
                </div>
            </div>
        </aside>
    </div>

    <footer>MI DECISIÓN · Aprende, reflexiona y decide.</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>