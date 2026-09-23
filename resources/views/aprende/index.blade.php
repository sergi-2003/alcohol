<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Aprende | MI DECISIÓN</title>


    {{-- =========================================================
         BOOTSTRAP
    ========================================================== --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- =========================================================
         BOOTSTRAP ICONS
    ========================================================== --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>

        /* =========================================================
           VARIABLES
        ========================================================== */

        :root {

            --primary: #1769e0;
            --primary-dark: #0b3f91;
            --blue-light: #eaf3ff;

            --yellow: #ffc928;
            --yellow-dark: #e7a900;

            --dark: #102a43;
            --text: #183b56;

            --muted: #71859a;

            --background: #f5f8fc;
            --card: #ffffff;

            --border: #e4ebf3;

        }


        /* =========================================================
           RESET
        ========================================================== */

        * {
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {

            margin: 0;

            background:
                linear-gradient(
                    180deg,
                    #f8fbff 0%,
                    #f2f6fb 100%
                );

            color: var(--text);

            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Arial,
                sans-serif;

            overflow-x: hidden;

        }


        /* =========================================================
           NAVBAR
        ========================================================== */

        .topbar {

            position: sticky;

            top: 0;

            z-index: 1000;

            background:
                rgba(255,255,255,.94);

            border-bottom:
                1px solid rgba(225,233,242,.9);

            backdrop-filter:
                blur(14px);

        }


        .navbar-inner {

            min-height: 72px;

        }


        .logo {

            height: 76px;

            width: 190px;

            object-fit: contain;

            display: block;

        }


        .home-button {

            border-radius: 12px;

            padding:
                9px 17px;

            font-size: 14px;

            font-weight: 700;

            transition:
                .25s ease;

        }


        .home-button:hover {

            transform:
                translateY(-2px);

        }


        /* =========================================================
           HERO
        ========================================================== */

        .hero {

            position: relative;

            overflow: hidden;

            min-height: 470px;

            background:

                linear-gradient(
                    90deg,
                    rgba(5,24,45,.97) 0%,
                    rgba(7,48,86,.91) 47%,
                    rgba(7,65,111,.72) 100%
                ),

                url('{{ asset('build/img/banner.png') }}')
                center center / cover no-repeat;

            color: white;

        }


        /* DECORACIÓN */

        .hero::before {

            content: "";

            position: absolute;

            width: 480px;

            height: 480px;

            right: -170px;

            top: -170px;

            border-radius: 50%;

            background:
                rgba(23,105,224,.30);

            filter:
                blur(2px);

            animation:
                heroOrb 8s ease-in-out infinite;

        }


        .hero::after {

            content: "";

            position: absolute;

            width: 320px;

            height: 320px;

            right: 25%;

            bottom: -220px;

            border-radius: 50%;

            background:
                rgba(255,201,40,.12);

            animation:
                heroOrbTwo 9s ease-in-out infinite;

        }


        .hero-content {

            position: relative;

            z-index: 5;

            max-width: 1250px;

            margin: auto;

            padding:
                70px 24px
                65px;

        }


        .hero-label {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding:
                8px 14px;

            border-radius: 30px;

            background:
                rgba(255,255,255,.10);

            border:
                1px solid rgba(255,255,255,.22);

            color:
                rgba(255,255,255,.92);

            font-size: 12px;

            font-weight: 700;

            letter-spacing:
                .5px;

            backdrop-filter:
                blur(10px);

            margin-bottom: 22px;

        }


        .hero h1 {

            max-width: 700px;

            margin: 0 0 18px;

            font-size:
                clamp(2.4rem, 5vw, 4.3rem);

            line-height: 1.04;

            letter-spacing:
                -1.8px;

            font-weight: 850;

        }


        .hero h1 span {

            color:
                var(--yellow);

        }


        .hero-description {

            max-width: 650px;

            margin: 0 0 30px;

            color:
                rgba(255,255,255,.84);

            font-size: 17px;

            line-height: 1.7;

        }


        /* =========================================================
           HERO STATS
        ========================================================== */

        .hero-stats {

            display: flex;

            flex-wrap: wrap;

            gap: 12px;

        }


        .hero-stat {

            display: flex;

            align-items: center;

            gap: 10px;

            min-width: 170px;

            padding:
                11px 14px;

            border-radius: 14px;

            background:
                rgba(255,255,255,.09);

            border:
                1px solid rgba(255,255,255,.14);

            backdrop-filter:
                blur(10px);

            transition:
                .25s ease;

        }


        .hero-stat:hover {

            transform:
                translateY(-4px);

            background:
                rgba(255,255,255,.14);

        }


        .hero-stat-icon {

            width: 40px;

            height: 40px;

            border-radius: 11px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                rgba(255,255,255,.12);

            color:
                var(--yellow);

            font-size: 18px;

        }


        .hero-stat strong {

            display: block;

            color: white;

            font-size: 12px;

        }


        .hero-stat span {

            display: block;

            margin-top: 2px;

            color:
                rgba(255,255,255,.62);

            font-size: 10px;

        }


        /* =========================================================
           HERO AVATARS
        ========================================================== */

        .hero-avatars {

            position: absolute;

            z-index: 8;

            right: 4%;

            top: 50%;

            width: 420px;

            height: 350px;

            transform:
                translateY(-50%);

        }


        .hero-avatars::before {

            content: "";

            position: absolute;

            width: 285px;

            height: 285px;

            left: 70px;

            top: 30px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(255,255,255,.15),
                    rgba(23,105,224,.08) 55%,
                    transparent 72%
                );

            border:
                1px solid rgba(255,255,255,.12);

            animation:
                avatarRing 5s ease-in-out infinite;

        }


        .hero-avatars::after {

            content: "";

            position: absolute;

            width: 190px;

            height: 190px;

            left: 115px;

            top: 75px;

            border-radius: 50%;

            border:
                1px dashed rgba(255,255,255,.20);

            animation:
                rotateRing 18s linear infinite;

        }


        .hero-avatar {

            position: absolute;

            z-index: 10;

            width: 115px;

            height: 115px;

            overflow: hidden;

            border-radius: 50%;

            background: white;

            border:
                4px solid rgba(255,255,255,.90);

            box-shadow:
                0 20px 40px rgba(0,0,0,.26);

            animation:
                avatarFloat 4.5s ease-in-out infinite;

        }


        .hero-avatar img {

            width: 100%;

            height: 100%;

            object-fit: cover;

            display: block;

        }


        .hero-avatar-1 {

            left: 0;

            top: 105px;

            animation-delay:
                0s;

        }


        .hero-avatar-2 {

            right: 4px;

            top: 20px;

            width: 105px;

            height: 105px;

            animation-delay:
                -.9s;

        }


        .hero-avatar-3 {

            right: 0;

            bottom: 5px;

            width: 112px;

            height: 112px;

            animation-delay:
                -1.7s;

        }


        .hero-avatar-4 {

            left: 92px;

            bottom: -5px;

            width: 100px;

            height: 100px;

            animation-delay:
                -2.5s;

        }


        /* =========================================================
           BURBUJA
        ========================================================== */

        .hero-main-bubble {

            position: absolute;

            z-index: 15;

            left: 135px;

            top: 112px;

            width: 155px;

            min-height: 105px;

            padding: 15px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            border-radius: 22px;

            background:
                rgba(255,255,255,.95);

            color:
                var(--dark);

            box-shadow:
                0 20px 45px rgba(0,0,0,.20);

            transform:
                rotate(-3deg);

            animation:
                bubbleFloat 4s ease-in-out infinite;

        }


        .hero-main-bubble::after {

            content: "";

            position: absolute;

            bottom: -10px;

            left: 38px;

            width: 21px;

            height: 21px;

            background: white;

            transform:
                rotate(45deg);

        }


        .hero-main-bubble i {

            color:
                var(--yellow-dark);

            font-size: 27px;

        }


        .hero-main-bubble span {

            font-size: 11px;

            line-height: 1.3;

            font-weight: 850;

            letter-spacing:
                .3px;

        }


        /* =========================================================
           MAIN
        ========================================================== */

        .main-container {

            max-width: 1250px;

            margin: auto;

            padding:
                55px 24px
                70px;

        }


        /* =========================================================
           SECTION HEADER
        ========================================================== */

        .section-header {

            display: flex;

            align-items: flex-end;

            justify-content: space-between;

            gap: 25px;

            margin-bottom: 30px;

        }


        .section-eyebrow {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            color:
                var(--primary);

            font-size: 12px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing:
                1px;

            margin-bottom: 7px;

        }


        .section-header h2 {

            margin: 0;

            color:
                var(--dark);

            font-size: 33px;

            font-weight: 850;

            letter-spacing:
                -.7px;

        }


        .section-header p {

            margin:
                8px 0 0;

            color:
                var(--muted);

            font-size: 15px;

        }


        .learning-message {

            display: flex;

            align-items: center;

            gap: 11px;

            max-width: 350px;

            padding:
                13px 16px;

            border-radius: 15px;

            background:
                linear-gradient(
                    135deg,
                    #edf5ff,
                    #f7fbff
                );

            border:
                1px solid #dbe9fa;

        }


        .learning-message i {

            color:
                var(--primary);

            font-size: 22px;

        }


        .learning-message strong {

            display: block;

            color:
                var(--text);

            font-size: 12px;

        }


        .learning-message span {

            display: block;

            margin-top: 2px;

            color:
                var(--muted);

            font-size: 11px;

        }


        /* =========================================================
           TOPIC GRID
        ========================================================== */

        .topic-grid {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 23px;

        }


        /* =========================================================
           TOPIC CARD
        ========================================================== */

        .topic-card {

            position: relative;

            overflow: hidden;

            background:
                white;

            border:
                1px solid var(--border);

            border-radius: 22px;

            box-shadow:
                0 6px 22px
                rgba(20,45,75,.055);

            transition:
                transform .3s ease,
                box-shadow .3s ease,
                border-color .3s ease;

        }


        .topic-card:hover {

            transform:
                translateY(-8px);

            box-shadow:
                0 22px 45px
                rgba(20,45,75,.13);

            border-color:
                #c8dcf5;

        }


        /* =========================================================
           TOPIC IMAGE
        ========================================================== */

        .topic-image {

            position: relative;

            height: 210px;

            overflow: hidden;

            background:
                linear-gradient(
                    135deg,
                    #edf4ff,
                    #f8fbff
                );

        }


        .topic-image img {

            width: 100%;

            height: 100%;

            object-fit: cover;

            display: block;

            transition:
                transform .55s ease;

        }


        .topic-card:hover
        .topic-image img {

            transform:
                scale(1.07);

        }


        .topic-image::after {

            content: "";

            position: absolute;

            inset: 0;

            background:
                linear-gradient(
                    180deg,
                    rgba(0,0,0,.02),
                    rgba(0,0,0,.38)
                );

            pointer-events:
                none;

        }


        /* =========================================================
           TOPIC BADGES
        ========================================================== */

        .topic-number {

            position: absolute;

            z-index: 5;

            top: 14px;

            left: 14px;

            padding:
                7px 11px;

            border-radius: 9px;

            color: white;

            background:
                rgba(8,25,43,.76);

            font-size: 11px;

            font-weight: 800;

            backdrop-filter:
                blur(7px);

        }


        .topic-status {

            position: absolute;

            z-index: 5;

            top: 14px;

            right: 14px;

        }


        .topic-status .badge {

            padding:
                7px 10px;

            border-radius: 9px;

            background:
                rgba(25,135,84,.94);

            font-size: 10px;

            font-weight: 800;

        }


        /* =========================================================
           TOPIC BODY
        ========================================================== */

        .topic-body {

            padding:
                21px;

        }


        .topic-title-row {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 12px;

        }


        .topic-title {

            margin: 0;

            color:
                var(--dark);

            font-size: 19px;

            line-height: 1.25;

            font-weight: 850;

        }


        .topic-icon {

            width: 43px;

            height: 43px;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 12px;

            background:
                #edf5ff;

            color:
                var(--primary);

            transition:
                .3s ease;

        }


        .topic-card:hover
        .topic-icon {

            transform:
                rotate(-8deg)
                scale(1.05);

            background:
                var(--primary);

            color: white;

        }


        .topic-description {

            min-height: 45px;

            margin:
                14px 0 17px;

            color:
                var(--muted);

            font-size: 13px;

            line-height: 1.65;

        }


        /* =========================================================
           AVATAR DE LA TARJETA
        ========================================================== */

        .topic-avatar-row {

            display: flex;

            align-items: center;

            gap: 11px;

            padding:
                10px 11px;

            margin-bottom: 17px;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #f4f8ff,
                    #edf4ff
                );

            border:
                1px solid #e1ebf8;

            transition:
                transform .25s ease,
                background .25s ease;

        }


        .topic-card:hover
        .topic-avatar-row {

            transform:
                translateX(3px);

            background:
                linear-gradient(
                    135deg,
                    #edf5ff,
                    #e6f0ff
                );

        }


        .topic-avatar {

            width: 48px;

            height: 48px;

            flex-shrink: 0;

            overflow: hidden;

            border-radius: 50%;

            background: white;

            border:
                3px solid white;

            box-shadow:
                0 6px 15px
                rgba(37,99,235,.15);

            animation:
                cardAvatarFloat 4s ease-in-out infinite;

        }


        .topic-avatar img {

            width: 100%;

            height: 100%;

            object-fit: cover;

            display: block;

            transition:
                transform .3s ease;

        }


        .topic-card:hover
        .topic-avatar img {

            transform:
                scale(1.1);

        }


        .topic-avatar-text {

            min-width: 0;

        }


        .topic-avatar-text strong {

            display: block;

            color:
                #24415d;

            font-size: 11px;

            font-weight: 850;

        }


        .topic-avatar-text span {

            display: block;

            margin-top: 2px;

            color:
                #7890a5;

            font-size: 10px;

        }


        /* =========================================================
           FOOTER TARJETA
        ========================================================== */

        .topic-footer {

            padding-top: 16px;

            border-top:
                1px solid #edf1f5;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 12px;

        }


        .content-count {

            display: flex;

            align-items: center;

            gap: 7px;

            color:
                var(--muted);

            font-size: 12px;

            font-weight: 700;

        }


        .content-count i {

            color:
                var(--primary);

            font-size: 16px;

        }


        .explore-button {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding:
                9px 14px;

            border-radius: 11px;

            font-size: 12px;

            font-weight: 800;

            transition:
                .25s ease;

        }


        .explore-button i {

            transition:
                transform .25s ease;

        }


        .topic-card:hover
        .explore-button {

            transform:
                translateY(-2px);

        }


        .topic-card:hover
        .explore-button i {

            transform:
                translateX(4px);

        }


        /* =========================================================
           MENSAJE FINAL
        ========================================================== */

        .reflection-box {

            position: relative;

            overflow: hidden;

            margin-top: 38px;

            padding:
                23px 25px;

            border-radius: 20px;

            background:
                linear-gradient(
                    135deg,
                    #eaf8f3,
                    #f4fbf8
                );

            border:
                1px solid #d4eee4;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 25px;

        }


        .reflection-box::after {

            content: "";

            position: absolute;

            width: 130px;

            height: 130px;

            right: -50px;

            bottom: -70px;

            border-radius: 50%;

            background:
                rgba(22,128,91,.07);

        }


        .reflection-content {

            display: flex;

            align-items: center;

            gap: 14px;

            position: relative;

            z-index: 2;

        }


        .reflection-icon {

            width: 51px;

            height: 51px;

            flex-shrink: 0;

            border-radius: 15px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                white;

            color:
                #16805b;

            font-size: 22px;

            box-shadow:
                0 7px 18px rgba(22,128,91,.08);

        }


        .reflection-content h6 {

            margin:
                0 0 3px;

            color:
                #16805b;

            font-weight: 850;

        }


        .reflection-content p {

            margin: 0;

            color:
                #28705b;

            font-size: 13px;

        }


        .reflection-quote {

            position: relative;

            z-index: 2;

            color:
                #28705b;

            font-size: 13px;

            font-style: italic;

            text-align: right;

        }


        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .empty-state {

            padding:
                70px 25px;

            text-align: center;

            background:
                white;

            border:
                1px solid var(--border);

            border-radius: 20px;

            box-shadow:
                0 6px 20px rgba(20,45,75,.05);

        }


        .empty-icon {

            width: 80px;

            height: 80px;

            margin:
                0 auto 20px;

            border-radius: 22px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                #eef3f8;

            color:
                #8a99a8;

            font-size: 34px;

        }


        .empty-state h4 {

            font-weight: 850;

        }


        .empty-state p {

            margin: 0;

            color:
                var(--muted);

        }


        /* =========================================================
           FOOTER
        ========================================================== */

        footer {

            padding:
                26px;

            text-align: center;

            background:
                white;

            border-top:
                1px solid #e4eaf0;

            color:
                var(--muted);

            font-size: 12px;

        }


        /* =========================================================
           ANIMACIONES
        ========================================================== */

        @keyframes avatarFloat {

            0%,
            100% {
                transform:
                    translateY(0)
                    rotate(0deg);
            }

            50% {
                transform:
                    translateY(-14px)
                    rotate(2deg);
            }

        }


        @keyframes bubbleFloat {

            0%,
            100% {
                transform:
                    translateY(0)
                    rotate(-3deg);
            }

            50% {
                transform:
                    translateY(-9px)
                    rotate(2deg);
            }

        }


        @keyframes avatarRing {

            0%,
            100% {
                transform:
                    scale(1);
                opacity: .7;
            }

            50% {
                transform:
                    scale(1.07);
                opacity: 1;
            }

        }


        @keyframes rotateRing {

            from {
                transform:
                    rotate(0deg);
            }

            to {
                transform:
                    rotate(360deg);
            }

        }


        @keyframes heroOrb {

            0%,
            100% {
                transform:
                    translate(0,0)
                    scale(1);
            }

            50% {
                transform:
                    translate(-25px,25px)
                    scale(1.08);
            }

        }


        @keyframes heroOrbTwo {

            0%,
            100% {
                transform:
                    translate(0,0);
            }

            50% {
                transform:
                    translate(25px,-20px);
            }

        }


        @keyframes cardAvatarFloat {

            0%,
            100% {
                transform:
                    translateY(0);
            }

            50% {
                transform:
                    translateY(-3px);
            }

        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media(max-width: 1100px) {

            .hero-avatars {

                right: -40px;

                transform:
                    translateY(-50%)
                    scale(.85);

                transform-origin:
                    right center;

            }

        }


        @media(max-width: 1000px) {

            .topic-grid {

                grid-template-columns:
                    repeat(2, minmax(0,1fr));

            }

            .hero-avatars {

                opacity: .72;

                right: -90px;

            }

        }


        @media(max-width: 800px) {

            .hero {

                min-height:
                    auto;

            }


            .hero-content {

                padding:
                    48px 20px
                    50px;

            }


            .hero h1 {

                max-width:
                    600px;

                font-size:
                    2.6rem;

            }


            .hero-avatars {

                display:
                    none;

            }


            .section-header {

                align-items:
                    flex-start;

                flex-direction:
                    column;

            }


            .learning-message {

                width: 100%;

                max-width:
                    100%;

            }

        }


        @media(max-width: 650px) {

            .logo {

                width:
                    155px;

                height:
                    65px;

            }


            .home-button {

                padding:
                    8px 12px;

                font-size:
                    12px;

            }


            .topic-grid {

                grid-template-columns:
                    1fr;

            }


            .main-container {

                padding:
                    40px 18px
                    55px;

            }


            .hero h1 {

                font-size:
                    2.3rem;

                letter-spacing:
                    -1px;

            }


            .hero-description {

                font-size:
                    15px;

            }


            .hero-stats {

                flex-direction:
                    column;

            }


            .hero-stat {

                width:
                    100%;

            }


            .section-header h2 {

                font-size:
                    28px;

            }


            .topic-image {

                height:
                    200px;

            }


            .reflection-box {

                align-items:
                    flex-start;

                flex-direction:
                    column;

            }


            .reflection-quote {

                text-align:
                    left;

            }

        }


        @media(max-width: 400px) {

            .hero h1 {

                font-size:
                    2rem;

            }


            .topic-body {

                padding:
                    18px;

            }

        }

    </style>

</head>


<body>


{{-- ============================================================
     NAVBAR
============================================================= --}}

<nav class="topbar">

    <div class="container">

        <div
            class="navbar-inner
                   d-flex
                   justify-content-between
                   align-items-center"
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


            {{-- INICIO --}}

            <a
                href="{{ route('home') }}"
                class="btn btn-outline-primary home-button"
            >

                <i class="bi bi-house me-1"></i>

                Inicio

            </a>

        </div>

    </div>

</nav>



{{-- ============================================================
     HERO
============================================================= --}}

<section class="hero">

    <div class="hero-content">

        <div class="hero-label">

            <i class="bi bi-stars"></i>

            Espacio educativo MI DECISIÓN

        </div>


        <h1>

            Aprende, reflexiona y
            <span>toma tus propias decisiones.</span>

        </h1>


        <p class="hero-description">

            Explora información sobre el alcohol, conoce diferentes
            situaciones y reflexiona sobre las decisiones que pueden
            influir en tu bienestar.

        </p>


        {{-- =====================================================
             INDICADORES
        ====================================================== --}}

        <div class="hero-stats">

            <div class="hero-stat">

                <div class="hero-stat-icon">

                    <i class="bi bi-book"></i>

                </div>

                <div>

                    <strong>

                        {{ $temas->count() }}

                        {{ $temas->count() == 1
                            ? 'tema'
                            : 'temas'
                        }}

                    </strong>

                    <span>
                        Para explorar
                    </span>

                </div>

            </div>


            <div class="hero-stat">

                <div class="hero-stat-icon">

                    <i class="bi bi-lightbulb"></i>

                </div>

                <div>

                    <strong>
                        Aprende a tu ritmo
                    </strong>

                    <span>
                        Sin presiones
                    </span>

                </div>

            </div>


            <div class="hero-stat">

                <div class="hero-stat-icon">

                    <i class="bi bi-person-check"></i>

                </div>

                <div>

                    <strong>
                        Información educativa
                    </strong>

                    <span>
                        Para reflexionar
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         AVATARES DEL HERO
    ====================================================== --}}

    <div class="hero-avatars">

        <div class="hero-avatar hero-avatar-1">

            <img
                src="{{ asset('build/img/avatars/samuel.webp') }}"
                alt="Avatar Samuel"
            >

        </div>


        <div class="hero-avatar hero-avatar-2">

            <img
                src="{{ asset('build/img/avatars/camila.webp') }}"
                alt="Avatar Camila"
            >

        </div>


        <div class="hero-avatar hero-avatar-3">

            <img
                src="{{ asset('build/img/avatars/mateo.webp') }}"
                alt="Avatar Mateo"
            >

        </div>


        <div class="hero-avatar hero-avatar-4">

            <img
                src="{{ asset('build/img/avatars/sofia.webp') }}"
                alt="Avatar Sofia"
            >

        </div>


        <div class="hero-main-bubble">

            <i class="bi bi-lightbulb"></i>

            <span>
                PIENSA<br>
                ANTES DE<br>
                DECIDIR
            </span>

        </div>

    </div>

</section>



{{-- ============================================================
     CONTENIDO PRINCIPAL
============================================================= --}}

<main class="main-container">


    {{-- =========================================================
         ENCABEZADO
    ========================================================== --}}

    <div class="section-header">

        <div>

            <div class="section-eyebrow">

                <i class="bi bi-grid"></i>

                Ponte Pilas

            </div>


            <h2>
                Conoce. Piensa. Decide.
            </h2>


            <p>

                Explora los temas, conoce diferentes situaciones
                y forma tu propia opinión.

            </p>

        </div>


        <div class="learning-message">

            <i class="bi bi-stars"></i>

            <div>

                <strong>
                    Aprende a tu propio ritmo
                </strong>

                <span>
                    Puedes explorar los temas en el orden que prefieras.
                </span>

            </div>

        </div>

    </div>



    {{-- =========================================================
         AVATARES DISPONIBLES
    ========================================================== --}}

    @php

        $avatares = [

            'samuel.webp',
            'camila.webp',
            'mateo.webp',
            'sofia.webp',
            'juan.webp',
            'mariana.webp',
            'sebastian.webp',
            'lucia.webp',
            'david.webp',
            'isabella.webp',

        ];


        $iconos = [

            'fa-circle-info'
                => 'bi-info-circle',

            'fa-brain'
                => 'bi-lightbulb',

            'fa-heart'
                => 'bi-heart',

            'fa-users'
                => 'bi-people',

            'fa-magnifying-glass'
                => 'bi-search',

            'fa-hand-holding-heart'
                => 'bi-hand-heart',

        ];

    @endphp



    {{-- =========================================================
         TEMAS
    ========================================================== --}}

    @if($temas->count())

        <div class="topic-grid">


            @foreach($temas as $index => $tema)


                @php

                    $icono =
                        $iconos[$tema->icono]
                        ?? $tema->icono;

                    if (!$icono) {

                        $icono =
                            'bi-collection';

                    }

                    $icono =
                        str_replace(
                            'bi ',
                            '',
                            $icono
                        );


                    $avatar =
                        $avatares[
                            $index
                            % count($avatares)
                        ];

                @endphp


                {{-- =================================================
                     TARJETA
                ================================================== --}}

                <article class="topic-card">


                    {{-- =================================================
                         IMAGEN
                    ================================================== --}}

                    <div class="topic-image">


                        @if($tema->imagen)

                            <img
                                src="{{ route('media.tema', [
                                    'filename'
                                        => basename($tema->imagen)
                                ]) }}"
                                alt="{{ $tema->titulo }}"
                                loading="lazy"

                                onerror="
                                    this.style.display='none';
                                    this.nextElementSibling.style.display='flex';
                                "
                            >


                            {{-- FALLBACK --}}

                            <div
                                class="w-100 h-100
                                       align-items-center
                                       justify-content-center"
                                style="display:none;"
                            >

                                <i
                                    class="bi {{ $icono }}"
                                    style="
                                        font-size:4rem;
                                        color:#1769e0;
                                    "
                                ></i>

                            </div>


                        @else

                            <div
                                class="w-100 h-100
                                       d-flex
                                       align-items-center
                                       justify-content-center"
                            >

                                <i
                                    class="bi {{ $icono }}"
                                    style="
                                        font-size:4rem;
                                        color:#1769e0;
                                    "
                                ></i>

                            </div>

                        @endif


                        {{-- NÚMERO --}}

                        <div class="topic-number">

                            <i class="bi bi-hash"></i>

                            Tema {{ $tema->orden }}

                        </div>


                        {{-- ESTADO --}}

                        @if($tema->activo)

                            <div class="topic-status">

                                <span class="badge">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Disponible

                                </span>

                            </div>

                        @endif

                    </div>



                    {{-- =================================================
                         INFORMACIÓN
                    ================================================== --}}

                    <div class="topic-body">


                        <div class="topic-title-row">

                            <div>

                                <h3 class="topic-title">

                                    {{ $tema->titulo }}

                                </h3>

                            </div>


                            <div class="topic-icon">

                                <i class="bi {{ $icono }}"></i>

                            </div>

                        </div>


                        {{-- DESCRIPCIÓN --}}

                        @if($tema->descripcion_corta)

                            <p class="topic-description">

                                {{ $tema->descripcion_corta }}

                            </p>

                        @else

                            <p class="topic-description">

                                Explora este tema educativo,
                                conoce información y reflexiona
                                sobre tus decisiones.

                            </p>

                        @endif



                        {{-- =================================================
                             AVATAR
                        ================================================== --}}

                        <div class="topic-avatar-row">


                            <div class="topic-avatar">

                                <img
                                    src="{{ asset(
                                        'build/img/avatars/'
                                        . $avatar
                                    ) }}"
                                    alt="Avatar"
                                    loading="lazy"
                                >

                            </div>


                            <div class="topic-avatar-text">

                                <strong>
                                    Tú decides cómo aprender
                                </strong>

                                <span>
                                    Explora este tema a tu ritmo
                                </span>

                            </div>

                        </div>



                        {{-- =================================================
                             PIE DE TARJETA
                        ================================================== --}}

                        <div class="topic-footer">


                            <div class="content-count">

                                <i class="bi bi-journal-text"></i>

                                <span>

                                    {{ $tema->contenidos_count }}

                                    {{ $tema->contenidos_count == 1
                                        ? 'contenido'
                                        : 'contenidos'
                                    }}

                                </span>

                            </div>


                            <a
                                href="{{ route(
                                    'aprende.tema',
                                    $tema
                                ) }}"
                                class="btn btn-primary explore-button"
                            >

                                Explorar

                                <i class="bi bi-arrow-right"></i>

                            </a>

                        </div>


                    </div>


                </article>


            @endforeach


        </div>



        {{-- =========================================================
             MENSAJE FINAL
        ========================================================== --}}



    @else


        {{-- =========================================================
             SIN TEMAS
        ========================================================== --}}

        <div class="empty-state">


            <div class="empty-icon">

                <i class="bi bi-journal-x"></i>

            </div>


            <h4>
                Próximamente
            </h4>


            <p>

                Los temas educativos estarán
                disponibles próximamente.

            </p>


        </div>


    @endif


</main>



{{-- ============================================================
     FOOTER
============================================================= --}}

<footer>

    MI DECISIÓN · Aprende, reflexiona y decide.

</footer>



{{-- ============================================================
     JAVASCRIPT
============================================================= --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | Movimiento adicional de los avatares
    |--------------------------------------------------------------------------
    */

    const heroAvatars =
        document.querySelector('.hero-avatars');


    if (heroAvatars) {

        heroAvatars.addEventListener(
            'mousemove',
            function(event) {

                const rect =
                    heroAvatars.getBoundingClientRect();

                const x =
                    (event.clientX - rect.left)
                    / rect.width
                    - .5;

                const y =
                    (event.clientY - rect.top)
                    / rect.height
                    - .5;


                const avatars =
                    heroAvatars.querySelectorAll(
                        '.hero-avatar'
                    );


                avatars.forEach(
                    function(avatar, index) {

                        const strength =
                            (index + 1) * 4;

                        avatar.style.marginLeft =
                            `${x * strength}px`;

                        avatar.style.marginTop =
                            `${y * strength}px`;

                    }
                );

            }
        );


        heroAvatars.addEventListener(
            'mouseleave',
            function() {

                const avatars =
                    heroAvatars.querySelectorAll(
                        '.hero-avatar'
                    );


                avatars.forEach(
                    function(avatar) {

                        avatar.style.marginLeft =
                            '';

                        avatar.style.marginTop =
                            '';

                    }
                );

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Animación suave de tarjetas
    |--------------------------------------------------------------------------
    */

    const topicCards =
        document.querySelectorAll('.topic-card');


    topicCards.forEach(
        function(card, index) {

            card.style.animationDelay =
                `${index * 80}ms`;

        }
    );

</script>


</body>

</html>