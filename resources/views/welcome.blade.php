<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Un Sorbito Hoy, Un Problema Mañana</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Nunito:wght@700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
:root{
  --tinta:#12303B; --teal:#1E6B73; --teal-osc:#154E55; --bruma:#EDF3F4;
  --latón:#B8842F; --texto:#2B3C45; --suave:#5A6B74; --linea:#D5E0E3; --blanco:#fff;
  --azul:#1A5E8A; --verde:#1E7A45;
  --serif:"Nunito","Trebuchet MS",Arial,sans-serif; --sans:"Inter",Arial,sans-serif;
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:var(--sans);font-size:18px;line-height:1.65;color:var(--texto);background:var(--blanco);overflow-x:hidden}
a{text-decoration:none;color:inherit}
img{max-width:100%;display:block}
:focus-visible{outline:3px solid var(--latón);outline-offset:3px}
h1,h2,h3{font-family:var(--serif);font-weight:800;color:var(--azul);line-height:1.15;letter-spacing:-.01em}
.wrap{width:min(1120px,100% - 40px);margin:0 auto}
.seccion{padding:88px 0}
.seccion h2{font-size:clamp(32px,5vw,48px);font-weight:900;margin-bottom:14px}
.lead{max-width:62ch;color:var(--texto);font-size:clamp(18px,2.2vw,21px);font-weight:500}

/* NAVBAR */
.nav{position:sticky;top:0;z-index:1000;background:var(--blanco);border-bottom:1px solid var(--linea)}
.nav .wrap{display:flex;align-items:center;justify-content:space-between;min-height:76px}
.logo{width:250px}
.nav-links{display:flex;align-items:center;gap:28px}
.nav-links a{font-weight:600;color:var(--tinta);padding:6px 0;border-bottom:2px solid transparent}
.nav-links a:hover{border-color:var(--latón)}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;padding:13px 26px;border-radius:8px;font-weight:700;font-size:17px;background:var(--teal);color:#fff!important;border:2px solid var(--teal);transition:background .2s}
.btn:hover{background:var(--teal-osc)}
.nav-links a.btn{border-bottom:2px solid var(--teal);padding:10px 22px}
.menu-btn{display:none;width:48px;height:48px;border:0;background:none;font-size:24px;color:var(--tinta);cursor:pointer}
.menu-movil{display:none;background:#fff;border-top:1px solid var(--linea);padding:8px 20px 18px}
.menu-movil.active{display:block}
.menu-movil a{display:block;padding:14px 4px;font-weight:600;border-bottom:1px solid var(--linea)}
.menu-movil a.btn{margin-top:14px;border:2px solid var(--teal)}

/* HERO */
.hero{position:relative;background:var(--bruma);--cta-x:73%;--cta-y:17%}
.hero img{width:100%;height:auto}
.btn-hero{position:absolute;left:var(--cta-x);bottom:var(--cta-y);transform:translateX(-50%);z-index:5;display:inline-flex;align-items:center;gap:12px;padding:16px 36px;border-radius:60px;background:linear-gradient(135deg,#F1C40F,#F39C12);color:var(--tinta);border:3px solid rgba(255,255,255,.9);font-family:var(--serif);font-weight:900;font-size:clamp(14px,2.2vw,24px);white-space:nowrap;box-shadow:0 8px 20px rgba(18,48,59,.28);transition:transform .2s,filter .2s}
.btn-hero:hover{transform:translateX(-50%) translateY(-3px);filter:brightness(1.05)}

/* PASOS */
.pasos{background:var(--blanco)}
.pasos-grid{display:grid;grid-template-columns:300px 1fr;gap:64px;align-items:start}
.guia img{width:100%;max-width:280px}
.guia-nota{margin-top:16px;padding:18px 20px;border-left:4px solid var(--latón);background:var(--bruma);border-radius:0 8px 8px 0}
.guia-nota strong{display:block;font-family:var(--serif);font-weight:800;color:var(--verde);font-size:20px;margin-bottom:4px}
.guia-nota p{font-size:16px;color:var(--suave)}
.lista-pasos{list-style:none;margin-top:36px;counter-reset:p;border-left:2px solid var(--linea);padding-left:0}
.lista-pasos li{counter-increment:p;position:relative;padding:0 0 30px 44px}
.lista-pasos li::before{content:counter(p);position:absolute;left:-17px;top:0;width:32px;height:32px;border-radius:50%;background:var(--teal);color:#fff;font-weight:700;font-size:16px;display:grid;place-items:center}
.lista-pasos h3{font-size:22px;color:var(--verde);margin-bottom:4px}
.lista-pasos p{color:var(--suave);max-width:60ch}
.compromiso{display:flex;gap:16px;align-items:center;padding:20px 24px;border:1px solid var(--linea);border-radius:10px;background:var(--bruma)}
.compromiso i{color:var(--teal);font-size:26px}
.compromiso strong{color:var(--tinta)}

/* TEMAS */
.temas{background:var(--bruma)}
.temas-lista{margin-top:40px;display:grid;gap:14px}
.tema{display:grid;grid-template-columns:64px 1fr auto;gap:22px;align-items:center;background:#fff;border:1px solid var(--linea);border-radius:10px;padding:22px 26px}
.tema-ico{width:56px;height:56px;border-radius:12px;background:var(--bruma);color:var(--teal);display:grid;place-items:center;font-size:24px}
.tema h3{font-size:24px;color:var(--verde);margin-bottom:4px}
.tema p{color:var(--suave);font-size:17px;max-width:64ch}
.tema button{font:inherit;font-weight:700;cursor:pointer;padding:12px 22px;border-radius:8px;border:2px solid var(--teal);background:#fff;color:var(--teal);white-space:nowrap;transition:.2s}
.tema button:hover{background:var(--teal);color:#fff}

/* LINEA 141 */
.linea{background:var(--tinta);color:#fff;padding:56px 0}
.linea .wrap{display:grid;grid-template-columns:150px 1fr auto;gap:36px;align-items:center}
.linea img{width:150px}
.linea h2{color:#fff;font-size:32px;font-weight:900;margin-bottom:6px}
.linea p{color:#CFDCE0;max-width:56ch}
.linea .btn{background:var(--latón);border-color:var(--latón);color:var(--tinta)!important;font-size:20px;padding:16px 30px}
.linea .btn:hover{background:#D19A3E}

/* POR QUE */
.porque-cab{display:grid;grid-template-columns:1fr 220px;gap:40px;align-items:center;margin-bottom:44px}
.porque-cab img{width:100%}

.razon{display:grid;grid-template-columns:44px 1fr;gap:16px;padding:24px 0;border-top:1px solid var(--linea)}
.razon i{font-size:22px;color:var(--teal);padding-top:4px}
.razon h3{font-size:22px;color:var(--verde);margin-bottom:4px}
.razon p{color:var(--suave);font-size:17px}
.pregunta{margin-top:36px;padding:26px 30px;background:var(--teal-osc);color:#fff;border-radius:10px;font-family:var(--serif);font-weight:800;font-size:24px}

/* MODAL */
.modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:20px;background:rgba(18,48,59,.7)}
.modal.active{display:flex}
.modal-caja{position:relative;width:min(640px,100%);max-height:90vh;overflow-y:auto;background:#fff;border-radius:12px;padding:38px 36px 32px}
.modal-cerrar{position:absolute;top:12px;right:12px;width:44px;height:44px;border:0;border-radius:50%;background:var(--bruma);font-size:18px;cursor:pointer;color:var(--tinta)}
.modal-ico{font-size:30px;color:var(--teal);margin-bottom:10px}
.modal h2{font-size:30px;font-weight:900;margin:0 40px 12px 0}
.modal-bloque{margin-top:20px;padding:16px 20px;border-left:4px solid var(--teal);background:var(--bruma);border-radius:0 8px 8px 0}
.modal-bloque h3{font-size:19px;color:var(--verde);margin-bottom:4px}
.modal-refl{margin-top:20px;padding-top:18px;border-top:1px solid var(--linea)}
.modal-refl strong{display:block;color:var(--latón);margin-bottom:4px}
body.modal-open{overflow:hidden}

/* ==========================================
   FOOTER INSTITUCIONAL
========================================== */

.footer-institucional {
    background: #123f68;
    color: #fff;
    margin-top: 70px;
    border-top: 4px solid #d6a72c;
}


/* CONTENEDOR PRINCIPAL */

.footer-container {
    width: min(1200px, calc(100% - 50px));
    margin: 0 auto;

    padding: 55px 0 48px;

    display: grid;
    grid-template-columns: 2.2fr 1fr 1.4fr;
    gap: 70px;

    align-items: start;
}


/* ==========================================
   IDENTIDAD
========================================== */

.footer-brand {
    display: flex;
    align-items: flex-start;
    gap: 25px;
}


/* Logo */

.footer-logo-box {
    width: 190px;
    min-width: 190px;
    height: 92px;

    background: #fff;

    border-radius: 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 10px;

    box-shadow: 0 4px 14px rgba(0,0,0,.08);
}

.footer-logo {
    width: 100%;
    height: 100%;
    object-fit: contain;
}


/* Texto institucional */

.footer-brand-text {
    max-width: 430px;
}

.footer-label {
    display: block;

    margin-bottom: 8px;

    color: #d6a72c;

    font-size: 11px;
    font-weight: 700;

    text-transform: uppercase;
    letter-spacing: 1.2px;
}


.footer-brand-text h3 {
    margin: 0 0 14px;

    color: #fff;

    font-size: 23px;
    line-height: 1.25;

    font-weight: 700;
}


.footer-brand-text p {
    margin: 0;

    color: rgba(255,255,255,.78);

    font-size: 13px;
    line-height: 1.7;
}


/* ==========================================
   COLUMNAS
========================================== */

.footer-column h4 {
    position: relative;

    margin: 0 0 22px;

    padding-bottom: 11px;

    color: #fff;

    font-size: 16px;
    font-weight: 700;
}


.footer-column h4::after {
    content: "";

    position: absolute;

    left: 0;
    bottom: 0;

    width: 34px;
    height: 3px;

    background: #d6a72c;

    border-radius: 3px;
}


.footer-column a {
    display: block;

    margin-bottom: 13px;

    color: rgba(255,255,255,.78);

    font-size: 13px;

    text-decoration: none;

    transition: .2s ease;
}


.footer-column a:hover {
    color: #fff;
    transform: translateX(3px);
}


.footer-column p {
    margin: 0;

    color: rgba(255,255,255,.78);

    font-size: 13px;
    line-height: 1.7;
}


/* ==========================================
   BARRA INFERIOR
========================================== */

.footer-bottom {
    width: min(1200px, calc(100% - 50px));

    margin: 0 auto;

    padding: 19px 0;

    border-top: 1px solid rgba(255,255,255,.16);

    display: flex;

    align-items: center;
    justify-content: space-between;

    gap: 20px;

    color: rgba(255,255,255,.62);

    font-size: 11px;
    line-height: 1.5;
}


/* ==========================================
   RESPONSIVE
========================================== */

@media (max-width: 900px) {

    .footer-container {
        grid-template-columns: 1fr 1fr;
        gap: 45px;
    }

    .footer-brand {
        grid-column: 1 / -1;
    }

}


@media (max-width: 600px) {

    .footer-container {
        width: min(100% - 35px, 500px);

        grid-template-columns: 1fr;

        gap: 35px;

        padding: 40px 0;
    }

    .footer-brand {
        flex-direction: column;

        gap: 20px;
    }

    .footer-logo-box {
        width: 190px;
        height: 88px;
    }

    .footer-brand-text {
        max-width: none;
    }

    .footer-brand-text h3 {
        font-size: 21px;
    }

    .footer-bottom {
        width: min(100% - 35px, 500px);

        flex-direction: column;

        align-items: flex-start;

        text-align: left;

        padding: 18px 0;
    }

}

@media (max-width:900px){
  .pasos-grid{grid-template-columns:1fr;gap:36px}
  .guia{display:grid;grid-template-columns:140px 1fr;gap:20px;align-items:center}
  .guia-nota{margin-top:0}
  .linea .wrap{grid-template-columns:1fr;text-align:center;justify-items:center}
  .linea img{width:110px}
}
@media (max-width:768px){
  body{font-size:17px}
  .seccion h2{font-size:clamp(30px,8.5vw,38px)}
  .seccion{padding:60px 0}
  .nav-links{display:none}
  .menu-btn{display:grid;place-items:center}
  .logo{width:180px}
  .btn-hero{padding:10px 22px;border-width:2px;bottom:6%;background:var(#f1c40f);--cta-x:55%;--cta-y:17%}
  .tema{grid-template-columns:52px 1fr;padding:18px}
  .tema button{grid-column:1/-1;width:100%}
  .porque-cab{grid-template-columns:1fr}
  .porque-cab img{max-width:160px;order:-1}
  .modal-caja{padding:30px 22px 24px}
  .guia{grid-template-columns:1fr}
  .guia img{max-width:180px;margin-left:80px}
}

.btn-guia-audio{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:8px;
  margin-top:14px;
  padding:10px 16px;
  border:2px solid var(--teal);
  border-radius:999px;
  background:#fff;
  color:var(--teal);
  font:700 15px var(--sans);
  cursor:pointer;
  transition:background .2s,color .2s,transform .2s;
}
.btn-guia-audio:hover{
  background:var(--teal);
  color:#fff;
  transform:translateY(-1px);
}
.controles-guia-audio{
  display:flex !important;
  flex-direction:column !important;
  align-items:flex-start !important;
  gap:10px !important;
  width:100% !important;
  margin-top:14px !important;
}
.controles-guia-audio .btn-guia-audio,
.controles-guia-audio .btn-guia-detener{
  display:inline-flex !important;
  visibility:visible !important;
  opacity:1 !important;
  position:relative !important;
  width:auto !important;
  min-height:40px;
  margin:0 !important;
  align-items:center;
  justify-content:center;
  gap:8px;
  padding:10px 16px;
  border-radius:999px;
  font:700 15px var(--sans);
  cursor:pointer;
  box-sizing:border-box;
}
.controles-guia-audio .btn-guia-audio{
  border:2px solid var(--teal);
  background:#fff;
  color:var(--teal);
}
.controles-guia-audio .btn-guia-detener{
  border:2px solid #C94B42;
  background:#fff;
  color:#B63B33;
}
.controles-guia-audio .btn-guia-detener:hover,
.controles-guia-audio .btn-guia-detener.activo{
  background:#C94B42;
  color:#fff;
}
@media (max-width:600px){
  .controles-guia-audio{
    align-items:flex-start !important;
  }
  .controles-guia-audio .btn-guia-audio,
  .controles-guia-audio .btn-guia-detener{
    width:auto !important;
    max-width:100%;
  }
}

.btn-guia-audio.hablando{
  background:var(--teal);
  color:#fff;
}
@media (prefers-reduced-motion:reduce){
  .btn-guia-audio{transition:none!important}
}

@media (prefers-reduced-motion:reduce){*{scroll-behavior:auto!important;transition:none!important}}
</style>
</head>
<body>

<header class="nav">
  <div class="wrap">
    <a href="{{ url('/') }}" aria-label="Inicio">
      <img src="{{ asset('build/img/logo.WebP') }}" alt="Ponte Pilas" class="logo">
    </a>
    <nav class="nav-links" aria-label="Principal">
      <a href="{{ url('/') }}">Inicio</a>
      <a href="{{ route('aprende.index') }}">Temas</a>
      <a href="{{ route('participacion.create') }}">¿Cómo participar?</a>
      <a href="#nosotros">Sobre el programa</a>
      <a class="btn" href="{{ route('login') }}"><i class="fa-solid fa-user"></i> Ingresar</a>
    </nav>
    <button type="button" class="menu-btn" id="menuMobile" aria-label="Abrir menú" aria-expanded="false">
      <i class="fa-solid fa-bars"></i>
    </button>
  </div>
  <div class="menu-movil" id="mobileMenu">
    <a href="#inicio">Inicio</a>
    <a href="#como-funciona">¿Cómo participar?</a>
    <a href="{{ route('participacion.create') }}">Aprende</a>
    <a href="#nosotros">Sobre el programa</a>
    <a href="{{ route('login') }}" class="btn"><i class="fa-solid fa-user"></i> Ingresar</a>
  </div>
</header>

<section class="hero" id="inicio">
  <picture>
    <source media="(max-width: 768px)" srcset="{{ asset('build/img/banner-mobile.webp') }}">
    <img src="{{ asset('build/img/banner.WebP') }}" alt="Mi Decisión">
  </picture>
  <a href="{{ route('participacion.create') }}" class="btn-hero" aria-label="Quiero conocer los temas">QUIERO CONOCER <i class="fa-solid fa-chevron-right"></i></a>
</section>

<section class="seccion pasos" id="como-funciona">
  <div class="wrap pasos-grid">
    <div class="guia">
      <img src="{{ asset('build/img/avatars/niño.webp') }}" alt="Guía de la plataforma">
      <div class="guia-nota">
        <strong>¡Hola! Soy tu guía</strong>
        <p>
          Te acompañaré durante este recorrido por
          <strong>Un Sorbito Hoy, Un Problema Mañana</strong>.
          Aquí encontrarás información y herramientas para fortalecer
          la prevención desde el hogar.
        </p>
        <div class="controles-guia-audio">
          <button type="button" id="btnHablarGuia" class="btn-guia-audio" aria-label="Escuchar a la guía">
            <i class="fa-solid fa-volume-high"></i>
            <span>Escuchar a la guía</span>
          </button>
          <button type="button" id="btnDetenerGuia" class="btn-guia-detener"
                  aria-label="Detener el audio de la guía">
            <i class="fa-solid fa-stop"></i>
            <span>Detener audio</span>
          </button>
        </div>
        <audio id="audioGuia" preload="auto">
            <source src="{{ asset('build/audio/guia_bienvenida.mp3') }}" type="audio/mpeg">
            Su navegador no admite la reproducción de audio.
        </audio>


        
      </div>
    </div>
    <div>
      <h2>¿Cómo participar?</h2>
      <p class="lead">Siga estos pasos para comenzar en <strong>Un Sorbito Hoy, Un Problema Mañana</strong>.</p>
      <ol class="lista-pasos">
        <li><h3>Ingrese a “¿Cómo participar?”</h3><p>Haga clic en el botón <strong>“¿Cómo participar?”</strong> para iniciar.</p></li>
        <li><h3>Complete el formulario</h3><p>Es un formulario breve con los datos necesarios para comenzar.</p></li>
        <li><h3>Elija su avatar</h3><p>Seleccione el personaje que representa su rol: madre, padre, abuela, abuelo, tía, tío, cuidadora o cuidador.</p></li>
        <li><h3>Conozca a su guía</h3><p>Su avatar lo acompañará durante el recorrido y lo orientará en cada sección.</p></li>
        <li><h3>Explore y participe</h3><p>Revise los contenidos, reflexione y encuentre herramientas para fortalecer la prevención en casa.</p></li>
      </ol>
      <div class="compromiso">
        <i class="fa-solid fa-heart"></i>
        <div><strong>Su participación importa.</strong> Puede marcar la diferencia en la vida de su hijo/a.</div>
      </div>
    </div>
  </div>
</section>
<!--
<section class="seccion temas" id="misiones">
  <div class="wrap">
    <h2>Conozca y reflexione</h2>
    <p class="lead">Contenidos pensados para comprender el consumo de alcohol y sus consecuencias en la familia.</p>
    <div class="temas-lista">
      <article class="tema">
        <div class="tema-ico"><i class="fa-solid fa-wine-bottle"></i></div>
        <div><h3>¿Qué es el alcohol?</h3><p>Qué es, cómo actúa en el organismo y por qué su consumo en la adolescencia puede afectar el desarrollo.</p></div>
        <button type="button" data-topic="¿Qué es el alcohol?">Conocer tema</button>
      </article>
      <article class="tema">
        <div class="tema-ico"><i class="fa-solid fa-brain"></i></div>
        <div><h3>Prevenir es manejar nuestras emociones</h3><p>Cómo las emociones influyen en las decisiones y qué alternativas saludables existen para afrontarlas.</p></div>
        <button type="button" data-topic="Alcohol y emociones">Reflexionar</button>
      </article>
      <article class="tema">
        <div class="tema-ico"><i class="fa-solid fa-people-group"></i></div>
        <div><h3>Presión social</h3><p>Cómo identificar situaciones de presión y expresar decisiones con seguridad y respeto.</p></div>
        <button type="button" data-topic="Presión social">Comprender</button>
      </article>
      <article class="tema">
        <div class="tema-ico"><i class="fa-solid fa-comments"></i></div>
        <div><h3>Mitos y realidades</h3><p>Ideas comunes sobre el alcohol, contrastadas con información confiable para formar criterio propio.</p></div>
        <button type="button" data-topic="Mitos y realidades">Ver información</button>
      </article>
      <article class="tema">
        <div class="tema-ico"><i class="fa-solid fa-seedling"></i></div>
        <div><h3>Mi bienestar, mi decisión</h3><p>Reconocer metas, fortalezas y redes de apoyo para construir un proyecto de vida que cuide lo importante.</p></div>
        <button type="button" data-topic="Mi bienestar, mi decisión">Entender</button>
      </article>
    </div>
  </div>
</section>-->

<section class="linea" aria-label="Línea de apoyo">
  <div class="wrap">
    <img src="{{ asset('build/img/avatar-banner.webp') }}" alt="MI DECISIÓN">
    <div>
      <h2>¿Necesita hablar con alguien?</h2>
      <p>Si busca orientación, apoyo o simplemente que alguien lo escuche, llame gratis a la <strong>Línea #141</strong>.</p>
    </div>
    <a href="tel:141" class="btn"><i class="fa-solid fa-phone"></i> Llamar al #141</a>
  </div>
</section>

<!--
<section class="seccion" id="por-que-alcohol">
  <div class="wrap">
    <div class="porque-cab">
      <div>
        <h2>¿Por qué se consume alcohol?</h2>
        <p class="lead">No siempre se trata de la bebida. A veces se trata de lo que una persona está viviendo.</p>
      </div>
      <img src="{{ asset('build/img/avatar-consume.webp') }}" alt="Avatar MI DECISIÓN" loading="lazy">
    </div>
    <div class="razones">
      <div class="razon"><i class="fa-solid fa-users"></i><div><h3>Presión social</h3><p>Querer encajar, pertenecer o sentir que todos esperan que se consuma.</p></div></div>
      <div class="razon"><i class="fa-solid fa-heart-crack"></i><div><h3>Emociones</h3><p>Buscar una forma de escapar, por un momento, de lo que se siente.</p></div></div>
      <div class="razon"><i class="fa-solid fa-music"></i><div><h3>Diversión</h3><p>Fiestas y reuniones, con la idea de que beber hace mejor el momento.</p></div></div>
      <div class="razon"><i class="fa-solid fa-bullhorn"></i><div><h3>Influencia del entorno</h3><p>Redes, publicidad, amistades y costumbres pueden hacer que el consumo parezca normal.</p></div></div>
      <div class="razon"><i class="fa-solid fa-flask"></i><div><h3>Curiosidad</h3><p>Querer experimentar o saber qué se siente puede ser el comienzo.</p></div></div>
    </div>
   
  </div>
</section>-->

<div class="modal" id="educationModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
  <div class="modal-caja">
    <button type="button" class="modal-cerrar" id="modalClose" aria-label="Cerrar"><i class="fa-solid fa-xmark"></i></button>
    <div class="modal-ico" id="modalIcon"><i class="fa-solid fa-book-open"></i></div>
    <h2 id="modalTitle">Información</h2>
    <p id="modalIntro"></p>
    <div class="modal-bloque"><h3 id="modalBlockTitle"></h3><p id="modalBlockText"></p></div>
    <div class="modal-refl"><strong><i class="fa-solid fa-lightbulb"></i> Para reflexionar</strong><p id="modalReflection"></p></div>
  </div>
</div>

<footer id="nosotros" class="footer-institucional">

    <div class="footer-container">

        <!-- Identidad -->
        <div class="footer-brand">

            <div class="footer-logo-box">
                <img
                    src="{{ asset('build/img/logo.webp') }}"
                    alt="Alcaldía de Armenia y Red Salud Armenia E.S.E."
                    class="footer-logo"
                >
            </div>

            <div class="footer-brand-text">
                <span class="footer-label">
                    Estrategia de prevención y educación
                </span>

                <h3>
                    Un Sorbito Hoy,<br>
                    Un Problema Mañana
                </h3>

                <p>
                    Espacio educativo orientado a la promoción de la prevención
                    del consumo de alcohol y al fortalecimiento de decisiones
                    conscientes en niños, niñas, adolescentes y sus familias.
                </p>
            </div>

        </div>


        <!-- Información -->
        <div class="footer-column">

            <h4>Información</h4>

            <a href="#como-funciona">
                ¿Cómo participar?
            </a>

            <a href="#nosotros">
                Sobre nosotros
            </a>

            <a href="{{ route('home') }}">
                Inicio
            </a>

        </div>


        <!-- Propósito -->
        <div class="footer-column">

            <h4>Nuestro propósito</h4>

            <p>
                Promover espacios de información, orientación y reflexión
                que contribuyan a la prevención del consumo de alcohol,
                fortaleciendo el acompañamiento familiar y la toma de
                decisiones conscientes.
            </p>

        </div>

    </div>


    <!-- Línea inferior -->
    <div class="footer-bottom">

        <span>
            © {{ date('Y') }} Un Sorbito Hoy, Un Problema Mañana.
            Todos los derechos reservados.
        </span>

        <span>
            Estrategia educativa para la prevención.
        </span>

    </div>

</footer>

<script>
const menuBtn = document.getElementById('menuMobile');
const menu = document.getElementById('mobileMenu');
menuBtn.addEventListener('click', () => {
  const abierto = menu.classList.toggle('active');
  menuBtn.setAttribute('aria-expanded', abierto);
});
menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
  menu.classList.remove('active'); menuBtn.setAttribute('aria-expanded', 'false');
}));

const modal = document.getElementById('educationModal');
const $ = id => document.getElementById(id);
const contenido = {
  '¿Qué es el alcohol?': {icon:'fa-wine-bottle', intro:'El alcohol es una sustancia psicoactiva que puede modificar la actividad del sistema nervioso y la forma en que una persona piensa, siente y actúa.', bt:'¿Por qué es importante conocerlo?', bx:'Conocer sus efectos ayuda a comprender que el consumo puede influir en la atención, la coordinación, el juicio y la capacidad de decidir. En la adolescencia, contar con información clara es especialmente importante.', rf:'El alcohol está muy arraigado en la cultura y en las reuniones sociales. Muchas veces se usa para relajarse o quitar la timidez. Sin embargo, normalizar su consumo hace que olvidemos sus riesgos reales para la salud física y mental.'},
  'Alcohol y emociones': {icon:'fa-face-smile', intro:'Lo que sentimos influye en las decisiones que tomamos. Ante la tristeza, el estrés, el enojo, la soledad o la presión, algunas personas piensan en consumir.', bt:'Hay otras formas de afrontar lo que sentimos', bx:'Hablar con alguien de confianza, hacer actividad física, escuchar música, descansar, escribir lo que se siente o buscar orientación son alternativas que ayudan en momentos difíciles.', rf:'El alcohol no elimina la emoción, solo la posterga. Al día siguiente, cuando el efecto pasa, el malestar original suele volver con más fuerza.'},
  'Presión social': {icon:'fa-people-group', intro:'La presión social aparece cuando sentimos que debemos hacer algo para pertenecer, agradar o evitar quedar fuera de un grupo.', bt:'La decisión sigue siendo suya', bx:'Se puede expresar un límite, decir que no, cambiar de actividad, alejarse de una situación o pedir apoyo. No hace falta justificar una decisión que protege el bienestar.', rf:'Establecer un límite no es un acto de agresión hacia el grupo; es un acto de respeto hacia uno mismo.'},
  'Mitos y realidades': {icon:'fa-comments', intro:'Alrededor del alcohol circulan muchas frases que se repiten como si fueran ciertas. Cuestionarlas ayuda a construir un criterio propio.', bt:'Aprenda a cuestionar lo que escucha', bx:'Antes de creer una afirmación sobre el alcohol, pregunte de dónde viene, qué evidencia la respalda y si es una experiencia personal, una opinión o información confiable.', rf:'Un mito frecuente: “si me presionan para tomar, es porque no me quieren en el grupo”. ¿Qué otra explicación podría haber?'},
  'Mi bienestar, mi decisión': {icon:'fa-seedling', intro:'Cuidarse también implica reconocer lo que se quiere para la vida, las metas y las decisiones que acercan o alejan de ellas.', bt:'Las metas también son una forma de cuidarse', bx:'Identificar personas de confianza, actividades que se disfrutan y formas saludables de afrontar las dificultades ayuda a decidir de acuerdo con el bienestar y el proyecto de vida.', rf:'Diseñar el propio bienestar requiere el coraje de mirar hacia adentro y descubrir qué da paz real, aunque sea distinto de lo que hacen los demás.'}
};

function abrir(tema) {
  const c = contenido[tema]; if (!c) return;
  $('modalTitle').textContent = tema;
  $('modalIntro').textContent = c.intro;
  $('modalBlockTitle').textContent = c.bt;
  $('modalBlockText').textContent = c.bx;
  $('modalReflection').textContent = c.rf;
  $('modalIcon').innerHTML = '<i class="fa-solid ' + c.icon + '"></i>';
  modal.classList.add('active'); modal.setAttribute('aria-hidden', 'false');
  document.body.classList.add('modal-open'); $('modalClose').focus();
}
function cerrar() {
  modal.classList.remove('active'); modal.setAttribute('aria-hidden', 'true');
  document.body.classList.remove('modal-open');
}
document.querySelectorAll('.tema button[data-topic]').forEach(b => b.addEventListener('click', () => abrir(b.dataset.topic)));
$('modalClose').addEventListener('click', cerrar);
modal.addEventListener('click', e => { if (e.target === modal) cerrar(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape' && modal.classList.contains('active')) cerrar(); });

/* =========================================================
   AUDIO REAL DE LA GUÍA
   Se reproduce al entrar y continúa con el siguiente audio
========================================================= */

const audioGuia = document.getElementById('audioGuia');
const btnHablarGuia = document.getElementById('btnHablarGuia');
const btnDetenerGuia = document.getElementById('btnDetenerGuia');
let guiaDetenidaManualmente = false;

const audiosGuia = [
    "{{ asset('build/audio/guia_bienvenida.mp3') }}",
    "{{ asset('build/audio/guia_siguiente_paso.mp3') }}"
];

let audioActual = 0;
let autoplayIntentado = false;

function actualizarBotonAudio(hablando) {
    if (!btnHablarGuia) return;

    const icono = btnHablarGuia.querySelector('i');
    const texto = btnHablarGuia.querySelector('span');

    if (btnDetenerGuia) {
        btnDetenerGuia.setAttribute('aria-disabled', hablando ? 'false' : 'true');
        btnDetenerGuia.classList.toggle('activo', hablando);
    }

    if (hablando) {
        if (icono) icono.className = 'fa-solid fa-volume-high';
        if (texto) texto.textContent = 'Hablando...';
        btnHablarGuia.classList.add('hablando');
    } else {
        if (icono) icono.className = 'fa-solid fa-volume-high';
        if (texto) texto.textContent = 'Escuchar a la guía';
        btnHablarGuia.classList.remove('hablando');
    }
}

function cargarAudio(indice) {
    if (!audioGuia || !audiosGuia[indice]) return;

    audioActual = indice;
    audioGuia.src = audiosGuia[audioActual];
    audioGuia.load();
}

function reproducirGuia(indice = audioActual) {
    if (!audioGuia || !audiosGuia[indice]) return;

    cargarAudio(indice);

    const reproduccion = audioGuia.play();

    if (reproduccion !== undefined) {
        reproduccion
            .then(function () {
                actualizarBotonAudio(true);
            })
            .catch(function (error) {
                console.log('El navegador bloqueó el autoplay:', error);
                actualizarBotonAudio(false);
            });
    }
}

if (audioGuia) {

    audioGuia.addEventListener('play', function () {
        actualizarBotonAudio(true);
    });

    audioGuia.addEventListener('ended', function () {

        actualizarBotonAudio(false);

        if (guiaDetenidaManualmente) {
            guiaDetenidaManualmente = false;
            audioActual = 0;
            return;
        }

        audioActual++;

        if (audioActual < audiosGuia.length) {

            /*
             * Cuando termina un audio,
             * carga y reproduce automáticamente el siguiente.
             */
            setTimeout(function () {
                reproducirGuia(audioActual);
            }, 300);

        } else {

            audioActual = 0;
        }
    });

    audioGuia.addEventListener('pause', function () {
        actualizarBotonAudio(false);
    });

    audioGuia.addEventListener('error', function () {
        console.warn('No se pudo cargar el audio:', audiosGuia[audioActual]);
        actualizarBotonAudio(false);
    });
}

/* Botón para detener toda la secuencia */
if (btnDetenerGuia) {
    btnDetenerGuia.addEventListener('click', function () {
        if (!audioGuia) return;

        guiaDetenidaManualmente = true;
        audioGuia.pause();
        audioGuia.currentTime = 0;
        audioActual = 0;
        actualizarBotonAudio(false);
    });
}

/* Botón para repetir desde el primer audio */
if (btnHablarGuia) {

    btnHablarGuia.addEventListener('click', function () {

        if (!audioGuia) return;

        guiaDetenidaManualmente = false;

        if (!audioGuia.paused) {

            audioGuia.pause();
            audioGuia.currentTime = 0;
            actualizarBotonAudio(false);

        } else {

            audioActual = 0;
            reproducirGuia(0);
        }
    });
}

/*
 * AUTOPLAY:
 * intenta reproducir el primer audio apenas termina
 * de cargar la página.
 */
window.addEventListener('load', function () {

    if (autoplayIntentado) return;

    autoplayIntentado = true;

    setTimeout(function () {
        if (!guiaDetenidaManualmente) {
            reproducirGuia(0);
        }
    }, 300);

});

/*
 * Algunos navegadores pueden necesitar que el documento
 * esté completamente cargado antes de permitir la carga.
 */
document.addEventListener('DOMContentLoaded', function () {

    if (!autoplayIntentado) {

        autoplayIntentado = true;

        setTimeout(function () {
            reproducirGuia(0);
        }, 300);
    }
});

window.addEventListener('beforeunload', function () {

    if (audioGuia) {
        audioGuia.pause();
        audioGuia.currentTime = 0;
    }
});
</script>

</body>
</html>