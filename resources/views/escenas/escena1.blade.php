<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Aprende | Ponte Pilas</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * {
            box-sizing: border-box;
        }

        :root {
            --navy: #06152e;
            --navy2: #0a2348;
            --blue: #1769ff;
            --blue2: #58c6ff;
            --yellow: #ffd447;
            --white: #ffffff;
            --ink: #102442;
            --muted: #61718a;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
            font-family: Inter, "Segoe UI", Arial, sans-serif;
        }

        body {
            background: var(--navy);
            color: var(--ink);
            overflow-x: hidden;
        }

        button {
            font: inherit;
        }

        /* =========================================================
           CONTENEDOR PRINCIPAL
        ========================================================= */

        .learn {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            background: #06152e;
        }

        .background {
            position: absolute;
            inset: 0;
            z-index: 0;

            background:
                linear-gradient(
                    90deg,
                    rgba(4,15,35,.88) 0%,
                    rgba(4,15,35,.46) 42%,
                    rgba(4,15,35,.70) 100%
                ),
                url("{{ asset('build/img/fondo.webp') }}")
                center / cover no-repeat;
        }

        .background::after {
            content: "";
            position: absolute;
            inset: 0;
            opacity: .07;

            background-image:
                linear-gradient(
                    rgba(255,255,255,.2) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(255,255,255,.2) 1px,
                    transparent 1px
                );

            background-size: 50px 50px;
        }

        .page {
            position: relative;
            z-index: 2;

            min-height: 100vh;

            padding:
                20px
                clamp(16px,4vw,58px)
                90px;
        }

        /* =========================================================
           BARRA SUPERIOR
        ========================================================= */

        .topbar {
            max-width: 1450px;
            margin: auto;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .back {
            width: 45px;
            height: 45px;

            border: 1px solid rgba(255,255,255,.15);
            border-radius: 14px;

            background: rgba(5,20,43,.58);
            color: white;

            cursor: pointer;

            backdrop-filter: blur(14px);

            transition: .2s;
        }

        .back:hover {
            background: var(--blue);
            transform: translateY(-2px);
        }

        .brand-title {
            font-size: 21px;
            font-weight: 900;
            color: white;
        }

        .brand-subtitle {
            font-size: 12px;
            color: rgba(255,255,255,.55);
        }

        .counter {
            display: flex;
            align-items: center;
            gap: 8px;

            padding: 9px 15px;

            border-radius: 999px;

            border: 1px solid rgba(255,255,255,.15);

            background: rgba(5,20,43,.58);

            color: white;

            font-size: 11px;
            font-weight: 900;

            backdrop-filter: blur(14px);
        }

        .counter strong {
            font-size: 15px;
            color: var(--yellow);
        }

        /* =========================================================
           PANEL XP
        ========================================================= */

        .xp-panel {

            position: absolute;

            right: 24px;
            top: 84px;

            z-index: 8;

            width: 230px;

            padding: 13px 15px;

            border-radius: 18px;

            background: rgba(5,20,43,.72);

            border: 1px solid rgba(255,255,255,.13);

            backdrop-filter: blur(16px);

            color: white;

            box-shadow:
                0 18px 45px rgba(0,0,0,.18);
        }

        .xp-top {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 8px;
        }

        .xp-label {
            font-size: 10px;
            font-weight: 900;

            letter-spacing: .08em;

            color: rgba(255,255,255,.55);
        }

        .xp-value {
            font-size: 15px;
            font-weight: 950;

            color: var(--yellow);
        }

        .xp-track {

            height: 7px;

            border-radius: 99px;

            background: rgba(255,255,255,.12);

            overflow: hidden;
        }

        .xp-fill {

            height: 100%;

            width: 4%;

            border-radius: 99px;

            background:
                linear-gradient(
                    90deg,
                    var(--blue),
                    var(--blue2)
                );

            transition: width .8s;
        }

        .level {

            display: flex;
            justify-content: space-between;

            margin-top: 6px;

            font-size: 10px;

            color: rgba(255,255,255,.55);
        }

        .level strong {
            color: white;
        }

        /* =========================================================
           ESCENA
        ========================================================= */

        .scene {

            width: min(1450px,100%);

            min-height:
                calc(100vh - 115px);

            margin: auto;

            display: grid;

            grid-template-columns:
                minmax(420px,.92fr)
                minmax(520px,1.08fr);

            align-items: center;

            gap:
                clamp(30px,5vw,85px);

            padding:
                30px
                0
                50px;
        }

        /* =========================================================
           ALEX
        ========================================================= */

        .character-zone {

            display: flex;

            justify-content: center;

            align-items: center;

            min-height: 640px;
        }

        .character {

            position: relative;

            width: min(530px,94%);

            height:
                min(710px,78vh);

            object-fit: contain;

            object-position:
                center bottom;

            filter:
                drop-shadow(
                    0 28px 45px
                    rgba(0,0,0,.28)
                );

            animation:
                characterEnter .75s ease both;
        }

        @keyframes characterEnter {

            from {
                opacity: 0;
                transform:
                    translateY(22px)
                    scale(.98);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        /* =========================================================
           TARJETA
        ========================================================= */

        .dialogue-card {

            width: min(700px,100%);

            padding: 38px;

            border-radius: 32px;

            background:
                rgba(248,251,255,.97);

            border:
                1px solid
                rgba(255,255,255,.7);

            box-shadow:
                0 35px 90px
                rgba(0,0,0,.28);

            animation:
                cardEnter .7s .08s ease both;
        }

        @keyframes cardEnter {

            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        /* =========================================================
           ENCABEZADO DEL DIALOGO
        ========================================================= */

        .speaker {

            display: flex;

            align-items: center;

            gap: 9px;

            color: var(--blue);

            font-size: 11px;

            font-weight: 950;

            text-transform: uppercase;

            letter-spacing: .1em;
        }

        .speaker-dot {

            width: 10px;
            height: 10px;

            border-radius: 50%;

            background: var(--blue);

            box-shadow:
                0 0 0 6px
                rgba(23,105,255,.1);
        }

        .tag {

            float: right;

            margin-top: -22px;

            padding: 7px 11px;

            border-radius: 999px;

            background: #edf4ff;

            color: var(--blue);

            font-size: 10px;

            font-weight: 900;
        }

        .dialogue-card h1 {

            margin:
                20px 0 0;

            color: var(--navy);

            font-size:
                clamp(38px,4vw,58px);

            line-height: .97;

            font-weight: 950;

            letter-spacing: -.055em;
        }

        .dialogue-card h1 span {
            color: var(--blue);
        }

        .yellow-line {

            width: 58px;
            height: 5px;

            border-radius: 99px;

            background: var(--yellow);

            margin: 22px 0;
        }

        .dialogue-text {

            margin: 0;

            color: #52627a;

            font-size: 17px;

            line-height: 1.68;
        }

        .dialogue-text strong {
            color: var(--navy);
        }

        /* =========================================================
           APRENDIZAJE
        ========================================================= */

        .learning {

            margin-top: 22px;

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 13px 15px;

            border:
                1px solid #e1ebf9;

            background: #f2f7ff;

            border-radius: 16px;
        }

        .learning-icon {

            width: 40px;
            height: 40px;

            border-radius: 12px;

            background: white;

            color: var(--blue);

            display: flex;

            align-items: center;

            justify-content: center;

            flex: none;
        }

        .learning strong {

            display: block;

            font-size: 12px;

            color: var(--navy);
        }

        .learning small {

            display: block;

            color: #7c899d;

            font-size: 11px;

            margin-top: 2px;
        }

        /* =========================================================
           VOZ
        ========================================================= */

        .voice {

            margin-top: 18px;

            padding: 10px;

            border-radius: 18px;

            background: #eaf3ff;

            display: flex;

            align-items: center;

            gap: 12px;
        }

        .voice-icon {

            width: 40px;
            height: 40px;

            border-radius: 12px;

            background: white;

            color: var(--blue);

            display: flex;

            align-items: center;

            justify-content: center;

            flex: none;
        }

        .voice-copy {
            flex: 1;
        }

        .voice-copy strong {

            font-size: 12px;

            color: #30425e;
        }

        .voice-copy small {

            display: block;

            font-size: 10px;

            color: #8290a2;
        }

        .bars {

            display: flex;

            align-items: center;

            gap: 3px;

            height: 25px;
        }

        .bar {

            width: 3px;

            height: 7px;

            border-radius: 5px;

            background: var(--blue);
        }

        .playing .bar:nth-child(1) {
            animation: sound .55s infinite;
        }

        .playing .bar:nth-child(2) {
            animation:
                sound .55s .1s infinite;
        }

        .playing .bar:nth-child(3) {
            animation:
                sound .55s .2s infinite;
        }

        .playing .bar:nth-child(4) {
            animation:
                sound .55s .3s infinite;
        }

        .playing .bar:nth-child(5) {
            animation:
                sound .55s .15s infinite;
        }

        @keyframes sound {

            0%,100% {
                height: 6px;
            }

            50% {
                height: 22px;
            }
        }

        .listen {

            border: 0;

            border-radius: 12px;

            background: var(--blue);

            color: white;

            padding:
                11px
                15px;

            font-size: 12px;

            font-weight: 900;

            cursor: pointer;
        }

        .listen:hover {
            background: #0d58d8;
        }

        .listen:disabled {

            opacity: .55;

            cursor: not-allowed;
        }

        /* =========================================================
           ACCIONES
        ========================================================= */

        .actions {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-top: 22px;
        }

        .stop {

            border: 0;

            background: transparent;

            color: #7b899c;

            font-size: 12px;

            font-weight: 850;

            cursor: pointer;
        }

        .stop:hover {
            color: var(--blue);
        }

        .continue {

            border: 0;

            border-radius: 15px;

            background: var(--yellow);

            color: #14243d;

            padding:
                13px
                14px
                13px
                19px;

            display: inline-flex;

            align-items: center;

            gap: 12px;

            font-size: 13px;

            font-weight: 950;

            cursor: pointer;

            box-shadow:
                0 12px 25px
                rgba(194,145,0,.18);

            transition: .2s;
        }

        .continue:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 17px 30px
                rgba(194,145,0,.24);
        }

        .continue-icon {

            width: 32px;
            height: 32px;

            border-radius: 10px;

            background:
                rgba(255,255,255,.45);

            display: flex;

            align-items: center;

            justify-content: center;
        }

        /* =========================================================
           PROGRESO
        ========================================================= */

        .progress-area {

            position: absolute;

            bottom: 18px;

            left: 50%;

            transform:
                translateX(-50%);

            width:
                min(1000px,88%);

            display: flex;

            align-items: center;

            gap: 9px;
        }

        .progress-step {

            display: flex;

            align-items: center;

            gap: 8px;

            color:
                rgba(255,255,255,.4);

            font-size: 10px;

            font-weight: 850;

            white-space: nowrap;
        }

        .progress-dot {

            width: 9px;
            height: 9px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.2);
        }

        .progress-step.active {
            color: white;
        }

        .progress-step.active
        .progress-dot {

            width: 12px;
            height: 12px;

            background:
                var(--blue2);

            box-shadow:
                0 0 0 5px
                rgba(88,198,255,.12),

                0 0 18px
                rgba(88,198,255,.7);
        }

        .progress-step.done {
            color:
                rgba(255,255,255,.75);
        }

        .progress-step.done
        .progress-dot {

            background:
                var(--yellow);
        }

        .progress-connector {

            flex: 1;

            height: 1px;

            background:
                rgba(255,255,255,.15);
        }

        /* =========================================================
           MODAL DE RECOMPENSA
        ========================================================= */

        .reward {

            position: fixed;

            inset: 0;

            z-index: 50;

            background:
                rgba(3,12,28,.72);

            backdrop-filter:
                blur(8px);

            display: flex;

            align-items: center;

            justify-content: center;

            opacity: 0;

            pointer-events: none;

            transition: .25s;
        }

        .reward.show {

            opacity: 1;

            pointer-events: auto;
        }

        .reward-card {

            width:
                min(420px,90%);

            padding:
                35px 30px;

            text-align: center;

            border-radius: 28px;

            background: white;

            box-shadow:
                0 35px 90px
                rgba(0,0,0,.35);

            transform:
                translateY(20px)
                scale(.97);

            transition: .3s;
        }

        .reward.show
        .reward-card {

            transform:
                translateY(0)
                scale(1);
        }

        .reward-icon {

            width: 76px;
            height: 76px;

            margin: auto;

            border-radius: 22px;

            background:
                #fff5c7;

            color:
                #d19c00;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 34px;

            box-shadow:
                0 12px 30px
                rgba(209,156,0,.15);
        }

        .reward-card h2 {

            margin:
                18px 0 6px;

            color: var(--navy);

            font-size: 30px;

            font-weight: 950;
        }

        .points {

            font-size: 42px;

            font-weight: 950;

            color: var(--blue);

            margin: 4px 0;
        }

        .reward-card p {

            margin: 0;

            color: #68778d;

            font-size: 14px;

            line-height: 1.55;
        }

        .unlock {

            margin: 18px 0;

            padding: 11px 13px;

            border-radius: 14px;

            background: #f1f6ff;

            color: #29405f;

            font-size: 12px;

            font-weight: 800;
        }

        .reward-btn {

            border: 0;

            border-radius: 13px;

            background: var(--blue);

            color: white;

            padding:
                12px 22px;

            font-weight: 900;

            cursor: pointer;
        }

        .reward-btn:hover {
            background: #0d58d8;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media(max-width:1050px) {

            .scene {

                grid-template-columns:
                    40%
                    60%;

                gap: 20px;
            }

            .character {
                height: 600px;
            }

            .dialogue-card {
                padding: 30px;
            }

            .dialogue-card h1 {
                font-size: 43px;
            }

            .xp-panel {

                right: 18px;

                top: 76px;

                width: 190px;
            }
        }

        @media(max-width:780px) {

            .page {

                padding:
                    14px
                    14px
                    100px;
            }

            .brand-subtitle {
                display: none;
            }

            .xp-panel {

                position: relative;

                top: auto;
                right: auto;

                width: 100%;

                max-width: 400px;

                margin:
                    15px auto 0;
            }

            .scene {

                grid-template-columns: 1fr;

                gap: 10px;

                min-height: auto;

                padding:
                    10px
                    0
                    70px;
            }

            .character-zone {
                min-height: 350px;
            }

            .character {

                height: 390px;

                width: 90%;
            }

            .dialogue-card {

                padding: 24px;

                border-radius: 24px;
            }

            .dialogue-card h1 {

                font-size: 34px;
            }

            .dialogue-text {

                font-size: 15px;
            }

            .tag {
                display: none;
            }

            .bars {
                display: none;
            }

            .voice {
                flex-wrap: wrap;
            }

            .listen {
                flex: 1;
            }

            .actions {

                flex-direction:
                    column-reverse;

                align-items:
                    stretch;
            }

            .continue,
            .stop {

                width: 100%;

                justify-content:
                    center;
            }

            .progress-area {

                width: 94%;

                gap: 5px;
            }

            .progress-step {

                font-size: 8px;
            }

            .progress-step span:last-child {
                display: none;
            }

            .progress-connector {

                min-width: 5px;
            }
        }

    </style>
</head>

<body>

<div class="learn">

    <div class="background"></div>

    <div class="page">

        <!-- =====================================================
             CABECERA
        ====================================================== -->

        <header class="topbar">

            <div class="brand">

                <button
                    class="back"
                    type="button"
                    onclick="history.back()"
                    aria-label="Volver">

                    <i class="bi bi-arrow-left"></i>

                </button>

                <div>

                    <div class="brand-title">
                        Aprende
                    </div>

                    <div class="brand-subtitle">
                        Comprender también es prevenir
                    </div>

                </div>

            </div>

            <div class="counter">

                <span>ESCENA</span>

                <strong>01</strong>

                <span>/</span>

                <span>08</span>

            </div>

        </header>


        <!-- =====================================================
             PANEL XP
        ====================================================== -->

        <div class="xp-panel">

            <div class="xp-top">

                <span class="xp-label">
                    PROGRESO
                </span>

                <span class="xp-value">

                    <span id="xpValue">
                        0
                    </span>

                    XP

                </span>

            </div>

            <div class="xp-track">

                <div
                    class="xp-fill"
                    id="xpFill">
                </div>

            </div>

            <div class="level">

                <span>
                    Nivel
                    <strong id="levelNumber">
                        1
                    </strong>
                </span>

                <strong id="levelName">
                    Explorador
                </strong>

            </div>

        </div>


        <!-- =====================================================
             ESCENA
        ====================================================== -->

        <section class="scene">


            <!-- =================================================
                 ALEX
            ================================================== -->

            <div class="character-zone">

                <img
                    class="character"
                    src="{{ asset('build/avatars/cuerpo.webp') }}"
                    alt="Profesor Alex">

            </div>


            <!-- =================================================
                 DIALOGO
            ================================================== -->

            <div>

                <article class="dialogue-card">


                    <div class="speaker">

                        <span class="speaker-dot"></span>

                        Profesor Alex

                    </div>


                    <span class="tag">

                        INTRODUCCIÓN

                    </span>


                    <h1>

                        Conoce las
                        <span>
                            señales de alerta
                        </span>

                    </h1>


                    <div class="yellow-line"></div>


                    <p class="dialogue-text">

                        Hola. Soy el Profesor Alex y voy a acompañarte durante este recorrido.

                        <br>
                        <br>

                        Aquí aprenderás a reconocer

                        <strong>
                            algunos cambios que pueden llamar nuestra atención
                        </strong>

                        cuando hablamos del consumo de alcohol en menores.

                        <br>
                        <br>

                        La idea no es juzgar.

                        Es aprender a observar,
                        conversar y brindar apoyo.

                    </p>


                    <!-- =================================================
                         OBJETIVO
                    ================================================== -->

                    <div class="learning">

                        <div class="learning-icon">

                            <i class="bi bi-compass-fill"></i>

                        </div>

                        <div>

                            <strong>
                                ¿Qué vas a aprender?
                            </strong>

                            <small>
                                Observar · Conversar · Acompañar
                            </small>

                        </div>

                    </div>


                    <!-- =================================================
                         VOZ
                    ================================================== -->

                    <div
                        class="voice"
                        id="voiceBox">

                        <div class="voice-icon">

                            <i class="bi bi-volume-up-fill"></i>

                        </div>


                        <div class="voice-copy">

                            <strong id="voiceText">

                                Escucha a Alex

                            </strong>

                            <small>

                                Puedes volver a escucharlo cuando quieras

                            </small>

                        </div>


                        <div class="bars">

                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>

                        </div>


                        <button
                            class="listen"
                            id="listenButton"
                            type="button"
                            onclick="hablar()">

                            <i class="bi bi-play-fill"></i>

                            Escuchar

                        </button>

                    </div>


                    <!-- =================================================
                         BOTONES
                    ================================================== -->

                    <div class="actions">

                        <button
                            class="stop"
                            type="button"
                            onclick="detener()">

                            <i class="bi bi-stop-fill"></i>

                            Detener audio

                        </button>


                        <button
                            class="continue"
                            type="button"
                            onclick="completarEscena()">

                            Completar escena

                            <span class="continue-icon">

                                <i class="bi bi-arrow-right"></i>

                            </span>

                        </button>

                    </div>


                </article>

            </div>

        </section>


        <!-- =====================================================
             PROGRESO DEL RECORRIDO
        ====================================================== -->

        <div class="progress-area">


            <div class="progress-step active">

                <span class="progress-dot"></span>

                <span>
                    Introducción
                </span>

            </div>


            <div class="progress-connector"></div>


            <div class="progress-step">

                <span class="progress-dot"></span>

                <span>
                    Concepto
                </span>

            </div>


            <div class="progress-connector"></div>


            <div class="progress-step">

                <span class="progress-dot"></span>

                <span>
                    Efectos
                </span>

            </div>


            <div class="progress-connector"></div>


            <div class="progress-step">

                <span class="progress-dot"></span>

                <span>
                    Señales
                </span>

            </div>


            <div class="progress-connector"></div>


            <div class="progress-step">

                <span class="progress-dot"></span>

                <span>
                    Situación
                </span>

            </div>


            <div class="progress-connector"></div>


            <div class="progress-step">

                <span class="progress-dot"></span>

                <span>
                    Decisión
                </span>

            </div>


            <div class="progress-connector"></div>


            <div class="progress-step">

                <span class="progress-dot"></span>

                <span>
                    Reflexión
                </span>

            </div>


            <div class="progress-connector"></div>


            <div class="progress-step">

                <span class="progress-dot"></span>

                <span>
                    Cierre
                </span>

            </div>

        </div>

    </div>

</div>


<!-- =============================================================
     MODAL DE RECOMPENSA
============================================================== -->

<div
    class="reward"
    id="reward">

    <div class="reward-card">


        <div class="reward-icon">

            <i class="bi bi-stars"></i>

        </div>


        <h2>
            ¡Escena completada!
        </h2>


        <div class="points">

            +50 XP

        </div>


        <p>

            Has completado la introducción y estás listo
            para continuar con el siguiente paso de la experiencia.

        </p>


        <div class="unlock">

            <i class="bi bi-unlock-fill"></i>

            Próxima escena desbloqueada

        </div>


        <button
            class="reward-btn"
            type="button"
            onclick="irSiguiente()">

            Continuar

            <i class="bi bi-arrow-right"></i>

        </button>


    </div>

</div>


<script>

/* =============================================================
   CONFIGURACIÓN DE LA ESCENA
============================================================= */

const escenaActual = 1;

const puntosEscena = 50;


/* =============================================================
   XP

   Por ahora usamos localStorage para probar el sistema.

   Después lo conectaremos con Laravel:
   - puntos
   - progreso
   - niveles
   - insignias
============================================================= */

let xp = Number(
    localStorage.getItem('ponte_pilas_xp') || 0
);


let escenasCompletadas = JSON.parse(

    localStorage.getItem(
        'ponte_pilas_escenas'
    ) || '[]'

);


/* =============================================================
   NIVELES
============================================================= */

function obtenerNivel(xp) {

    if (xp >= 900) {

        return {
            nivel: 5,
            nombre: 'Preventor',
            anterior: 900,
            siguiente: 1075
        };

    }

    if (xp >= 650) {

        return {
            nivel: 4,
            nombre: 'Acompañante',
            anterior: 650,
            siguiente: 900
        };

    }

    if (xp >= 400) {

        return {
            nivel: 3,
            nombre: 'Comprensivo',
            anterior: 400,
            siguiente: 650
        };

    }

    if (xp >= 200) {

        return {
            nivel: 2,
            nombre: 'Observador',
            anterior: 200,
            siguiente: 400
        };

    }

    return {

        nivel: 1,

        nombre: 'Explorador',

        anterior: 0,

        siguiente: 200

    };

}


/* =============================================================
   ACTUALIZAR XP
============================================================= */

function actualizarXP() {

    const info =
        obtenerNivel(xp);


    document.getElementById(
        'xpValue'
    ).textContent = xp;


    document.getElementById(
        'levelNumber'
    ).textContent = info.nivel;


    document.getElementById(
        'levelName'
    ).textContent = info.nombre;


    let porcentaje =

        (
            (xp - info.anterior) /
            (info.siguiente - info.anterior)
        ) * 100;


    porcentaje = Math.max(
        4,
        Math.min(100, porcentaje)
    );


    document.getElementById(
        'xpFill'
    ).style.width =
        porcentaje + '%';

}


actualizarXP();


/* =============================================================
   COMPLETAR ESCENA
============================================================= */

function completarEscena() {

    detener();


    /*
     * Evita que el usuario gane
     * los mismos puntos varias veces.
     */

    if (
        !escenasCompletadas.includes(
            escenaActual
        )
    ) {

        xp += puntosEscena;


        escenasCompletadas.push(
            escenaActual
        );


        localStorage.setItem(

            'ponte_pilas_xp',

            xp

        );


        localStorage.setItem(

            'ponte_pilas_escenas',

            JSON.stringify(
                escenasCompletadas
            )

        );

    }


    actualizarXP();


    document
        .getElementById('reward')
        .classList.add('show');

}


/* =============================================================
   SIGUIENTE ESCENA
============================================================= */

function irSiguiente() {

    /*
     * Ruta que construiremos
     * para la escena 2.
     */

    window.location.href =
        "{{ url('/aprende/escena/2') }}";

}


/* =============================================================
   VOZ DE ALEX
============================================================= */

const textoAlex = `

Hola. Soy el Profesor Alex y voy a acompañarte
durante este recorrido.

Aquí aprenderás a reconocer algunos cambios
que pueden llamar nuestra atención cuando
hablamos del consumo de alcohol en menores.

La idea no es juzgar.

Es aprender a observar,
conversar y brindar apoyo.

`;


const voiceBox =
    document.getElementById(
        'voiceBox'
    );


const voiceText =
    document.getElementById(
        'voiceText'
    );


const listenButton =
    document.getElementById(
        'listenButton'
    );


/* =============================================================
   BUSCAR VOZ ESPAÑOL
============================================================= */

function obtenerVozEspanol() {

    if (
        !('speechSynthesis' in window)
    ) {

        return null;

    }


    const voces =
        window.speechSynthesis
            .getVoices();


    return (

        voces.find(

            voz =>

                voz.lang
                    .toLowerCase() ===
                'es-co'

        )

        ||

        voces.find(

            voz =>

                voz.lang
                    .toLowerCase()
                    .startsWith('es')

        )

        ||

        null

    );

}


/* =============================================================
   HABLAR
============================================================= */

function hablar() {

    if (
        !('speechSynthesis' in window)
    ) {

        alert(
            'Este navegador no permite reproducir la voz de Alex.'
        );

        return;

    }


    window.speechSynthesis.cancel();


    const voz =

        new SpeechSynthesisUtterance(
            textoAlex
        );


    voz.lang =
        'es-CO';


    voz.rate =
        0.94;


    voz.pitch =
        1.05;


    voz.volume =
        1;


    const vozDisponible =
        obtenerVozEspanol();


    if (
        vozDisponible
    ) {

        voz.voice =
            vozDisponible;

    }


    voz.onstart =
        function () {

            voiceBox.classList.add(
                'playing'
            );


            voiceText.textContent =
                'Alex está hablando...';


            listenButton.disabled =
                true;


            listenButton.innerHTML = `

                <i class="bi bi-volume-up-fill"></i>

                Reproduciendo

            `;

        };


    voz.onend =
        finalizarAudio;


    voz.onerror =
        finalizarAudio;


    window.speechSynthesis.speak(
        voz
    );

}


/* =============================================================
   DETENER AUDIO
============================================================= */

function detener() {

    if (
        'speechSynthesis' in window
    ) {

        window.speechSynthesis.cancel();

    }


    finalizarAudio();

}


/* =============================================================
   FINALIZAR AUDIO
============================================================= */

function finalizarAudio() {

    voiceBox.classList.remove(
        'playing'
    );


    voiceText.textContent =
        'Escucha a Alex';


    listenButton.disabled =
        false;


    listenButton.innerHTML = `

        <i class="bi bi-play-fill"></i>

        Escuchar

    `;

}

/* =============================================================
   LIMPIAR AL SALIR
============================================================= */

window.addEventListener(
    'beforeunload',
    function () {

        if (
            'speechSynthesis' in window
        ) {

            window.speechSynthesis.cancel();

        }

    }
);


/* =============================================================
   REPRODUCCIÓN AUTOMÁTICA AL ENTRAR A LA ESCENA
============================================================= */

window.addEventListener('load', function () {

    setTimeout(function () {

        hablar();

    }, 800);

});

</script>

</body>
</html>