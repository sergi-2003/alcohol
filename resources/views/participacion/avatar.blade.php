<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Elige tu avatar | Ponte Pilas</title>

    <link rel="icon" href="{{ asset('build/img/logo.webp') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* =========================================================
           RESET + VARIABLES
        ========================================================= */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --azul: #1657a3;
            --azul-oscuro: #0c376f;
            --azul-profundo: #082d5c;
            --azul-claro: #e8f2ff;

            --dorado: #f0bd45;
            --dorado-oscuro: #8a6210;
            --dorado-claro: #fff1cc;

            --verde: #23a879;

            --crema: #fffaf0;
            --crema-2: #fff4de;

            --texto: #2a3648;
            --texto-suave: #66768a;
            --blanco: #ffffff;
            --borde: #eadfca;

            --radio: 22px;
            --sombra-suave: 0 8px 22px rgba(90, 60, 10, .08);
            --sombra-media: 0 18px 40px rgba(40, 60, 100, .14);
        }

        html { scroll-behavior: smooth; }

        body {
            min-height: 100vh;
            font-family: "Nunito", system-ui, -apple-system, "Segoe UI", sans-serif;
            color: var(--texto);
            line-height: 1.5;
            background:
                linear-gradient(rgba(255, 248, 232, .90), rgba(255, 252, 245, .95)),
                url("{{ asset('build/img/fondo.webp') }}") center / cover fixed no-repeat;
            background-color: var(--crema);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Manchas decorativas suaves */
        body::before, body::after {
            content: "";
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }
        body::before {
            width: 420px; height: 420px;
            top: -170px; right: -120px;
            background: radial-gradient(circle, rgba(240, 189, 69, .28), transparent 70%);
        }
        body::after {
            width: 380px; height: 380px;
            bottom: -160px; left: -120px;
            background: radial-gradient(circle, rgba(22, 87, 163, .14), transparent 70%);
        }

        img { max-width: 100%; display: block; }

        :focus-visible {
            outline: 3px solid var(--dorado);
            outline-offset: 3px;
        }

        /* =========================================================
           LAYOUT
        ========================================================= */
        .page {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            padding: 20px 20px 48px;
        }

        .container { width: 100%; max-width: 1140px; }

        /* =========================================================
           HEADER
        ========================================================= */
        .header {
            position: sticky;
            top: 12px;
            z-index: 100;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
            padding: 10px 14px;
            border-radius: 20px;
            background: rgba(255, 255, 255, .92);
            border: 1px solid rgba(255, 255, 255, .95);
            box-shadow: 0 10px 30px rgba(90, 60, 10, .10);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: inherit;
            text-decoration: none;
            min-width: 0;
        }

        .brand-logo-wrap {
            flex: 0 0 auto;
            display: grid;
            place-items: center;
            padding: 4px 10px;
            height: 52px;
            border-radius: 14px;
            background: var(--azul-claro);
        }

        .brand-logo {
            height: 42px;
            width: auto;
            max-width: 130px;
            object-fit: contain;
        }

        .brand-copy h1 {
            font-size: 18px;
            line-height: 1.1;
            font-weight: 900;
            color: var(--azul-oscuro);
        }

        .brand-copy p {
            margin-top: 2px;
            font-size: 12px;
            color: var(--texto-suave);
            font-weight: 600;
        }

        .main-nav {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 12px;
            border-radius: 12px;
            color: #5c7086;
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            transition: background .2s, color .2s;
        }
        .nav-link:hover { color: var(--azul); background: var(--azul-claro); }
        .nav-link.active { color: var(--azul); background: var(--azul-claro); }

        .user-pill {
            margin-left: auto;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 5px 14px 5px 5px;
            border-radius: 50px;
            background: var(--crema-2);
            border: 1px solid var(--borde);
        }

        .user-pill-icon {
            width: 34px; height: 34px;
            display: grid; place-items: center;
            border-radius: 50%;
            color: var(--dorado-oscuro);
            background: var(--dorado-claro);
            font-size: 16px;
        }

        .user-pill-text {
            display: flex;
            flex-direction: column;
            line-height: 1.15;
            min-width: 0;
        }
        .user-pill-text strong {
            max-width: 130px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 13px;
            color: var(--azul-profundo);
        }
        .user-pill-text small { font-size: 11px; color: var(--texto-suave); font-weight: 600; }

        .nav-toggle {
            display: none;
            width: 42px; height: 42px;
            border: 0;
            border-radius: 12px;
            color: var(--azul);
            background: var(--azul-claro);
            font-size: 22px;
            cursor: pointer;
            place-items: center;
        }

        /* =========================================================
           PROGRESO
        ========================================================= */
        .journey-bar {
            margin: 0 0 16px;
            padding: 14px 18px;
            border-radius: 18px;
            background: rgba(255, 255, 255, .85);
            border: 1px solid rgba(255, 255, 255, .95);
            box-shadow: var(--sombra-suave);
        }

        .journey-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 9px;
            font-size: 13px;
            font-weight: 700;
            color: var(--texto-suave);
        }
        .journey-top span { display: inline-flex; align-items: center; gap: 7px; }
        .journey-top i { color: var(--azul); }
        .journey-top strong { color: var(--azul); font-weight: 900; }

        .journey-track {
            height: 8px;
            border-radius: 50px;
            background: #f0e8d8;
            overflow: hidden;
        }
        .journey-progress {
            display: block;
            width: 66%;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--azul), #4d8ed5, var(--dorado));
        }

        .journey-steps {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            gap: 8px;
        }
        .journey-step {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 800;
            color: #a2adb9;
        }
        .journey-step.done { color: var(--verde); }
        .journey-step.current { color: var(--azul); }

        /* =========================================================
           TARJETA PRINCIPAL
        ========================================================= */
        .main-card {
            position: relative;
            overflow: hidden;
            padding: 34px 32px 26px;
            border-radius: 28px;
            background: rgba(255, 255, 255, .96);
            border: 1px solid #fff;
            box-shadow: var(--sombra-media);
        }

        .top-line {
            position: absolute;
            inset: 0 0 auto 0;
            height: 6px;
            background: linear-gradient(90deg, var(--azul), #4d8ed5, var(--dorado));
        }

        /* =========================================================
           INTRO
        ========================================================= */
        .intro {
            max-width: 640px;
            margin: 0 auto 28px;
            text-align: center;
        }

        .intro-tag {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 14px;
            padding: 7px 14px;
            border-radius: 50px;
            background: var(--dorado-claro);
            color: var(--dorado-oscuro);
            font-size: 13px;
            font-weight: 800;
        }

        .intro h2 {
            margin-bottom: 10px;
            font-size: clamp(28px, 4.2vw, 40px);
            line-height: 1.1;
            font-weight: 900;
            letter-spacing: -.5px;
            color: var(--azul-profundo);
        }

        .intro p {
            font-size: 16px;
            line-height: 1.6;
            color: var(--texto-suave);
            font-weight: 600;
        }

        .intro-helper {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 16px;
            padding: 8px 14px;
            border-radius: 50px;
            background: var(--crema);
            border: 1px dashed #e0cfa8;
            color: #7a6a48;
            font-size: 13px;
            font-weight: 700;
        }
        .intro-helper i { color: var(--azul); font-size: 15px; }

        /* =========================================================
           ERROR
        ========================================================= */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            margin-bottom: 24px;
            padding: 14px 16px;
            border-radius: 14px;
            background: #fff3f1;
            border: 1px solid #f4cfc9;
            color: #a3382d;
            font-size: 14px;
            font-weight: 600;
        }
        .alert i { font-size: 19px; flex-shrink: 0; }

        /* =========================================================
           GRID DE AVATARES
        ========================================================= */
        .avatars-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 16px;
        }

        .avatar-option {
            position: relative;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            cursor: pointer;
            border: 3px solid transparent;
            border-radius: var(--radio);
            background: var(--blanco);
            box-shadow: var(--sombra-suave);
            transition: transform .22s ease, border-color .22s ease, box-shadow .22s ease;
            -webkit-tap-highlight-color: transparent;
        }

        .avatar-option:hover {
            transform: translateY(-4px);
            border-color: #f3dca0;
            box-shadow: 0 16px 30px rgba(90, 60, 10, .14);
        }

        .avatar-option.selected {
            transform: translateY(-4px);
            border-color: var(--azul);
            box-shadow: 0 0 0 4px rgba(240, 189, 69, .45), 0 18px 34px rgba(22, 87, 163, .22);
        }

        .avatar-option:has(input:focus-visible) {
            outline: 3px solid var(--dorado);
            outline-offset: 3px;
        }

        .avatar-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        /* Fondos pastel cálidos que rotan */
        .avatar-image {
            position: relative;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            aspect-ratio: 4 / 5;
            overflow: hidden;
            padding: 10px 10px 0;
            background: linear-gradient(160deg, #e9f3ff, #ffffff);
        }
        .avatar-option:nth-child(4n+2) .avatar-image { background: linear-gradient(160deg, #fff3d0, #fffdf6); }
        .avatar-option:nth-child(4n+3) .avatar-image { background: linear-gradient(160deg, #e3f7ee, #fbfffd); }
        .avatar-option:nth-child(4n)   .avatar-image { background: linear-gradient(160deg, #fde9e4, #fffafa); }

        .avatar-image::before {
            content: "";
            position: absolute;
            width: 78%;
            aspect-ratio: 1;
            bottom: -34%;
            border-radius: 50%;
            background: rgba(255, 255, 255, .7);
        }

        .avatar-image img {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center bottom;
            transition: transform .35s ease;
        }
        .avatar-option:hover .avatar-image img,
        .avatar-option.selected .avatar-image img {
            transform: scale(1.05) translateY(-3px);
        }

        .avatar-info {
            position: relative;
            z-index: 2;
            flex: 1;
            padding: 12px 10px 14px;
            text-align: center;
            background: #fff;
            border-top: 1px solid #f3ead8;
        }

        .avatar-info h3 {
            margin-bottom: 3px;
            font-size: 16px;
            font-weight: 900;
            color: var(--azul-profundo);
        }

        .avatar-info p {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-size: 12.5px;
            line-height: 1.4;
            color: var(--texto-suave);
            font-weight: 600;
        }

        /* Check de seleccionado */
        .selected-check {
            position: absolute;
            z-index: 5;
            top: 10px; right: 10px;
            width: 32px; height: 32px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--azul);
            color: #fff;
            font-size: 16px;
            opacity: 0;
            transform: scale(.5);
            box-shadow: 0 6px 16px rgba(22, 87, 163, .35);
            transition: opacity .25s ease, transform .3s cubic-bezier(.34, 1.56, .64, 1);
        }
        .avatar-option.selected .selected-check { opacity: 1; transform: scale(1); }

        /* =========================================================
           PANEL DE SELECCIÓN
        ========================================================= */
        .selection-panel {
            position: sticky;
            bottom: 14px;
            z-index: 50;
            margin-top: 24px;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            border-radius: 20px;
            background: rgba(255, 250, 238, .96);
            border: 1px solid var(--borde);
            box-shadow: 0 12px 30px rgba(90, 60, 10, .14);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .selection-message {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 0;
        }

        .selection-icon {
            width: 44px; height: 44px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: #fff;
            color: var(--azul);
            font-size: 21px;
            box-shadow: 0 5px 14px rgba(22, 87, 163, .10);
        }
        .selection-icon .bi-check-circle-fill { color: var(--verde); }

        .selection-message strong {
            display: block;
            font-size: 15px;
            font-weight: 900;
            color: var(--azul-profundo);
        }
        .selection-message span {
            display: block;
            font-size: 13.5px;
            color: var(--texto-suave);
            font-weight: 600;
        }
        .selected-name { color: var(--azul); font-weight: 900; }

        .btn-submit {
            flex-shrink: 0;
            min-width: 210px;
            height: 50px;
            padding: 0 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #1657a3, #2473c1);
            color: #fff;
            font-family: inherit;
            font-size: 15px;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 10px 22px rgba(22, 87, 163, .26);
            transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease;
        }
        .btn-submit i { font-size: 18px; transition: transform .2s ease; }
        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(22, 87, 163, .32);
        }
        .btn-submit:hover:not(:disabled) i { transform: translateX(3px); }
        .btn-submit:disabled {
            opacity: .5;
            cursor: not-allowed;
            box-shadow: none;
        }

        .spin { animation: spin 1s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* =========================================================
           VOLVER
        ========================================================= */
        .back-button { text-align: center; margin-top: 14px; }
        .back-button button {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            border: none;
            border-radius: 50px;
            background: transparent;
            color: #6f7f92;
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: color .2s, background .2s;
        }
        .back-button button:hover { color: var(--azul); background: var(--azul-claro); }

        /* =========================================================
           VACÍO
        ========================================================= */
        .empty { padding: 60px 20px; text-align: center; color: var(--texto-suave); }
        .empty i { display: block; margin-bottom: 12px; font-size: 48px; color: #c9b98f; }
        .empty h3 { margin-bottom: 6px; font-size: 20px; color: var(--azul-profundo); }
        .empty p { font-size: 15px; }

        /* =========================================================
           RESPONSIVE
        ========================================================= */
        @media (max-width: 1100px) {
            .avatars-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        }

        @media (max-width: 900px) {
            .header { position: relative; top: 0; flex-wrap: wrap; }
            .nav-toggle { display: grid; margin-left: auto; }
            .user-pill { margin-left: 0; }

            .main-nav {
                display: none;
                order: 10;
                width: 100%;
                padding-top: 10px;
                border-top: 1px solid #f0e8d8;
            }
            .main-nav.open { display: grid; grid-template-columns: repeat(2, 1fr); }
            .nav-link { justify-content: center; }

            .avatars-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        }

        @media (max-width: 700px) {
            .page { padding: 12px 12px 36px; }
            .main-card { padding: 28px 16px 20px; border-radius: 24px; }
            .intro { margin-bottom: 22px; }
            .intro p { font-size: 15px; }
            .avatars-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
            .avatar-image { aspect-ratio: 1 / 1.05; }
            .avatar-info h3 { font-size: 15px; }
            .avatar-info p { font-size: 12px; }

            .selection-panel {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
                bottom: 10px;
                padding: 12px;
            }
            .btn-submit { width: 100%; }
        }

        @media (max-width: 480px) {
            .header { padding: 8px 10px; border-radius: 17px; }
            .brand-logo-wrap { height: 44px; padding: 3px 8px; }
            .brand-logo { height: 36px; max-width: 100px; }
            .brand-copy h1 { font-size: 16px; }
            .brand-copy p { display: none; }
            .user-pill { display: none; }

            .journey-bar { padding: 12px 13px; }
            .journey-step { font-size: 11px; gap: 4px; }
            .journey-top { font-size: 12px; }

            .main-nav.open { grid-template-columns: 1fr; }

            .intro-helper { font-size: 12px; text-align: left; }
            .selected-check { width: 28px; height: 28px; top: 8px; right: 8px; font-size: 14px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>


<body>

<div class="page">
    <div class="container">

        {{-- =====================================================
             HEADER
        ====================================================== --}}
        <header class="header">

            <a href="{{ url('/') }}" class="brand" aria-label="Ir al inicio de Ponte Pilas">
                <span class="brand-logo-wrap">
                    <img src="{{ asset('build/img/logo.webp') }}" alt="Ponte Pilas" class="brand-logo">
                </span>

                <div class="brand-copy">
                    <h1>Ponte Pilas</h1>
                    <p>Aprende, decide y ponte pilas</p>
                </div>
            </a>

            <nav class="main-nav" id="mainNav" aria-label="Navegación principal">
                {{-- Agrega aquí tus enlaces, por ejemplo:
                <a href="{{ url('/') }}" class="nav-link active"><i class="bi bi-house-heart"></i> Inicio</a>
                --}}
            </nav>

            <div class="user-pill">
                <span class="user-pill-icon"><i class="bi bi-stars"></i></span>
                <span class="user-pill-text">
                    <strong>{{ session('participacion_nombre') ?: 'Participante' }}</strong>
                    <small>Tu recorrido</small>
                </span>
            </div>

            <button type="button" class="nav-toggle" id="navToggle"
                    aria-label="Abrir menú" aria-expanded="false" aria-controls="mainNav">
                <i class="bi bi-list"></i>
            </button>

        </header>


        {{-- =====================================================
             PROGRESO
        ====================================================== --}}
        <div class="journey-bar" aria-label="Progreso de preparación">

            <div class="journey-top">
                <span><i class="bi bi-signpost-2"></i> Preparando tu experiencia</span>
                <strong>Paso 2 de 3</strong>
            </div>

            <div class="journey-track">
                <span class="journey-progress"></span>
            </div>

            <div class="journey-steps">
                <span class="journey-step done"><i class="bi bi-check-circle-fill"></i> Datos</span>
                <span class="journey-step current"><i class="bi bi-person-heart"></i> Personaje</span>
                <span class="journey-step"><i class="bi bi-controller"></i> Comenzar</span>
            </div>

        </div>


        {{-- =====================================================
             MAIN
        ====================================================== --}}
        <main class="main-card">

            <div class="top-line"></div>

            <div class="intro">
                <div class="intro-tag">
                    <i class="bi bi-stars"></i>
                    Tu personaje
                </div>

                <h2>¡Elige a tu compañero!</h2>

                <p>
                    Escoge el personaje que más conecte contigo. Te acompañará
                    durante las actividades y decisiones de tu recorrido por Ponte Pilas.
                </p>

                <div class="intro-helper">
                    <i class="bi bi-hand-index-thumb"></i>
                    Toca una tarjeta y descubre cuál te representa
                </div>
            </div>


            @if(session('error'))
                <div class="alert" role="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif


            <form action="{{ route('participacion.avatar.guardar') }}" method="POST" id="avatarForm">
                @csrf

                @if($avatares->count())

                    <div class="avatars-grid" id="avatares" role="radiogroup" aria-label="Personajes disponibles">

                        @foreach($avatares as $avatar)

                            <label class="avatar-option"
                                   data-avatar-id="{{ $avatar->id }}"
                                   data-avatar-name="{{ $avatar->nombre }}">

                                <input type="radio" name="avatar_id" value="{{ $avatar->id }}">

                                <div class="selected-check" aria-hidden="true">
                                    <i class="bi bi-check-lg"></i>
                                </div>

                                <div class="avatar-image">
                                    <img src="{{ asset('build/img/avatars/' . trim($avatar->imagen)) }}"
                                         alt="{{ $avatar->nombre }}"
                                         loading="lazy">
                                </div>

                                <div class="avatar-info">
                                    <h3>{{ $avatar->nombre }}</h3>
                                    <p>{{ $avatar->descripcion ?? 'Tu compañero durante esta experiencia.' }}</p>
                                </div>

                            </label>

                        @endforeach

                    </div>

                @else

                    <div class="empty">
                        <i class="bi bi-person-x"></i>
                        <h3>No hay avatares disponibles</h3>
                        <p>En este momento no hay personajes disponibles. Vuelve a intentarlo más tarde.</p>
                    </div>

                @endif


                <div class="selection-panel" aria-live="polite">

                    <div class="selection-message">
                        <div class="selection-icon">
                            <i class="bi bi-person-check" id="selectionIcon"></i>
                        </div>

                        <div>
                            <strong id="selectionTitle">Aún no has elegido</strong>
                            <span id="selectionText">Selecciona un personaje para continuar.</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit" id="btnContinuar" disabled>
                        <span>Elegir y comenzar</span>
                        <i class="bi bi-arrow-right"></i>
                    </button>

                </div>

            </form>


            <div class="back-button">
                <button type="button" onclick="window.history.back()">
                    <i class="bi bi-arrow-left"></i>
                    Volver al formulario
                </button>
            </div>

        </main>

    </div>
</div>


<script>
    (function () {

        const avatarOptions  = document.querySelectorAll('.avatar-option');
        const btnContinuar   = document.getElementById('btnContinuar');
        const selectionTitle = document.getElementById('selectionTitle');
        const selectionText  = document.getElementById('selectionText');
        const selectionIcon  = document.getElementById('selectionIcon');
        const avatarForm     = document.getElementById('avatarForm');
        const navToggle      = document.getElementById('navToggle');
        const mainNav        = document.getElementById('mainNav');

        /* ---------------------------------------------------------
           Seleccionar avatar (el label ya activa el radio;
           escuchamos "change" y también funciona con teclado)
        --------------------------------------------------------- */
        function marcar(card) {
            avatarOptions.forEach(function (item) {
                item.classList.toggle('selected', item === card);
            });

            selectionTitle.textContent = 'Has elegido a';

            selectionText.textContent = '';
            const nombre = document.createElement('span');
            nombre.className = 'selected-name';
            nombre.textContent = card.dataset.avatarName;
            selectionText.append(nombre, ' te acompañará durante el recorrido.');

            selectionIcon.className = 'bi bi-check-circle-fill';
            btnContinuar.disabled = false;
        }

        avatarOptions.forEach(function (card) {
            const radio = card.querySelector('input[type="radio"]');
            radio.addEventListener('change', function () {
                if (radio.checked) marcar(card);
            });
        });

        /* ---------------------------------------------------------
           Menú móvil (se oculta si no hay enlaces)
        --------------------------------------------------------- */
        if (navToggle && mainNav) {

            if (!mainNav.querySelector('.nav-link')) {
                navToggle.style.display = 'none';
                mainNav.style.display = 'none';
            }

            navToggle.addEventListener('click', function () {
                const abierto = mainNav.classList.toggle('open');
                navToggle.setAttribute('aria-expanded', abierto ? 'true' : 'false');
                navToggle.innerHTML = abierto
                    ? '<i class="bi bi-x-lg"></i>'
                    : '<i class="bi bi-list"></i>';
            });

            mainNav.querySelectorAll('.nav-link').forEach(function (link) {
                link.addEventListener('click', function () {
                    mainNav.classList.remove('open');
                    navToggle.setAttribute('aria-expanded', 'false');
                    navToggle.innerHTML = '<i class="bi bi-list"></i>';
                });
            });
        }

        /* ---------------------------------------------------------
           Envío: evitar doble clic
        --------------------------------------------------------- */
        avatarForm.addEventListener('submit', function (event) {

            if (!document.querySelector('input[name="avatar_id"]:checked')) {
                event.preventDefault();
                return;
            }

            btnContinuar.disabled = true;
            btnContinuar.innerHTML =
                '<span>Preparando tu experiencia...</span>' +
                '<i class="bi bi-arrow-repeat spin"></i>';
        });

    })();
</script>

</body>

</html>