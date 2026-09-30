<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Un Sorbito Hoy, Un Problema Mañana</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Nunito:wght@700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
:root{
  --azul:#2469b3; --azul-osc:#17457c; --verde:#1f7a55; --verde-suave:#e6f4ec;
  --oro:#e9b530; --oro-suave:#fdf3d3; --oro-tinta:#7a5a05;
  --tinta:#152d4f; --texto:#1d2b40; --suave:#55657a;
  --crema:#fbf8f2; --linea:#e7e1d4; --blanco:#fff;
  --titulo:"Nunito","Trebuchet MS",Arial,sans-serif; --cuerpo:"Inter",Arial,sans-serif;
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:var(--cuerpo);font-size:18px;line-height:1.65;color:var(--texto);background:var(--blanco);overflow-x:hidden;-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}
img{max-width:100%;display:block}
:focus-visible{outline:3px solid var(--oro);outline-offset:3px}
h1,h2,h3{font-family:var(--titulo);font-weight:800;color:var(--azul-osc);line-height:1.15;letter-spacing:-.01em}
.wrap{width:min(1120px,100% - 40px);margin:0 auto}
.seccion{padding:88px 0}
.seccion h2{font-size:clamp(32px,5vw,48px);font-weight:900;margin-bottom:14px}
.lead{max-width:62ch;font-size:clamp(18px,2.2vw,21px);font-weight:500;color:#48576b}

/* NAVBAR */
.nav{position:sticky;top:0;z-index:1000;background:var(--blanco);border-bottom:1px solid var(--linea)}
.nav .wrap{display:flex;align-items:center;justify-content:space-between;min-height:76px}
.logo{width:250px}
.nav-links{display:flex;align-items:center;gap:28px}
.nav-links a{padding:6px 0;border-bottom:2px solid transparent;font-weight:600;color:var(--tinta)}
.nav-links a:hover{border-color:var(--oro)}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;padding:13px 26px;border:2px solid var(--azul);border-radius:12px;background:var(--azul);color:#fff!important;font-weight:700;font-size:17px;transition:background .2s,transform .2s}
.btn:hover{background:var(--azul-osc);transform:translateY(-1px)}
.nav-links a.btn{padding:10px 22px;border-bottom:2px solid var(--azul)}
.menu-btn{display:none;width:48px;height:48px;border:0;border-radius:12px;background:#eaf2fc;font-size:22px;color:var(--azul-osc);cursor:pointer}
.menu-movil{display:none;padding:8px 20px 18px;background:#fff;border-top:1px solid var(--linea)}
.menu-movil.active{display:block}
.menu-movil a{display:block;padding:14px 4px;border-bottom:1px solid var(--linea);font-weight:600}
.menu-movil a.btn{margin-top:14px;border-bottom:2px solid var(--azul)}

/* HERO */
.hero{position:relative;background:var(--crema)}
.hero img{width:100%;height:auto}
.btn-hero{position:absolute;left:73%;bottom:17%;transform:translateX(-50%);z-index:5;display:inline-flex;align-items:center;gap:12px;padding:16px 36px;border:3px solid rgba(255,255,255,.9);border-radius:60px;background:linear-gradient(135deg,#f1c40f,#f39c12);color:var(--tinta);font-family:var(--titulo);font-weight:900;font-size:clamp(14px,2.2vw,24px);white-space:nowrap;box-shadow:0 8px 20px rgba(21,45,79,.28);transition:transform .2s,filter .2s}
.btn-hero:hover{transform:translateX(-50%) translateY(-3px);filter:brightness(1.05)}

/* PASOS */
.pasos{background:var(--crema)}
.pasos-grid{display:grid;grid-template-columns:300px 1fr;gap:64px;align-items:start}
.guia img{width:100%;max-width:280px;transform-origin:50% 100%}
.guia.hablando img{animation:hablar .55s ease-in-out infinite alternate}
@keyframes hablar{from{transform:translateY(0) scale(1)}to{transform:translateY(-4px) scale(1.02)}}
.guia-nota{margin-top:16px;padding:20px 22px;border:1px solid #f0d99a;border-left:5px solid var(--oro);border-radius:0 14px 14px 0;background:var(--oro-suave)}
.guia-nota>strong{display:block;margin-bottom:6px;font-family:var(--titulo);font-weight:800;font-size:22px;color:var(--azul-osc)}
.guia-nota p{font-size:16px;color:#4a4a3a}
.guia-audio{display:flex;flex-wrap:wrap;gap:10px;margin-top:16px}
.btn-audio{display:inline-flex;align-items:center;gap:8px;min-height:44px;padding:10px 18px;border:2px solid var(--azul);border-radius:99px;background:#fff;color:var(--azul);font:700 16px var(--cuerpo);cursor:pointer;transition:background .2s,color .2s}
.btn-audio:hover,.btn-audio.hablando{background:var(--azul);color:#fff}
.btn-audio.detener{border-color:#c94b42;color:#b63b33}
.btn-audio.detener:hover{background:#c94b42;color:#fff}
.btn-audio[hidden]{display:none}
.lista-pasos{list-style:none;margin:36px 0;counter-reset:p;border-left:2px solid var(--linea)}
.lista-pasos li{counter-increment:p;position:relative;padding:0 0 30px 44px}
.lista-pasos li::before{content:counter(p);position:absolute;left:-17px;top:0;width:34px;height:34px;display:grid;place-items:center;border-radius:50%;background:var(--azul);color:#fff;font-weight:700;font-size:16px;box-shadow:0 0 0 5px var(--crema)}
.lista-pasos h3{margin-bottom:4px;font-size:23px;color:var(--verde)}
.lista-pasos p{max-width:60ch;color:var(--suave)}
.compromiso{display:flex;gap:16px;align-items:center;padding:20px 24px;border:1px solid var(--linea);border-radius:16px;background:#fff}
.compromiso i{font-size:28px;color:#d6453d}
.compromiso strong{color:var(--azul-osc)}

/* TEMAS (imagen) */
.temas{background:var(--blanco)}
.temas-imagen-wrap{width:min(1120px,100% - 40px);margin:0 auto}
.temas-imagen-ayuda{text-align:center}
.temas-imagen{width:100%;height:auto;border-radius:20px;box-shadow:0 14px 40px rgba(21,45,79,.12)}

/* LINEA 141 */
.linea{padding:56px 0;background:var(--tinta);color:#fff}
.linea .wrap{display:grid;grid-template-columns:150px 1fr auto;gap:36px;align-items:center}
.linea img{width:150px}
.linea h2{margin-bottom:6px;font-size:clamp(26px,3.6vw,34px);font-weight:900;color:#fff}
.linea p{max-width:56ch;color:#d3deea}
.linea .btn{padding:16px 30px;border-color:var(--oro);background:var(--oro);color:var(--tinta)!important;font-size:20px}
.linea .btn:hover{background:#f2c54a}

/* MODAL */
.modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:20px;background:rgba(21,45,79,.7)}
.modal.active{display:flex}
.modal-caja{position:relative;width:min(640px,100%);max-height:90vh;overflow-y:auto;padding:38px 36px 32px;border-radius:20px;background:#fff}
.modal-cerrar{position:absolute;top:12px;right:12px;width:44px;height:44px;border:0;border-radius:50%;background:var(--crema);font-size:18px;color:var(--tinta);cursor:pointer}
.modal-ico{margin-bottom:10px;font-size:30px;color:var(--azul)}
.modal h2{margin:0 40px 12px 0;font-size:30px;font-weight:900}
.modal-bloque{margin-top:20px;padding:16px 20px;border-left:4px solid var(--azul);border-radius:0 12px 12px 0;background:#eaf2fc}
.modal-bloque h3{margin-bottom:4px;font-size:20px;color:var(--verde)}
.modal-refl{margin-top:20px;padding-top:18px;border-top:1px solid var(--linea)}
.modal-refl strong{display:block;margin-bottom:4px;color:var(--oro-tinta)}
body.modal-open{overflow:hidden}

/* FOOTER */
.footer-institucional{margin-top:0;border-top:4px solid var(--oro);background:#123f68;color:#fff}
.footer-container{width:min(1200px,calc(100% - 50px));margin:0 auto;padding:56px 0 48px;display:grid;grid-template-columns:2.2fr 1fr 1.4fr;gap:64px;align-items:start}
.footer-brand{display:flex;align-items:flex-start;gap:25px}
.footer-logo-box{width:190px;min-width:190px;height:92px;display:flex;align-items:center;justify-content:center;padding:10px;border-radius:14px;background:#fff;box-shadow:0 4px 14px rgba(0,0,0,.08)}
.footer-logo{width:100%;height:100%;object-fit:contain}
.footer-brand-text{max-width:440px}
.footer-label{display:block;margin-bottom:8px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--oro)}
.footer-brand-text h3{margin:0 0 14px;font-size:26px;line-height:1.25;color:#fff}
.footer-brand-text p,.footer-column p{font-size:16px;line-height:1.7;color:rgba(255,255,255,.85)}
.footer-column h4{position:relative;margin:0 0 22px;padding-bottom:11px;font-family:var(--titulo);font-size:19px;font-weight:800;color:#fff}
.footer-column h4::after{content:"";position:absolute;left:0;bottom:0;width:34px;height:3px;border-radius:3px;background:var(--oro)}
.footer-column a{display:block;margin-bottom:13px;font-size:16px;color:rgba(255,255,255,.85);transition:color .2s,transform .2s}
.footer-column a:hover{color:#fff;transform:translateX(3px)}
.footer-bottom{width:min(1200px,calc(100% - 50px));margin:0 auto;padding:20px 0;display:flex;align-items:center;justify-content:space-between;gap:20px;border-top:1px solid rgba(255,255,255,.18);font-size:14px;line-height:1.5;color:rgba(255,255,255,.75)}

/* RESPONSIVE */
@media (max-width:900px){
  .pasos-grid{grid-template-columns:1fr;gap:36px}
  .guia{display:grid;grid-template-columns:150px 1fr;gap:20px;align-items:center}
  .guia-nota{margin-top:0}
  .linea .wrap{grid-template-columns:1fr;text-align:center;justify-items:center}
  .linea img{width:110px}
  .footer-container{grid-template-columns:1fr 1fr;gap:44px}
  .footer-brand{grid-column:1 / -1}
}
@media (max-width:768px){
  body{font-size:17px}
  .seccion{padding:60px 0}
  .seccion h2{font-size:clamp(30px,8.5vw,38px)}
  .nav-links{display:none}
  .menu-btn{display:grid;place-items:center}
  .logo{width:180px}
  .btn-hero{left:55%;bottom:6%;padding:10px 22px;border-width:2px}
  .guia{grid-template-columns:1fr;justify-items:center;text-align:left}
  .guia img{max-width:180px}
  .guia-nota{width:100%}
  .modal-caja{padding:30px 22px 24px}
}
@media (max-width:600px){
  .footer-container{width:min(100% - 35px,500px);grid-template-columns:1fr;gap:34px;padding:40px 0}
  .footer-brand{flex-direction:column;gap:20px}
  .footer-logo-box{width:190px;height:88px}
  .footer-brand-text{max-width:none}
  .footer-bottom{width:min(100% - 35px,500px);flex-direction:column;align-items:flex-start;padding:18px 0}
}
@media (prefers-reduced-motion:reduce){*,*::before,*::after{scroll-behavior:auto!important;transition:none!important;animation:none!important}}
</style>
</head>
<body>

<header class="nav">
  <div class="wrap">
    <a href="{{ url('/') }}" aria-label="Inicio">
      <img src="{{ asset('build/img/logo.webp') }}" alt="Ponte Pilas" class="logo">
    </a>
    <nav class="nav-links" aria-label="Principal">
      <a href="{{ url('/') }}">Inicio</a>
      <a href="{{ route('aprende.index') }}">Temas</a>
      <a href="{{ route('participacion.create') }}">¿Cómo participar?</a>
      <a href="#nosotros">Sobre el programa</a>
      <a class="btn" href="{{ route('login') }}"><i class="fa-solid fa-user"></i> Ingresar</a>
    </nav>
    <button type="button" class="menu-btn" id="menuMobile" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobileMenu">
      <i class="fa-solid fa-bars"></i>
    </button>
  </div>
  <div class="menu-movil" id="mobileMenu">
    <a href="{{ url('/') }}">Inicio</a>
    <a href="{{ route('aprende.index') }}">Temas</a>
    <a href="{{ route('participacion.create') }}">¿Cómo participar?</a>
    <a href="#nosotros">Sobre el programa</a>
    <a href="{{ route('login') }}" class="btn"><i class="fa-solid fa-user"></i> Ingresar</a>
  </div>
</header>

<main>

<section class="hero" id="inicio">
  <picture>
    <source media="(max-width: 768px)" srcset="{{ asset('build/img/banner-mobile.webp') }}">
    <img src="{{ asset('build/img/banner.webp') }}" alt="Mi Decisión">
  </picture>
  <a href="{{ route('participacion.create') }}" class="btn-hero" aria-label="Quiero conocer los temas">QUIERO CONOCER <i class="fa-solid fa-chevron-right"></i></a>
</section>

<section class="seccion pasos" id="como-funciona">
  <div class="wrap pasos-grid">
    <div class="guia" id="guia">
      <img src="{{ asset('build/img/avatars/niño.webp') }}" alt="Guía de la plataforma">
      <div class="guia-nota">
        <strong>¡Hola! Soy tu guía</strong>
        <p>
          Te acompañaré durante este recorrido por
          <strong>Un Sorbito Hoy, Un Problema Mañana</strong>.
          Aquí encontrarás información y herramientas para fortalecer
          la prevención desde el hogar.
        </p>
        <div class="guia-audio">
          <button type="button" id="btnHablarGuia" class="btn-audio">
            <i class="fa-solid fa-volume-high"></i> <span>Escuchar a la guía</span>
          </button>
          <button type="button" id="btnDetenerGuia" class="btn-audio detener" hidden>
            <i class="fa-solid fa-stop"></i> <span>Detener audio</span>
          </button>
        </div>
        <audio id="audioGuia" preload="none"></audio>
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

<section class="seccion temas" id="misiones" aria-labelledby="temas-imagen-titulo">
  <div class="temas-imagen-wrap">
    <h2 id="temas-imagen-titulo" class="temas-imagen-ayuda">Conozca y reflexione</h2>
    <img
      class="temas-imagen"
      src="{{ asset('build/img/conozca-reflexione-sin-botones.webp') }}"
      alt="Conozca y reflexione: contenidos sobre qué es el alcohol, alcohol y emociones, presión social, mitos y realidades, y mi bienestar, mi decisión."
      width="1536" height="1024" loading="lazy" decoding="async">
  </div>
</section>

<section class="linea" aria-label="Línea de apoyo">
  <div class="wrap">
    <img src="{{ asset('build/img/avatar-banner.webp') }}" alt="MI DECISIÓN" loading="lazy">
    <div>
      <h2>¿Necesita hablar con alguien?</h2>
      <p>Si busca orientación, apoyo o simplemente que alguien lo escuche, llame gratis a la <strong>Línea #141</strong>.</p>
    </div>
    <a href="tel:141" class="btn"><i class="fa-solid fa-phone"></i> Llamar al #141</a>
  </div>
</section>

</main>

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
    <div class="footer-brand">
      <div class="footer-logo-box">
        <img src="{{ asset('build/img/logo.webp') }}" alt="Alcaldía de Armenia y Red Salud Armenia E.S.E." class="footer-logo">
      </div>
      <div class="footer-brand-text">
        <span class="footer-label">Estrategia de prevención y educación</span>
        <h3>Un Sorbito Hoy,<br>Un Problema Mañana</h3>
        <p>Espacio educativo orientado a la promoción de la prevención del consumo de alcohol y al fortalecimiento de decisiones conscientes en niños, niñas, adolescentes y sus familias.</p>
      </div>
    </div>

    <div class="footer-column">
      <h4>Información</h4>
      <a href="#como-funciona">¿Cómo participar?</a>
      <a href="#nosotros">Sobre nosotros</a>
      <a href="{{ route('home') }}">Inicio</a>
    </div>

    <div class="footer-column">
      <h4>Nuestro propósito</h4>
      <p>Promover espacios de información, orientación y reflexión que contribuyan a la prevención del consumo de alcohol, fortaleciendo el acompañamiento familiar y la toma de decisiones conscientes.</p>
    </div>
  </div>

  <div class="footer-bottom">
    <span>© {{ date('Y') }} Un Sorbito Hoy, Un Problema Mañana. Todos los derechos reservados.</span>
    <span>Estrategia educativa para la prevención.</span>
  </div>
</footer>

<script>
const $ = id => document.getElementById(id);

/* ---------- Menú móvil ---------- */
const menuBtn = $('menuMobile');
const menu = $('mobileMenu');
function pintarMenu(abierto) {
  menu.classList.toggle('active', abierto);
  menuBtn.setAttribute('aria-expanded', abierto ? 'true' : 'false');
  menuBtn.innerHTML = abierto ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
}
menuBtn.addEventListener('click', () => pintarMenu(!menu.classList.contains('active')));
menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => pintarMenu(false)));

/* ---------- Modal de contenidos ---------- */
const modal = $('educationModal');
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
document.querySelectorAll('[data-topic]').forEach(b => b.addEventListener('click', () => abrir(b.dataset.topic)));
$('modalClose').addEventListener('click', cerrar);
modal.addEventListener('click', e => { if (e.target === modal) cerrar(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape' && modal.classList.contains('active')) cerrar(); });

/* ---------- Audio de la guía (solo al hacer clic) ---------- */
const audio = $('audioGuia');
const btnHablar = $('btnHablarGuia');
const btnDetener = $('btnDetenerGuia');
const guia = $('guia');

const PISTAS = [
  "{{ asset('build/audio/guia_bienvenida.mp3') }}",
  "{{ asset('build/audio/guia_siguiente_paso.mp3') }}"
];
let pista = 0;
let sonando = false;

function pintarAudio(on) {
  btnHablar.classList.toggle('hablando', on);
  btnHablar.querySelector('span').textContent = on ? 'Escuchando…' : 'Escuchar a la guía';
  btnDetener.hidden = !on;
  guia.classList.toggle('hablando', on);
}

function reproducir(n) {
  pista = n;
  audio.src = PISTAS[n];
  audio.play().then(() => pintarAudio(true)).catch(() => { sonando = false; pintarAudio(false); });
}

function detener() {
  sonando = false;
  audio.pause();
  pintarAudio(false);
}

audio.addEventListener('ended', () => {
  if (sonando && pista < PISTAS.length - 1) {
    setTimeout(() => { if (sonando) reproducir(pista + 1); }, 300);
  } else {
    sonando = false;
    pintarAudio(false);
  }
});
audio.addEventListener('error', () => {
  if (audio.getAttribute('src')) console.warn('No se pudo cargar el audio:', PISTAS[pista]);
  sonando = false;
  pintarAudio(false);
});

btnHablar.addEventListener('click', () => { sonando = true; reproducir(0); });
btnDetener.addEventListener('click', detener);
window.addEventListener('pagehide', detener);
document.addEventListener('visibilitychange', () => { if (document.hidden) detener(); });
</script>

</body>
</html>