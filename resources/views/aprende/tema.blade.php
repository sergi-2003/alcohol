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

        :root {
            --azul: #0d6efd;
            --azul-oscuro: #12395d;
            --texto: #17324d;
            --gris: #68788a;
            --fondo: #f4f7fb;
        }


        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            background: var(--fondo);
            color: var(--texto);
            font-family: Arial, Helvetica, sans-serif;
        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        .topbar {
            background: rgba(255,255,255,.96);
            border-bottom: 1px solid #e6ebf1;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }


        .logo {
            height: 80px;
            width: 200px;
        }


        /* =====================================================
           HERO
        ===================================================== */

        .hero {
            min-height: 330px;
            position: relative;
            overflow: hidden;
            color: white;
            background:
                linear-gradient(
                    90deg,
                    rgba(9,30,52,.92) 0%,
                    rgba(9,30,52,.78) 48%,
                    rgba(9,30,52,.25) 100%
                ),
                url('{{ asset('build/img/banner.png') }}')
                center / cover no-repeat;
        }


        .hero::after {
            content: "";
            position: absolute;
            width: 480px;
            height: 480px;
            right: -160px;
            top: -100px;
            background: rgba(13,110,253,.35);
            border-radius: 50%;
            filter: blur(10px);
        }


        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1250px;
            margin: auto;
            padding: 55px 24px 48px;
        }


        .breadcrumb-custom {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 14px;
            margin-bottom: 28px;
            opacity: .9;
        }


        .breadcrumb-custom a {
            color: white;
            text-decoration: none;
        }


        .breadcrumb-custom a:hover {
            text-decoration: underline;
        }


        .tema-badge {
            display: inline-flex;
            align-items: center;
            background: #0d6efd;
            color: white;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 15px;
        }


        .hero h1 {
            font-size: clamp(2.2rem, 5vw, 3.3rem);
            font-weight: 800;
            margin-bottom: 12px;
        }


        .hero-description {
            font-size: 1.15rem;
            opacity: .9;
            max-width: 720px;
            margin-bottom: 28px;
        }


        /* =====================================================
           INDICADORES
        ===================================================== */

        .hero-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }


        .hero-stat {
            display: flex;
            align-items: center;
            gap: 10px;
        }


        .hero-stat-icon {
            width: 44px;
            height: 44px;
            border: 1px solid rgba(255,255,255,.45);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }


        .hero-stat strong {
            display: block;
            font-size: 14px;
        }


        .hero-stat span {
            display: block;
            font-size: 12px;
            opacity: .75;
        }


        /* =====================================================
           CONTENEDOR
        ===================================================== */

        .main-container {
            max-width: 1250px;
            margin: auto;
            padding: 42px 24px 55px;
        }


        /* =====================================================
           TÍTULO SECCIÓN
        ===================================================== */

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 22px;
        }


        .section-heading h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 5px;
        }


        .section-heading p {
            margin: 0;
            color: var(--gris);
        }


        .instruction-box {
            background: #eaf3ff;
            border: 1px solid #d6e8ff;
            border-radius: 15px;
            padding: 14px 18px;
            display: flex;
            gap: 12px;
            align-items: center;
            color: #315477;
        }


        .instruction-box i {
            font-size: 22px;
            color: var(--azul);
        }


        /* =====================================================
           CONTENIDO
        ===================================================== */

        .content-card {
            background: white;
            border: 1px solid #e6ebf1;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 7px 25px rgba(20,40,70,.06);
            margin-bottom: 24px;
        }


        .content-top {
            padding: 28px;
        }


        .content-title-row {
            display: flex;
            gap: 18px;
            align-items: flex-start;
        }


        .content-number {
            flex: 0 0 auto;
            width: 50px;
            height: 50px;
            background: #eaf3ff;
            color: var(--azul);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
        }


        .content-title {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 4px;
        }


        .content-subtitle {
            color: var(--gris);
            margin: 0;
        }


        .available-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #e5f7ef;
            color: #16805b;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            margin-left: 10px;
        }


        /* =====================================================
           TEXTO EDUCATIVO
        ===================================================== */

        .educational-text {
            margin-top: 28px;
            color: #31506f;
            font-size: 16px;
            line-height: 1.8;
            white-space: normal;
            overflow-wrap: anywhere;
        }


        .educational-text p {
            margin-bottom: 14px;
        }


        /* =====================================================
           IMAGEN PRINCIPAL
        ===================================================== */

        .main-content-image {
            width: 100%;
            max-height: 480px;
            object-fit: cover;
            border-radius: 17px;
            margin-top: 25px;
        }


        /* =====================================================
           GALERÍA
        ===================================================== */

        .gallery-section {
            margin-top: 28px;
        }


        .gallery-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
        }


        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }


        .gallery-image {
            width: 100%;
            height: 190px;
            object-fit: cover;
            border-radius: 14px;
            cursor: pointer;
            transition: .2s ease;
        }


        .gallery-image:hover {
            transform: scale(1.015);
            box-shadow: 0 8px 22px rgba(0,0,0,.12);
        }


        /* =====================================================
           VIDEO
        ===================================================== */

        .media-box {
            margin-top: 28px;
        }


        .media-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 14px;
        }


        .video-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 17px;
            background: #101820;
        }


        .video-wrapper iframe {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }


        /* =====================================================
           IFRAME
        ===================================================== */

        .iframe-wrapper {
            width: 100%;
            border: 1px solid #e4e9ef;
            border-radius: 15px;
            overflow: hidden;
            background: white;
        }


        .iframe-wrapper iframe {
            width: 100%;
            min-height: 500px;
            border: 0;
        }


        /* =====================================================
           RECORDATORIO
        ===================================================== */

        .remember-box {
            background: linear-gradient(
                135deg,
                #e9f8f3,
                #f2fbf8
            );
            border: 1px solid #cceee2;
            border-radius: 18px;
            padding: 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-top: 28px;
        }


        .remember-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }


        .remember-icon {
            width: 50px;
            height: 50px;
            background: white;
            color: #16805b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }


        .remember-box h6 {
            color: #16805b;
            font-weight: 800;
            margin-bottom: 3px;
        }


        .remember-box p {
            margin: 0;
            color: #28705b;
            font-size: 14px;
        }


        .remember-quote {
            color: #28705b;
            font-style: italic;
            text-align: right;
        }


        /* =====================================================
           SIN CONTENIDO
        ===================================================== */

        .empty-content {
            background: white;
            border: 1px solid #e6ebf1;
            border-radius: 20px;
            padding: 55px 25px;
            text-align: center;
        }


        .empty-content i {
            font-size: 50px;
            color: #a5b0bd;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        footer {
            text-align: center;
            padding: 25px;
            color: #68788a;
            font-size: 14px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media(max-width: 900px) {

            .section-heading {
                flex-direction: column;
                align-items: flex-start;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }


        @media(max-width: 600px) {

            .hero-content {
                padding: 38px 18px;
            }

            .main-container {
                padding-left: 18px;
                padding-right: 18px;
            }

            .hero-stats {
                gap: 18px;
            }

            .content-top {
                padding: 20px;
            }

            .content-title {
                font-size: 1.4rem;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .remember-box {
                flex-direction: column;
                align-items: flex-start;
            }

            .remember-quote {
                text-align: left;
            }

        }

    </style>

</head>


<body>


{{-- ============================================================
     NAVBAR
============================================================= --}}

<nav class="topbar">

    <div class="container-fluid">

        <div
            class="d-flex justify-content-between align-items-center"
            style="max-width:1250px;margin:auto;padding:12px 0;"
        >


            {{-- LOGO --}}

            <a
                href="{{ route('home') }}"
                class="text-decoration-none"
            >

                <img
                    src="{{ asset('build/img/logo.WebP') }}"
                    alt="MI DECISIÓN"
                    class="logo"
                >

            </a>


            {{-- VOLVER --}}

            <a
                href="{{ route('aprende.index') }}"
                class="btn btn-outline-primary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver a temas

            </a>


        </div>

    </div>

</nav>



{{-- ============================================================
     HERO
============================================================= --}}

<section class="hero">

    <div class="hero-content">


        {{-- BREADCRUMB --}}

        <div class="breadcrumb-custom">

            <a href="{{ route('home') }}">

                <i class="bi bi-house me-1"></i>

                Inicio

            </a>


            <i class="bi bi-chevron-right"></i>


            <a href="{{ route('aprende.index') }}">

                Temas

            </a>


            <i class="bi bi-chevron-right"></i>


            <span>

                {{ $tema->titulo }}

            </span>

        </div>


        {{-- TEMA --}}

        <div class="tema-badge">

            Tema {{ $tema->orden }}

        </div>


        <h1>

            {{ $tema->titulo }}

        </h1>


        @if($tema->descripcion_corta)

            <p class="hero-description">

                {{ $tema->descripcion_corta }}

            </p>

        @else

            <p class="hero-description">

                Explora este contenido educativo y aprende
                a tu propio ritmo.

            </p>

        @endif


        {{-- INDICADORES --}}

        <div class="hero-stats">


            <div class="hero-stat">

                <div class="hero-stat-icon">

                    <i class="bi bi-book"></i>

                </div>

                <div>

                    <strong>

                        {{ $contenidos->count() }}

                        {{ $contenidos->count() == 1
                            ? 'contenido'
                            : 'contenidos'
                        }}

                    </strong>

                    <span>

                        Para aprender

                    </span>

                </div>

            </div>


            <div class="hero-stat">

                <div class="hero-stat-icon">

                    <i class="bi bi-clock"></i>

                </div>

                <div>

                    <strong>

                        A tu propio ritmo

                    </strong>

                    <span>

                        Sin presiones

                    </span>

                </div>

            </div>


            <div class="hero-stat">

                <div class="hero-stat-icon">

                    <i class="bi bi-lightbulb"></i>

                </div>

                <div>

                    <strong>

                        Información educativa

                    </strong>

                    <span>

                        Aprende y reflexiona

                    </span>

                </div>

            </div>


        </div>


    </div>

</section>



{{-- ============================================================
     CONTENIDO PRINCIPAL
============================================================= --}}

<main class="main-container">


    {{-- ENCABEZADO --}}

    <div class="section-heading">


        <div>

            <h2>

                Aprende sobre este tema

            </h2>

            <p>

                Explora cada contenido a tu propio ritmo.

            </p>

        </div>


        <div class="instruction-box">

            <i class="bi bi-stars"></i>

            <div>

                <strong>

                    Conoce, reflexiona y decide.

                </strong>

                <div class="small">

                    Puedes revisar los contenidos en el orden que prefieras.

                </div>

            </div>

        </div>


    </div>



    {{-- ========================================================
         CONTENIDOS
    ========================================================= --}}

    @if($contenidos->count())


        @foreach($contenidos as $contenido)


            <article class="content-card">


                <div class="content-top">


                    {{-- =================================================
                         TÍTULO
                    ================================================== --}}

                    <div class="content-title-row">


                        <div class="content-number">

                            {{ $contenido->orden }}

                        </div>


                        <div class="flex-grow-1">


                            <div class="d-flex flex-wrap align-items-center gap-1">

                                <h3 class="content-title mb-0">

                                    {{ $contenido->titulo }}

                                </h3>


                                <span class="available-badge">

                                    <i class="bi bi-check-circle-fill"></i>

                                    Disponible

                                </span>

                            </div>


                            <p class="content-subtitle">

                                <i class="bi bi-file-earmark-text me-1"></i>

                                Contenido educativo

                            </p>


                        </div>


                    </div>



                    {{-- =================================================
                         TEXTO
                    ================================================== --}}

                    @if($contenido->contenido)

                        <div class="educational-text">

                            {!! nl2br(e($contenido->contenido)) !!}

                        </div>

                    @endif



                    {{-- =================================================
                         IMAGEN PRINCIPAL
                    ================================================== --}}

                    @if($contenido->imagen)

                        <div>

                            <img
                                src="{{ route('media.contenido', [
                                    'filename' => basename($contenido->imagen)
                                ]) }}"
                                alt="{{ $contenido->titulo }}"
                                class="main-content-image"
                                loading="lazy"
                            >

                        </div>

                    @endif



                    {{-- =================================================
                         GALERÍA DE IMÁGENES
                    ================================================== --}}

                    @if($contenido->imagenes && $contenido->imagenes->count())


                        <div class="gallery-section">


                            <div class="gallery-title">

                                <i class="bi bi-images text-primary me-1"></i>

                                Galería

                                <span class="text-muted fw-normal">

                                    ({{ $contenido->imagenes->count() }}
                                    {{ $contenido->imagenes->count() == 1
                                        ? 'imagen'
                                        : 'imágenes'
                                    }})

                                </span>

                            </div>


                            <div class="gallery-grid">


                                @foreach($contenido->imagenes as $imagen)


                                    <img
                                        src="{{ route('media.recurso', [
                                            'filename' => basename($imagen->ruta)
                                        ]) }}"
                                        alt="{{ $imagen->titulo ?? 'Imagen educativa' }}"
                                        class="gallery-image"
                                        loading="lazy"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalImagen{{ $imagen->id }}"
                                    >


                                    {{-- MODAL IMAGEN --}}

                                    <div
                                        class="modal fade"
                                        id="modalImagen{{ $imagen->id }}"
                                        tabindex="-1"
                                        aria-hidden="true"
                                    >

                                        <div
                                            class="modal-dialog modal-xl modal-dialog-centered"
                                        >

                                            <div class="modal-content bg-dark border-0">

                                                <div class="modal-header border-0">

                                                    <button
                                                        type="button"
                                                        class="btn-close btn-close-white ms-auto"
                                                        data-bs-dismiss="modal"
                                                    ></button>

                                                </div>


                                                <div class="modal-body text-center">

                                                    <img
                                                        src="{{ route('media.recurso', [
                                                            'filename' => basename($imagen->ruta)
                                                        ]) }}"
                                                        alt="Imagen educativa"
                                                        class="img-fluid rounded"
                                                        style="max-height:80vh;"
                                                    >

                                                </div>

                                            </div>

                                        </div>

                                    </div>


                                @endforeach


                            </div>

                        </div>

                    @endif



                    {{-- =================================================
                         VIDEO
                    ================================================== --}}

                    @if($contenido->video_url)


                        @php

                            $videoUrl = $contenido->video_url;

                            $youtubeId = null;

                            if (
                                str_contains($videoUrl, 'youtube.com/watch?v=')
                            ) {

                                parse_str(
                                    parse_url($videoUrl, PHP_URL_QUERY) ?? '',
                                    $youtubeParams
                                );

                                $youtubeId =
                                    $youtubeParams['v'] ?? null;

                            }

                            elseif (
                                str_contains($videoUrl, 'youtu.be/')
                            ) {

                                $youtubeId = trim(
                                    parse_url(
                                        $videoUrl,
                                        PHP_URL_PATH
                                    ),
                                    '/'
                                );

                            }

                        @endphp


                        <div class="media-box">


                            <div class="media-title">

                                <i class="bi bi-play-circle text-primary me-1"></i>

                                Video educativo

                            </div>


                            @if($youtubeId)

                                <div class="video-wrapper">

                                    <iframe
                                        src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                        title="{{ $contenido->titulo }}"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen
                                    ></iframe>

                                </div>

                            @else

                                <div class="alert alert-info">

                                    <i class="bi bi-info-circle me-1"></i>

                                    <a
                                        href="{{ $contenido->video_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >

                                        Ver video

                                    </a>

                                </div>

                            @endif


                        </div>

                    @endif



                    {{-- =================================================
                         IFRAME
                    ================================================== --}}

                    @if($contenido->iframe)


                        <div class="media-box">


                            <div class="media-title">

                                <i class="bi bi-window-stack text-primary me-1"></i>

                                Contenido interactivo

                            </div>


                            <div class="iframe-wrapper">

                                {!! $contenido->iframe !!}

                            </div>


                        </div>

                    @endif


                </div>


            </article>


        @endforeach


    @else


        {{-- ========================================================
             SIN CONTENIDOS
        ========================================================= --}}

        <div class="empty-content">

            <i class="bi bi-journal-x"></i>


            <h4 class="fw-bold mt-3">

                Próximamente

            </h4>


            <p class="text-muted mb-0">

                Este tema todavía no tiene contenidos educativos disponibles.

            </p>

        </div>


    @endif



    {{-- ============================================================
         RECORDATORIO
    ============================================================= --}}

    @if($contenidos->count())


        <div class="remember-box">


            <div class="remember-left">

                <div class="remember-icon">

                    <i class="bi bi-lightbulb"></i>

                </div>


                <div>

                    <h6>

                        Recuerda

                    </h6>


                    <p>

                        Conocer la información es un paso importante
                        para reflexionar sobre nuestras decisiones.

                    </p>

                </div>

            </div>


            <div class="remember-quote">

                “Conocer es el primer paso para decidir mejor.”

            </div>


        </div>


    @endif


</main>



{{-- ============================================================
     FOOTER
============================================================= --}}

<footer>

    MI DECISIÓN · Aprende, reflexiona y decide.

</footer>



<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>