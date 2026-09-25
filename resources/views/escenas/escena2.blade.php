<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Escena 2 | Aprende | Ponte Pilas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * { box-sizing: border-box; }

        :root {
            --navy:#06152e;
            --navy2:#0b2851;
            --blue:#1769ff;
            --blue2:#58c6ff;
            --yellow:#ffd447;
            --white:#fff;
            --ink:#102442;
            --muted:#687993;
            --glass:rgba(6,21,46,.70);
            --line:rgba(255,255,255,.14);
        }

        html, body {
            margin:0;
            min-height:100%;
            font-family:Inter,"Segoe UI",Arial,sans-serif;
        }

        body {
            background:var(--navy);
            color:var(--ink);
            overflow-x:hidden;
        }

        button { font:inherit; }

        .learn {
            min-height:100vh;
            position:relative;
            overflow:hidden;
            background:var(--navy);
        }

        .background {
            position:absolute;
            inset:0;
            z-index:0;
            background:
                linear-gradient(90deg,
                    rgba(4,15,35,.90) 0%,
                    rgba(4,15,35,.58) 38%,
                    rgba(4,15,35,.45) 70%,
                    rgba(4,15,35,.66) 100%),
                url("{{ asset('build/img/fondo.webp') }}") center/cover no-repeat;
        }

        .background::after {
            content:"";
            position:absolute;
            inset:0;
            background:
                radial-gradient(circle at 74% 24%, rgba(88,198,255,.16), transparent 28%),
                linear-gradient(180deg, rgba(3,13,30,.10), rgba(3,13,30,.40));
            pointer-events:none;
        }

        .page {
            position:relative;
            z-index:2;
            min-height:100vh;
            width:min(1420px,100%);
            margin:auto;
            padding:24px 30px 34px;
        }

        .topbar {
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:20px;
            color:#fff;
        }

        .brand {
            display:flex;
            align-items:center;
            gap:14px;
        }

        .back {
            width:46px;
            height:46px;
            border:1px solid var(--line);
            border-radius:15px;
            background:rgba(5,20,43,.62);
            color:#fff;
            display:grid;
            place-items:center;
            text-decoration:none;
            backdrop-filter:blur(14px);
            transition:.22s ease;
            flex-shrink:0;
        }

        .back:hover {
            background:var(--blue);
            color:#fff;
            transform:translateY(-2px);
        }

        .back i { font-size:20px; }

        .brand-title {
            font-size:20px;
            font-weight:900;
            letter-spacing:-.4px;
        }

        .brand-subtitle {
            margin-top:2px;
            font-size:11px;
            font-weight:700;
            color:rgba(255,255,255,.62);
        }

        .counter {
            display:flex;
            align-items:center;
            gap:7px;
            padding:10px 15px;
            border:1px solid var(--line);
            border-radius:15px;
            background:rgba(5,20,43,.62);
            backdrop-filter:blur(14px);
            color:rgba(255,255,255,.65);
            font-size:10px;
            font-weight:900;
            letter-spacing:1.3px;
            flex-shrink:0;
        }

        .counter strong {
            color:var(--yellow);
            font-size:16px;
        }

        .xp-panel {
            margin:18px 0 16px;
            padding:13px 17px;
            border:1px solid var(--line);
            border-radius:18px;
            background:rgba(5,20,43,.56);
            backdrop-filter:blur(16px);
            color:#fff;
        }

        .xp-top {
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:15px;
            margin-bottom:8px;
        }

        .xp-label {
            font-size:10px;
            font-weight:900;
            letter-spacing:1.4px;
            text-transform:uppercase;
            color:rgba(255,255,255,.62);
        }

        .xp-value {
            color:var(--yellow);
            font-weight:900;
            font-size:13px;
        }

        .xp-track {
            height:6px;
            border-radius:20px;
            background:rgba(255,255,255,.12);
            overflow:hidden;
        }

        .xp-fill {
            height:100%;
            width:12%;
            border-radius:20px;
            background:linear-gradient(90deg,var(--blue),var(--blue2));
            transition:width .7s ease;
        }

        .stage {
            display:grid;
            grid-template-columns:minmax(0,1fr) 390px;
            gap:24px;
            min-height:610px;
        }

        .content-card {
            align-self:center;
            padding:38px;
            border:1px solid rgba(255,255,255,.17);
            border-radius:30px;
            background:rgba(255,255,255,.94);
            box-shadow:0 24px 70px rgba(0,0,0,.25);
        }

        .eyebrow {
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:7px 11px;
            border-radius:999px;
            background:#eaf2ff;
            color:var(--blue);
            font-size:10px;
            font-weight:900;
            letter-spacing:1.1px;
            text-transform:uppercase;
        }

        .eyebrow i { font-size:13px; }

        h1 {
            margin:18px 0 12px;
            color:var(--navy);
            font-size:clamp(28px,4vw,52px);
            line-height:1.08;
            letter-spacing:-1.8px;
            font-weight:950;
            max-width:780px;
        }

        .lead {
            margin:0;
            max-width:800px;
            color:#53647d;
            font-size:clamp(14px,1.6vw,16px);
            line-height:1.7;
        }

        .effects {
            display:grid;
            grid-template-columns:repeat(2,minmax(0,1fr));
            gap:13px;
            margin-top:26px;
        }

        .effect-card {
            position:relative;
            min-height:155px;
            padding:20px;
            border:1px solid #e2eaf5;
            border-radius:21px;
            background:#fff;
            cursor:pointer;
            text-align:left;
            transition:.22s ease;
        }

        .effect-card:hover {
            transform:translateY(-3px);
            border-color:#9dc1ff;
            box-shadow:0 14px 30px rgba(23,105,255,.10);
        }

        .effect-card.active {
            border-color:var(--blue);
            box-shadow:0 0 0 3px rgba(23,105,255,.10);
            background:#f8fbff;
        }

        .effect-icon {
            width:42px;
            height:42px;
            display:grid;
            place-items:center;
            border-radius:13px;
            background:#edf4ff;
            color:var(--blue);
            font-size:19px;
            margin-bottom:13px;
        }

        .effect-card h3 {
            margin:0 0 7px;
            font-size:15px;
            font-weight:950;
            color:var(--navy);
        }

        .effect-card p {
            margin:0;
            font-size:12px;
            line-height:1.55;
            color:#65758c;
        }

        .selected {
            margin-top:16px;
            padding:16px 18px;
            border-radius:18px;
            background:#eef6ff;
            border:1px solid #d8e9ff;
        }

        .selected-label {
            font-size:9px;
            font-weight:950;
            letter-spacing:1.2px;
            text-transform:uppercase;
            color:var(--blue);
            margin-bottom:5px;
        }

        .selected-title {
            font-size:15px;
            font-weight:950;
            color:var(--navy);
        }

        .selected-text {
            margin-top:4px;
            font-size:12px;
            line-height:1.55;
            color:#5d6d83;
        }

        .actions {
            display:flex;
            justify-content:flex-end;
            align-items:center;
            gap:10px;
            margin-top:22px;
        }

        .btn-action {
            border:0;
            border-radius:14px;
            min-height:46px;
            padding:0 17px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            font-size:12px;
            font-weight:900;
            cursor:pointer;
            transition:.2s ease;
        }

        .btn-voice {
            background:#edf4ff;
            color:var(--blue);
        }

        .btn-voice:hover { background:#dceaff; }

        .btn-next {
            background:var(--blue);
            color:#fff;
            box-shadow:0 10px 22px rgba(23,105,255,.25);
        }

        .btn-next:hover {
            transform:translateY(-2px);
            background:#0e5ce8;
        }

        .avatar-side {
            position:relative;
            min-height:610px;
            display:flex;
            align-items:flex-end;
            justify-content:center;
        }

        .avatar-glow {
            position:absolute;
            width:330px;
            height:330px;
            border-radius:50%;
            background:rgba(88,198,255,.18);
            filter:blur(30px);
            bottom:55px;
        }

        .avatar {
            position:relative;
            z-index:2;
            width:min(100%,390px);
            max-height:610px;
            object-fit:contain;
            object-position:center bottom;
            filter:drop-shadow(0 24px 24px rgba(0,0,0,.22));
            animation:float 4.8s ease-in-out infinite;
        }

        .speech {
            position:absolute;
            z-index:4;
            top:58px;
            left:0;
            right:0;
            margin:auto;
            width:min(350px,92%);
            padding:17px 18px;
            border-radius:20px;
            background:rgba(255,255,255,.96);
            box-shadow:0 18px 45px rgba(0,0,0,.18);
            border:1px solid rgba(255,255,255,.8);
        }

        .speech::after {
            content:"";
            position:absolute;
            bottom:-10px;
            left:45%;
            width:20px;
            height:20px;
            background:#fff;
            transform:rotate(45deg);
        }

        .speech-top {
            display:flex;
            align-items:center;
            gap:8px;
            margin-bottom:7px;
        }

        .speech-dot {
            width:8px;
            height:8px;
            border-radius:50%;
            background:var(--blue);
            flex-shrink:0;
        }

        .speech-name {
            font-size:10px;
            font-weight:950;
            color:var(--blue);
            letter-spacing:.8px;
            text-transform:uppercase;
        }

        .speech p {
            position:relative;
            z-index:2;
            margin:0;
            color:#263b5a;
            font-size:13px;
            line-height:1.55;
            font-weight:650;
        }

        .progress-area {
            margin-top:19px;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            color:rgba(255,255,255,.60);
            font-size:9px;
            font-weight:900;
            text-transform:uppercase;
            letter-spacing:.55px;
        }

        .progress-step {
            display:flex;
            align-items:center;
            gap:6px;
            white-space:nowrap;
        }

        .progress-dot {
            width:8px;
            height:8px;
            border-radius:50%;
            background:rgba(255,255,255,.22);
            flex-shrink:0;
        }

        .progress-step.done .progress-dot,
        .progress-step.active .progress-dot {
            background:var(--yellow);
            box-shadow:0 0 0 4px rgba(255,212,71,.12);
        }

        .progress-step.active { color:#fff; }

        .progress-connector {
            width:25px;
            height:1px;
            background:rgba(255,255,255,.17);
            flex-shrink:0;
        }

        .toast-complete {
            position:fixed;
            inset:0;
            z-index:50;
            display:none;
            align-items:center;
            justify-content:center;
            padding:20px;
            background:rgba(2,10,24,.68);
            backdrop-filter:blur(9px);
        }

        .toast-complete.show { display:flex; }

        .complete-box {
            width:min(430px,100%);
            padding:30px;
            border-radius:28px;
            background:#fff;
            text-align:center;
            box-shadow:0 30px 90px rgba(0,0,0,.35);
            animation:pop .35s ease;
        }

        .complete-icon {
            width:62px;
            height:62px;
            margin:0 auto 15px;
            border-radius:20px;
            display:grid;
            place-items:center;
            background:#eaf3ff;
            color:var(--blue);
            font-size:27px;
        }

        .complete-box h2 {
            margin:0;
            color:var(--navy);
            font-size:24px;
            font-weight:950;
        }

        .complete-box p {
            margin:8px 0 20px;
            color:var(--muted);
            font-size:13px;
        }

        .xp-earned {
            display:inline-flex;
            align-items:center;
            gap:7px;
            padding:9px 14px;
            border-radius:999px;
            background:#fff5c9;
            color:#6e5600;
            font-size:12px;
            font-weight:950;
            margin-bottom:20px;
        }

        @keyframes float {
            0%,100% { transform:translateY(0); }
            50% { transform:translateY(-9px); }
        }

        @keyframes pop {
            from { transform:scale(.94); opacity:0; }
            to { transform:scale(1); opacity:1; }
        }

        /* ============================================
           RESPONSIVE — tablet / mobile (<=1050px)
           ============================================ */
        @media (max-width:1050px) {

            .stage {
                grid-template-columns:1fr;
                min-height:auto;
                gap:28px;
            }

            /* El avatar y su globo/burbuja dejan de flotar superpuestos
               y pasan a apilarse en flujo normal: evita que la burbuja
               (con texto largo) se monte encima de la tarjeta de abajo. */
            .avatar-side {
                min-height:auto;
                order:-1;
                flex-direction:column;
                align-items:center;
                justify-content:center;
                gap:16px;
                padding-top:6px;
            }

            .avatar-glow { display:none; }

            .avatar {
                position:relative;
                width:min(60vw,300px);
                max-height:360px;
                animation:none;
            }

            .speech {
                position:relative;
                z-index:2;
                top:auto;
                left:auto;
                right:auto;
                margin:0 auto;
                width:min(420px,94%);
            }

            .speech::after { display:none; }

            .content-card { align-self:auto; }
        }

        /* ============================================
           RESPONSIVE — móvil (<=720px)
           ============================================ */
        @media (max-width:720px) {
            .page { padding:15px 14px 25px; }

            .brand-subtitle { display:none; }

            .counter { padding:9px 11px; }

            .stage { gap:18px; }

            .avatar-side { gap:12px; }

            .avatar {
                width:min(52vw,240px);
                max-height:280px;
            }

            .speech {
                width:100%;
                padding:15px 16px;
            }

            .content-card {
                padding:24px 18px;
                border-radius:23px;
            }

            h1 { font-size:32px; }

            .lead { font-size:14px; }

            .effects {
                grid-template-columns:1fr;
            }

            .effect-card { min-height:auto; }

            .actions {
                flex-direction:column;
                align-items:stretch;
            }

            .btn-action { width:100%; }

            .progress-area {
                overflow-x:auto;
                justify-content:flex-start;
                padding-bottom:5px;
                -webkit-overflow-scrolling:touch;
            }

            .progress-connector { width:15px; }
        }

        /* ============================================
           RESPONSIVE — móviles muy pequeños (<=420px)
           ============================================ */
        @media (max-width:420px) {
            .brand-title { font-size:17px; }

            .counter {
                font-size:9px;
                padding:8px 9px;
                gap:5px;
            }

            .avatar { width:min(48vw,190px); max-height:220px; }

            h1 { font-size:26px; letter-spacing:-1px; }

            .effect-card { padding:16px; }

            .effect-icon { width:36px; height:36px; font-size:16px; }

            .complete-box { padding:22px; }
        }
    </style>
</head>

<body>

<div class="learn">

    <div class="background"></div>

    <div class="page">

        <header class="topbar">
            <div class="brand">
                <a
                    href="{{ url('/escena') }}"
                    class="back"
                    aria-label="Volver a la escena 1"
                    title="Volver a la escena 1">
                    <i class="bi bi-arrow-left"></i>
                </a>

                <div>
                    <div class="brand-title">Aprende</div>
                    <div class="brand-subtitle">Comprender también es prevenir</div>
                </div>
            </div>

            <div class="counter">
                <span>ESCENA</span>
                <strong>02</strong>
                <span>/</span>
                <span>08</span>
            </div>
        </header>

        <div class="xp-panel">
            <div class="xp-top">
                <span class="xp-label">Tu recorrido de aprendizaje</span>
                <span class="xp-value"><span id="xpValue">50</span> XP</span>
            </div>

            <div class="xp-track">
                <div class="xp-fill" id="xpFill"></div>
            </div>
        </div>

        <main class="stage">

            <section class="content-card">

                <span class="eyebrow">
                    <i class="bi bi-lightbulb"></i>
                    Escena 02 · Comprender
                </span>

                <h1>¿Qué efectos negativos puede traer el alcohol?</h1>

                <p class="lead">
                    En los menores, el alcohol puede afectar distintas áreas de la vida.
                    No se trata solamente de sentirse mal después de beber. También puede
                    influir en el cerebro, las decisiones, las relaciones y la seguridad.
                </p>

                <div class="effects">

                    <button class="effect-card active" type="button"
                        data-title="Cerebro y aprendizaje"
                        data-text="Durante la adolescencia el cerebro todavía está en desarrollo. El alcohol puede interferir con procesos relacionados con la memoria, el aprendizaje y la toma de decisiones."
                        onclick="seleccionarEfecto(this)">
                        <div class="effect-icon">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <h3>Cerebro y aprendizaje</h3>
                        <p>Puede afectar procesos relacionados con la memoria, el aprendizaje y las decisiones.</p>
                    </button>

                    <button class="effect-card" type="button"
                        data-title="Emociones y decisiones"
                        data-text="El alcohol puede afectar el juicio y el control de los impulsos, haciendo más difícil valorar los riesgos y tomar decisiones seguras."
                        onclick="seleccionarEfecto(this)">
                        <div class="effect-icon">
                            <i class="bi bi-signpost-split"></i>
                        </div>
                        <h3>Emociones y decisiones</h3>
                        <p>Puede alterar el juicio y hacer más difícil valorar los riesgos.</p>
                    </button>

                    <button class="effect-card" type="button"
                        data-title="Cuerpo y seguridad"
                        data-text="El alcohol puede aumentar el riesgo de caídas, lesiones, accidentes y otras situaciones peligrosas, especialmente cuando se consume en exceso."
                        onclick="seleccionarEfecto(this)">
                        <div class="effect-icon">
                            <i class="bi bi-shield-exclamation"></i>
                        </div>
                        <h3>Cuerpo y seguridad</h3>
                        <p>Puede aumentar el riesgo de lesiones, accidentes y situaciones peligrosas.</p>
                    </button>

                    <button class="effect-card" type="button"
                        data-title="Relaciones y estudio"
                        data-text="El consumo de alcohol puede relacionarse con dificultades en la escuela, conflictos y problemas en las relaciones con otras personas."
                        onclick="seleccionarEfecto(this)">
                        <div class="effect-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3>Relaciones y estudio</h3>
                        <p>Puede relacionarse con dificultades escolares, conflictos y problemas en las relaciones.</p>
                    </button>

                </div>

                <div class="selected">
                    <div class="selected-label">Profundiza</div>
                    <div class="selected-title" id="selectedTitle">Cerebro y aprendizaje</div>
                    <div class="selected-text" id="selectedText">
                        Durante la adolescencia el cerebro todavía está en desarrollo.
                        El alcohol puede interferir con procesos relacionados con la memoria,
                        el aprendizaje y la toma de decisiones.
                    </div>
                </div>

                <div class="actions">
                    <button class="btn-action btn-voice" type="button" onclick="escuchar()">
                        <i class="bi bi-volume-up"></i>
                        Escuchar a Alex
                    </button>

                    <button class="btn-action btn-next" type="button" onclick="completarEscena()">
                        Continuar
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>

            </section>

            <aside class="avatar-side">

                <div class="avatar-glow"></div>

                <div class="speech">
                    <div class="speech-top">
                        <span class="speech-dot"></span>
                        <span class="speech-name">Profesor Alex</span>
                    </div>

                    <p id="speechText">
                        No todo se reduce a “tomar o no tomar”.
                        También importa entender qué puede cambiar cuando el alcohol
                        entra en la vida de un menor.
                    </p>
                </div>

                <img
                    class="avatar"
                    src="{{ asset('build/avatars/cuerpo2.webp') }}"
                    alt="Profesor Alex">
            </aside>

        </main>

        <div class="progress-area">

            <div class="progress-step done">
                <span class="progress-dot"></span>
                <span>Introducción</span>
            </div>

            <div class="progress-connector"></div>

            <div class="progress-step active">
                <span class="progress-dot"></span>
                <span>Concepto</span>
            </div>

            <div class="progress-connector"></div>

            <div class="progress-step">
                <span class="progress-dot"></span>
                <span>Efectos</span>
            </div>

            <div class="progress-connector"></div>

            <div class="progress-step">
                <span class="progress-dot"></span>
                <span>Señales</span>
            </div>

            <div class="progress-connector"></div>

            <div class="progress-step">
                <span class="progress-dot"></span>
                <span>Situación</span>
            </div>

            <div class="progress-connector"></div>

            <div class="progress-step">
                <span class="progress-dot"></span>
                <span>Decisión</span>
            </div>

            <div class="progress-connector"></div>

            <div class="progress-step">
                <span class="progress-dot"></span>
                <span>Reflexión</span>
            </div>

            <div class="progress-connector"></div>

            <div class="progress-step">
                <span class="progress-dot"></span>
                <span>Cierre</span>
            </div>

        </div>

    </div>
</div>

<div class="toast-complete" id="completeModal">
    <div class="complete-box">
        <div class="complete-icon">
            <i class="bi bi-check2-circle"></i>
        </div>

        <h2>Escena completada</h2>

        <p>
            Ya conoces algunas áreas en las que el alcohol puede afectar
            la vida de un menor. Ahora vamos a observar las señales que
            pueden llamar nuestra atención.
        </p>

        <div class="xp-earned">
            <i class="bi bi-star-fill"></i>
            +75 XP
        </div>

        <button class="btn-action btn-next w-100" type="button" onclick="irSiguiente()">
            Ir a la siguiente escena
            <i class="bi bi-arrow-right"></i>
        </button>
    </div>
</div>

<script>
    const escenaActual = 2;
    const puntosEscena = 75;


    /* =============================================================
       EFECTO SELECCIONADO
    ============================================================= */

    let efectoSeleccionado = {
        title: 'Cerebro y aprendizaje',
        text: 'Durante la adolescencia el cerebro todavía está en desarrollo. El alcohol puede interferir con procesos relacionados con la memoria, el aprendizaje y la toma de decisiones.'
    };


    /* =============================================================
       SELECCIONAR EFECTO
    ============================================================= */

    function seleccionarEfecto(card) {

        document.querySelectorAll('.effect-card').forEach(item => {
            item.classList.remove('active');
        });

        card.classList.add('active');

        efectoSeleccionado = {
            title: card.dataset.title,
            text: card.dataset.text
        };

        document.getElementById('selectedTitle').textContent =
            efectoSeleccionado.title;

        document.getElementById('selectedText').textContent =
            efectoSeleccionado.text;

        document.getElementById('speechText').textContent =
            efectoSeleccionado.title +
            '. ' +
            efectoSeleccionado.text;
    }


    /* =============================================================
       OBTENER VOZ EN ESPAÑOL
    ============================================================= */

    function obtenerVozEspanol() {

        if (!('speechSynthesis' in window)) {
            return null;
        }

        const voces = speechSynthesis.getVoices();

        return (
            voces.find(
                voz => voz.lang.toLowerCase() === 'es-co'
            )
            ||
            voces.find(
                voz => voz.lang.toLowerCase().startsWith('es')
            )
            ||
            null
        );
    }


    /* =============================================================
       ESCUCHAR EFECTO SELECCIONADO
    ============================================================= */

    function escuchar() {

        if (!('speechSynthesis' in window)) {

            alert(
                'Tu navegador no permite reproducción de voz.'
            );

            return;
        }

        speechSynthesis.cancel();

        const texto =
            'Soy el Profesor Alex. ' +
            efectoSeleccionado.title +
            '. ' +
            efectoSeleccionado.text;

        reproducirTexto(texto);
    }


    /* =============================================================
       REPRODUCIR TEXTO
    ============================================================= */

    function reproducirTexto(texto) {

        const utterance =
            new SpeechSynthesisUtterance(texto);

        utterance.lang = 'es-CO';
        utterance.rate = 0.94;
        utterance.pitch = 1.05;
        utterance.volume = 1;

        const voz = obtenerVozEspanol();

        if (voz) {
            utterance.voice = voz;
        }

        speechSynthesis.speak(utterance);
    }


    /* =============================================================
       AUDIO AUTOMÁTICO DE LA ESCENA
    ============================================================= */

    function reproducirEscenaAutomaticamente() {

        if (!('speechSynthesis' in window)) {
            return;
        }

        const textoEscena = `
            Hola. Soy el Profesor Alex.

            En esta escena vamos a conocer algunos de los
            efectos negativos que puede traer el consumo
            de alcohol durante la adolescencia.

            En los menores, el alcohol puede afectar distintas
            áreas de la vida.

            No se trata solamente de sentirse mal después
            de beber.

            También puede influir en el cerebro,
            las decisiones, las relaciones y la seguridad.

            Selecciona cada una de las tarjetas para conocer
            más sobre estos efectos.
        `;

        speechSynthesis.cancel();

        reproducirTexto(textoEscena);
    }


    /* =============================================================
       XP
    ============================================================= */

    function obtenerXP() {

        return parseInt(
            localStorage.getItem('pontePilasXP') || '50',
            10
        );
    }


    function guardarXP(valor) {

        localStorage.setItem(
            'pontePilasXP',
            valor
        );
    }


    function actualizarXP() {

        const xp = obtenerXP();

        document.getElementById(
            'xpValue'
        ).textContent = xp;

        const porcentaje =
            Math.min(
                (xp / 1075) * 100,
                100
            );

        document.getElementById(
            'xpFill'
        ).style.width =
            porcentaje + '%';
    }


    /* =============================================================
       COMPLETAR ESCENA
    ============================================================= */

    function completarEscena() {

        const completadas =
            JSON.parse(
                localStorage.getItem(
                    'pontePilasEscenas'
                ) || '[]'
            );


        if (!completadas.includes(escenaActual)) {

            completadas.push(
                escenaActual
            );

            localStorage.setItem(
                'pontePilasEscenas',
                JSON.stringify(completadas)
            );


            const nuevoXP =
                obtenerXP() +
                puntosEscena;


            guardarXP(
                nuevoXP
            );
        }


        actualizarXP();


        document
            .getElementById('completeModal')
            .classList.add('show');
    }


    /* =============================================================
       SIGUIENTE ESCENA
    ============================================================= */

    function irSiguiente() {

        window.location.href =
            "{{ url('/aprende/escena/3') }}";
    }


    /* =============================================================
       CARGAR ESCENA
    ============================================================= */

    actualizarXP();


    /* =============================================================
       REPRODUCCIÓN AUTOMÁTICA
    ============================================================= */

    window.addEventListener(
        'load',
        function () {

            setTimeout(
                function () {

                    reproducirEscenaAutomaticamente();

                },
                800
            );

        }
    );


    /* =============================================================
       CARGAR VOCES DEL NAVEGADOR
    ============================================================= */

    if ('speechSynthesis' in window) {

        speechSynthesis.onvoiceschanged =
            function () {

                obtenerVozEspanol();

            };
    }


    /* =============================================================
       DETENER AUDIO AL SALIR
    ============================================================= */

    window.addEventListener(
        'beforeunload',
        function () {

            if ('speechSynthesis' in window) {

                speechSynthesis.cancel();

            }

        }
    );

</script>

</body>
</html>