<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mi Decisión</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <style>
        :root {
            --azul: #079fe0;
            --azul-oscuro: #006fa8;
            --verde: #35c928;
            --verde-oscuro: #249c15;
            --amarillo: #ffd21c;
            --rosa: #ef2870;
            --morado: #8241df;
            --naranja: #f59b00;
            --oscuro: #10205c;
            --gris: #64748b;
            --fondo: #f7fbff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: var(--oscuro);
            background: var(--fondo);
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar-custom {
            position: relative;
            width: 100%;
            min-height: 76px;
            padding: 10px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            z-index: 1000;
            box-shadow: 0 3px 15px rgba(0,0,0,.10);
        }

        .navbar-inner {
            width: 100%;
            max-width: 1250px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-logo-link {
            display: none;
        }

        .nav-brand-text {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--oscuro);
            font-size: 20px;
            font-weight: 900;
        }

        .nav-brand-text i {
            color: var(--rosa);
            font-size: 18px;
        }

        .nav-brand-text strong {
            color: var(--verde-oscuro);
        }

        .navbar-desktop {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .navbar-desktop a {
            color: var(--oscuro);
            font-weight: 700;
            transition: .25s ease;
        }

        .navbar-desktop a:hover {
            color: var(--azul);
        }

        .btn-login {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 11px 21px;
            border-radius: 30px;
            background: var(--azul);
            color: #fff !important;
        }

        .btn-login:hover {
            background: var(--azul-oscuro);
            transform: translateY(-2px);
        }

         .btn-registro {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 11px 21px;
            border-radius: 30px;
            color: #fff !important;
        }

        .btn-registro:hover {
            background: var(--azul-oscuro);
            transform: translateY(-2px);
        }

        /* =========================
   BANNER
========================= */

.hero {
    position: relative;
    width: 100%;
    overflow: hidden;
    background: #dff4ff;
}

.banner-img {
    display: block;
    width: 100%;
    height: auto;
}

/* =========================
   BOTÓN QUIERO CONOCER
========================= */

.btn-comenzar {
    position: absolute;

    left: 50%;
    bottom: 12%;

    transform: translateX(-50%);

    z-index: 20;

    min-width: 300px;

    padding: 14px 32px;

    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;

    background: #FACC11;
    color: #ffffff;

    border: 4px solid rgba(255,255,255,.90);
    border-radius: 60px;

    font-size: 24px;
    font-weight: 900;

    text-decoration: none;

    box-shadow:
        0 7px 0 rgba(0,0,0,.12),
        0 12px 25px rgba(0,0,0,.20);

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        filter .2s ease;
}

.btn-comenzar:hover {
    color: #ffffff;

    transform:
        translateX(-50%)
        translateY(-3px);

    filter: brightness(1.05);

    box-shadow:
        0 10px 0 var(--verde-oscuro),
        0 15px 28px rgba(0,0,0,.22);
}

.btn-comenzar i {
    font-size: 18px;
    transition: transform .2s ease;
}

.btn-comenzar:hover i {
    transform: translateX(4px);
}

/* =========================
   CURVA DEL BANNER
========================= */

.hero::after {
    content: "";

    position: absolute;

    left: -5%;
    bottom: -80px;

    width: 110%;
    height: 145px;

    background: #fff;

    border-radius:
        50% 50% 0 0 /
        100% 100% 0 0;

    z-index: 5;

    pointer-events: none;
}

/* =========================
   TABLET
========================= */

@media (max-width: 900px) {

    .btn-comenzar {
        min-width: 260px;
        padding: 12px 27px;
        font-size: 20px;
        bottom: 10%;
    }

    .btn-comenzar i {
        font-size: 16px;
    }
}

/* =========================
   MÓVIL
========================= */

@media (max-width: 768px) {

    .banner-img {
        width: 100%;
        height: auto;
    }

    .btn-comenzar {
        min-width: 230px;

        padding: 10px 22px;

        font-size: 17px;

        border-width: 3px;

        bottom: 9%;

        gap: 8px;
    }

    .btn-comenzar i {
        font-size: 14px;
    }

    .hero::after {
        bottom: -52px;
        height: 95px;
    }
}

/* =========================
   CELULAR PEQUEÑO
========================= */

@media (max-width: 480px) {

    .btn-comenzar {
        min-width: 210px;

        padding: 9px 18px;

        font-size: 15px;

        bottom: 8%;
    }

    .btn-comenzar i {
        font-size: 13px;
    }
}

        .mobile-menu-btn {
            display: none;
            width: 44px;
            height: 44px;
            border: 0;
            background: transparent;
            color: var(--azul);
            font-size: 25px;
            cursor: pointer;
        }

        /* =========================
           MENU MOVIL
        ========================= */

        .mobile-menu {
            display: none;
            position: absolute;
            top: 76px;
            left: 0;
            width: 100%;
            padding: 15px;
            background: #fff;
            box-shadow: 0 10px 25px rgba(0,0,0,.12);
            margin-top:30px;
        }

        .mobile-menu.active {
            display: block;
        }

        .mobile-menu a {
            display: block;
            padding: 13px 10px;
            text-align: center;
            color: var(--oscuro);
            font-weight: 700;
            border-bottom: 1px solid #edf2f7;
        }

        .mobile-menu .btn-login {
            margin-top: 10px;
            color: #fff !important;
            border-bottom: 0;
        }

        /* =========================
           BANNER
        ========================= */

        .hero {
            position: relative;
            width: 100%;
            overflow: hidden;
            background: #dff4ff;
        }

        .banner-img {
            display: block;
            width: 100%;
            height: auto;
        }

        /*
         * El botón es HTML, no está dentro de banner.png.
         * Se coloca sobre la zona inferior del banner.
         */
        .btn-comenzar {
            position: absolute;
            left: 50%;
            bottom: 18%;
            transform: translateX(-50%);
            z-index: 10;
            min-width: 360px;
            padding: 15px 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            background-color:#FACC11;
            color: #fff;
            border: 4px solid rgba(255,255,255,.85);
            border-radius: 60px;
            font-size: 27px;
            font-weight: 900;
            transition: .2s ease;
            margin-top:-205px;
        }

        .btn-comenzar:hover {
            color: #fff;
            transform: translateX(-50%) translateY(3px);
            box-shadow:
                0 4px 0 var(--verde-oscuro),
                0 8px 20px rgba(0,0,0,.18);
        }

        /* =========================
           CURVA
        ========================= */

        .hero::after {
            content: "";
            position: absolute;
            left: -5%;
            bottom: -80px;
            width: 110%;
            height: 145px;
            background: #fff;
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
            z-index: 5;
            pointer-events: none;
        }

        /* =========================
           COMO FUNCIONA
        ========================= */

       .como-funciona {
    position: relative;
    padding: 70px 20px 75px;
    overflow: hidden;
    background: #ffffff;
}

        .como-funciona::before {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 85%;
            max-width: 1100px;
            height: 2px;
            
        }

        .como-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .como-title {
            text-align: center;
            color: var(--oscuro);
            font-size: 40px;
            font-weight: 900;
            margin-bottom: 8px;
        }

        .como-title::before,
        .como-title::after {
            content: "✦";
            color: var(--amarillo);
            margin: 0 13px;
        }

        .como-subtitle {
            text-align: center;
            color: var(--oscuro);
            font-size: 17px;
            margin-bottom: 45px;
        }

        .pasos-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            position: relative;
        }

        .pasos-grid::before {
            content: "";
            position: absolute;
            top: 52px;
            left: 12%;
            right: 12%;
            height: 4px;
            background: #dbe9f8;
            border-radius: 10px;
            z-index: 0;
        }

        .paso {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 8px 12px 5px;
        }

        .paso-icon {
            width: 92px;
            height: 92px;
            margin: 0 auto 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            border: 7px solid #fff;
            box-shadow: 0 8px 22px rgba(16,32,92,.10);
        }

        .paso:nth-child(1) .paso-icon {
            background: #ffdce9;
            color: var(--rosa);
        }

        .paso:nth-child(2) .paso-icon {
            background: #d8efff;
            color: #078dd0;
        }

        .paso:nth-child(3) .paso-icon {
            background: #ddcffd;
            color: var(--morado);
        }

        .paso:nth-child(4) .paso-icon {
            background: #d2f8df;
            color: #00a85a;
        }

        .paso-numero {
            display: inline-block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 900;
            color: var(--gris);
        }

        .paso h3 {
            color: var(--oscuro);
            font-size: 20px;
            font-weight: 900;
            margin-bottom: 8px;
        }

        .paso p {
            max-width: 220px;
            margin: 0 auto;
            color: #30456e;
            font-size: 14px;
            line-height: 1.45;
        }

        .como-frase {
            max-width: 850px;
            margin: 42px auto 0;
            padding: 16px 25px;
            border-radius: 22px;
            background: #fff;
            text-align: center;
            color: var(--oscuro);
            font-size: 17px;
            font-weight: 700;
            box-shadow: 0 8px 25px rgba(24,55,90,.08);
        }

        .como-frase i {
            color: var(--verde);
            margin-right: 7px;
        }

        /* =========================
           MISIONES
        ========================= */

        .missions-section {
            background: #fff;
            padding: 65px 20px 80px;
            margin-top:-75px;
        }

        .missions-container {
            width: 100%;
            max-width: 1250px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 42px;
            font-weight: 900;
            margin-bottom: 8px;
        }

        .section-title::before,
        .section-title::after {
            content: "✦";
            color: var(--amarillo);
            margin: 0 14px;
        }

        .section-description {
            text-align: center;
            font-size: 17px;
            margin-bottom: 42px;
        }

   .missions-grid {
    display: grid;

    grid-template-columns:
        repeat(5, 1fr);

    gap: 18px;

    align-items: stretch;
}

        .mission-card {
    border-radius: 25px;
    padding: 20px 14px 17px;
    text-align: center;

    border: 2px solid rgba(255,255,255,.95);

    box-shadow:
        0 8px 25px rgba(24,55,90,.10);

    transition: .3s ease;

    /* IMPORTANTE */
    display: flex;
    flex-direction: column;

    /* Todas las tarjetas tendrán la misma altura */
    height: 100%;
}

        .mission-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 17px 32px rgba(24,55,90,.15);
        }

        .mission-card:nth-child(1) {
            background: linear-gradient(#fff0c9, #fff);
        }

        .mission-card:nth-child(2) {
            background: linear-gradient(#d8f0ff, #fff);
        }

        .mission-card:nth-child(3) {
            background: linear-gradient(#eadcff, #fff);
        }

        .mission-card:nth-child(4) {
            background: linear-gradient(#d7ffe9, #fff);
        }

        .mission-card:nth-child(5) {
            background: linear-gradient(#ffdce9, #fff);
        }

        .mission-icon {
            width: 92px;
            height: 92px;
            margin: 0 auto 15px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 43px;
        }

        .mission-card:nth-child(1) .mission-icon {
            background: #ffe3a3;
            color: #c87900;
        }

        .mission-card:nth-child(2) .mission-icon {
            background: #bce5ff;
            color: #078dd0;
        }

        .mission-card:nth-child(3) .mission-icon {
            background: #d7c0ff;
            color: var(--morado);
        }

        .mission-card:nth-child(4) .mission-icon {
            background: #baf4d2;
            color: #00a85a;
        }

        .mission-card:nth-child(5) .mission-icon {
            background: #ffc0d9;
            color: var(--rosa);
        }

        .mission-number {
            display: block;
            font-size: 15px;
            font-weight: 900;
            margin-bottom: 7px;
        }

        .mission-card:nth-child(1) .mission-number {
            color: #c87900;
        }

        .mission-card:nth-child(2) .mission-number {
            color: #078dd0;
        }

        .mission-card:nth-child(3) .mission-number {
            color: var(--morado);
        }

        .mission-card:nth-child(4) .mission-number {
            color: #00a85a;
        }

        .mission-card:nth-child(5) .mission-number {
            color: var(--rosa);
        }

        .mission-card h3 {
            font-size: 19px;
            font-weight: 900;
            margin-bottom: 11px;
        }

        .mission-card p {
    min-height: 105px;

    font-size: 14px;
    line-height: 1.45;

    color: #20345d;

    margin-bottom: 17px;

    /* Evita que el contenido empuje el botón */
    flex-grow: 0;
}

      .mission-btn {
    position: relative;

    width: 100%;

    min-width: 0;

    min-height: 48px;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 12px;

    padding: 10px 16px 10px 20px;

    /* ESTA ES LA CLAVE */
    margin-top: auto;

    color: #fff;

    font-size: 15px;

    font-weight: 900;

    letter-spacing: .2px;

    text-decoration: none;

    border: 0;

    border-radius: 16px;

    overflow: hidden;

    box-shadow:
        0 6px 14px rgba(16,32,92,.14),
        inset 0 1px 0 rgba(255,255,255,.35);

    transition:
        transform .25s ease,
        box-shadow .25s ease,
        filter .25s ease;
}

        .mission-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -120%;
            width: 70%;
            height: 100%;

            background: linear-gradient(
                90deg,
                transparent,
                rgba(255,255,255,.28),
                transparent
            );

            transform: skewX(-20deg);
            transition: left .55s ease;
        }

        .mission-btn:hover {
            color: #fff;
            transform: translateY(-3px);
            filter: brightness(1.04);

            box-shadow:
                0 10px 20px rgba(16,32,92,.18),
                inset 0 1px 0 rgba(255,255,255,.4);
        }

        .mission-btn:hover::before {
            left: 140%;
        }

        .mission-btn span {
            position: relative;
            z-index: 1;
        }

        .mission-btn .explore-arrow {
            position: relative;
            z-index: 1;

            width: 27px;
            height: 27px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;
            background: rgba(255,255,255,.22);
            border: 1px solid rgba(255,255,255,.32);

            font-size: 11px;

            transition:
                transform .25s ease,
                background .25s ease;
        }

        .mission-btn:hover .explore-arrow {
            transform: translateX(4px);
            background: rgba(255,255,255,.32);
        }

        .mission-card:nth-child(1) .mission-btn {
            background: linear-gradient(135deg, #08a9df, #087fc1);
        }

        .mission-card:nth-child(2) .mission-btn {
            background: linear-gradient(135deg, #35c928, #249c15);
        }

        .mission-card:nth-child(3) .mission-btn {
            background: linear-gradient(135deg, #8241df, #6230b5);
        }

        .mission-card:nth-child(4) .mission-btn {
            background: linear-gradient(135deg, #f0a000, #d57d00);
        }

        .mission-card:nth-child(5) .mission-btn {
            background: linear-gradient(135deg, #ef2870, #cf1658);
        }

        /* =========================
           BANNER FINAL
        ========================= */

        .final-banner {
            max-width: 1100px;
            margin: 55px auto 0;
            padding: 24px 32px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;
            background: linear-gradient(135deg, #fff, #eef8ff);
            box-shadow: 0 8px 30px rgba(20,70,110,.10);
        }

        .final-content {
            display: flex;
            align-items: center;
            gap: 18px;
        }


        .logo{
            width: 250px;
            margin-left:50px;
        }

        .final-icon {
            flex-shrink: 0;
            width: 72px;
            height: 72px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffe27b;
            color: #b77a00;
            font-size: 31px;
        }

        .final-content h2 {
            font-size: 22px;
            font-weight: 900;
            margin-bottom: 5px;
        }

        .final-content p {
            margin: 0;
            font-size: 15px;
        }

        .final-button {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 16px 23px;
            border-radius: 23px;
            color: #fff;
            background: linear-gradient(135deg, #59df4d, #19b94b);
            font-weight: 900;
            transition: .25s ease;
        }

        .final-button:hover {
            color: #fff;
            transform: translateY(-3px);
        }

        .final-button i {
            font-size: 33px;
        }

        /* =====================================================
   BANNER - LÍNEA GRATUITA #141
===================================================== */

.final-banner {
    position: relative;

    display: flex;
    align-items: center;

    width: 100%;
    min-height: 210px;

    padding: 28px 30px 28px 300px;

    background:
        linear-gradient(
            110deg,
            #f4fbff 0%,
            #eef9ff 55%,
            #e5f6ff 100%
        );

    border: 1px solid #d6edf8;

    border-radius: 28px;

    box-shadow:
        0 12px 35px rgba(18, 70, 100, .10);

    overflow: hidden;
}


/* =====================================================
   DECORACIÓN DE FONDO
===================================================== */

.final-banner::before {
    content: "";

    position: absolute;

    width: 330px;
    height: 330px;

    left: -90px;
    top: -80px;

    border-radius: 50%;

    background:
        rgba(20, 184, 255, .08);

    pointer-events: none;
}


.final-banner::after {
    content: "";

    position: absolute;

    width: 240px;
    height: 240px;

    right: -90px;
    bottom: -130px;

    border-radius: 50%;

    background:
        rgba(13, 110, 253, .06);

    pointer-events: none;
}


/* =====================================================
   AVATAR
===================================================== */

.final-avatar {
    position: absolute;

    left: 10px;
    bottom: 0;

    width: 290px;
    height: 205px;

    display: flex;

    align-items: flex-end;
    justify-content: center;

    z-index: 3;

    pointer-events: none;
}


.final-avatar img {
    display: block;

    width: 275px;
    height: 275px;

    object-fit: contain;

    object-position: bottom center;

    filter:
        drop-shadow(
            0 12px 10px rgba(15, 50, 80, .15)
        );

    transform:
        translateY(22px);
}


/* =====================================================
   CONTENIDO
===================================================== */

.final-content {
    position: relative;

    z-index: 4;

    display: flex;

    align-items: center;

    gap: 17px;

    flex: 1;

    min-width: 0;

    margin-right: 25px;
}


/* =====================================================
   ICONO
===================================================== */

.final-icon {
    width: 64px;
    height: 64px;

    flex: 0 0 64px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background:
        linear-gradient(
            135deg,
            #ffe88b,
            #ffd34d
        );

    color: #a86b00;

    font-size: 25px;

    box-shadow:
        0 7px 17px rgba(214, 165, 0, .18);
}


/* =====================================================
   TEXTO
===================================================== */

.final-content-text {
    min-width: 0;
}


.final-label {
    display: inline-block;

    margin-bottom: 5px;

    color: #087ca8;

    font-size: 11px;

    font-weight: 900;

    letter-spacing: 1.1px;

    text-transform: uppercase;
}


.final-content h2 {
    margin: 0 0 7px;

    color: #102f56;

    font-size: 26px;

    line-height: 1.15;

    font-weight: 900;
}


.final-content p {
    margin: 0;

    max-width: 500px;

    color: #42627d;

    font-size: 14px;

    line-height: 1.5;
}


.final-content p strong {
    color: #102f56;

    font-weight: 800;
}


/* =====================================================
   BOTÓN #141
===================================================== */

.final-button {
    position: relative;

    z-index: 5;

    flex: 0 0 270px;

    min-height: 82px;

    display: flex;

    align-items: center;
    justify-content: center;

    gap: 13px;

    padding: 13px 20px;

    color: #fff;

    background:
        linear-gradient(
            135deg,
            #29d34b 0%,
            #17b93d 100%
        );

    border-radius: 20px;

    text-decoration: none;

    box-shadow:
        0 9px 22px rgba(22, 185, 61, .25);

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}


.final-button:hover {
    color: white;

    transform: translateY(-3px);

    box-shadow:
        0 13px 28px rgba(22, 185, 61, .32);
}


.final-button > i:first-child {
    font-size: 30px;
}


.final-button span {
    display: flex;

    flex-direction: column;

    line-height: 1.1;
}


.final-button small {
    margin-bottom: 5px;

    font-size: 11px;

    font-weight: 600;

    opacity: .92;
}


.final-button strong {
    font-size: 21px;

    font-weight: 900;
}


.final-arrow {
    font-size: 15px !important;

    margin-left: 3px;
}


/* =====================================================
   TABLET
===================================================== */

@media (max-width: 1050px) {

    .final-banner {
        padding-left: 245px;
    }


    .final-avatar {
        width: 240px;
    }


    .final-avatar img {
        width: 235px;
        height: 235px;
    }


    .final-content {
        margin-right: 15px;
    }


    .final-content h2 {
        font-size: 22px;
    }


    .final-button {
        flex-basis: 235px;
    }

}


/* =====================================================
   TABLET PEQUEÑA
===================================================== */

@media (max-width: 850px) {

    .final-banner {
        padding-left: 200px;

        min-height: 190px;
    }


    .final-avatar {
        width: 200px;
        height: 190px;
    }


    .final-avatar img {
        width: 210px;
        height: 210px;

        transform:
            translateY(18px);
    }


    .final-icon {
        width: 55px;
        height: 55px;

        flex-basis: 55px;

        font-size: 21px;
    }


    .final-content h2 {
        font-size: 20px;
    }


    .final-content p {
        font-size: 13px;
    }


    .final-button {
        flex-basis: 210px;

        min-height: 70px;
    }


    .final-button strong {
        font-size: 18px;
    }

}


/* =====================================================
   MÓVIL
===================================================== */

@media (max-width: 700px) {

    .final-banner {

        display: flex;

        flex-direction: column;

        align-items: center;

        text-align: center;

        min-height: auto;

        margin-top: 100px;

        padding:
            30px 20px 22px;

        overflow: visible;
    }


    /* AVATAR ARRIBA */

    .final-avatar {

        left: 50%;

        top: -105px;
        bottom: auto;

        width: 150px;
        height: 130px;

        transform:
            translateX(-50%);
    }


    .final-avatar img {

        width: 150px;
        height: 150px;

        transform:
            translateY(12px);
    }


    /* CONTENIDO */

    .final-content {

        width: 100%;

        flex-direction: column;

        gap: 10px;

        margin-right: 0;
    }


    .final-icon {

        width: 55px;
        height: 55px;

        flex-basis: 55px;
    }


    .final-content h2 {

        font-size: 22px;
    }


    .final-content p {

        max-width: 100%;

        font-size: 14px;
    }


    /* BOTÓN */

    .final-button {

        width: 100%;

        flex-basis: auto;

        min-height: 72px;

        margin-top: 12px;
    }

}

        /* =========================
           CONTENIDO EDUCATIVO
        ========================= */

        .aprende-section {
            position: relative;
            padding: 85px 20px 90px;
            background: #ffffff;
            overflow: hidden;
        }

        .aprende-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .aprende-header {
            max-width: 850px;
            margin: 0 auto 48px;
            text-align: center;
        }

        .aprende-title {
            margin: 0 0 10px;
            color: var(--oscuro);
            font-size: 42px;
            line-height: 1.15;
            font-weight: 900;
        }

        .aprende-title::before,
        .aprende-title::after {
            content: "✦";
            color: var(--amarillo);
            margin: 0 13px;
        }

        .aprende-subtitle {
            margin: 0 auto;
            max-width: 780px;
            color: #30456e;
            font-size: 17px;
            line-height: 1.6;
        }

        .educational-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .educational-card {
            position: relative;
            padding: 27px 24px 25px;
            min-height: 285px;
            border-radius: 26px;
            border: 1px solid rgba(16,32,92,.06);
            box-shadow: 0 10px 28px rgba(24,55,90,.09);
            overflow: hidden;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .educational-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 17px 35px rgba(24,55,90,.14);
        }

        .educational-card::after {
            content: "";
            position: absolute;
            width: 110px;
            height: 110px;
            right: -42px;
            bottom: -42px;
            border-radius: 50%;
            background: rgba(255,255,255,.38);
            pointer-events: none;
        }

        .educational-card:nth-child(1) {
            background: linear-gradient(145deg, #fff3cf, #fffaf0);
        }

        .educational-card:nth-child(2) {
            background: linear-gradient(145deg, #dff3ff, #f6fbff);
        }

        .educational-card:nth-child(3) {
            background: linear-gradient(145deg, #e7dcff, #faf7ff);
        }

        .educational-card:nth-child(4) {
            background: linear-gradient(145deg, #dff9ea, #f7fffa);
        }

        .educational-card:nth-child(5) {
            background: linear-gradient(145deg, #ffe0ec, #fff7fa);
        }

        .educational-card:nth-child(6) {
            background: linear-gradient(145deg, #e5f0ff, #f8fbff);
        }

        .educational-icon {
            width: 68px;
            height: 68px;
            margin-bottom: 17px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 29px;
            background: rgba(255,255,255,.72);
            box-shadow: 0 7px 18px rgba(16,32,92,.08);
        }

        .educational-card:nth-child(1) .educational-icon {
            color: #c87900;
        }

        .educational-card:nth-child(2) .educational-icon {
            color: #078dd0;
        }

        .educational-card:nth-child(3) .educational-icon {
            color: var(--morado);
        }

        .educational-card:nth-child(4) .educational-icon {
            color: #00a85a;
        }

        .educational-card:nth-child(5) .educational-icon {
            color: var(--rosa);
        }

        .educational-card:nth-child(6) .educational-icon {
            color: #1474c4;
        }

        .educational-card h3 {
            position: relative;
            z-index: 1;
            margin: 0 0 10px;
            color: var(--oscuro);
            font-size: 21px;
            font-weight: 900;
        }

        .educational-card p {
            position: relative;
            z-index: 1;
            margin: 0;
            color: #30456e;
            font-size: 14px;
            line-height: 1.55;
        }

        .educational-highlight {
            margin: 42px auto 0;
            max-width: 1000px;
            padding: 24px 30px;
            border-radius: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            background: linear-gradient(135deg, #eefaff, #f7fff8);
            border: 1px solid rgba(7,159,224,.08);
            box-shadow: 0 9px 27px rgba(24,55,90,.08);
        }

        .educational-highlight-icon {
            flex-shrink: 0;
            width: 62px;
            height: 62px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #d9f7df;
            color: var(--verde-oscuro);
            font-size: 27px;
        }

        .educational-highlight h3 {
            margin: 0 0 4px;
            color: var(--oscuro);
            font-size: 20px;
            font-weight: 900;
        }

        .educational-highlight p {
            margin: 0;
            color: #30456e;
            font-size: 14px;
            line-height: 1.5;
        }

        @media (max-width: 900px) {
            .educational-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .aprende-title {
                font-size: 34px;
            }
        }

        @media (max-width: 768px) {
            .aprende-section {
                padding: 60px 15px 70px;
            }

            .aprende-title {
                font-size: 29px;
            }

             .logo{
            width: 250px;
            margin-left:40px;
        }

            .aprende-title::before,
            .aprende-title::after {
                margin: 0 7px;
            }

            .aprende-subtitle {
                font-size: 14px;
            }

            .educational-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            /* Botones educativos en móvil */
            .educational-open,
            .educational-open1 {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                max-width: 100%;
                min-width: 0;
                min-height: 44px;
                margin-top: 18px;
                padding: 11px 14px;
                font-size: 13px;
                line-height: 1.2;
                white-space: normal;
                overflow-wrap: anywhere;
            }

            .educational-open i,
            .educational-open1 i {
                flex: 0 0 auto;
                font-size: 15px;
            }

            .educational-card {
                min-height: auto;
                padding: 22px 20px;
            }

            .educational-icon {
                width: 58px;
                height: 58px;
                margin-bottom: 13px;
                font-size: 25px;
            }

            .educational-card h3 {
                font-size: 18px;
            }

            .educational-card p {
                font-size: 13px;
            }

            .educational-highlight {
                margin-top: 28px;
                padding: 20px;
                align-items: flex-start;
            }

            .educational-highlight-icon {
                width: 52px;
                height: 52px;
                font-size: 22px;
            }

            .educational-highlight h3 {
                font-size: 17px;
            }

            .educational-highlight p {
                font-size: 13px;
            }
        }

        /* =========================
           MODALES EDUCATIVOS
        ========================= */

        .educational-open {
            position: relative;
            z-index: 2;
            width: 100%;
            margin-top: 20px;
            padding: 12px 16px;
            border: 0;
            border-radius: 15px;
            color: #fff;
            background: linear-gradient(135deg, #079fdc, #078bd0);
            font-family: inherit;
            font-size: 14px;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 7px 15px rgba(7,159,224,.18);
            transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
        }

        .educational-card:nth-child(2) .educational-open { background: linear-gradient(135deg, #2ccf2c, #12ae25); box-shadow: 0 7px 15px rgba(18,174,37,.18); }
        .educational-card:nth-child(3) .educational-open { background: linear-gradient(135deg, #9148ec, #7134cf); box-shadow: 0 7px 15px rgba(113,52,207,.18); }
        .educational-card:nth-child(4) .educational-open { background: linear-gradient(135deg, #08c477, #00a65d); box-shadow: 0 7px 15px rgba(0,166,93,.18); }
        .educational-card:nth-child(5) .educational-open { background: linear-gradient(135deg, #f51f69, #e91e63); box-shadow: 0 7px 15px rgba(233,30,99,.18); }
        .educational-card:nth-child(6) .educational-open { background: linear-gradient(135deg, #3b8fe8, #1474c4); box-shadow: 0 7px 15px rgba(20,116,196,.18); }

        .educational-open:hover {
            transform: translateY(-2px);
            filter: brightness(1.04);
            box-shadow: 0 10px 20px rgba(16,32,92,.16);
        }

        /* BOTÓN DE APOYO / WHATSAPP */
        .educational-open1 {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            max-width: 100%;
            min-width: 0;
            min-height: 46px;
            margin-top: 20px;
            padding: 12px 16px;
            border: 0;
            border-radius: 15px;
            color: #fff;
            background: linear-gradient(135deg, #25d366, #16a34a);
            font-family: inherit;
            font-size: 14px;
            font-weight: 900;
            line-height: 1.2;
            text-align: center;
            white-space: normal;
            cursor: pointer;
            box-shadow: 0 7px 15px rgba(22,163,74,.18);
            transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
        }

        .educational-open1:hover {
            color: #fff;
            transform: translateY(-2px);
            filter: brightness(1.04);
            box-shadow: 0 10px 20px rgba(22,163,74,.20);
        }

        .educational-open1 i {
            flex: 0 0 auto;
            font-size: 16px;
        }

        .educational-open i {
            margin-left: 7px;
            transition: transform .2s ease;
        }

        .educational-open:hover i {
            transform: translateX(3px);
        }

        .education-modal {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(7, 20, 61, .58);
            backdrop-filter: blur(5px);
        }

        .education-modal.active {
            display: flex;
            animation: modalFade .2s ease;
        }

        @keyframes modalFade {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .education-modal-box {
            position: relative;
            width: min(680px, 100%);
            max-height: 88vh;
            overflow-y: auto;
            padding: 34px 34px 30px;
            border-radius: 28px;
            background: #fff;
            box-shadow: 0 25px 70px rgba(7,20,61,.25);
            animation: modalUp .25s ease;
        }

        @keyframes modalUp {
            from { transform: translateY(18px) scale(.98); opacity: .5; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }

        .education-modal-close {
            position: absolute;
            top: 16px;
            right: 17px;
            width: 38px;
            height: 38px;
            border: 0;
            border-radius: 50%;
            background: #f1f5fb;
            color: var(--oscuro);
            font-size: 17px;
            cursor: pointer;
            transition: .2s ease;
        }

        .education-modal-close:hover {
            background: #e5ebf5;
            transform: rotate(90deg);
        }

        .modal-topic-icon {
            width: 72px;
            height: 72px;
            margin-bottom: 16px;
            border-radius: 21px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e6f6ff;
            color: #079fdc;
            font-size: 30px;
        }

        .education-modal h2 {
            margin: 0 45px 12px 0;
            color: var(--oscuro);
            font-size: 30px;
            font-weight: 900;
        }

        .education-modal .modal-intro {
            margin: 0 0 20px;
            color: #30456e;
            font-size: 15px;
            line-height: 1.65;
        }

        .modal-info-block {
            margin-top: 16px;
            padding: 17px 19px;
            border-radius: 18px;
            background: #f7fbff;
            border-left: 5px solid #079fdc;
        }

        .modal-info-block h3 {
            margin: 0 0 6px;
            color: var(--oscuro);
            font-size: 16px;
            font-weight: 900;
        }

        .modal-info-block p {
            margin: 0;
            color: #30456e;
            font-size: 14px;
            line-height: 1.6;
        }

        .modal-reflection {
            margin-top: 18px;
            padding: 17px 19px;
            border-radius: 18px;
            background: linear-gradient(135deg, #effbea, #f7fff8);
        }

        .modal-reflection strong {
            display: block;
            margin-bottom: 5px;
            color: #079447;
        }

        .modal-reflection p {
            margin: 0;
            color: #30456e;
            font-size: 14px;
            line-height: 1.55;
        }

        body.modal-open {
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .education-modal {
                padding: 14px;
            }

            .education-modal-box {
                padding: 27px 21px 23px;
                border-radius: 23px;
                max-height: 90vh;
            }

            .modal-topic-icon {
                width: 60px;
                height: 60px;
                font-size: 25px;
            }

            .education-modal h2 {
                font-size: 24px;
                margin-right: 35px;
            }

            .education-modal .modal-intro,
            .modal-info-block p,
            .modal-reflection p {
                font-size: 13px;
            }
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: var(--oscuro);
            color: #fff;
            text-align: center;
            padding: 35px 20px;
        }

        .footer-logo {
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 8px;
        }

        .footer-logo span {
            color: var(--verde);
        }

        footer p {
            color: #c7d5e7;
            margin: 5px 0;
        }

        /* =========================
           TABLET
        ========================= */

        @media (max-width: 1100px) {
            .missions-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .navbar-desktop {
                gap: 20px;
            }
        }

        @media (max-width: 900px) {

            .pasos-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px 15px;
            }

            .pasos-grid::before {
                display: none;
            }

            .como-title {
                font-size: 34px;
            }
        }

        /* =========================
           MOVIL
        ========================= */

        @media (max-width: 768px) {

            .navbar-custom {
                min-height: 68px;
                padding: 8px 15px;
            }

            .navbar-desktop {
                display: none;
            }

            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .mobile-menu {
                top: 68px;
            }

            /*
             * En móvil el banner se muestra completo.
             * El botón queda debajo de la fila de iconos,
             * en la parte inferior de la imagen.
             */
            .banner-img {
                width: 100%;
                height: auto;
            }

            .btn-comenzar {
                min-width: 260px;
                padding: 11px 27px;
                font-size: 20px;
                border-width: 3px;
                bottom: 10%;
                gap: 9px;
            }

            .btn-comenzar i {
                font-size: 17px;
            }

            .hero::after {
                bottom: -52px;
                height: 95px;
            }

            .missions-section {
                padding: 52px 15px 65px;
            }

            .section-title {
                font-size: 31px;
            }

            .section-title::before,
            .section-title::after {
                margin: 0 7px;
            }

            .como-funciona {
                padding: 50px 15px 55px;
            }

            .como-title {
                font-size: 29px;
            }

            .como-title::before,
            .como-title::after {
                margin: 0 7px;
            }

            .como-subtitle {
                font-size: 14px;
                margin-bottom: 30px;
            }

            .pasos-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .paso {
                display: grid;
                grid-template-columns: 75px 1fr;
                grid-template-rows: auto auto auto;
                column-gap: 14px;
                align-items: center;
                text-align: left;
                padding: 5px 8px;
            }

            .paso-icon {
                grid-column: 1;
                grid-row: 1 / 4;
                width: 70px;
                height: 70px;
                margin: 0;
                font-size: 28px;
                border-width: 5px;
            }

            .paso-numero {
                grid-column: 2;
                grid-row: 1;
                margin: 0;
                font-size: 11px;
            }

            .paso h3 {
                grid-column: 2;
                grid-row: 2;
                margin: 1px 0 3px;
                font-size: 17px;
            }

            .paso p {
                grid-column: 2;
                grid-row: 3;
                max-width: none;
                margin: 0;
                font-size: 12px;
                line-height: 1.3;
            }

            .como-frase {
                margin-top: 28px;
                padding: 14px 15px;
                font-size: 14px;
            }

            /*
             * En móvil las misiones se vuelven
             * tarjetas horizontales como la referencia.
             */
            .missions-grid {
                grid-template-columns: 1fr;
                gap: 10px;
                max-width: 520px;
                margin: 0 auto;
            }

            .mission-card {
                min-height: 92px;
                padding: 10px 12px;
                border-radius: 16px;

                display: grid;
                grid-template-columns: 80px 1fr 40px;
                grid-template-rows: auto auto;
                column-gap: 12px;
                align-items: center;

                text-align: left;
            }

            .mission-icon {
                grid-column: 1;
                grid-row: 1 / 3;

                width: 70px;
                height: 70px;

                margin: 0;

                font-size: 31px;
            }

            .mission-number {
                grid-column: 2;
                grid-row: 1;

                margin: 0 0 2px;
                font-size: 12px;
            }

            .mission-card h3 {
                grid-column: 2;
                grid-row: 2;

                margin: 0;

                font-size: 15px;
                line-height: 1.15;
            }

            .mission-card p {
                grid-column: 2;
                grid-row: 3;

                min-height: auto;

                margin: 3px 0 0;

                font-size: 11px;
                line-height: 1.2;
            }

            .mission-btn {
                grid-column: 3;
                grid-row: 1 / 4;

                width: 42px;
                height: 42px;
                min-height: 42px;
                padding: 0;

                border-radius: 50%;

                font-size: 0;
                box-shadow: 0 5px 12px rgba(16,32,92,.16);
            }

            .mission-btn span:first-child {
                display: none;
            }

            .mission-btn .explore-arrow {
                width: 100%;
                height: 100%;

                background: transparent;
                border: 0;

                font-size: 14px;
            }

            .mission-btn:hover {
                transform: translateY(-2px);
            }

            .mission-btn:hover .explore-arrow {
                transform: translateX(2px);
                background: transparent;
            }

            .final-banner {
                flex-direction: column;
                text-align: center;
                padding: 25px 18px;
            }

            .final-content {
                flex-direction: column;
            }

            .final-button {
                width: 100%;
                max-width: 100%;
                min-height: 52px;
                justify-content: center;
                text-align: center;
                padding: 13px 16px;
                line-height: 1.2;
            }

            .final-button span {
                min-width: 0;
            }

            .final-button i {
                flex: 0 0 auto;
                font-size: 27px;
            }
        }

        /* =========================
           TELEFONO PEQUEÑO
        ========================= */@media (max-width: 480px) {

            .btn-comenzar {
                min-width: 220px;
                width: 50%;
                padding: 9px 14px;
                font-size: 12px;
                bottom: 9px;
            }

            .btn-comenzar i {
                font-size: 14px;
            }

            .hero::after {
                bottom: -43px;
                height: 78px;
            }

            .section-title {
                font-size: 26px;
            }

            .section-description {
                font-size: 13px;
            }

            .mission-card {
                grid-template-columns: 68px 1fr 36px;
                padding: 8px 10px;
            }

            .mission-icon {
                width: 60px;
                height: 60px;
                font-size: 27px;
            }

            .mission-card h3 {
                font-size: 14px;
            }

            .mission-card p {
                font-size: 10px;
            }

            .mission-btn {
                width: 36px;
                height: 36px;
                min-height: 36px;
            }

            .mission-btn .explore-arrow {
                font-size: 12px;
            }

            .final-content h2 {
                font-size: 19px;
            }

            .educational-open,
            .educational-open1 {
                min-height: 42px;
                padding: 10px 12px;
                font-size: 12px;
                border-radius: 13px;
            }

            .mission-btn {
                max-width: 100%;
            }
        }@media (max-width: 360px) {

            .btn-comenzar {
                width: 64%;
                min-width: 205px;
                font-size: 15px;
            }

            .mission-card {
                grid-template-columns: 60px 1fr 32px;
            }

            .mission-icon {
                width: 54px;
                height: 54px;
            }
        }
    
        /* =========================
           CORRECCIONES FINALES
        ========================= */

        .hero-banner-picture {
            display: block;
            width: 100%;
            line-height: 0;
        }

        .hero-banner-picture img {
            display: block;
            width: 100%;
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 768px) {
            .hero-banner-picture,
            .hero-banner-picture img {
                width: 100%;
                max-width: 100%;
                height: auto;
            }

            .hero::after {
                bottom: -42px;
                height: 75px;
            }

            .navbar-custom {
                min-height: 68px;
            }

            .mobile-menu {
                top: 68px;
                margin-top: 0;
            }

            .missions-grid {
                grid-template-columns: 1fr;
            }

            .mission-card {
                min-height: 92px;
                grid-template-columns: 70px minmax(0, 1fr) 42px;
                grid-template-rows: auto auto auto;
            }

            .mission-btn {
                width: 42px;
                height: 42px;
                min-height: 42px;
                padding: 0;
            }

            .final-banner {
                width: 100%;
                margin-top: 100px;
                padding: 30px 18px 22px;
            }

            .final-avatar {
                left: 50%;
                top: -105px;
                bottom: auto;
                transform: translateX(-50%);
            }

            .final-content {
                width: 100%;
                margin-right: 0;
                text-align: center;
            }

            .final-button {
                width: 100%;
            }

            .education-modal {
                padding: 12px;
            }

            .education-modal-box {
                width: 100%;
                max-height: 90vh;
                padding: 26px 20px 22px;
                border-radius: 22px;
            }
        }

        @media (max-width: 420px) {
            .como-title,
            .section-title,
            .aprende-title {
                font-size: 27px;
            }

            .mission-card {
                grid-template-columns: 60px minmax(0, 1fr) 40px;
                column-gap: 9px;
                padding: 9px;
            }

            .mission-icon {
                width: 58px;
                height: 58px;
                font-size: 26px;
            }

            .mission-card h3 {
                font-size: 14px;
            }

            .mission-card p {
                font-size: 11px;
            }

            .final-content h2 {
                font-size: 20px;
            }
        }

    
/* =========================================================
   RESPONSIVE FINAL — MI DECISIÓN
   ========================================================= */

html, body {
    width: 100%;
    max-width: 100%;
    overflow-x: hidden !important;
}

img, picture, video, iframe {
    max-width: 100%;
}

.hero-banner-picture {
    display: block;
    width: 100%;
    line-height: 0;
}

.hero-banner-picture img {
    display: block;
    width: 100%;
    max-width: 100%;
    height: auto;
}

/* El CTA antiguo del banner queda eliminado */


/* ---------- TABLET ---------- */
@media (max-width: 991.98px) {
    .navbar-custom {
        min-height: 70px;
        padding: 10px 22px;
    }

    .navbar-desktop {
        gap: 14px;
    }

    .pasos-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 28px 15px;
    }

    .pasos-grid::before {
        display: none;
    }

    .missions-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .final-banner {
        padding-left: 230px;
    }

    .final-avatar {
        width: 220px;
    }

    .final-avatar img {
        width: 220px;
        height: 220px;
    }
}

/* ---------- MÓVIL ---------- */
@media (max-width: 767.98px) {

    body {
        font-size: 15px;
    }

    .navbar-custom {
        min-height: 66px;
        padding: 8px 16px;
    }

    .navbar-inner {
        min-width: 0;
    }

    .navbar-desktop {
        display: none !important;
    }

    .mobile-menu-btn {
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .mobile-menu {
        top: 66px;
        margin-top: 0;
        z-index: 9999;
        max-height: calc(100vh - 66px);
        overflow-y: auto;
    }

    /* Banner móvil: usa banner-mobile.webp */
    .hero {
        width: 100%;
        overflow: hidden;
    }

    .hero-banner-picture {
        display: block;
        width: 100%;
    }

    .hero-banner-picture img {
        display: block;
        width: 100%;
        height: auto;
        min-width: 0;
        object-fit: cover;
    }

    .hero::after {
        left: -8%;
        bottom: -35px;
        width: 116%;
        height: 65px;
    }

    /* COMO FUNCIONA */
    .como-funciona {
        padding: 52px 16px 55px;
    }

    .como-title,
    .section-title {
        font-size: clamp(26px, 7vw, 34px);
        line-height: 1.1;
    }

    .como-title::before,
    .como-title::after,
    .section-title::before,
    .section-title::after {
        margin: 0 6px;
    }

    .como-subtitle,
    .section-description {
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 30px;
    }

    .pasos-grid {
        grid-template-columns: 1fr;
        gap: 26px;
    }

    .paso {
        padding: 0 8px;
    }

    .paso-icon {
        width: 78px;
        height: 78px;
        font-size: 31px;
        border-width: 5px;
    }

    .paso h3 {
        font-size: 18px;
    }

    .paso p {
        max-width: 320px;
        font-size: 13px;
    }

    .como-frase {
        margin-top: 30px;
        padding: 14px 17px;
        font-size: 14px;
        line-height: 1.45;
    }

    /* MISIONES */
    .missions-section {
        padding: 50px 14px 60px;
        margin-top: -35px;
    }

    .missions-container {
        width: 100%;
    }

    .missions-grid {
        grid-template-columns: 1fr !important;
        gap: 14px;
    }

    .mission-card {
        width: 100%;
        min-width: 0;
        min-height: 0;
        height: auto;
        display: grid;
        grid-template-columns: 64px minmax(0, 1fr) 42px;
        grid-template-rows: auto auto auto;
        column-gap: 11px;
        align-items: center;
        text-align: left;
        padding: 13px 12px;
        border-radius: 20px;
    }

    .mission-icon {
        grid-column: 1;
        grid-row: 1 / 4;
        width: 58px;
        height: 58px;
        margin: 0;
        font-size: 27px;
    }

    .mission-number {
        grid-column: 2;
        grid-row: 1;
        margin: 0 0 2px;
        font-size: 11px;
    }

    .mission-card h3 {
        grid-column: 2;
        grid-row: 2;
        margin: 0;
        font-size: 15px;
        line-height: 1.2;
    }

    .mission-card p {
        grid-column: 2;
        grid-row: 3;
        min-height: 0;
        margin: 5px 0 0;
        font-size: 11.5px;
        line-height: 1.35;
    }

    .mission-btn {
        grid-column: 3;
        grid-row: 1 / 4;
        width: 42px;
        min-width: 42px;
        height: 42px;
        min-height: 42px;
        padding: 0;
        border-radius: 13px;
        align-self: center;
    }

    .mission-btn span {
        display: none;
    }

    .mission-btn .explore-arrow {
        width: 28px;
        height: 28px;
        font-size: 11px;
    }

    /* BANNER FINAL */
    .final-banner {
        width: calc(100% - 24px);
        margin: 95px auto 25px;
        min-height: 0;
        padding: 105px 18px 20px;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        text-align: center;
        border-radius: 22px;
    }

    .final-avatar {
        position: absolute;
        left: 50%;
        top: -92px;
        bottom: auto;
        width: 190px;
        height: 190px;
        transform: translateX(-50%);
    }

    .final-avatar img {
        width: 190px;
        height: 190px;
        transform: translateY(0);
    }

    .final-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        width: 100%;
        margin: 0;
    }

    .final-icon {
        width: 56px;
        height: 56px;
        flex-basis: 56px;
        font-size: 22px;
    }

    .final-content-text {
        width: 100%;
    }

    .final-content h2 {
        font-size: 19px;
        line-height: 1.2;
    }

    .final-content p {
        font-size: 13px;
        line-height: 1.45;
    }

    .final-button {
        width: 100%;
        justify-content: center;
        padding: 13px 16px;
        border-radius: 17px;
        font-size: 14px;
    }

    .final-button i {
        font-size: 25px;
    }

    /* MODALES */
    .education-modal {
        position: fixed;
        inset: 0;
        z-index: 10000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 12px;
        overflow-y: auto;
    }

    .education-modal.active {
        display: flex;
    }

    .education-modal-box {
        width: min(100%, 520px);
        max-height: 90vh;
        overflow-y: auto;
        padding: 25px 18px 20px;
        border-radius: 22px;
    }

    .education-modal-close {
        top: 10px;
        right: 10px;
    }

    #modalTitle {
        font-size: 24px;
        line-height: 1.15;
        padding-right: 30px;
    }

    .modal-intro,
    #modalBlockText,
    #modalReflection {
        font-size: 14px;
        line-height: 1.5;
    }
}

/* ---------- MÓVIL PEQUEÑO ---------- */
@media (max-width: 480px) {

    .navbar-custom {
        padding-left: 12px;
        padding-right: 12px;
    }

    .mobile-menu-btn {
        width: 40px;
        height: 40px;
        font-size: 22px;
    }

    .hero::after {
        bottom: -26px;
        height: 50px;
    }

    .como-funciona {
        padding-top: 42px;
    }

    .missions-section {
        padding-left: 10px;
        padding-right: 10px;
    }

    .mission-card {
        grid-template-columns: 56px minmax(0, 1fr) 38px;
        column-gap: 8px;
        padding: 11px 9px;
    }

    .mission-icon {
        width: 52px;
        height: 52px;
        font-size: 24px;
    }

    .mission-card h3 {
        font-size: 14px;
    }

    .mission-card p {
        font-size: 11px;
    }

    .mission-btn {
        width: 38px;
        min-width: 38px;
        height: 38px;
        min-height: 38px;
    }

    .final-banner {
        width: calc(100% - 18px);
        margin-top: 88px;
        padding-top: 95px;
    }

    .final-avatar,
    .final-avatar img {
        width: 175px;
        height: 175px;
    }
}

/* ---------- MÓVIL MUY PEQUEÑO ---------- */
@media (max-width: 360px) {

    .mission-card {
        grid-template-columns: 50px minmax(0, 1fr) 36px;
        column-gap: 7px;
        padding: 9px 7px;
    }

    .mission-icon {
        width: 47px;
        height: 47px;
        font-size: 21px;
    }

    .mission-card h3 {
        font-size: 13px;
    }

    .mission-card p {
        font-size: 10.5px;
    }

    .mission-btn {
        width: 36px;
        min-width: 36px;
        height: 36px;
        min-height: 36px;
    }

    .final-content h2 {
        font-size: 18px;
    }
}


/* =========================================================
   RESPONSIVE FINAL INTEGRADO — MI DECISIÓN
   ========================================================= */

html,
body {
    width: 100%;
    max-width: 100%;
    overflow-x: hidden !important;
}

img,
picture,
video,
iframe {
    max-width: 100%;
}

.hero {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.hero-banner-picture {
    display: block;
    width: 100%;
    margin: 0;
    padding: 0;
    line-height: 0;
}

.hero-banner-picture img {
    display: block;
    width: 100%;
    max-width: 100%;
    height: auto;
    margin: 0;
    padding: 0;
}

/* El botón antiguo del banner ya no se utiliza */

/* =========================================================
   TABLET
   ========================================================= */

@media (max-width: 991.98px) {

    .navbar-custom {
        padding: 9px 22px;
    }

    .navbar-desktop {
        gap: 15px;
    }

    .pasos-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 25px 15px;
    }

    .pasos-grid::before {
        display: none;
    }

    .missions-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .final-banner {
        padding-left: 220px;
    }

    .final-avatar {
        width: 215px;
    }

    .final-avatar img {
        width: 215px;
        height: 215px;
    }
}

/* =========================================================
   MÓVIL
   ========================================================= */

@media (max-width: 768px) {

    body {
        font-size: 15px;
    }

    .navbar-custom {
        min-height: 68px;
        padding: 8px 15px;
    }

    .navbar-inner {
        min-width: 0;
    }

    .navbar-desktop {
        display: none !important;
    }

    .mobile-menu-btn {
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .mobile-menu {
        top: 68px;
        left: 0;
        margin-top: 0 !important;
        width: 100%;
        max-height: calc(100vh - 68px);
        overflow-y: auto;
        z-index: 9999;
    }

    /* -------------------------
       BANNER MÓVIL
       ------------------------- */

    .hero {
        width: 100%;
        overflow: hidden;
    }

    .hero-banner-picture {
        display: block;
        width: 100%;
        height: auto;
    }

    .hero-banner-picture img {
        display: block;
        width: 100%;
        max-width: 100%;
        height: auto;
        min-width: 0;
        object-fit: contain;
    }

    .hero::after {
        left: -8%;
        bottom: -35px;
        width: 116%;
        height: 65px;
    }

    /* -------------------------
       COMO FUNCIONA
       ------------------------- */

    .como-funciona {
        padding: 52px 16px 55px;
    }

    .como-title,
    .section-title,
    .aprende-title {
        font-size: clamp(26px, 7vw, 34px);
        line-height: 1.12;
    }

    .como-title::before,
    .como-title::after,
    .section-title::before,
    .section-title::after,
    .aprende-title::before,
    .aprende-title::after {
        margin: 0 5px;
    }

    .como-subtitle,
    .section-description,
    .aprende-subtitle {
        font-size: 14px;
        line-height: 1.5;
    }

    .pasos-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .paso {
        display: grid;
        grid-template-columns: 72px minmax(0, 1fr);
        grid-template-rows: auto auto auto;
        column-gap: 13px;
        align-items: center;
        text-align: left;
        padding: 5px 6px;
    }

    .paso-icon {
        grid-column: 1;
        grid-row: 1 / 4;
        width: 68px;
        height: 68px;
        margin: 0;
        font-size: 27px;
        border-width: 5px;
    }

    .paso-numero {
        grid-column: 2;
        grid-row: 1;
        margin: 0;
        font-size: 11px;
    }

    .paso h3 {
        grid-column: 2;
        grid-row: 2;
        margin: 1px 0 3px;
        font-size: 17px;
    }

    .paso p {
        grid-column: 2;
        grid-row: 3;
        max-width: none;
        margin: 0;
        font-size: 12px;
        line-height: 1.35;
    }

    .como-frase {
        margin-top: 28px;
        padding: 14px 15px;
        font-size: 14px;
        line-height: 1.45;
    }

    /* -------------------------
       MISIONES
       ------------------------- */

    .missions-section {
        padding: 50px 12px 65px;
        margin-top: -35px;
    }

    .missions-grid {
        grid-template-columns: 1fr !important;
        gap: 11px;
        max-width: 540px;
        margin: 0 auto;
    }

    .mission-card {
        width: 100%;
        min-width: 0;
        min-height: 0;
        height: auto;

        display: grid;
        grid-template-columns: 62px minmax(0, 1fr) 42px;
        grid-template-rows: auto auto auto;
        column-gap: 10px;

        align-items: center;
        text-align: left;

        padding: 12px 10px;
        border-radius: 18px;
    }

    .mission-icon {
        grid-column: 1;
        grid-row: 1 / 4;

        width: 56px;
        height: 56px;

        margin: 0;
        font-size: 25px;
    }

    .mission-number {
        grid-column: 2;
        grid-row: 1;

        margin: 0 0 2px;
        font-size: 11px;
    }

    .mission-card h3 {
        grid-column: 2;
        grid-row: 2;

        margin: 0;
        font-size: 15px;
        line-height: 1.2;
    }

    .mission-card p {
        grid-column: 2;
        grid-row: 3;

        min-height: 0;
        margin: 5px 0 0;

        font-size: 11.5px;
        line-height: 1.35;
    }

    .mission-btn {
        grid-column: 3;
        grid-row: 1 / 4;

        width: 42px;
        min-width: 42px;
        height: 42px;
        min-height: 42px;

        padding: 0;
        border-radius: 13px;
    }

    .mission-btn span {
        display: none;
    }

    .mission-btn .explore-arrow {
        width: 28px;
        height: 28px;
        font-size: 11px;
    }

    /* -------------------------
       CONTENIDO EDUCATIVO
       ------------------------- */

    .aprende-section {
        padding: 55px 15px 65px;
    }

    .educational-grid {
        grid-template-columns: 1fr !important;
        gap: 14px;
    }

    .educational-card {
        min-height: auto;
        padding: 21px 18px;
        border-radius: 21px;
    }

    .educational-icon {
        width: 57px;
        height: 57px;
        font-size: 24px;
    }

    .educational-card h3 {
        font-size: 18px;
        line-height: 1.2;
    }

    .educational-card p {
        font-size: 13px;
        line-height: 1.5;
    }

    .educational-open,
    .educational-open1 {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        min-height: 44px;
        padding: 11px 13px;
        font-size: 13px;
        line-height: 1.25;
        white-space: normal;
        overflow-wrap: anywhere;
    }

    .educational-highlight {
        margin-top: 25px;
        padding: 18px;
        gap: 13px;
    }

    /* -------------------------
       SECCIÓN ¿POR QUÉ?
       ------------------------- */

    .why-alcohol {
        padding: 65px 15px;
        overflow: hidden;
    }

    .why-header h2 {
        font-size: clamp(30px, 9vw, 38px);
        line-height: 1.08;
    }

    .why-header p {
        font-size: 14px;
        line-height: 1.5;
    }

    .why-scene {
        display: flex;
        flex-direction: column;
        gap: 14px;
        min-height: auto;
    }

    .why-circle {
        display: none;
    }

    .why-character {
        order: 1;
        width: 100%;
        height: 330px;
        margin-bottom: 10px;
    }

    .character-circle {
        width: 240px;
        height: 240px;
    }

    .why-character img {
        width: 240px;
        height: 320px;
    }

    .character-bubble {
        right: 15px;
        top: 0;
    }

    .why-card {
        width: 100% !important;
        margin: 0;
    }

    .why-card-one { order: 2; }
    .why-card-two { order: 3; }
    .why-card-three { order: 4; }
    .why-card-four { order: 5; }
    .why-card-bottom { order: 6; }

    .why-final {
        margin-top: 25px;
        padding: 20px;
        align-items: flex-start;
    }

    /* -------------------------
       BANNER FINAL / #141
       ------------------------- */

    .final-banner {
        width: calc(100% - 20px);
        margin: 95px auto 25px;

        min-height: 0;
        padding: 100px 17px 20px;

        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;

        border-radius: 22px;
        overflow: visible;
    }

    .final-avatar {
        position: absolute;

        left: 50%;
        top: -92px;
        bottom: auto;

        width: 180px;
        height: 180px;

        transform: translateX(-50%);
    }

    .final-avatar img {
        width: 180px;
        height: 180px;
        transform: translateY(0);
    }

    .final-content {
        width: 100%;
        margin-right: 0;

        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;

        text-align: center;
    }

    .final-content h2 {
        font-size: 20px;
        line-height: 1.2;
    }

    .final-content p {
        max-width: 100%;
        font-size: 13px;
        line-height: 1.45;
    }

    .final-button {
        width: 100%;
        min-height: 68px;
        flex-basis: auto;
        justify-content: center;
        padding: 12px 15px;
        border-radius: 17px;
    }

    /* -------------------------
       MODAL
       ------------------------- */

    .education-modal {
        position: fixed;
        inset: 0;
        z-index: 10000;

        display: none;
        align-items: center;
        justify-content: center;

        padding: 12px;
        overflow-y: auto;
    }

    .education-modal.active {
        display: flex;
    }

    .education-modal-box {
        width: 100%;
        max-width: 520px;
        max-height: 90vh;
        overflow-y: auto;

        padding: 26px 18px 21px;
        border-radius: 22px;
    }

    .education-modal h2 {
        font-size: 24px;
        line-height: 1.15;
        margin-right: 35px;
    }

    .education-modal .modal-intro,
    .modal-info-block p,
    .modal-reflection p {
        font-size: 13px;
        line-height: 1.55;
    }
}

/* =========================================================
   MÓVIL PEQUEÑO
   ========================================================= */

@media (max-width: 480px) {

    .navbar-custom {
        padding-left: 11px;
        padding-right: 11px;
    }

    .mobile-menu-btn {
        width: 40px;
        height: 40px;
        font-size: 22px;
    }

    .hero::after {
        bottom: -27px;
        height: 52px;
    }

    .mission-card {
        grid-template-columns: 54px minmax(0, 1fr) 38px;
        column-gap: 8px;
        padding: 10px 8px;
    }

    .mission-icon {
        width: 50px;
        height: 50px;
        font-size: 23px;
    }

    .mission-card h3 {
        font-size: 14px;
    }

    .mission-card p {
        font-size: 11px;
    }

    .mission-btn {
        width: 38px;
        min-width: 38px;
        height: 38px;
        min-height: 38px;
    }

    .final-banner {
        width: calc(100% - 14px);
        margin-top: 88px;
        padding-top: 94px;
    }

    .final-avatar,
    .final-avatar img {
        width: 170px;
        height: 170px;
    }

    .why-character {
        height: 300px;
    }

    .why-character img {
        width: 220px;
        height: 295px;
    }

    .character-circle {
        width: 215px;
        height: 215px;
    }

    .character-bubble {
        right: 4px;
        transform: scale(.9) rotate(3deg);
    }

    .why-final {
        flex-direction: column;
        text-align: center;
        align-items: center;
    }
}

/* =========================================================
   MÓVIL MUY PEQUEÑO
   ========================================================= */

@media (max-width: 360px) {

    .mission-card {
        grid-template-columns: 49px minmax(0, 1fr) 36px;
        column-gap: 7px;
        padding: 9px 7px;
    }

    .mission-icon {
        width: 46px;
        height: 46px;
        font-size: 21px;
    }

    .mission-card h3 {
        font-size: 13px;
    }

    .mission-card p {
        font-size: 10.5px;
    }

    .mission-btn {
        width: 36px;
        min-width: 36px;
        height: 36px;
        min-height: 36px;
    }

    .final-content h2 {
        font-size: 18px;
    }
}

</style>
</head>

<body>

    <!-- =====================================================
         NAVBAR
    ====================================================== -->

    <nav class="navbar-custom">

        <div class="navbar-inner">

            <div class="nav-brand-text">
     
             <img
            src="{{ asset('build/img/logo.WebP') }}"
            alt="Mi Decisión - Aprende, Decide y Avanza"
            class="logo"
        >
            </div>

            <div class="navbar-desktop">

                <a href="#inicio">
                    Inicio
                </a>

             <a href="{{ route('aprende.index') }}"> 
    Temas 
</a>
                <a href="#como-funciona">
                    ¿Cómo participar?
                </a>

                <a href="#aprende">
                    Aprende
                </a>

                <a href="#nosotros">
                    Sobre el programa
                </a>
                
               <!-- <a class="btn-registro" href="{{ route('registro') }}">
                <i class="fa-solid fa-user"></i>Registro</a>-->
         
                 <a class="btn-login" href="{{ route('login') }}">
                 <i class="fa-solid fa-user"></i>Ingresar</a>

            </div>

            <button
                type="button"
                class="mobile-menu-btn"
                id="menuMobile"
                aria-label="Abrir menú"
            >
                <i class="fa-solid fa-bars"></i>
            </button>

        </div>

        <!-- Menú móvil -->

        <div
            class="mobile-menu"
            id="mobileMenu"
        >

            <a href="#inicio">
                Inicio
            </a>

            <a href="#misiones">
                Temas
            </a>

            <a href="#como-funciona">
                ¿Cómo participar?
            </a>

            <a href="#aprende">
                Aprende
            </a>

            <a href="#nosotros">
                Sobre el programa
            </a>

         <!--   <a class="btn-registro" href="{{ route('registro') }}">
                <i class="fa-solid fa-user"></i>Registro</a>-->

            <a
                href="{{ route('login') }}"
                class="btn-login"
            >
                <i class="fa-solid fa-user"></i>
                Ingresar
            </a>

        </div>

    </nav>


    <!-- =====================================================
         BANNER
    ====================================================== -->

    <section
        class="hero"
        id="inicio"
    >
    <picture class="hero-banner-picture">

    <source
        media="(max-width: 768px)"
        srcset="{{ asset('build/img/banner-mobile.webp') }}"
    >

    <img
        src="{{ asset('build/img/banner.WebP') }}"
        alt="Mi Decisión"
        class="banner-img"
    >

    <a
    href="#misiones"
    class="btn-comenzar"
    aria-label="Quiero conocer los temas"
>
    QUIERO CONOCER
    <i class="fa-solid fa-chevron-right"></i>
</a>

</picture>

<a
    href="#misiones"
    class="btn-comenzar"
    aria-label="Quiero conocer los temas"
>
    QUIERO CONOCER
    <i class="fa-solid fa-chevron-right"></i>
</a>
    </section>


    <!-- =====================================================
     COMO PARTICIPAR
====================================================== -->

<section class="como-funciona" id="como-funciona">
    <div class="como-container">
        <h2 class="como-title">¿Cómo participar?</h2>
        <p class="como-subtitle">
            Un espacio para conocer, pensar y tomar decisiones conscientes frente al consumo de alcohol.
        </p>

        <div class="pasos-grid">
            <article class="paso">
                <div class="paso-icon">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <span class="paso-numero">1</span>
                <h3>Conoce</h3>
                <p>Encuentra información clara sobre el alcohol, sus efectos y los riesgos de consumirlo a temprana edad.</p>
            </article>

            <article class="paso">
                <div class="paso-icon">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <span class="paso-numero">2</span>
                <h3>Reflexiona</h3>
                <p>Piensa en tus emociones, tus relaciones, tus metas y aquello que realmente quieres para tu vida.</p>
            </article>

            <article class="paso">
                <div class="paso-icon">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <span class="paso-numero">3</span>
                <h3>Conversa</h3>
                <p>Reconoce la presión social y descubre que pedir apoyo, hablar y decir no también son decisiones válidas.</p>
            </article>

            <article class="paso">
                <div class="paso-icon">
                    <i class="fa-solid fa-seedling"></i>
                </div>
                <span class="paso-numero">4</span>
                <h3>Cuida</h3>
                <p>Fortalece hábitos y decisiones que protejan tu bienestar, tus relaciones y tus proyectos de vida.</p>
            </article>
        </div>

        <div class="como-frase">
            <i class="fa-solid fa-heart"></i>
            Tu bienestar importa. Informarte también es una forma de cuidarte.
        </div>
    </div>
</section>

<!-- =====================================================
     TEMAS DE REFLEXIÓN
====================================================== -->

<section class="missions-section" id="misiones">
    <div class="missions-container">
        <h2 class="section-title">Conoce y reflexiona</h2>
        <p class="section-description">
            Explora contenidos pensados para ayudarte a comprender el consumo de alcohol y sus consecuencias.
        </p>

        <div class="missions-grid">

            <article class="mission-card">
                <div class="mission-icon">
                    <i class="fa-solid fa-wine-bottle"></i>
                </div>
                <span class="mission-number">TEMA 1</span>
                <h3>¿Qué es el alcohol?</h3>
                <p>Conoce qué es, cómo actúa en el organismo y por qué el consumo durante la adolescencia puede afectar el desarrollo.</p>

                <button type="button" class="mission-btn" data-topic="¿Qué es el alcohol?">
                    <span>Conocer tema</span>
                    <span class="explore-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </button>
            </article>

            <article class="mission-card">
                <div class="mission-icon">
                    <i class="fa-solid fa-brain"></i>
                </div>
                <span class="mission-number">TEMA 2</span>
                <h3>Alcohol y emociones</h3>
                <p>Reflexiona sobre cómo las emociones pueden influir en nuestras decisiones y conoce alternativas saludables para afrontarlas.</p>

                <button type="button" class="mission-btn" data-topic="Alcohol y emociones">
                    <span>Reflexionar</span>
                    <span class="explore-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </button>
            </article>

            <article class="mission-card">
                <div class="mission-icon">
                    <i class="fa-solid fa-people-group"></i>
                </div>
                <span class="mission-number">TEMA 3</span>
                <h3>Presión social</h3>
                <p>Aprende a identificar situaciones de presión y descubre formas de expresar tus decisiones con seguridad y respeto.</p>

                <button type="button" class="mission-btn" data-topic="Presión social">
                    <span>Comprender</span>
                    <span class="explore-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </button>
            </article>

            <article class="mission-card">
                <div class="mission-icon">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <span class="mission-number">TEMA 4</span>
                <h3>Mitos y realidades</h3>
                <p>Cuestiona ideas comunes sobre el alcohol y contrasta lo que escuchas con información que te permita formar tu propio criterio.</p>

                <button type="button" class="mission-btn" data-topic="Mitos y realidades">
                    <span>información</span>
                    <span class="explore-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </button>
            </article>

            <article class="mission-card">
                <div class="mission-icon">
                    <i class="fa-solid fa-seedling"></i>
                </div>
                <span class="mission-number">TEMA 5</span>
                <h3>Mi bienestar, mi decisión</h3>
                <p>Reconoce tus metas, fortalezas y redes de apoyo para construir un proyecto de vida que cuide lo que es importante para ti.</p>

                <button type="button" class="mission-btn" data-topic="Mi bienestar, mi decisión">
                    <span>Entender</span>
                    <span class="explore-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </button>
            </article>

        </div>

        <div class="final-banner">

    {{-- AVATAR --}}
    <div class="final-avatar">

        <img
            src="{{ asset('build/img/avatar-banner.webp') }}"
            alt="MI DECISIÓN"
        >

    </div>


    {{-- MENSAJE PRINCIPAL --}}
    <div class="final-content">

        <div class="final-icon">

            <i class="fa-solid fa-phone"></i>

        </div>


        <div class="final-content-text">

            <span class="final-label">
                LÍNEA GRATUITA DE APOYO
            </span>

            <h2>
                ¿Necesitas hablar?
            </h2>

            <p>
                Si necesitas orientación, apoyo o simplemente
                alguien que te escuche, puedes comunicarte
                gratuitamente con la <strong>Línea #141</strong>.
            </p>

        </div>

    </div>


    {{-- LLAMADO A LA ACCIÓN --}}
    <a
        href="tel:141"
        class="final-button"
    >

        <i class="fa-solid fa-phone"></i>

        <span>

            <small>
                Llama gratis
            </small>

            <strong>
                Línea #141
            </strong>

        </span>

        <i class="fa-solid fa-arrow-right final-arrow"></i>

    </a>

</div>
</section>



    <!-- =====================================================
         CONTENIDO EDUCATIVO
    ====================================================== -->
<section class="why-alcohol" id="por-que-alcohol">

    <div class="why-alcohol-container">

        {{-- ENCABEZADO --}}

        <div class="why-header">

            <span class="why-kicker">
                DETRÁS DE CADA DECISIÓN
            </span>

            <h2>
                ¿Por qué se consume
                <span>alcohol?</span>
            </h2>

            <p>
                No siempre se trata de la bebida.
                A veces se trata de lo que una persona está viviendo.
            </p>

        </div>


        {{-- ESCENA PRINCIPAL --}}

        <div class="why-scene">

            {{-- DECORACIÓN --}}

            <div class="why-circle why-circle-one"></div>
            <div class="why-circle why-circle-two"></div>


            {{-- RAZÓN 1 --}}

            <div class="why-card why-card-left why-card-one">

                <span class="why-number">
                    01
                </span>

                <div class="why-card-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <div>
                    <strong>
                        Presión social
                    </strong>

                    <p>
                        Querer encajar, pertenecer o sentir
                        que todos esperan que consumas.
                    </p>
                </div>

            </div>


            {{-- RAZÓN 2 --}}

            <div class="why-card why-card-left why-card-two">

                <span class="why-number">
                    02
                </span>

                <div class="why-card-icon">
                    <i class="fa-solid fa-heart-crack"></i>
                </div>

                <div>
                    <strong>
                        Emociones
                    </strong>

                    <p>
                        Buscar una forma de escapar
                        temporalmente de lo que sentimos.
                    </p>
                </div>

            </div>


            {{-- PERSONAJE CENTRAL --}}

            <div class="why-character">

                <div class="character-shadow"></div>

                <div class="character-circle"></div>

                <img
                    src="{{ asset('build/img/avatar-consume.webp') }}"
                    alt="Avatar MI DECISIÓN"
                    loading="lazy"
                >

                <div class="character-bubble">

                    <span>
                        PREGÚNTATE
                    </span>

                    <strong>
                        ¿Qué hay detrás?
                    </strong>

                </div>

            </div>


            {{-- RAZÓN 3 --}}

            <div class="why-card why-card-right why-card-three">

                <span class="why-number">
                    03
                </span>

                <div class="why-card-icon">
                    <i class="fa-solid fa-music"></i>
                </div>

                <div>
                    <strong>
                        Diversión
                    </strong>

                    <p>
                        Fiestas, reuniones y la idea de que
                        beber hace que un momento sea mejor.
                    </p>
                </div>

            </div>


            {{-- RAZÓN 4 --}}

            <div class="why-card why-card-right why-card-four">

                <span class="why-number">
                    04
                </span>

                <div class="why-card-icon">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>

                <div>
                    <strong>
                        Influencia del entorno
                    </strong>

                    <p>
                        Redes, publicidad, amigos y costumbres
                        pueden hacer que el consumo parezca normal.
                    </p>
                </div>

            </div>


            {{-- RAZÓN 5 --}}

            <div class="why-card why-card-bottom">

                <span class="why-number">
                    05
                </span>

                <div class="why-card-icon">
                    <i class="fa-solid fa-flask"></i>
                </div>

                <div>
                    <strong>
                        Curiosidad
                    </strong>

                    <p>
                        Querer experimentar o descubrir
                        qué se siente puede ser el comienzo.
                    </p>
                </div>

            </div>


        </div>

</section>


<style>

/* =========================================================
   SECCIÓN PRINCIPAL
========================================================= */

.why-alcohol {

    position: relative;

    padding: 100px 20px;
    margin-top:-80px;

    overflow: hidden;

    background:
        #f6f9fc;
}


.why-alcohol-container {

    width: 100%;

    max-width: 1200px;

    margin: auto;
}

/* ================================
   ANIMACIÓN CONSTANTE DEL AVATAR
================================ */

.why-character {
    animation: avatarFloat 4s ease-in-out infinite;
    will-change: transform;
}

@keyframes avatarFloat {
    0% {
        transform: translateY(0px);
    }

    50% {
        transform: translateY(-14px);
    }

    100% {
        transform: translateY(0px);
    }
}


/* =========================================================
   HEADER
========================================================= */

.why-header {

    max-width: 750px;

    margin: 0 auto 70px;

    text-align: center;
}


.why-kicker {

    display: inline-block;

    padding: 7px 17px;

    border-radius: 30px;

    background: #10205c;

    color: white;

    font-size: 11px;

    font-weight: 900;

    letter-spacing: 2px;
}


.why-header h2 {

    margin: 20px 0 15px;

    color: #10205c;

    font-size: clamp(40px, 6vw, 65px);

    line-height: .98;

    font-weight: 900;

    letter-spacing: -2px;
}


.why-header h2 span {

    color: #079fdc;

    font-style: italic;
}


.why-header p {

    margin: 0 auto;

    max-width: 620px;

    color: #62758a;

    font-size: 17px;

    line-height: 1.6;
}


/* =========================================================
   ESCENA
========================================================= */

.why-scene {

    position: relative;

    min-height: 650px;

    display: grid;

    grid-template-columns: 1fr 320px 1fr;

    grid-template-rows: 1fr 1fr 120px;

    gap: 25px;

    align-items: center;
}


/* =========================================================
   CÍRCULOS DECORATIVOS
========================================================= */

.why-circle {

    position: absolute;

    border-radius: 50%;

    pointer-events: none;
}


.why-circle-one {

    width: 500px;

    height: 500px;

    left: 50%;

    top: 50%;

    transform: translate(-50%, -50%);

    background:
        #e7f7ff;

    z-index: 0;
}


.why-circle-two {

    width: 390px;

    height: 390px;

    left: 50%;

    top: 50%;

    transform: translate(-50%, -50%);

    border: 2px dashed #b9dfee;

    background: transparent;

    z-index: 0;
}


/* =========================================================
   AVATAR
========================================================= */

.why-character {

    position: relative;

    grid-column: 2;

    grid-row: 1 / 3;

    height: 500px;

    display: flex;

    align-items: flex-end;

    justify-content: center;

    z-index: 3;
}


.character-circle {

    position: absolute;

    width: 300px;

    height: 300px;

    bottom: 30px;

    border-radius: 50%;

    background:
        linear-gradient(
            145deg,
            #ffffff,
            #dff4ff
        );

    box-shadow:
        0 20px 50px rgba(20,70,100,.10);
}


.character-shadow {

    position: absolute;

    bottom: 20px;

    width: 220px;

    height: 35px;

    border-radius: 50%;

    background:
        rgba(16,32,92,.12);

    filter: blur(10px);
}


.why-character img {

    position: relative;

    z-index: 3;

    width: 310px;

    height: 470px;

    object-fit: contain;

    object-position: bottom;

    filter:
        drop-shadow(
            0 15px 15px rgba(20,50,80,.15)
        );

    transition:
        transform .35s ease;
}


.why-character:hover img {

    transform:
        translateY(-8px);
}


/* =========================================================
   BURBUJA
========================================================= */

.character-bubble {

    position: absolute;

    z-index: 5;

    top: 10px;

    right: -20px;

    display: flex;

    flex-direction: column;

    padding: 13px 17px;

    border-radius: 15px;

    background: #ffd21c;

    color: #10205c;

    transform: rotate(3deg);

    box-shadow:
        0 8px 20px rgba(160,120,0,.15);
}


.character-bubble::after {

    content: "";

    position: absolute;

    bottom: -10px;

    left: 25px;

    border-style: solid;

    border-width:
        10px 10px 0 0;

    border-color:
        #ffd21c transparent transparent transparent;
}


.character-bubble span {

    font-size: 9px;

    font-weight: 900;

    letter-spacing: 1px;
}


.character-bubble strong {

    margin-top: 2px;

    font-size: 16px;

    font-weight: 900;
}


/* =========================================================
   TARJETAS
========================================================= */

.why-card {

    position: relative;

    z-index: 4;

    display: grid;

    grid-template-columns: 48px 1fr;

    gap: 13px;

    align-items: start;

    padding: 18px;

    border-radius: 20px;

    background: rgba(255,255,255,.95);

    border: 1px solid #dceaf2;

    box-shadow:
        0 10px 25px rgba(20,60,90,.07);

    transition:
        transform .25s ease,
        box-shadow .25s ease;
}


.why-card:hover {

    transform:
        translateY(-5px);

    box-shadow:
        0 16px 30px rgba(20,60,90,.12);
}


.why-card-left {

    margin-right: 20px;
}


.why-card-right {

    margin-left: 20px;
}


/* =========================================================
   POSICIONES
========================================================= */

.why-card-one {

    grid-column: 1;

    grid-row: 1;

    align-self: end;
}


.why-card-two {

    grid-column: 1;

    grid-row: 2;

    align-self: start;
}


.why-card-three {

    grid-column: 3;

    grid-row: 1;

    align-self: end;
}


.why-card-four {

    grid-column: 3;

    grid-row: 2;

    align-self: start;
}


.why-card-bottom {

    grid-column: 2;

    grid-row: 3;

    width: 280px;

    justify-self: center;

    align-self: start;
}


/* =========================================================
   NÚMERO
========================================================= */

.why-number {

    position: absolute;

    top: 10px;

    right: 13px;

    color: #c5d8e5;

    font-size: 10px;

    font-weight: 900;
}


/* =========================================================
   ICONO
========================================================= */

.why-card-icon {

    width: 48px;

    height: 48px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    background: #eef8fd;

    color: #079fdc;

    font-size: 19px;
}


.why-card:nth-child(4) .why-card-icon {

    color: #ed4b7a;

    background: #fff0f5;
}


.why-card:nth-child(6) .why-card-icon {

    color: #8c55df;

    background: #f3edff;
}


.why-card:nth-child(7) .why-card-icon {

    color: #10a866;

    background: #eafaf2;
}


/* =========================================================
   TEXTO
========================================================= */

.why-card strong {

    display: block;

    margin-bottom: 5px;

    color: #10205c;

    font-size: 16px;

    font-weight: 900;
}


.why-card p {

    margin: 0;

    color: #64788b;

    font-size: 12px;

    line-height: 1.5;
}


/* =========================================================
   MENSAJE FINAL
========================================================= */

.why-final {

    max-width: 900px;

    margin: 45px auto 0;

    display: flex;

    align-items: center;

    gap: 18px;

    padding: 25px 30px;

    border-radius: 22px;

    background:
        #10205c;

    color: white;

    box-shadow:
        0 15px 35px rgba(16,32,92,.15);
}


.why-final-icon {

    width: 58px;

    height: 58px;

    flex: 0 0 58px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #ffd21c;

    color: #10205c;

    font-size: 22px;
}


.why-final span {

    display: block;

    margin-bottom: 4px;

    color: #ffd21c;

    font-size: 10px;

    font-weight: 900;

    letter-spacing: 1.5px;
}


.why-final h3 {

    margin: 0 0 5px;

    color: white;

    font-size: 22px;

    font-weight: 900;
}


.why-final p {

    margin: 0;

    color: #d9e5f1;

    font-size: 13px;

    line-height: 1.5;
}


/* =========================================================
   ANIMACIONES
========================================================= */

.why-card {

    opacity: 0;

    transform: translateY(20px);

    animation:
        whyCardIn .6s ease forwards;
}


.why-card-one {
    animation-delay: .1s;
}


.why-card-two {
    animation-delay: .2s;
}


.why-card-three {
    animation-delay: .3s;
}


.why-card-four {
    animation-delay: .4s;
}


.why-card-bottom {
    animation-delay: .5s;
}


@keyframes whyCardIn {

    to {

        opacity: 1;

        transform: translateY(0);

    }

}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 900px) {

    .why-scene {

        grid-template-columns:
            1fr 250px 1fr;

        gap: 15px;
    }


    .why-character img {

        width: 260px;

        height: 430px;
    }


    .character-circle {

        width: 250px;

        height: 250px;
    }


    .why-card {

        padding: 14px;

        grid-template-columns:
            40px 1fr;
    }


    .why-card-icon {

        width: 40px;

        height: 40px;
    }


    .why-card p {

        font-size: 11px;
    }

}


/* =========================================================
   MÓVIL
========================================================= */

@media (max-width: 700px) {

    .why-alcohol {

        padding: 70px 15px;

    }


    .why-header {

        margin-bottom: 40px;

    }


    .why-header h2 {

        font-size: 38px;

        letter-spacing: -1px;

    }


    .why-header p {

        font-size: 14px;

    }


    .why-scene {

        min-height: auto;

        display: flex;

        flex-direction: column;

        gap: 15px;

    }


    .why-circle {

        display: none;

    }


    .why-character {

        order: 1;

        width: 100%;

        height: 330px;

        margin-bottom: 15px;

    }


    .character-circle {

        width: 240px;

        height: 240px;

    }


    .why-character img {

        width: 240px;

        height: 320px;

    }


    .character-bubble {

        right: 20px;

        top: 0;

    }


    .why-card {

        width: 100% !important;

        margin: 0;

    }


    .why-card-one {

        order: 2;

    }


    .why-card-two {

        order: 3;

    }


    .why-card-three {

        order: 4;

    }


    .why-card-four {

        order: 5;

    }


    .why-card-bottom {

        order: 6;

    }


    .why-final {

        margin-top: 30px;

        padding: 22px;

        align-items: flex-start;

    }


    .why-final h3 {

        font-size: 19px;

    }


}


/* =========================================================
   MÓVIL PEQUEÑO
========================================================= */

@media (max-width: 420px) {

    .why-header h2 {

        font-size: 32px;

    }


    .why-character {

        height: 300px;

    }


    .why-character img {

        width: 220px;

        height: 295px;

    }


    .character-circle {

        width: 215px;

        height: 215px;

    }


    .character-bubble {

        right: 5px;

        transform: scale(.9) rotate(3deg);

    }


    .why-final {

        flex-direction: column;

        text-align: center;

        align-items: center;

    }

}

</style>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
     * Efecto suave al pasar sobre las razones.
     */

    const cards =
        document.querySelectorAll('.why-card');


    cards.forEach(function (card) {

        card.addEventListener('mouseenter', function () {

            card.style.zIndex = '10';

        });


        card.addEventListener('mouseleave', function () {

            card.style.zIndex = '4';

        });

    });


    /*
     * Movimiento suave del avatar
     * según el movimiento del mouse.
     */

    const character =
        document.querySelector('.why-character');


    const avatar =
        document.querySelector('.why-character img');


    if (character && avatar && window.innerWidth > 700) {

        character.addEventListener(
            'mousemove',
            function (event) {

                const rect =
                    character.getBoundingClientRect();


                const x =
                    event.clientX - rect.left;


                const y =
                    event.clientY - rect.top;


                const moveX =
                    ((x / rect.width) - .5) * 8;


                const moveY =
                    ((y / rect.height) - .5) * 5;


                avatar.style.transform =
                    `translate(${moveX}px, ${moveY}px)`;

            }
        );


        character.addEventListener(
            'mouseleave',
            function () {

                avatar.style.transform =
                    'translate(0, 0)';

            }
        );

    }

});

</script>
 

    <!-- =====================================================
         MODAL EDUCATIVO
    ====================================================== -->

    <div
        class="education-modal"
        id="educationModal"
        aria-hidden="true"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modalTitle"
    >
        <div class="education-modal-box">

            <button
                type="button"
                class="education-modal-close"
                id="modalClose"
                aria-label="Cerrar"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="modal-topic-icon" id="modalIcon">
                <i class="fa-solid fa-book-open"></i>
            </div>

            <h2 id="modalTitle">Información</h2>

            <p class="modal-intro" id="modalIntro"></p>

            <div class="modal-info-block">
                <h3 id="modalBlockTitle">Lo importante</h3>
                <p id="modalBlockText"></p>
            </div>

            <div class="modal-reflection">
                <strong>
                    <i class="fa-solid fa-lightbulb"></i>
                    Para reflexionar
                </strong>

                <p id="modalReflection"></p>
            </div>

        </div>
    </div>


   
    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <footer id="nosotros">

        <div class="footer-logo">
            CONCIENCIA Y BIENESTAR
        </div>

        <p>
            
        </p>

        <p>
            © {{ date('Y') }} Mi Decisión.
            Un espacio educativo para promover decisiones conscientes.
        </p>

    </footer>


    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script>

        const menuMobile =
            document.getElementById('menuMobile');

        const mobileMenu =
            document.getElementById('mobileMenu');

        if (menuMobile && mobileMenu) {

            menuMobile.addEventListener('click', function () {
                mobileMenu.classList.toggle('active');

                const expanded =
                    mobileMenu.classList.contains('active');

                menuMobile.setAttribute(
                    'aria-expanded',
                    expanded ? 'true' : 'false'
                );
            });

            document
                .querySelectorAll('.mobile-menu a')
                .forEach(function (link) {

                    link.addEventListener('click', function () {
                        mobileMenu.classList.remove('active');
                        menuMobile.setAttribute(
                            'aria-expanded',
                            'false'
                        );
                    });

                });
        }


        /* =========================
           MODALES DE CONTENIDO
        ========================= */

        const educationModal = document.getElementById('educationModal');
        const modalClose = document.getElementById('modalClose');
        const modalTitle = document.getElementById('modalTitle');
        const modalIntro = document.getElementById('modalIntro');
        const modalBlockTitle = document.getElementById('modalBlockTitle');
        const modalBlockText = document.getElementById('modalBlockText');
        const modalReflection = document.getElementById('modalReflection');
        const modalIcon = document.getElementById('modalIcon');

        const educationalContent = {
            '¿Qué es el alcohol?': {
                icon: 'fa-wine-bottle',
                title: '¿Qué es el alcohol?',
                intro: 'El alcohol es una sustancia psicoactiva que puede modificar la actividad del sistema nervioso y la forma en que una persona piensa, siente y actúa.',
                blockTitle: '¿Por qué es importante conocerlo?',
                blockText: 'Conocer sus efectos ayuda a comprender que el consumo puede influir en la atención, la coordinación, el juicio y la capacidad de tomar decisiones. Durante la adolescencia, contar con información clara es especialmente importante.',
                reflection: 'El alcohol está muy arraigado en la cultura y en las reuniones sociales. Muchas veces se usa para relajar la mente o quitar la timidez. Sin embargo, la normalización de su consumo hace que olvidemos sus riesgos reales para la salud física y mental'
            },
            'Alcohol y cerebro': {
                icon: 'fa-brain',
                title: 'Alcohol y cerebro',
                intro: 'El cerebro continúa desarrollándose durante la adolescencia y la juventud. El alcohol puede afectar procesos relacionados con la atención, la memoria, la coordinación y la toma de decisiones.',
                blockTitle: 'Una decisión también necesita información',
                blockText: 'Los efectos del alcohol pueden hacer más difícil valorar riesgos y consecuencias en una situación. Comprender esto permite mirar el consumo desde el cuidado y no solo desde lo que ocurre en una fiesta o reunión.',
                reflection: 'Buscamos el alcohol para "apagar" el ruido mental, el estrés o la timidez. Lo irónico es que la sensación de libertad o euforia inicial no es más que el cerebro perdiendo la capacidad de regularse. No nos volvemos más alegres o valientes; simplemente, la corteza prefronta'
            },
            'Alcohol y emociones': {
                icon: 'fa-face-smile',
                title: 'Alcohol y emociones',
                intro: 'Lo que sentimos influye en las decisiones que tomamos. Algunas personas pueden pensar en consumir cuando atraviesan tristeza, estrés, enojo, soledad o presión.',
                blockTitle: 'Hay otras formas de afrontar lo que sentimos',
                blockText: 'Hablar con alguien de confianza, hacer actividad física, escuchar música, descansar, escribir lo que sentimos o buscar orientación son alternativas que pueden ayudar a afrontar momentos difíciles.',
                reflection: 'Muchas personas recurren al alcohol para silenciar emociones incómodas: la ansiedad, la soledad, el duelo o el estrés laboral. Al deprimir el sistema nervioso, el alcohol cumple temporalmente su promesa y adormece el cerebro. Sin embargo, el alcohol no elimina la emoción, solo la posterga. Al día siguiente, cuando el efecto desaparece, el cerebro sufre un desequilibrio químico (un bajón de dopamina y serotonina) que amplifica el malestar original, un fenómeno conocido popularmente como "ansiedad de resaca" '
            },
            'Presión social': {
                icon: 'fa-people-group',
                title: 'Presión social',
                intro: 'La presión social aparece cuando sentimos que debemos hacer algo para pertenecer, agradar a otras personas o evitar quedar fuera de un grupo.',
                blockTitle: 'Tu decisión sigue siendo tuya',
                blockText: 'Puedes expresar un límite, decir que no, cambiar de actividad, alejarte de una situación o pedir apoyo. No necesitas justificar una decisión que protege tu bienestar.',
                reflection: 'La verdadera madurez y el amor propio comienzan cuando entendemos que los límites personales no se negocian para asegurar la comodidad ajena. Establecer un límite no es un acto de agresión hacia el grupo; es un acto de respeto hacia uno mismo. Cuando alguien se mantiene firme en su decisión (como decidir no beber, retirarse temprano o no participar en una conversación tóxica)'
            },
            'Mitos y realidades': {
                icon: 'fa-comments',
                title: 'Mitos y realidades',
                intro: 'Alrededor del alcohol circulan muchas frases que se repiten como si fueran ciertas. Cuestionarlas ayuda a construir un criterio propio.',
                blockTitle: 'Aprende a cuestionar lo que escuchas',
                blockText: 'Antes de creer una afirmación sobre el alcohol, pregunta de dónde viene, qué evidencia la respalda y si se trata de una experiencia personal, una opinión o información confiable.',
                reflection: 'Si me presionan para tomar o hacer algo, es porque no me quieren en el grupo'
            },
            'Buscar apoyo también cuenta': {
                icon: 'fa-hand-holding-heart',
                title: 'Buscar apoyo también cuenta',
                intro: 'Hablar sobre una preocupación relacionada con el alcohol no tiene que ser un momento de juicio. Pedir ayuda puede ser una forma de cuidar de ti o de alguien cercano.',
                blockTitle: 'No tienes que resolverlo todo solo',
                blockText: 'Una persona adulta de confianza, un orientador, un profesional de salud u otro apoyo confiable puede ayudarte a entender una situación y encontrar opciones. Si existe una situación de riesgo inmediato, busca ayuda presencial de inmediato.',
                reflection: 'El conocimiento sin reflexión es solo información acumulada. Pero cuando conectas lo que sabes con lo que sientes, se transforma en sabiduría. Al entender cómo funciona tu cerebro, cómo se disfrazan tus emociones y cómo presiona el entorno, dejas de ser una víctima de las circunstancias. Te conviertes en el arquitecto de tus propios límites.'
            }
,
            'Mi bienestar, mi decisión': {
                icon: 'fa-seedling',
                title: 'Mi bienestar, mi decisión',
                intro: 'Cuidar de ti también implica reconocer lo que quieres para tu vida, tus metas y las decisiones que pueden acercarte o alejarte de ellas.',
                blockTitle: 'Tus metas también son una forma de cuidarte',
                blockText: 'Identificar personas de confianza, actividades que disfrutas y formas saludables de afrontar las dificultades puede ayudarte a tomar decisiones coherentes con tu bienestar y tu proyecto de vida.',
                reflection: 'Diseñar tu propio bienestar requiere el coraje de mirar hacia adentro, descubrir qué te da paz real y sostener esa verdad aunque sea diferente a la de los demás.'
            }
        };

        function openEducationModal(topic) {

            if (!educationModal) return;

            const content = educationalContent[topic];

            if (!content) return;

            if (modalTitle) {
                modalTitle.textContent = content.title || '';
            }

            if (modalIntro) {
                modalIntro.textContent = content.intro || '';
            }

            if (modalBlockTitle) {
                modalBlockTitle.textContent =
                    content.blockTitle || '';
            }

            if (modalBlockText) {
                modalBlockText.textContent =
                    content.blockText || '';
            }

            if (modalReflection) {
                modalReflection.textContent =
                    content.reflection || '';
            }

            if (modalIcon) {
                modalIcon.innerHTML =
                    '<i class="fa-solid ' +
                    content.icon +
                    '"></i>';
            }

            educationModal.classList.add('active');
            educationModal.setAttribute(
                'aria-hidden',
                'false'
            );

            document.body.classList.add('modal-open');
        }


        function closeEducationModal() {

            if (!educationModal) return;

            educationModal.classList.remove('active');

            educationModal.setAttribute(
                'aria-hidden',
                'true'
            );

            document.body.classList.remove('modal-open');
        }


        document
            .querySelectorAll('.mission-btn[data-topic]')
            .forEach(function (button) {

                button.addEventListener('click', function (event) {

                    event.preventDefault();

                    openEducationModal(
                        this.dataset.topic
                    );

                });

            });


        if (modalClose) {

            modalClose.addEventListener(
                'click',
                closeEducationModal
            );

        }


        if (educationModal) {

            educationModal.addEventListener(
                'click',
                function (event) {

                    if (
                        event.target === educationModal
                    ) {
                        closeEducationModal();
                    }

                }
            );

        }


        document.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Escape' &&
                    educationModal &&
                    educationModal.classList.contains('active')
                ) {
                    closeEducationModal();
                }

            }
        );

    </script>

</body>
</html>
