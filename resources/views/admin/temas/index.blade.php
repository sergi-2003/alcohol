@extends('admin.layouts.app')

@section('title', 'Temas educativos')

@section('content')

<style>
    /* =========================================================
       TEMAS EDUCATIVOS - DISEÑO MODERNO
    ========================================================= */

    .topics-page {
        --tp-blue: #2563eb;
        --tp-blue-dark: #1d4ed8;
        --tp-yellow: #fbbf24;
        --tp-dark: #172033;
        --tp-muted: #64748b;
        --tp-border: #e8edf4;
        --tp-bg: #f6f8fc;
    }

    /* HEADER */
    .topics-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
    }

    .topics-title-area {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .topics-title-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        color: white;
        font-size: 23px;
        box-shadow: 0 10px 25px rgba(37, 99, 235, .20);
    }

    .topics-title h2 {
        font-size: 25px;
        font-weight: 800;
        color: var(--tp-dark);
        margin: 0;
        letter-spacing: -.5px;
    }

    .topics-title p {
        margin: 4px 0 0;
        color: var(--tp-muted);
        font-size: 14px;
    }

    .btn-new-topic {
        border: 0;
        border-radius: 12px;
        padding: 11px 18px;
        font-weight: 700;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        box-shadow: 0 8px 20px rgba(37, 99, 235, .20);
        transition: .25s ease;
    }

    .btn-new-topic:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(37, 99, 235, .28);
    }


    /* ALERTAS */
    .topics-alert {
        border: 0;
        border-radius: 14px;
        padding: 14px 18px;
        box-shadow: 0 5px 18px rgba(15, 23, 42, .05);
    }


    /* =========================================================
       ESTADISTICAS
    ========================================================= */

    .topic-stat {
        position: relative;
        overflow: hidden;
        border: 1px solid var(--tp-border);
        border-radius: 18px;
        background: #fff;
        padding: 20px;
        height: 100%;
        transition: .25s ease;
    }

    .topic-stat:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 30px rgba(15, 23, 42, .07);
    }

    .topic-stat::after {
        content: "";
        position: absolute;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        right: -35px;
        top: -35px;
        background: rgba(37, 99, 235, .05);
    }

    .topic-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        margin-bottom: 16px;
    }

    .stat-blue .topic-stat-icon {
        background: #eff6ff;
        color: #2563eb;
    }

    .stat-green .topic-stat-icon {
        background: #ecfdf5;
        color: #059669;
    }

    .stat-yellow .topic-stat-icon {
        background: #fffbeb;
        color: #d97706;
    }

    .topic-stat-label {
        font-size: 13px;
        color: var(--tp-muted);
        margin-bottom: 2px;
    }

    .topic-stat-number {
        font-size: 27px;
        line-height: 1;
        font-weight: 800;
        color: var(--tp-dark);
    }


    /* =========================================================
       SEPARADOR
    ========================================================= */

    .topics-section-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 30px 0 17px;
    }

    .topics-section-heading h4 {
        margin: 0;
        font-size: 17px;
        font-weight: 800;
        color: var(--tp-dark);
    }

    .topics-section-heading span {
        color: var(--tp-muted);
        font-size: 13px;
    }


    /* =========================================================
       TARJETAS DE TEMAS
    ========================================================= */

    .topic-card {
        position: relative;
        height: 100%;
        overflow: hidden;
        border: 1px solid var(--tp-border);
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 5px 18px rgba(15, 23, 42, .045);
        transition:
            transform .3s ease,
            box-shadow .3s ease,
            border-color .3s ease;
    }

    .topic-card:hover {
        transform: translateY(-7px);
        border-color: rgba(37, 99, 235, .18);
        box-shadow: 0 18px 38px rgba(15, 23, 42, .11);
    }


    /* IMAGEN */

    .topic-cover {
        position: relative;
        height: 190px;
        overflow: hidden;
        background:
            linear-gradient(135deg, #eaf2ff, #f8fbff);
    }

    .topic-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .55s ease;
    }

    .topic-card:hover .topic-cover img {
        transform: scale(1.07);
    }

    .topic-cover::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(15, 23, 42, .48),
            rgba(15, 23, 42, .04) 60%,
            transparent
        );
        pointer-events: none;
    }

    .topic-cover-empty {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #2563eb;
        font-size: 55px;
        background:
            radial-gradient(circle at 20% 20%, rgba(37,99,235,.10), transparent 30%),
            radial-gradient(circle at 80% 70%, rgba(251,191,36,.12), transparent 32%),
            #f7faff;
    }


    /* BADGES SOBRE IMAGEN */

    .topic-order {
        position: absolute;
        z-index: 3;
        top: 14px;
        left: 14px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 9px;
        background: rgba(15, 23, 42, .76);
        color: white;
        font-size: 11px;
        font-weight: 700;
        backdrop-filter: blur(8px);
    }

    .topic-status {
        position: absolute;
        z-index: 3;
        top: 14px;
        right: 14px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 800;
        backdrop-filter: blur(8px);
    }

    .topic-status.active {
        color: #047857;
        background: rgba(236, 253, 245, .94);
    }

    .topic-status.inactive {
        color: #475569;
        background: rgba(248, 250, 252, .94);
    }


    /* CONTADOR DE CONTENIDOS */

    .topic-content-counter {
        position: absolute;
        z-index: 4;
        left: 16px;
        bottom: 14px;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: white;
        font-size: 12px;
        font-weight: 700;
    }

    .topic-content-counter i {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: rgba(255,255,255,.18);
        backdrop-filter: blur(7px);
    }


    /* CUERPO */

    .topic-body {
        padding: 19px 20px 14px;
    }

    .topic-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }

    .topic-title {
        font-size: 17px;
        line-height: 1.25;
        font-weight: 800;
        color: var(--tp-dark);
        margin: 0;
    }

    .topic-slug {
        color: #94a3b8;
        font-size: 11px;
        margin-top: 5px;
        word-break: break-word;
    }

    .topic-icon {
        flex: 0 0 auto;
        width: 39px;
        height: 39px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        color: #2563eb;
    }

    .topic-description {
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
        margin: 14px 0 0;
        min-height: 42px;
    }


    /* FOOTER */

    .topic-footer {
        padding: 12px 20px 18px;
    }

    .topic-divider {
        height: 1px;
        background: #eef2f7;
        margin-bottom: 12px;
    }

    .topic-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .topic-actions-left {
        display: flex;
        gap: 7px;
    }

    .topic-action {
        width: 37px;
        height: 37px;
        padding: 0;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: .2s ease;
    }

    .topic-action:hover {
        transform: translateY(-2px);
    }

    .topic-open {
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }

    .topic-open:hover {
        color: #2563eb;
    }


    /* EMPTY */

    .topics-empty {
        border: 1px dashed #cbd5e1;
        border-radius: 20px;
        background: #fff;
        padding: 60px 20px;
        text-align: center;
    }

    .topics-empty-icon {
        width: 78px;
        height: 78px;
        margin: 0 auto 18px;
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        color: #2563eb;
        font-size: 32px;
    }

    .topics-empty h5 {
        color: var(--tp-dark);
        font-weight: 800;
    }

    .topics-empty p {
        color: var(--tp-muted);
        max-width: 430px;
        margin: 8px auto 22px;
        font-size: 14px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .topics-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .btn-new-topic {
            width: 100%;
        }

        .topics-title h2 {
            font-size: 22px;
        }

        .topic-cover {
            height: 180px;
        }
    }

    @media (max-width: 480px) {

        .topics-title-icon {
            width: 46px;
            height: 46px;
        }

        .topic-cover {
            height: 170px;
        }

        .topic-body {
            padding: 17px;
        }

        .topic-footer {
            padding-left: 17px;
            padding-right: 17px;
        }
    }
</style>


<div class="topics-page">

    {{-- =====================================================
         ENCABEZADO
    ====================================================== --}}
    <div class="topics-header">

        <div class="topics-title-area">

            <div class="topics-title-icon">
                <i class="bi bi-collection"></i>
            </div>

            <div class="topics-title">
                <h2>Temas educativos</h2>

                <p>
                    Organiza y administra los contenidos de MI DECISIÓN.
                </p>
            </div>

        </div>


        @if(auth()->user()->rol?->tienePermiso('contenidos.crear'))

            <a
                href="{{ route('admin.temas.create') }}"
                class="btn btn-primary btn-new-topic"
            >
                <i class="bi bi-plus-lg me-2"></i>
                Nuevo tema
            </a>

        @endif

    </div>


    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('error'))

        <div class="alert alert-danger topics-alert mb-3">
            <i class="bi bi-exclamation-triangle me-2"></i>
            {{ session('error') }}
        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger topics-alert mb-3">

            <strong>
                <i class="bi bi-exclamation-triangle me-2"></i>
                Revisa los siguientes campos:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
         ESTADÍSTICAS
    ====================================================== --}}

    <div class="row g-3">

        {{-- TOTAL --}}
        <div class="col-xl-4 col-md-4">

            <div class="topic-stat stat-blue">

                <div class="topic-stat-icon">
                    <i class="bi bi-collection"></i>
                </div>

                <div class="topic-stat-label">
                    Total de temas
                </div>

                <div class="topic-stat-number">
                    {{ $temas->count() }}
                </div>

            </div>

        </div>


        {{-- ACTIVOS --}}
        <div class="col-xl-4 col-md-4">

            <div class="topic-stat stat-green">

                <div class="topic-stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>

                <div class="topic-stat-label">
                    Temas activos
                </div>

                <div class="topic-stat-number">
                    {{ $temas->where('activo', true)->count() }}
                </div>

            </div>

        </div>


        {{-- CONTENIDOS --}}
        <div class="col-xl-4 col-md-4">

            <div class="topic-stat stat-yellow">

                <div class="topic-stat-icon">
                    <i class="bi bi-journal-text"></i>
                </div>

                <div class="topic-stat-label">
                    Contenidos publicados
                </div>

                <div class="topic-stat-number">
                    {{ $temas->sum('contenidos_count') }}
                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         TITULO DE SECCIÓN
    ====================================================== --}}

    <div class="topics-section-heading">

        <h4>
            Tus temas
        </h4>

        <span>
            {{ $temas->count() }}
            {{ $temas->count() == 1 ? 'tema disponible' : 'temas disponibles' }}
        </span>

    </div>


    {{-- =====================================================
         TEMAS
    ====================================================== --}}

    @if($temas->count())

        <div class="row g-4">

            @foreach($temas as $tema)

                <div class="col-xl-4 col-lg-6">

                    <div class="topic-card">

                        {{-- =================================
                             IMAGEN
                        ================================== --}}
                        <div class="topic-cover">

                            @if($tema->imagen)

                                <img
                                    src="{{ route('media.tema', ['filename' => basename($tema->imagen)]) }}"
                                    alt="{{ $tema->titulo }}"
                                    loading="lazy"
                                    onerror="
                                        this.style.display='none';
                                        this.nextElementSibling.style.display='flex';
                                    "
                                >

                                <div
                                    class="topic-cover-empty"
                                    style="display:none;"
                                >
                                    <i class="bi {{ $tema->icono ?: 'bi-collection' }}"></i>
                                </div>

                            @elseif($tema->icono)

                                <div class="topic-cover-empty">
                                    <i class="bi {{ $tema->icono }}"></i>
                                </div>

                            @else

                                <div class="topic-cover-empty">
                                    <i class="bi bi-collection"></i>
                                </div>

                            @endif


                            {{-- ORDEN --}}
                            <div class="topic-order">

                                <i class="bi bi-list-ol"></i>

                                {{ $tema->orden }}

                            </div>


                            {{-- ESTADO --}}
                            @if($tema->activo)

                                <div class="topic-status active">

                                    <i class="bi bi-circle-fill"></i>

                                    Activo

                                </div>

                            @else

                                <div class="topic-status inactive">

                                    <i class="bi bi-pause-circle"></i>

                                    Inactivo

                                </div>

                            @endif


                            {{-- CONTENIDOS --}}
                            <div class="topic-content-counter">

                                <i class="bi bi-journal-text"></i>

                                <span>
                                    {{ $tema->contenidos_count }}
                                    {{ $tema->contenidos_count == 1 ? 'contenido' : 'contenidos' }}
                                </span>

                            </div>

                        </div>


                        {{-- =================================
                             CUERPO
                        ================================== --}}
                        <div class="topic-body">

                            <div class="topic-heading">

                                <div>

                                    <h5 class="topic-title">
                                        {{ $tema->titulo }}
                                    </h5>

                                    <div class="topic-slug">
                                        /{{ $tema->slug }}
                                    </div>

                                </div>


                                @if($tema->icono)

                                    <div class="topic-icon">

                                        <i class="bi {{ $tema->icono }}"></i>

                                    </div>

                                @endif

                            </div>


                            <p class="topic-description">

                                @if($tema->descripcion_corta)

                                    {{ \Illuminate\Support\Str::limit($tema->descripcion_corta, 115) }}

                                @else

                                    <span class="fst-italic">
                                        Este tema todavía no tiene descripción.
                                    </span>

                                @endif

                            </p>

                        </div>


                        {{-- =================================
                             FOOTER
                        ================================== --}}
                        <div class="topic-footer">

                            <div class="topic-divider"></div>

                            <div class="topic-actions">

                                <div class="topic-actions-left">

                                    {{-- EDITAR --}}
                                    @if(auth()->user()->rol?->tienePermiso('contenidos.editar'))

                                        <a
                                            href="{{ route('admin.temas.edit', $tema) }}"
                                            class="btn btn-outline-primary topic-action"
                                            title="Editar tema"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- ACTIVAR / DESACTIVAR --}}
                                        <form
                                            action="{{ route('admin.temas.toggle', $tema) }}"
                                            method="POST"
                                            class="d-inline"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="btn btn-outline-secondary topic-action"
                                                title="{{ $tema->activo ? 'Desactivar tema' : 'Activar tema' }}"
                                            >

                                                <i class="bi bi-power"></i>

                                            </button>

                                        </form>

                                    @endif

                                </div>


                                <span class="topic-open">
                                    Tema
                                    <i class="bi bi-arrow-up-right ms-1"></i>
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        {{-- =================================================
             SIN TEMAS
        ================================================== --}}

        <div class="topics-empty">

            <div class="topics-empty-icon">
                <i class="bi bi-collection"></i>
            </div>

            <h5>
                No hay temas creados
            </h5>

            <p>
                Crea el primer tema educativo para comenzar a organizar
                el contenido de MI DECISIÓN.
            </p>

            @if(auth()->user()->rol?->tienePermiso('contenidos.crear'))

                <a
                    href="{{ route('admin.temas.create') }}"
                    class="btn btn-primary btn-new-topic"
                >

                    <i class="bi bi-plus-lg me-2"></i>

                    Crear primer tema

                </a>

            @endif

        </div>

    @endif

</div>

@endsection