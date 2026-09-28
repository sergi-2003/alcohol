<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>Elige tu avatar | Ponte Pilas</title>

    <link rel="icon"
          href="{{ asset('build/img/logo.webp') }}">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>

        /* =========================================================
           RESET
        ========================================================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =========================================================
           VARIABLES
        ========================================================= */

        :root {

            --azul: #1657a3;
            --azul-oscuro: #0c376f;
            --azul-profundo: #082d5c;

            --azul-claro: #eaf4ff;
            --azul-suave: #f4f8fd;

            --dorado: #f0bd45;
            --dorado-claro: #fff5d9;

            --verde: #23a879;

            --texto: #203247;
            --texto-suave: #708196;

            --blanco: #ffffff;

            --borde: #dfe8f2;

            --sombra:
                0 20px 60px rgba(20, 62, 105, .13);
        }


        /* =========================================================
           BODY
        ========================================================= */

        body {

            min-height: 100vh;

            font-family:
                Inter,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            color: var(--texto);

            background:
                linear-gradient(
                    rgba(237, 245, 253, .83),
                    rgba(248, 251, 255, .93)
                ),
                url("{{ asset('build/img/fondo.webp') }}")
                center / cover fixed no-repeat;

            overflow-x: hidden;
        }


        /* =========================================================
           DECORACIÓN
        ========================================================= */

        body::before {

            content: "";

            position: fixed;

            width: 360px;
            height: 360px;

            border-radius: 50%;

            background:
                rgba(240, 189, 69, .12);

            top: -150px;
            right: -100px;

            pointer-events: none;
        }


        body::after {

            content: "";

            position: fixed;

            width: 280px;
            height: 280px;

            border-radius: 50%;

            background:
                rgba(22, 87, 163, .08);

            bottom: -130px;
            left: -100px;

            pointer-events: none;
        }


        /* =========================================================
           PAGE
        ========================================================= */

        .page {

            position: relative;
            z-index: 1;

            min-height: 100vh;

            padding:
                28px
                20px
                55px;

            display: flex;

            justify-content: center;

            align-items: flex-start;
        }


        .container {

            width: 100%;

            max-width: 1180px;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 22px;

            padding: 13px 18px;

            background:
                rgba(255,255,255,.93);

            border:
                1px solid rgba(255,255,255,.85);

            border-radius: 18px;

            box-shadow:
                0 12px 35px rgba(20,62,105,.10);

            backdrop-filter:
                blur(12px);
        }


        .brand {

            display: flex;

            align-items: center;

            gap: 11px;
        }


        .brand-logo {

            width: 45px;
            height: 45px;

            object-fit: contain;

            border-radius: 12px;
        }


        .brand h1 {

            font-size: 18px;

            line-height: 1;

            font-weight: 850;

            color: var(--azul-oscuro);

            margin-bottom: 4px;
        }


        .brand p {

            font-size: 11px;

            color: var(--texto-suave);
        }


        .step {

            display: flex;

            align-items: center;

            gap: 8px;

            padding: 9px 14px;

            border-radius: 50px;

            background:
                var(--azul-claro);

            color:
                var(--azul);

            font-size: 12px;

            font-weight: 800;

            white-space: nowrap;
        }


        .step i {

            font-size: 15px;
        }



        /* =========================================================
           HEADER + NAV DINÁMICO
        ========================================================= */

        .header {
            position: sticky;
            top: 14px;
            z-index: 100;
            min-height: 66px;
            margin-bottom: 12px;
            padding: 9px 12px 9px 15px;
            border-radius: 20px;
            gap: 12px;
        }

        .brand {
            min-width: 190px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: inherit;
            text-decoration: none;
        }

        .brand-logo-wrap {
            width: 156px;
            height: 62px;
            display: grid;
            place-items: center;
            flex: 0 0 42px;
            border-radius: 13px;
            background: #f1f7ff;
            box-shadow: inset 0 0 0 1px #e3edf8;
        }

        .brand-logo {
            width: 156px;
            height: 63px;
            object-fit: contain;
        }

        .brand-copy h1 {
            margin: 0 0 3px;
        }

        .brand-copy p {
            margin: 0;
        }

        .main-nav {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            flex: 1;
        }

        .nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 11px;
            border-radius: 11px;
            color: #60758a;
            text-decoration: none;
            font-size: 11px;
            font-weight: 800;
            transition: .2s ease;
        }

        .nav-link i {
            font-size: 14px;
        }

        .nav-link:hover {
            color: var(--azul);
            background: #f1f7ff;
            transform: translateY(-1px);
        }

        .nav-link.active {
            color: var(--azul);
            background: #eaf4ff;
        }

        .nav-link.active::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -3px;
            width: 18px;
            height: 3px;
            border-radius: 50px;
            background: var(--dorado);
            transform: translateX(-50%);
        }

        .user-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-width: 145px;
            padding: 6px 10px 6px 7px;
            border: 1px solid #e3edf7;
            border-radius: 50px;
            background: #f8fbff;
        }

        .user-pill-icon {
            width: 31px;
            height: 31px;
            display: grid;
            place-items: center;
            flex: 0 0 31px;
            border-radius: 50%;
            color: #9b7014;
            background: var(--dorado-claro);
        }

        .user-pill-text {
            min-width: 0;
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .user-pill-text strong {
            max-width: 105px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--azul-profundo);
            font-size: 10px;
        }

        .user-pill-text small {
            margin-top: 3px;
            color: var(--texto-suave);
            font-size: 9px;
        }

        .nav-toggle {
            display: none;
            width: 39px;
            height: 39px;
            border: 0;
            border-radius: 11px;
            color: var(--azul);
            background: #eaf4ff;
            font-size: 21px;
            cursor: pointer;
        }

        .journey-bar {
            margin: 0 2px 14px;
            padding: 11px 15px 10px;
            border: 1px solid rgba(255,255,255,.9);
            border-radius: 17px;
            background: rgba(255,255,255,.88);
            box-shadow: 0 9px 24px rgba(20,62,105,.07);
            backdrop-filter: blur(12px);
        }

        .journey-top,
        .journey-steps {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .journey-top {
            margin-bottom: 7px;
            color: var(--texto-suave);
            font-size: 10px;
            font-weight: 750;
        }

        .journey-top span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .journey-top i {
            color: var(--azul);
        }

        .journey-top strong {
            color: var(--azul);
            font-size: 10px;
        }

        .journey-track {
            height: 5px;
            overflow: hidden;
            border-radius: 50px;
            background: #e9f0f7;
        }

        .journey-progress {
            display: block;
            width: 66%;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg,var(--azul),#4d8ed5,var(--dorado));
        }

        .journey-steps {
            margin-top: 7px;
            gap: 8px;
        }

        .journey-step {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #91a0af;
            font-size: 9px;
            font-weight: 750;
        }

        .journey-step i {
            font-size: 11px;
        }

        .journey-step.done {
            color: var(--verde);
        }

        .journey-step.current {
            color: var(--azul);
        }

        /* =========================================================
           MAIN
        ========================================================= */

        .main-card {
            position: relative;
            overflow: hidden;
            background: rgba(255,255,255,.96);
            border: 1px solid rgba(255,255,255,.9);
            border-radius: 24px;
            box-shadow: 0 18px 45px rgba(20,62,105,.11);
            padding: 28px 30px 24px;
            backdrop-filter: blur(15px);
        }


        /* =========================================================
           TOP DECORATIVE LINE
        ========================================================= */

        .top-line {

            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 5px;

            background:
                linear-gradient(
                    90deg,
                    var(--azul),
                    #4d8ed5,
                    var(--dorado)
                );
        }


        /* =========================================================
           INTRO
        ========================================================= */

        .intro {
            max-width: 680px;
            margin: 0 auto 26px;
            text-align: center;
        }


        .intro-tag {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding:
                7px
                13px;

            margin-bottom: 14px;

            border-radius: 50px;

            background:
                var(--dorado-claro);

            color:
                #9b7014;

            font-size: 11px;

            font-weight: 850;

            letter-spacing: .4px;

            text-transform: uppercase;
        }


        .intro-tag i {

            font-size: 14px;
        }


        .intro h2 {
            color: var(--azul-profundo);
            font-size: 29px;
            line-height: 1.15;
            font-weight: 850;
            letter-spacing: -.5px;
            margin-bottom: 9px;
        }


        .intro p {
            color: var(--texto-suave);
            font-size: 13px;
            line-height: 1.55;
        }


        /* =========================================================
           MINI EXPLICACIÓN
        ========================================================= */

        .intro-helper {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 12px;
            padding: 7px 11px;
            border-radius: 50px;
            background: #f4f8fd;
            color: #60758a;
            font-size: 11px;
            font-weight: 700;
            border: 1px solid #e4edf6;
        }


        .intro-helper i {

            color:
                var(--azul);
        }


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

            background: #fff3f3;

            border:
                1px solid #f2cccc;

            color:
                #a33a3a;

            font-size: 13px;

            line-height: 1.5;
        }


        .alert i {

            font-size: 18px;

            flex-shrink: 0;
        }


        /* =========================================================
           AVATAR GRID
        ========================================================= */

        .avatars-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 14px;
        }


        /* =========================================================
           AVATAR OPTION
        ========================================================= */

        .avatar-option {
            position: relative;
            display: block;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 7px 18px rgba(25,64,105,.075);
            transition: transform .22s ease, border-color .22s ease,
                        box-shadow .22s ease, background .22s ease;
        }

        .avatar-option:nth-child(4n+1) .avatar-image {
            background: linear-gradient(145deg,#edf6ff,#ffffff);
        }

        .avatar-option:nth-child(4n+2) .avatar-image {
            background: linear-gradient(145deg,#fff8df,#ffffff);
        }

        .avatar-option:nth-child(4n+3) .avatar-image {
            background: linear-gradient(145deg,#eafaf4,#ffffff);
        }

        .avatar-option:nth-child(4n) .avatar-image {
            background: linear-gradient(145deg,#f2edff,#ffffff);
        }


        .avatar-option:hover {
            transform: translateY(-5px) rotate(-.6deg);
            border-color: #b8d1ea;
            box-shadow: 0 15px 28px rgba(25,64,105,.13);
        }

        .avatar-option:nth-child(even):hover {
            transform: translateY(-5px) rotate(.6deg);
        }


        .avatar-option.selected {
            transform: translateY(-5px) scale(1.015);
            border-color: var(--azul);
            background: linear-gradient(180deg,#ffffff 0%,#edf6ff 100%);
            box-shadow: 0 16px 32px rgba(22,87,163,.18);
        }


        /* =========================================================
           RADIO
        ========================================================= */

        .avatar-option input {

            position: absolute;

            opacity: 0;

            pointer-events: none;
        }


        /* =========================================================
           IMAGE AREA
        ========================================================= */

        .avatar-image {
            position: relative;
            height: 205px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            overflow: hidden;
            padding: 7px 8px 0;
            background: #f7fbff;
        }


        /* decorative circle */

        .avatar-image::before {
            content: "";
            position: absolute;
            width: 135px;
            height: 135px;
            border-radius: 50%;
            bottom: -70px;
            background: rgba(22,87,163,.07);
        }


        .avatar-image img {

            position: relative;

            z-index: 1;

            width: 100%;

            height: 100%;

            object-fit: contain;

            object-position:
                center bottom;

            transition:
                transform .35s ease;
        }


        .avatar-option:hover
        .avatar-image img {

            transform:
                scale(1.055)
                translateY(-3px);
        }


        .avatar-option.selected
        .avatar-image img {

            transform:
                scale(1.05)
                translateY(-3px);
        }


        /* =========================================================
           NAME
        ========================================================= */

        .avatar-info {
            position: relative;
            z-index: 2;
            padding: 10px 8px 12px;
            text-align: center;
            border-top: 1px solid #edf1f5;
            background: rgba(255,255,255,.95);
        }


        .avatar-info h3 {
            color: var(--azul-profundo);
            font-size: 14px;
            font-weight: 850;
            margin-bottom: 3px;
        }


        .avatar-info p {
            color: var(--texto-suave);
            font-size: 10px;
            line-height: 1.35;
            min-height: 27px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }


        /* =========================================================
           SELECTED BADGE
        ========================================================= */

        .selected-check {
            position: absolute;
            z-index: 5;
            top: 8px;
            right: 8px;
            width: 29px;
            height: 29px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--azul);
            color: white;
            opacity: 0;
            transform: scale(.65);
            box-shadow: 0 7px 17px rgba(22,87,163,.30);
            transition: opacity .25s ease, transform .25s ease;
        }


        .selected-check::after {

            content: "";

            position: absolute;

            inset: -5px;

            border:
                2px solid rgba(240,189,69,.65);

            border-radius: 50%;
        }


        .avatar-option.selected
        .selected-check {

            opacity: 1;

            transform:
                scale(1);
        }


        /* =========================================================
           SELECTION PANEL
        ========================================================= */

        .selection-panel {
            margin-top: 20px;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            border: 1px solid #dce8f4;
            border-radius: 15px;
            background: linear-gradient(135deg,#f7fbff,#eef6ff);
        }


        .selection-message {

            display: flex;

            align-items: center;

            gap: 12px;
        }


        .selection-icon {
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: white;
            color: var(--azul);
            box-shadow: 0 5px 15px rgba(22,87,163,.08);
            font-size: 17px;
        }


        .selection-message strong {

            display: block;

            color:
                var(--azul-profundo);

            font-size: 13px;

            margin-bottom: 2px;
        }


        .selection-message span {

            display: block;

            color:
                var(--texto-suave);

            font-size: 12px;
        }


        .selected-name {

            color:
                var(--azul);

            font-weight: 850;
        }


        /* =========================================================
           BUTTON
        ========================================================= */

        .btn-submit {
            border: none;
            min-width: 190px;
            height: 44px;
            padding: 0 18px;
            border-radius: 12px;
            background: linear-gradient(135deg,#1657a3,#2473c1);
            color: white;
            font-family: inherit;
            font-size: 12px;
            font-weight: 850;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 9px 22px rgba(22,87,163,.22);
            transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease;
        }


        .btn-submit:hover:not(:disabled) {

            transform:
                translateY(-2px);

            box-shadow:
                0 14px 28px rgba(22,87,163,.28);
        }


        .btn-submit:disabled {

            opacity: .48;

            cursor: not-allowed;

            box-shadow: none;
        }


        .btn-submit i {

            font-size: 16px;
        }


        /* =========================================================
           BACK
        ========================================================= */

        .back-button {

            text-align: center;

            margin-top: 18px;
        }


        .back-button button {

            border: none;

            background: transparent;

            color:
                #718397;

            font-family: inherit;

            font-size: 12px;

            font-weight: 650;

            cursor: pointer;

            padding: 8px 13px;

            transition:
                color .2s ease;
        }


        .back-button button:hover {

            color:
                var(--azul);
        }


        /* =========================================================
           EMPTY
        ========================================================= */

        .empty {

            padding:
                60px 20px;

            text-align: center;

            color:
                var(--texto-suave);
        }


        .empty i {

            display: block;

            margin-bottom: 12px;

            color:
                #9bb2ca;

            font-size: 45px;
        }


        .empty h3 {

            color:
                var(--azul-profundo);

            font-size: 18px;

            margin-bottom: 5px;
        }


        .empty p {

            font-size: 13px;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */


        @media (max-width: 900px) {

            .header {
                position: relative;
                flex-wrap: wrap;
            }

            .nav-toggle {
                display: grid;
                place-items: center;
                margin-left: auto;
            }

            .main-nav {
                display: none;
                order: 10;
                width: 100%;
                flex-basis: 100%;
                padding-top: 8px;
                border-top: 1px solid #edf2f7;
                justify-content: stretch;
            }

            .main-nav.open {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }

            .nav-link {
                justify-content: center;
            }

            .user-pill {
                margin-left: auto;
            }
        }

        @media (max-width: 560px) {

            .header {
                top: 8px;
                padding: 8px 9px;
                border-radius: 17px;
            }

            .brand {
                min-width: 0;
            }

            .brand-logo-wrap {
                width: 38px;
                height: 38px;
                flex-basis: 38px;
            }

            .brand-logo {
                width: 32px;
                height: 32px;
            }

            .brand-copy h1 {
                font-size: 16px;
            }

            .brand-copy p {
                font-size: 9px;
            }

            .user-pill {
                display: none;
            }

            .journey-bar {
                margin-top: 8px;
                padding: 10px 11px;
            }

            .journey-step {
                font-size: 8px;
            }

            .main-nav.open {
                grid-template-columns: 1fr 1fr;
            }

            .nav-link {
                padding: 10px 7px;
                font-size: 10px;
            }
        }

        @media (max-width: 1100px) {
            .avatars-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }


        @media (max-width: 800px) {

            .page {

                padding:
                    18px
                    12px
                    40px;
            }


            .header {

                border-radius: 16px;

                padding:
                    12px
                    14px;
            }


            .brand-logo {

                width: 40px;
                height: 40px;
            }


            .brand h1 {

                font-size: 17px;
            }


            .brand p {

                font-size: 10px;
            }


            .step {

                padding:
                    8px
                    11px;

                font-size: 10px;
            }


            .main-card {

                padding:
                    30px
                    20px
                    22px;

                border-radius: 24px;
            }


            .intro h2 {

                font-size: 28px;
            }


            .avatars-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 14px;
            }


            .avatar-image {

                height: 245px;
            }


            .selection-panel {

                flex-direction: column;

                align-items: stretch;
            }


            .btn-submit {

                width: 100%;
            }

        }


        @media (max-width: 500px) {

            .header {

                flex-direction: column;

                align-items: stretch;
            }


            .step {

                justify-content: center;
            }


            .main-card {
                padding: 22px 10px 18px;
            }


            .intro {
                margin-bottom: 22px;
            }


            .intro h2 {

                font-size: 25px;
            }


            .intro p {

                font-size: 13px;
            }


            .avatars-grid {

                grid-template-columns: 1fr;

                gap: 15px;
            }


            .avatar-image {

                height: 310px;
            }


            .avatar-info h3 {

                font-size: 18px;
            }


            .selection-message {

                align-items: flex-start;
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
                    <img
                        src="{{ asset('build/img/logo.webp') }}"
                        alt="Ponte Pilas"
                        class="brand-logo"
                    >
                </span>

                <div class="brand-copy">
                    <h1>Ponte Pilas</h1>
                    <p>Aprende, decide y ponte pilas</p>
                </div>

            </a>

            <button
                type="button"
                class="nav-toggle"
                id="navToggle"
                aria-label="Abrir menú"
                aria-expanded="false"
            >
                <i class="bi bi-list"></i>
            </button>

            <nav class="main-nav" id="mainNav" aria-label="Navegación principal">

          
            </nav>

            <div class="user-pill">
                <span class="user-pill-icon">
                    <i class="bi bi-stars"></i>
                </span>

                <span class="user-pill-text">
                    <strong>{{ session('participacion_nombre') ?: 'Participante' }}</strong>
                    <small>Tu recorrido</small>
                </span>
            </div>

        </header>

        <div class="journey-bar" aria-label="Progreso de preparación">

            <div class="journey-top">
                <span>
                    <i class="bi bi-signpost-2"></i>
                    Preparando tu experiencia
                </span>

                <strong>1 de 2</strong>
            </div>

            <div class="journey-track">
                <span class="journey-progress"></span>
            </div>

            <div class="journey-steps">
                <span class="journey-step done">
                    <i class="bi bi-check-circle-fill"></i>
                    Datos
                </span>

                <span class="journey-step current">
                    <i class="bi bi-person-heart"></i>
                    Personaje
                </span>

                <span class="journey-step">
                    <i class="bi bi-controller"></i>
                    Comenzar
                </span>
            </div>

        </div>


        {{-- =====================================================
             MAIN
        ====================================================== --}}

        <main class="main-card">

            <div class="top-line"></div>


            {{-- =================================================
                 INTRO
            ================================================== --}}

            <div class="intro">

                <div class="intro-tag">

                    <i class="bi bi-stars"></i>

                    Tu personaje

                </div>


                <h2>
                    ¡Elige a tu compañero!
                </h2>


                <p>
                    Escoge el personaje que más conecte contigo.
                    Te acompañará durante las actividades y decisiones
                    de tu recorrido por Ponte Pilas.
                </p>


                <div class="intro-helper">

                    <i class="bi bi-hand-index-thumb"></i>

                    <i class="bi bi-hand-index-thumb"></i>
                    Toca una tarjeta y descubre cuál te representa

                </div>

            </div>


            {{-- =================================================
                 ERROR
            ================================================== --}}

            @if(session('error'))

                <div class="alert">

                    <i class="bi bi-exclamation-circle-fill"></i>

                    <div>
                        {{ session('error') }}
                    </div>

                </div>

            @endif


            {{-- =================================================
                 FORMULARIO
            ================================================== --}}

            <form
                action="{{ route('participacion.avatar.guardar') }}"
                method="POST"
                id="avatarForm"
            >

                @csrf


                {{-- =================================================
                     AVATARES
                ================================================== --}}

                @if($avatares->count())

                    <div class="avatars-grid" id="avatares">

                        @foreach($avatares as $avatar)

                            <label
                                class="avatar-option"
                                data-avatar-id="{{ $avatar->id }}"
                                data-avatar-name="{{ $avatar->nombre }}"
                            >

                                <input
                                    type="radio"
                                    name="avatar_id"
                                    value="{{ $avatar->id }}"
                                >


                                {{-- CHECK --}}

                                <div class="selected-check">

                                    <i class="bi bi-check-lg"></i>

                                </div>


                                {{-- IMAGEN --}}

                                <div class="avatar-image">

                                    <img
                                        src="{{ asset('build/img/avatars/' . trim($avatar->imagen)) }}"
                                        alt="{{ $avatar->nombre }}"
                                        loading="lazy"
                                    >

                                </div>


                                {{-- INFORMACIÓN --}}

                                <div class="avatar-info">

                                    <h3>
                                        {{ $avatar->nombre }}
                                    </h3>

                                    <p>
                                        {{ $avatar->descripcion ?? 'Tu compañero durante esta experiencia.' }}
                                    </p>

                                </div>

                            </label>

                        @endforeach

                    </div>

                @else

                    <div class="empty">

                        <i class="bi bi-person-x"></i>

                        <h3>
                            No hay avatares disponibles
                        </h3>

                        <p>
                            En este momento no hay personajes disponibles.
                        </p>

                    </div>

                @endif


                {{-- =================================================
                     SELECCIÓN
                ================================================== --}}

                <div class="selection-panel">

                    <div class="selection-message">

                        <div class="selection-icon">

                            <i
                                class="bi bi-person-check"
                                id="selectionIcon"
                            ></i>

                        </div>


                        <div>

                            <strong id="selectionTitle">
                                Aún no has elegido
                            </strong>

                            <span id="selectionText">
                                Tu personaje aparecerá durante el recorrido.
                            </span>

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="btn-submit"
                        id="btnContinuar"
                        disabled
                    >

                        <span>
                            Elegir y comenzar
                        </span>

                        <i class="bi bi-arrow-right"></i>

                    </button>

                </div>


            </form>


            {{-- =================================================
                 VOLVER
            ================================================== --}}

            <div class="back-button">

                <button
                    type="button"
                    onclick="window.history.back()"
                >

                    <i class="bi bi-arrow-left"></i>

                    Volver al formulario

                </button>

            </div>


        </main>

    </div>

</div>


<script>

    /*
    |--------------------------------------------------------------------------
    | ELEMENTOS
    |--------------------------------------------------------------------------
    */

    const avatarOptions =
        document.querySelectorAll('.avatar-option');

    const btnContinuar =
        document.getElementById('btnContinuar');

    const selectionTitle =
        document.getElementById('selectionTitle');

    const selectionText =
        document.getElementById('selectionText');

    const selectionIcon =
        document.getElementById('selectionIcon');

    const avatarForm =
        document.getElementById('avatarForm');


    /*
    |--------------------------------------------------------------------------
    | SELECCIONAR AVATAR
    |--------------------------------------------------------------------------
    */

    avatarOptions.forEach(function(card) {

        card.addEventListener(
            'click',
            function() {


                /*
                |------------------------------------------------------
                | Quitar selección anterior
                |------------------------------------------------------
                */

                avatarOptions.forEach(function(item) {

                    item.classList.remove(
                        'selected'
                    );

                });


                /*
                |------------------------------------------------------
                | Seleccionar tarjeta
                |------------------------------------------------------
                */

                card.classList.add(
                    'selected'
                );


                /*
                |------------------------------------------------------
                | Marcar radio
                |------------------------------------------------------
                */

                const radio =
                    card.querySelector(
                        'input[type="radio"]'
                    );


                radio.checked = true;


                /*
                |------------------------------------------------------
                | Obtener nombre
                |------------------------------------------------------
                */

                const avatarName =
                    card.dataset.avatarName;


                /*
                |------------------------------------------------------
                | Actualizar panel
                |------------------------------------------------------
                */

                selectionTitle.textContent =
                    'Has elegido a';


                selectionText.innerHTML =
                    `
                        <span class="selected-name">
                            ${avatarName}
                        </span>
                        te acompañará durante el recorrido.
                    `;


                selectionIcon.className =
                    'bi bi-check-circle-fill';


                /*
                |------------------------------------------------------
                | Activar botón
                |------------------------------------------------------
                */

                btnContinuar.disabled =
                    false;

            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | ENVÍO
    |--------------------------------------------------------------------------
    */


        // ---------------------------------------------------------
        // MENÚ MÓVIL
        // ---------------------------------------------------------
        const navToggle = document.getElementById('navToggle');
        const mainNav = document.getElementById('mainNav');

        if (navToggle && mainNav) {
            navToggle.addEventListener('click', function () {
                const abierto = mainNav.classList.toggle('open');

                navToggle.setAttribute(
                    'aria-expanded',
                    abierto ? 'true' : 'false'
                );

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

        // ---------------------------------------------------------
        // AVATAR: PEQUEÑA INTERACCIÓN AL SELECCIONAR
        // ---------------------------------------------------------
        avatarOptions.forEach(function (card) {
            card.setAttribute('tabindex', '0');

            card.addEventListener('keydown', function (event) {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    card.click();
                }
            });
        });

    avatarForm.addEventListener(
        'submit',
        function(event) {


            const selected =
                document.querySelector(
                    'input[name="avatar_id"]:checked'
                );


            if (!selected) {

                event.preventDefault();

                return;

            }


            /*
            | Evitar doble envío
            */

            btnContinuar.disabled =
                true;


            btnContinuar.innerHTML = `
                <span>Preparando tu experiencia...</span>
                <i class="bi bi-arrow-repeat"></i>
            `;

        }
    );

</script>


</body>

</html>