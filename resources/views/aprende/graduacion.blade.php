<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado de finalización | Un Sorbito Hoy, Un Problema Mañana</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Nunito:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        :root{
            --green:#27AE60; --green-dark:#1E8449; --blue:#15276A;
            --gold:#F1C40F; --paper:#E8F6F3; --ink:#2C3E50;
            --muted:#607080; --line:#D8E5E8;
        }
        *{box-sizing:border-box}
        body{margin:0;background:#eaf2f3;color:var(--ink);font-family:"Inter","Segoe UI",Arial,sans-serif;font-size:16px;padding:24px}
        .toolbar{max-width:1120px;margin:0 auto 18px;display:flex;gap:12px;justify-content:flex-end}
        .toolbar button,.toolbar a{border:0;border-radius:10px;padding:12px 18px;font-weight:800;text-decoration:none;cursor:pointer;font-size:14px}
        .btn-print{background:var(--gold);color:#263238}
        .btn-back{background:#fff;border:1px solid var(--line)!important;color:var(--blue)}
        .certificate{position:relative;max-width:1120px;min-height:760px;margin:0 auto;background:#fff;border:8px solid var(--green-dark);outline:2px solid var(--gold);outline-offset:-17px;padding:34px 42px 30px;overflow:hidden;box-shadow:0 16px 44px #15276a18}
        .certificate:before,.certificate:after{content:"";position:absolute;width:190px;height:190px;border:22px solid #e8f6f3;border-radius:50%;z-index:0}
        .certificate:before{top:-115px;left:-100px}
        .certificate:after{right:-115px;bottom:-120px}
        .inner{position:relative;z-index:1}
        .topline{display:flex;justify-content:space-between;align-items:center;gap:18px;border-bottom:2px solid var(--gold);padding-bottom:16px}
        .brand{display:flex;align-items:center;gap:12px}
        .brand-logo{display:block;width:170px;max-width:100%;height:58px;object-fit:contain;object-position:left center}
        .brand-name{font-family:"Nunito",sans-serif;font-weight:900;letter-spacing:.025em;color:var(--green-dark);font-size:16px}
        .brand-sub{font-size:11px;color:var(--muted);margin-top:3px}
        .certificate-code{text-align:right;font-size:10px;color:var(--muted);line-height:1.6}
        .heading{text-align:center;padding:19px 0 12px}
        .eyebrow{font-size:11px;letter-spacing:.22em;font-weight:900;color:var(--green-dark);text-transform:uppercase}
        h1{margin:7px 0 5px;font-family:"Nunito","Inter",sans-serif;font-size:38px;font-weight:900;letter-spacing:-.025em;color:var(--blue)}
        .subtitle{margin:0;color:var(--muted);font-size:13px}
        .recipient{display:flex;align-items:center;justify-content:center;gap:18px;margin:12px auto 14px}
        .avatar-wrap{width:82px;height:82px;flex:0 0 82px;border-radius:50%;background:var(--paper);border:3px solid var(--gold);display:grid;place-items:center;overflow:hidden}
        .avatar-wrap img{width:100%;height:100%;object-fit:contain}
        .recipient-info{text-align:left}
        .recipient-label{font-size:11px;color:var(--muted)}
        .recipient-name{font-family:"Nunito","Inter",sans-serif;font-size:27px;font-weight:900;color:var(--green-dark);margin:4px 0}
        .recipient-note{font-size:12px;color:var(--muted)}
        .statement{text-align:center;font-size:13px;line-height:1.55;max-width:770px;margin:0 auto 15px}
        .stats{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin:0 0 16px}
        .stat{background:var(--paper);border:1px solid #d8eee6;border-radius:12px;padding:10px;text-align:center}
        .stat strong{display:block;font-size:23px;color:var(--green-dark);line-height:1.2}
        .stat span{display:block;font-size:10px;color:var(--muted);margin-top:4px}
        .section-title{display:flex;align-items:center;gap:8px;color:var(--blue);font-family:"Nunito",sans-serif;font-weight:900;font-size:15px;margin:12px 0 8px}
        .section-title:after{content:"";height:1px;background:var(--line);flex:1}
        .details{display:grid;grid-template-columns:repeat(4,1fr);gap:7px;margin-bottom:12px}
        .detail{padding:8px 10px;border:1px solid var(--line);border-radius:8px;min-width:0}
        .detail span{display:block;font-size:9px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em}
        .detail strong{display:block;font-size:11px;color:var(--ink);margin-top:4px;overflow-wrap:anywhere}
        .answers-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px}
        .answer-card{border:1px solid var(--line);border-radius:9px;padding:9px 11px;break-inside:avoid}
        .answer-head{display:flex;justify-content:space-between;gap:8px;align-items:flex-start}
        .answer-head strong{font-size:11px;line-height:1.35;color:var(--blue)}
        .badge{font-size:9px;font-weight:800;white-space:nowrap;border-radius:20px;padding:4px 7px;background:#f1f3f5;color:#5f6d80}
        .badge.ok{background:#e1f6e9;color:#176b3a}
        .badge.bad{background:#fff1d6;color:#815800}
        .answer-line{font-size:10px;line-height:1.4;margin-top:5px}
        .answer-line b{color:var(--muted)}
        .footer{display:flex;justify-content:space-between;align-items:flex-end;gap:20px;border-top:1px solid var(--line);padding-top:11px;margin-top:14px}
        .footer-note{font-size:9px;color:var(--muted);line-height:1.5;max-width:65%}
        .signature{text-align:center;min-width:190px}
        .signature-line{border-top:1px solid #8a9aa7;margin-bottom:5px}
        .signature strong{display:block;font-size:10px;color:var(--blue)}
        .signature span{font-size:9px;color:var(--muted)}
        .no-data{font-size:12px;color:var(--muted);padding:12px;border:1px dashed var(--line);border-radius:8px}
        @media(max-width:760px){
            body{padding:10px}.certificate{padding:26px 22px;min-height:0;border-width:5px}
            h1{font-size:32px}.recipient-name{font-size:25px}
            .brand{align-items:flex-start;flex-wrap:wrap}.brand-logo{width:155px;height:54px}
            .brand-name{font-size:16px}.brand-sub,.certificate-code,.eyebrow,.subtitle,.recipient-label,.recipient-note,.statement,.stat span,.detail span,.detail strong,.section-title,.answer-head strong,.badge,.answer-line,.footer-note,.signature strong,.signature span{font-size:16px}
            .stats{grid-template-columns:repeat(2,1fr)}.details{grid-template-columns:1fr 1fr}
            .stat strong{font-size:25px}.detail{padding:11px}.answer-card{padding:12px}.answers-grid{grid-template-columns:1fr}.topline{align-items:flex-start;flex-direction:column}
            .certificate-code{text-align:left}.toolbar{justify-content:stretch}.toolbar button,.toolbar a{flex:1;text-align:center}
        }
        @page{size:A4 landscape;margin:8mm}
        @media print{
            body{padding:0;background:#fff;-webkit-print-color-adjust:exact;print-color-adjust:exact}
            .toolbar{display:none!important}
            .certificate{max-width:none;width:100%;min-height:0;height:auto;margin:0;border-width:5px;padding:20px 28px;box-shadow:none;outline-offset:-12px}
            .certificate:before,.certificate:after{opacity:.65}
            h1{font-size:30px}.heading{padding:10px 0 6px}
            .recipient{margin:7px auto}.avatar-wrap{width:62px;height:62px;flex-basis:62px}
            .recipient-name{font-size:22px}.statement{font-size:10px;margin-bottom:8px}
            .stats{margin-bottom:8px;gap:6px}.stat{padding:6px}.stat strong{font-size:18px}
            .section-title{margin:7px 0 5px}.details{gap:5px;margin-bottom:7px}
            .detail{padding:5px 7px}.answers-grid{gap:5px}
            .answer-card{padding:6px 8px}.answer-line{font-size:9px;margin-top:3px}
            .footer{margin-top:8px;padding-top:7px}
        }
    </style>
</head>
<body>
    <div class="toolbar">
        <a class="btn-back" href="{{ url('/aprende') }}"><i class="bi bi-arrow-left"></i> Volver a Aprende</a>
        <button class="btn-print" type="button" onclick="window.print()"><i class="bi bi-file-earmark-pdf-fill"></i> Generar / guardar PDF</button>
    </div>

    <main class="certificate">
        <div class="inner">
            <header class="topline">
                <div class="brand">
                    <img class="brand-logo" src="{{ asset('build/img/logo.webp') }}" alt="Logo de Un Sorbito Hoy, Un Problema Mañana" onerror="this.style.display='none'">
                    <div>
                        <div class="brand-name">UN SORBITO HOY, UN PROBLEMA MAÑANA</div>
                        <div class="brand-sub">Prevención, educación y decisiones saludables</div>
                    </div>
                </div>
                <div class="certificate-code">
                    <strong>CERTIFICADO DE FINALIZACIÓN</strong><br>
                    Código: {{ $codigoCertificado }}<br>
                    Fecha: {{ now()->format('d/m/Y') }}
                </div>
            </header>

            <section class="heading">
                <div class="eyebrow">Reconocimiento de aprendizaje</div>
                <h1>Certificado de participación</h1>
                <p class="subtitle">Se otorga a quien completó el recorrido educativo de prevención y reflexión.</p>
            </section>

            <section class="recipient">
                <div class="avatar-wrap">
                    <img src="{{ $avatarRuta }}" alt="Avatar seleccionado por el participante" onerror="this.onerror=null;this.src='{{ asset('build/img/avatars/cuerpo.webp') }}'">
                </div>
                <div class="recipient-info">
                    <div class="recipient-label">Este reconocimiento se entrega a</div>
                    <div class="recipient-name">{{ $nombreVisible }}</div>
                    <div class="recipient-note">Por completar las actividades educativas y reflexionar sobre decisiones saludables.</div>
                </div>
            </section>

            <p class="statement">
                Participó en el recorrido <strong>“Un Sorbito Hoy, Un Problema Mañana”</strong>,
                enfocado en reconocer riesgos, fortalecer el diálogo familiar y conocer recursos de prevención y apoyo.
            </p>

            <section class="stats" aria-label="Resumen de gamificación">
                <div class="stat"><strong id="totalXp">—</strong><span>Puntos XP acumulados</span></div>
                <div class="stat"><strong id="correctCount">—</strong><span>Respuestas correctas</span></div>
                <div class="stat"><strong id="questionCount">—</strong><span>Preguntas respondidas</span></div>
                <div class="stat"><strong id="accuracy">—</strong><span>Porcentaje de aciertos</span></div>
            </section>

            <div class="section-title"><i class="bi bi-person-vcard"></i> Datos del participante</div>
            <section class="details">
                <div class="detail"><span>Edad</span><strong>{{ $participante->edad ?: 'No registrada' }}</strong></div>
                <div class="detail"><span>Institución</span><strong>{{ $participante->institucion ?: 'No registrada' }}</strong></div>
                <div class="detail"><span>Grado</span><strong>{{ $participante->grado ?: 'No registrado' }}</strong></div>
                <div class="detail"><span>Rol familiar</span><strong>{{ $participante->rol_familiar ?: 'No registrado' }}</strong></div>
            </section>

            <div class="section-title"><i class="bi bi-patch-question"></i> Registro de preguntas y respuestas</div>
            <section id="answerRecords" class="answers-grid">
                <div class="no-data">Preparando el registro de respuestas…</div>
            </section>

            <footer class="footer">
                <div class="footer-note">
                    Este certificado resume la participación y los resultados de gamificación registrados en este navegador.
                    Código de referencia: {{ $codigoCertificado }}.
                </div>
                <div class="signature">
                    <div class="signature-line"></div>
                    <strong>Programa educativo</strong>
                    <span>Un Sorbito Hoy, Un Problema Mañana</span>
                </div>
            </footer>
        </div>
    </main>

<script>
(() => {
    const participacionId = @json(session('participacion_id') ?: 'anon');

    // Preguntas de los niveles con cuestionario que ya están definidos en las vistas actuales.
    // Las escenas 1 y 2 otorgan XP por completar la escena, pero no tienen quiz de preguntas.
    const banco = [
        {
            nivel: 3,
            preguntas: [
                {
                    texto: 'Tu hijo llega con los ojos rojos un sábado y dice que “solo comió mucho”. ¿Cuál es la primera acción recomendable?',
                    opciones: [
                        'Confrontarlo de inmediato y registrar su cuarto.',
                        'Observar si se repite el patrón y preparar una conversación calmada.',
                        'Ignorarlo — los adolescentes exageran.',
                        'Castigarlo preventivamente.'
                    ],
                    correcta: 1
                },
                {
                    texto: '¿Cuál combinación de señales debe generar mayor preocupación en un padre?',
                    opciones: [
                        'Cambios de humor + amigos nuevos.',
                        'Consumo abierto + mentiras frecuentes + dinero desaparecido.',
                        'Bajas en notas únicamente.',
                        'Distanciamiento de la familia.'
                    ],
                    correcta: 1
                }
            ]
        },
        {
            nivel: 4,
            preguntas: [
                {
                    texto: 'Tu hijo de 14 años admite haber consumido marihuana 3 veces. ¿Cuál es la ruta correcta?',
                    opciones: [
                        'Internarlo de inmediato en un centro de rehabilitación.',
                        'Hablar con calma, entender el contexto y buscar orientación si se repite.',
                        'Probar la droga tú mismo para entender el efecto.',
                        'Ignorarlo — probar una vez no es el fin del mundo.'
                    ],
                    correcta: 1
                },
                {
                    texto: 'En Colombia, ¿a qué línea llamar si tu hijo está en una crisis de consumo aguda?',
                    opciones: [
                        'Línea 123 (Policía).',
                        'Línea 106 de Salud Mental — gratuita 24/7.',
                        'Línea 141 del ICBF.',
                        'Esperar a que pase y hablar mañana.'
                    ],
                    correcta: 1
                }
            ]
        }
    ];

    const registros = [];
    let aciertos = 0;
    let respondidas = 0;

    banco.forEach(grupo => {
        const clave = `pp_quiz_${participacionId}_${grupo.nivel}`;
        let guardado = {};
        try { guardado = JSON.parse(localStorage.getItem(clave) || '{}'); } catch (e) {}
        const respuestas = guardado && guardado.respuestas && typeof guardado.respuestas === 'object'
            ? guardado.respuestas : {};

        grupo.preguntas.forEach((pregunta, indice) => {
            if (!Object.prototype.hasOwnProperty.call(respuestas, indice)) return;

            const elegida = Number(respuestas[indice]);
            if (!Number.isInteger(elegida) || !pregunta.opciones[elegida]) return;

            const correcta = elegida === pregunta.correcta;
            respondidas++;
            if (correcta) aciertos++;

            registros.push({
                nivel: grupo.nivel,
                pregunta: pregunta.texto,
                elegida: pregunta.opciones[elegida],
                respuestaCorrecta: pregunta.opciones[pregunta.correcta],
                correcta
            });
        });
    });

    const contenedor = document.getElementById('answerRecords');
    contenedor.replaceChildren();

    if (!registros.length) {
        const aviso = document.createElement('div');
        aviso.className = 'no-data';
        aviso.textContent = 'No se encontraron respuestas de cuestionarios guardadas en este navegador. Verifica que estés usando el mismo navegador y perfil con el que realizaste las actividades.';
        contenedor.appendChild(aviso);
    } else {
        registros.forEach((registro, i) => {
            const tarjeta = document.createElement('article');
            tarjeta.className = 'answer-card';

            const cabecera = document.createElement('div');
            cabecera.className = 'answer-head';

            const titulo = document.createElement('strong');
            titulo.textContent = `Nivel ${registro.nivel} · Pregunta ${i + 1}`;

            const estado = document.createElement('span');
            estado.className = 'badge ' + (registro.correcta ? 'ok' : 'bad');
            estado.textContent = registro.correcta ? 'Correcta' : 'Por reforzar';

            cabecera.append(titulo, estado);

            const pregunta = document.createElement('div');
            pregunta.className = 'answer-line';
            const pq = document.createElement('b');
            pq.textContent = 'Pregunta: ';
            pregunta.append(pq, document.createTextNode(registro.pregunta));

            const elegida = document.createElement('div');
            elegida.className = 'answer-line';
            const pe = document.createElement('b');
            pe.textContent = 'Respuesta elegida: ';
            elegida.append(pe, document.createTextNode(registro.elegida));

            const correcta = document.createElement('div');
            correcta.className = 'answer-line';
            const pc = document.createElement('b');
            pc.textContent = 'Respuesta correcta: ';
            correcta.append(pc, document.createTextNode(registro.respuestaCorrecta));

            tarjeta.append(cabecera, pregunta, elegida, correcta);
            contenedor.appendChild(tarjeta);
        });
    }

    let xpBase = 0;
    try {
        xpBase = Number(localStorage.getItem('pontePilasXP')
            || localStorage.getItem('ponte_pilas_xp') || 0);
    } catch (e) {}

    let xpNivelesQuiz = 0;
    try {
        const progreso = JSON.parse(sessionStorage.getItem('pp_progreso') || '{}');
        const niveles = progreso && progreso.niveles ? Object.values(progreso.niveles) : [];
        xpNivelesQuiz = niveles.reduce((s, n) => s + Number(n && n.xp || 0), 0);
    } catch (e) {}

    const xpTotal = Math.max(0, xpBase + xpNivelesQuiz);
    const porcentaje = respondidas ? Math.round((aciertos / respondidas) * 100) : 0;

    document.getElementById('totalXp').textContent = xpTotal + ' XP';
    document.getElementById('correctCount').textContent = aciertos;
    document.getElementById('questionCount').textContent = respondidas;
    document.getElementById('accuracy').textContent = porcentaje + '%';
})();
</script>
</body>
</html>
