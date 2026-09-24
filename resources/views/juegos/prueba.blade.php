<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ponte Pilas | Experiencia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #1769aa;
            --primary-dark: #0d4f82;
            --gold: #f4b942;
            --bg: #f4f8fc;
            --text: #172b3a;
            --muted: #718096;
            --white: #ffffff;
            --success: #36a269;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top right, rgba(23,105,170,.12), transparent 30%),
                linear-gradient(180deg, #eef7ff 0%, #ffffff 100%);
            color: var(--text);
        }

        .game-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
        }

        .game {
            width: 100%;
            max-width: 1100px;
            min-height: 720px;
            background: var(--white);
            border-radius: 28px;
            box-shadow: 0 20px 60px rgba(20, 60, 90, .14);
            overflow: hidden;
            position: relative;
        }

        /* =========================
           TOP BAR
        ========================= */

        .game-header {
            padding: 20px 28px 15px;
            border-bottom: 1px solid #edf2f7;
            background: rgba(255,255,255,.95);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 20px;
            color: var(--primary);
        }

        .brand i {
            font-size: 24px;
        }

        .stats {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .stat {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            background: #f6f9fc;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
        }

        .stat i {
            color: var(--gold);
        }

        .progress-container {
            margin-top: 15px;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 7px;
            font-size: 12px;
            color: var(--muted);
            font-weight: 600;
        }

        .progress {
            height: 9px;
            border-radius: 20px;
            background: #edf2f7;
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--primary), #3b9ad9);
            border-radius: 20px;
            transition: width .5s ease;
        }

        /* =========================
           SCREENS
        ========================= */

        .screen {
            display: none;
            min-height: 620px;
            padding: 45px;
            animation: fadeIn .45s ease;
        }

        .screen.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =========================
           NAME SCREEN
        ========================= */

        .welcome-screen {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .welcome-content {
            max-width: 600px;
            width: 100%;
        }

        .avatar-circle {
            width: 150px;
            height: 150px;
            margin: 0 auto 25px;
            border-radius: 50%;
            background: linear-gradient(145deg, #e6f4ff, #f8fbff);
            border: 6px solid #fff;
            box-shadow: 0 12px 35px rgba(23,105,170,.16);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 75px;
        }

        .welcome-content h1 {
            font-size: 38px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .welcome-content p {
            color: var(--muted);
            font-size: 17px;
            line-height: 1.6;
        }

        .name-input {
            max-width: 430px;
            margin: 30px auto 20px;
            position: relative;
        }

        .name-input i {
            position: absolute;
            left: 18px;
            top: 16px;
            color: var(--primary);
        }

        .name-input input {
            width: 100%;
            padding: 15px 18px 15px 48px;
            border: 2px solid #e5edf5;
            border-radius: 15px;
            outline: none;
            font-size: 16px;
            transition: .2s;
        }

        .name-input input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(23,105,170,.08);
        }

        /* =========================
           BUTTONS
        ========================= */

        .btn-game {
            border: 0;
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 15px;
            transition: .2s;
            cursor: pointer;
        }

        .btn-primary-game {
            background: var(--primary);
            color: white;
        }

        .btn-primary-game:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-gold {
            background: var(--gold);
            color: #3d2b00;
        }

        .btn-gold:hover {
            transform: translateY(-2px);
        }

        /* =========================
           INTRO
        ========================= */

        .intro-screen {
            display: flex;
            align-items: center;
        }

        .intro-content {
            max-width: 800px;
            margin: auto;
            text-align: center;
        }

        .chapter-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 14px;
            border-radius: 30px;
            background: #eaf5ff;
            color: var(--primary);
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 22px;
        }

        .intro-content h2 {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .intro-content p {
            color: var(--muted);
            font-size: 18px;
            line-height: 1.7;
            max-width: 680px;
            margin: auto auto 30px;
        }

        .avatar-intro {
            font-size: 100px;
            margin-bottom: 15px;
        }

        /* =========================
           MAP
        ========================= */

        .map-screen {
            text-align: center;
        }

        .map-screen h2 {
            font-weight: 800;
            font-size: 32px;
        }

        .map-screen > p {
            color: var(--muted);
        }

        .map {
            max-width: 800px;
            margin: 50px auto;
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .map::before {
            content: "";
            position: absolute;
            top: 27px;
            left: 5%;
            right: 5%;
            height: 5px;
            background: #e5edf5;
            z-index: 0;
        }

        .map-node {
            position: relative;
            z-index: 1;
            width: 70px;
        }

        .node-circle {
            width: 55px;
            height: 55px;
            margin: auto;
            border-radius: 50%;
            background: #edf2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9aa8b5;
            font-weight: 800;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,.08);
        }

        .map-node.completed .node-circle {
            background: var(--success);
            color: white;
        }

        .map-node.current .node-circle {
            background: var(--gold);
            color: #3d2b00;
            transform: scale(1.12);
        }

        .map-node span {
            display: block;
            margin-top: 10px;
            font-size: 11px;
            font-weight: 700;
            color: var(--muted);
        }

        /* =========================
           STORY
        ========================= */

        .story-layout {
            max-width: 900px;
            margin: auto;
        }

        .scene-title {
            text-align: center;
            margin-bottom: 25px;
        }

        .scene-title small {
            color: var(--primary);
            font-weight: 800;
        }

        .scene-title h2 {
            font-size: 32px;
            font-weight: 800;
        }

        .story-visual {
            min-height: 280px;
            border-radius: 25px;
            background:
                linear-gradient(rgba(23,105,170,.05), rgba(23,105,170,.12)),
                linear-gradient(135deg, #dff1ff, #f7fbff);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            margin-bottom: 25px;
        }

        .story-visual::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255,255,255,.45);
            top: -300px;
            right: -100px;
        }

        .story-avatar {
            font-size: 130px;
            position: relative;
            z-index: 2;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .story-text {
            background: white;
            border: 1px solid #e8eef4;
            border-radius: 20px;
            padding: 25px;
            font-size: 17px;
            line-height: 1.7;
            box-shadow: 0 8px 25px rgba(20,60,90,.06);
        }

        .story-actions {
            text-align: center;
            margin-top: 25px;
        }

        /* =========================
           DECISIONS
        ========================= */

        .decision-layout {
            max-width: 850px;
            margin: auto;
        }

        .decision-question {
            text-align: center;
            margin-bottom: 30px;
        }

        .decision-question h2 {
            font-size: 30px;
            font-weight: 800;
        }

        .decision-question p {
            color: var(--muted);
        }

        .decision-card {
            border: 2px solid #e6edf4;
            border-radius: 18px;
            padding: 20px;
            margin-bottom: 14px;
            background: white;
            cursor: pointer;
            transition: .2s;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .decision-card:hover {
            border-color: var(--primary);
            transform: translateX(5px);
            box-shadow: 0 8px 20px rgba(23,105,170,.08);
        }

        .decision-letter {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf5ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            flex-shrink: 0;
        }

        /* =========================
           CONSEQUENCE
        ========================= */

        .consequence {
            max-width: 700px;
            margin: auto;
            text-align: center;
        }

        .consequence-icon {
            width: 90px;
            height: 90px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #fff5d9;
            color: #d59600;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
        }

        .consequence h2 {
            font-size: 34px;
            font-weight: 800;
        }

        .consequence p {
            color: var(--muted);
            line-height: 1.7;
            font-size: 17px;
        }

        .points-earned {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff6d8;
            color: #9b7100;
            padding: 10px 18px;
            border-radius: 30px;
            font-weight: 800;
            margin: 20px 0;
        }

        /* =========================
           REFLECTION
        ========================= */

        .reflection {
            max-width: 750px;
            margin: auto;
            text-align: center;
        }

        .reflection-icon {
            font-size: 65px;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .reflection h2 {
            font-size: 32px;
            font-weight: 800;
        }

        .reflection p {
            color: var(--muted);
            font-size: 17px;
            line-height: 1.7;
        }

        .reflection textarea {
            width: 100%;
            min-height: 160px;
            border: 2px solid #e5edf5;
            border-radius: 18px;
            padding: 18px;
            margin: 25px 0 15px;
            resize: none;
            outline: none;
        }

        .reflection textarea:focus {
            border-color: var(--primary);
        }

        /* =========================
           REWARD
        ========================= */

        .reward {
            text-align: center;
            max-width: 650px;
            margin: auto;
        }

        .reward-icon {
            font-size: 90px;
            color: var(--gold);
            animation: pop .5s ease;
        }

        @keyframes pop {
            0% {
                transform: scale(.4);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .reward h2 {
            font-size: 36px;
            font-weight: 800;
        }

        .reward-card {
            margin: 25px auto;
            padding: 25px;
            max-width: 400px;
            background: #fffaf0;
            border: 1px solid #f5e5b5;
            border-radius: 20px;
        }

        /* =========================
           FINAL
        ========================= */

        .final {
            max-width: 700px;
            margin: auto;
            text-align: center;
        }

        .final-badge {
            width: 110px;
            height: 110px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: linear-gradient(145deg, #fff3c7, #ffe59a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 55px;
            color: #b98400;
        }

        .final h2 {
            font-size: 38px;
            font-weight: 800;
        }

        .final-message {
            background: #f4f9fd;
            border-radius: 20px;
            padding: 25px;
            margin: 25px 0;
            line-height: 1.7;
        }

        .final-stats {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .final-stat {
            padding: 15px 20px;
            background: white;
            border: 1px solid #e5edf5;
            border-radius: 15px;
            min-width: 130px;
        }

        .final-stat strong {
            display: block;
            font-size: 22px;
            color: var(--primary);
        }

        .final-stat span {
            font-size: 12px;
            color: var(--muted);
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

            .game-wrapper {
                padding: 0;
            }

            .game {
                min-height: 100vh;
                border-radius: 0;
            }

            .screen {
                padding: 35px 20px;
                min-height: calc(100vh - 150px);
            }

            .game-header {
                padding: 18px;
            }

            .stats {
                gap: 6px;
            }

            .stat {
                padding: 7px 9px;
                font-size: 12px;
            }

            .welcome-content h1,
            .intro-content h2 {
                font-size: 30px;
            }

            .story-visual {
                min-height: 220px;
            }

            .story-avatar {
                font-size: 100px;
            }

            .map {
                margin-top: 40px;
            }

            .node-circle {
                width: 45px;
                height: 45px;
            }

            .map::before {
                top: 22px;
            }
        }
    </style>
</head>

<body>

<div class="game-wrapper">

    <div class="game">

        {{-- =========================
             HEADER
        ========================== --}}

        <header class="game-header">

            <div class="d-flex justify-content-between align-items-center">

                <div class="brand">
                    <i class="bi bi-lightning-charge-fill"></i>
                    Ponte Pilas
                </div>

                <div class="stats">

                    <div class="stat">
                        <i class="bi bi-star-fill"></i>
                        <span id="points">0</span>
                    </div>

                    <div class="stat">
                        <i class="bi bi-trophy-fill"></i>
                        <span id="badges">0</span>
                    </div>

                </div>

            </div>

            <div class="progress-container">

                <div class="progress-info">
                    <span>Progreso de la experiencia</span>
                    <span id="progressText">0%</span>
                </div>

                <div class="progress">
                    <div
                        id="progressBar"
                        class="progress-bar"
                        role="progressbar"
                        style="width: 0%">
                    </div>
                </div>

            </div>

        </header>


        {{-- =========================
             1. NOMBRE
        ========================== --}}

        <section
            id="screen-name"
            class="screen active welcome-screen"
        >

            <div class="welcome-content">

                <div class="avatar-circle">
                    👤
                </div>

                <h1>¡Bienvenido!</h1>

                <p>
                    Antes de comenzar esta experiencia,
                    queremos saber cómo quieres que te llamemos.
                </p>

                <div class="name-input">

                    <i class="bi bi-person-fill"></i>

                    <input
                        type="text"
                        id="playerName"
                        maxlength="30"
                        placeholder="Escribe tu nombre..."
                    >

                </div>

                <button
                    type="button"
                    class="btn-game btn-primary-game"
                    onclick="startExperience()"
                >
                    Comenzar experiencia
                    <i class="bi bi-arrow-right ms-2"></i>
                </button>

            </div>

        </section>


        {{-- =========================
             2. INTRODUCCIÓN
        ========================== --}}

        <section
            id="screen-intro"
            class="screen intro-screen"
        >

            <div class="intro-content">

                <div class="chapter-label">
                    <i class="bi bi-play-circle-fill"></i>
                    NUEVA EXPERIENCIA
                </div>

                <div class="avatar-intro">
                    👤
                </div>

                <h2>
                    Una decisión puede cambiar el momento
                </h2>

                <p>
                    <strong id="introName">Jugador</strong>,
                    estás a punto de vivir una historia en la que
                    tus decisiones pueden cambiar lo que ocurre.
                </p>

                <p>
                    Observa la situación, piensa antes de decidir
                    y descubre qué sucede después.
                </p>

                <button
                    type="button"
                    class="btn-game btn-primary-game"
                    onclick="showScreen('map')"
                >
                    Comenzar
                    <i class="bi bi-play-fill ms-2"></i>
                </button>

            </div>

        </section>


        {{-- =========================
             3. MAPA
        ========================== --}}

        <section
            id="screen-map"
            class="screen map-screen"
        >

            <h2>Tu experiencia</h2>

            <p>
                Avanza por la historia y descubre qué hay detrás de cada decisión.
            </p>

            <div class="map">

                <div class="map-node current">
                    <div class="node-circle">1</div>
                    <span>Inicio</span>
                </div>

                <div class="map-node">
                    <div class="node-circle">2</div>
                    <span>Invitación</span>
                </div>

                <div class="map-node">
                    <div class="node-circle">3</div>
                    <span>Decisión</span>
                </div>

                <div class="map-node">
                    <div class="node-circle">4</div>
                    <span>Reflexión</span>
                </div>

                <div class="map-node">
                    <div class="node-circle">5</div>
                    <span>Final</span>
                </div>

            </div>

            <button
                type="button"
                class="btn-game btn-primary-game"
                onclick="showScreen('story')"
            >
                Entrar en la historia
                <i class="bi bi-arrow-right ms-2"></i>
            </button>

        </section>


        {{-- =========================
             4. ESCENA
        ========================== --}}

        <section
            id="screen-story"
            class="screen"
        >

            <div class="story-layout">

                <div class="scene-title">

                    <small>ESCENA 01</small>

                    <h2>Un día normal</h2>

                </div>

                <div class="story-visual">

                    <div class="story-avatar">
                        👤
                    </div>

                </div>

                <div class="story-text">

                    <p class="mb-0">

                        Es una tarde normal después de clases.
                        Vas caminando con tus amigos cuando uno de ellos
                        recibe un mensaje.

                        <br><br>

                        <strong>
                            —Esta noche hay una reunión. ¿Vamos?
                        </strong>

                    </p>

                </div>

                <div class="story-actions">

                    <button
                        type="button"
                        class="btn-game btn-primary-game"
                        onclick="showScreen('decision')"
                    >
                        Continuar
                        <i class="bi bi-arrow-right ms-2"></i>
                    </button>

                </div>

            </div>

        </section>


        {{-- =========================
             5. DECISIÓN
        ========================== --}}

        <section
            id="screen-decision"
            class="screen"
        >

            <div class="decision-layout">

                <div class="decision-question">

                    <div class="chapter-label">
                        <i class="bi bi-signpost-split-fill"></i>
                        MOMENTO DE DECIDIR
                    </div>

                    <h2>
                        Tus amigos quieren que vayas.
                    </h2>

                    <p>
                        ¿Qué decides hacer?
                    </p>

                </div>


                <div
                    class="decision-card"
                    onclick="chooseDecision('a')"
                >

                    <div class="decision-letter">A</div>

                    <div>
                        <strong>Voy con ellos.</strong>
                        <div class="text-muted small">
                            No quiero quedarme por fuera.
                        </div>
                    </div>

                </div>


                <div
                    class="decision-card"
                    onclick="chooseDecision('b')"
                >

                    <div class="decision-letter">B</div>

                    <div>
                        <strong>Pregunto primero qué van a hacer.</strong>
                        <div class="text-muted small">
                            Quiero saber cómo será la reunión.
                        </div>
                    </div>

                </div>


                <div
                    class="decision-card"
                    onclick="chooseDecision('c')"
                >

                    <div class="decision-letter">C</div>

                    <div>
                        <strong>Prefiero no ir.</strong>
                        <div class="text-muted small">
                            Tengo claro que no quiero participar.
                        </div>
                    </div>

                </div>

            </div>

        </section>


        {{-- =========================
             6. CONSECUENCIA
        ========================== --}}

        <section
            id="screen-consequence"
            class="screen"
        >

            <div class="consequence">

                <div class="consequence-icon">
                    <i class="bi bi-lightbulb-fill"></i>
                </div>

                <h2 id="consequenceTitle">
                    Tu decisión cambió la historia
                </h2>

                <p id="consequenceText">
                    Cada decisión puede abrir diferentes caminos.
                    Lo importante es detenerse a pensar antes de actuar.
                </p>

                <div class="points-earned">
                    <i class="bi bi-star-fill"></i>
                    +20 puntos
                </div>

                <br>

                <button
                    type="button"
                    class="btn-game btn-primary-game"
                    onclick="showScreen('reflection')"
                >
                    Continuar
                    <i class="bi bi-arrow-right ms-2"></i>
                </button>

            </div>

        </section>


        {{-- =========================
             7. REFLEXIÓN
        ========================== --}}

        <section
            id="screen-reflection"
            class="screen"
        >

            <div class="reflection">

                <div class="reflection-icon">
                    <i class="bi bi-chat-heart-fill"></i>
                </div>

                <h2>
                    Ahora piensa un momento
                </h2>

                <p>
                    ¿Qué crees que hace difícil decir "no"
                    cuando tus amigos insisten?
                </p>

                <textarea
                    id="reflectionText"
                    placeholder="Escribe lo que piensas..."
                ></textarea>

                <br>

                <button
                    type="button"
                    class="btn-game btn-primary-game"
                    onclick="completeReflection()"
                >
                    Guardar reflexión
                    <i class="bi bi-check-lg ms-2"></i>
                </button>

            </div>

        </section>


        {{-- =========================
             8. RECOMPENSA
        ========================== --}}

        <section
            id="screen-reward"
            class="screen"
        >

            <div class="reward">

                <div class="reward-icon">
                    <i class="bi bi-trophy-fill"></i>
                </div>

                <h2>
                    ¡Insignia desbloqueada!
                </h2>

                <div class="reward-card">

                    <h4>
                        🧠 Pensador
                    </h4>

                    <p class="text-muted mb-0">
                        Completaste tu primera reflexión.
                    </p>

                </div>

                <p class="text-muted">
                    Has conseguido
                    <strong>+30 puntos</strong>.
                </p>

                <button
                    type="button"
                    class="btn-game btn-primary-game"
                    onclick="showScreen('final')"
                >
                    Ver resultado
                    <i class="bi bi-arrow-right ms-2"></i>
                </button>

            </div>

        </section>


        {{-- =========================
             9. FINAL
        ========================== --}}

        <section
            id="screen-final"
            class="screen"
        >

            <div class="final">

                <div class="final-badge">
                    <i class="bi bi-trophy-fill"></i>
                </div>

                <h2>
                    ¡Experiencia completada!
                </h2>

                <p class="text-muted">
                    <strong id="finalName">Jugador</strong>,
                    has llegado al final de esta experiencia.
                </p>

                <div class="final-message">

                    <strong>
                        Tu decisión también cuenta.
                    </strong>

                    <br><br>

                    Las decisiones que tomamos pueden cambiar
                    lo que ocurre a nuestro alrededor.
                    Detenerse, pensar y decidir también es una forma
                    de cuidar de nosotros mismos.

                </div>

                <div class="final-stats">

                    <div class="final-stat">
                        <strong id="finalPoints">50</strong>
                        <span>PUNTOS</span>
                    </div>

                    <div class="final-stat">
                        <strong>1</strong>
                        <span>DECISIÓN</span>
                    </div>

                    <div class="final-stat">
                        <strong>1</strong>
                        <span>REFLEXIÓN</span>
                    </div>

                    <div class="final-stat">
                        <strong id="finalBadges">1</strong>
                        <span>INSIGNIA</span>
                    </div>

                </div>

                <button
                    type="button"
                    class="btn-game btn-gold"
                    onclick="location.reload()"
                >
                    <i class="bi bi-arrow-repeat me-2"></i>
                    Volver a experimentar
                </button>

            </div>

        </section>

    </div>

</div>


<script>

    /*
    |--------------------------------------------------------------------------
    | ESTADO DEL JUEGO
    |--------------------------------------------------------------------------
    */

    let game = {
        playerName: '',
        points: 0,
        badges: 0,
        decisions: 0,
        reflections: 0,
        progress: 0
    };


    /*
    |--------------------------------------------------------------------------
    | CAMBIAR PANTALLA
    |--------------------------------------------------------------------------
    */

    function showScreen(screenName) {

        document.querySelectorAll('.screen').forEach(screen => {
            screen.classList.remove('active');
        });

        const screen = document.getElementById('screen-' + screenName);

        if (screen) {
            screen.classList.add('active');
        }

        updateProgress(screenName);
    }


    /*
    |--------------------------------------------------------------------------
    | INICIAR EXPERIENCIA
    |--------------------------------------------------------------------------
    */

    function startExperience() {

        const input = document.getElementById('playerName');

        const name = input.value.trim();

        if (!name) {

            input.focus();

            input.style.borderColor = '#dc3545';

            setTimeout(() => {
                input.style.borderColor = '';
            }, 1500);

            return;
        }

        game.playerName = name;

        document.getElementById('introName').textContent = name;
        document.getElementById('finalName').textContent = name;

        showScreen('intro');
    }


    /*
    |--------------------------------------------------------------------------
    | DECISIÓN
    |--------------------------------------------------------------------------
    */

    function chooseDecision(option) {

        game.decisions++;

        game.points += 20;

        updateStats();

        const title = document.getElementById('consequenceTitle');
        const text = document.getElementById('consequenceText');

        if (option === 'a') {

            title.textContent = 'Decidiste acompañarlos';

            text.textContent =
                'Decidiste ir con tus amigos. La historia continúa y pronto tendrás que enfrentarte a nuevas situaciones.';

        }

        if (option === 'b') {

            title.textContent = 'Decidiste preguntar primero';

            text.textContent =
                'Antes de actuar quisiste conocer la situación. A veces detenerse unos segundos puede ayudarnos a tomar decisiones más conscientes.';

        }

        if (option === 'c') {

            title.textContent = 'Decidiste no ir';

            text.textContent =
                'Tomaste tu propia decisión. Decir que no también puede ser una manera de mantenerte fiel a lo que quieres.';

        }

        showScreen('consequence');
    }


    /*
    |--------------------------------------------------------------------------
    | REFLEXIÓN
    |--------------------------------------------------------------------------
    */

    function completeReflection() {

        const text = document
            .getElementById('reflectionText')
            .value
            .trim();

        if (!text) {

            document
                .getElementById('reflectionText')
                .focus();

            return;
        }

        game.reflections++;

        game.points += 30;

        game.badges++;

        updateStats();

        showScreen('reward');
    }


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR ESTADÍSTICAS
    |--------------------------------------------------------------------------
    */

    function updateStats() {

        document.getElementById('points').textContent =
            game.points;

        document.getElementById('badges').textContent =
            game.badges;

        document.getElementById('finalPoints').textContent =
            game.points;

        document.getElementById('finalBadges').textContent =
            game.badges;
    }


    /*
    |--------------------------------------------------------------------------
    | PROGRESO
    |--------------------------------------------------------------------------
    */

    function updateProgress(screenName) {

        const progressMap = {

            name: 0,
            intro: 10,
            map: 20,
            story: 40,
            decision: 55,
            consequence: 70,
            reflection: 80,
            reward: 90,
            final: 100

        };

        const progress =
            progressMap[screenName] ?? game.progress;

        game.progress = progress;

        document.getElementById('progressBar').style.width =
            progress + '%';

        document.getElementById('progressText').textContent =
            progress + '%';
    }


    /*
    |--------------------------------------------------------------------------
    | ENTER PARA CONTINUAR
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('playerName')
        .addEventListener('keydown', function(event) {

            if (event.key === 'Enter') {
                startExperience();
            }

        });

</script>

</body>
</html>