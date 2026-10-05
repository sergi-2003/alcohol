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
        html{width:100%;max-width:100%;overflow-x:hidden}
        body{margin:0;width:100%;max-width:100%;min-width:0;overflow-x:hidden;background:#eaf2f3;color:var(--ink);font-family:"Inter","Segoe UI",Arial,sans-serif;font-size:16px;padding:24px}
        .toolbar{width:100%;max-width:1120px;margin:0 auto 18px;display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;justify-content:end}
        .toolbar button,.toolbar a{border:0;border-radius:10px;padding:12px 18px;font-weight:800;text-decoration:none;cursor:pointer;font-size:14px}
        .btn-print{background:var(--gold);color:#263238}

        .btn-share{background:var(--green);color:#fff}
        .btn-platform{background:var(--blue);color:#fff}
        .completion-badge{
            width:max-content;
            max-width:100%;
            margin:24px auto 28px;
            padding:10px 18px;
            border-radius:12px;
            background:var(--paper);
            border:1px solid #d8eee6;
            color:var(--green-dark);
            font-weight:800;
            text-align:center;
        }
        .share-message{
            display:none;
            max-width:1120px;
            margin:0 auto 12px;
            padding:10px 14px;
            border-radius:9px;
            background:#e1f6e9;
            color:#176b3a;
            font-size:13px;
            font-weight:700;
        }
        .btn-back{background:#fff;border:1px solid var(--line)!important;color:var(--blue)}
        .certificate{position:relative;width:100%;max-width:1120px;min-width:0;min-height:650px;margin:0 auto;background:#fff;border:8px solid var(--green-dark);outline:2px solid var(--gold);outline-offset:-17px;padding:30px 42px 26px;overflow:hidden;box-shadow:0 16px 44px #15276a18}
        .certificate:before,.certificate:after{content:"";position:absolute;width:190px;height:190px;border:22px solid #e8f6f3;border-radius:50%;z-index:0}
        .certificate:before{top:-115px;left:-100px}
        .certificate:after{right:-115px;bottom:-120px}
        .inner{position:relative;z-index:1}
        .topline{display:flex;justify-content:space-between;align-items:center;gap:18px;min-width:0;border-bottom:2px solid var(--gold);padding-bottom:16px}
        .brand{display:flex;align-items:center;gap:12px;min-width:0;max-width:100%}
        .brand > *{min-width:0}
        .brand-name,.brand-sub{overflow-wrap:anywhere;word-break:break-word}
        .brand-logo{display:block;width:170px;max-width:100%;height:58px;object-fit:contain;object-position:left center}
        .brand-name{font-family:"Nunito",sans-serif;font-weight:900;letter-spacing:.025em;color:var(--green-dark);font-size:16px}
        .brand-sub{font-size:11px;color:var(--muted);margin-top:3px}
        .certificate-code{text-align:right;font-size:10px;color:var(--muted);line-height:1.6;min-width:0;max-width:42%;overflow-wrap:anywhere}
        .heading{text-align:center;padding:19px 0 12px}
        .eyebrow{font-size:11px;letter-spacing:.22em;font-weight:900;color:var(--green-dark);text-transform:uppercase}
        h1{margin:7px 0 5px;font-family:"Nunito","Inter",sans-serif;font-size:38px;font-weight:900;letter-spacing:-.025em;color:var(--blue)}
        .subtitle{margin:0;color:var(--muted);font-size:13px}
        .recipient{display:flex;align-items:center;justify-content:center;gap:18px;margin:12px auto 14px}
        .avatar-wrap{width:82px;height:82px;flex:0 0 82px;border-radius:50%;background:var(--paper);border:3px solid var(--gold);display:grid;place-items:center;overflow:hidden}
        .avatar-wrap img{width:100%;height:100%;object-fit:contain}
        .recipient-info{text-align:left;min-width:0;max-width:100%}
        .recipient-label{font-size:11px;color:var(--muted)}
        .recipient-name{font-family:"Nunito","Inter",sans-serif;font-size:29px;font-weight:900;color:var(--green-dark);margin:4px 0;overflow-wrap:anywhere;word-break:break-word}
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
        .footer{display:flex;justify-content:space-between;align-items:flex-end;gap:20px;min-width:0;border-top:1px solid var(--line);padding-top:11px;margin-top:14px}
        .footer-note{font-size:9px;color:var(--muted);line-height:1.5;max-width:65%;min-width:0;overflow-wrap:anywhere}
        .signature{text-align:center;min-width:0;width:38%;max-width:240px}
        .signature-line{border-top:1px solid #8a9aa7;margin-bottom:5px}
        .signature strong{display:block;font-size:10px;color:var(--blue)}
        .signature span{font-size:9px;color:var(--muted)}
        .no-data{font-size:12px;color:var(--muted);padding:12px;border:1px dashed var(--line);border-radius:8px}
        @media(max-width:760px){
            body{padding:10px}
            .toolbar{grid-template-columns:repeat(2,minmax(0,1fr));gap:8px;margin-bottom:12px}
            .toolbar button,.toolbar a{width:100%;min-width:0;padding:11px 8px;font-size:13px;line-height:1.2;text-align:center}
            .certificate{width:100%;max-width:100%;padding:22px 16px;min-height:0;border-width:5px;outline-offset:-12px}
            .certificate:before,.certificate:after{width:130px;height:130px;border-width:14px}
            .certificate:before{top:-82px;left:-72px}.certificate:after{right:-78px;bottom:-82px}
            .topline{align-items:stretch;flex-direction:column;gap:10px;padding-bottom:12px}
            .brand{align-items:center;flex-wrap:wrap;gap:8px}
            .brand-logo{width:125px;height:44px}
            .brand-name{font-size:14px;line-height:1.15}.brand-sub{font-size:10px}
            .certificate-code{max-width:100%;text-align:left;font-size:9px;line-height:1.5}
            .heading{padding:15px 0 9px}
            .eyebrow{font-size:9px;letter-spacing:.13em}
            h1{font-size:27px;line-height:1.08;overflow-wrap:anywhere}
            .subtitle{font-size:11px;line-height:1.4}
            .recipient{width:100%;flex-direction:column;gap:8px;margin:10px auto 12px;text-align:center}
            .avatar-wrap{width:72px;height:72px;flex-basis:72px}
            .recipient-info{text-align:center;width:100%}
            .recipient-name{font-size:22px;line-height:1.1}
            .recipient-label,.recipient-note{font-size:10px;line-height:1.4}
            .statement{font-size:11px;line-height:1.5;max-width:100%;margin-bottom:12px}
            .stats{grid-template-columns:repeat(2,minmax(0,1fr));gap:7px}
            .stat{padding:9px 6px}.stat strong{font-size:20px}.stat span{font-size:9px}
            .details{grid-template-columns:1fr 1fr;gap:6px}
            .detail{padding:8px}.detail span{font-size:8px}.detail strong{font-size:10px}
            .answers-grid{grid-template-columns:1fr;gap:7px}
            .answer-card{padding:9px}.answer-head{flex-direction:column;gap:5px}.answer-head strong{font-size:10px}.badge{font-size:8px;align-self:flex-start}.answer-line{font-size:9px}
            .section-title{font-size:12px}
            .footer{flex-direction:column;align-items:stretch;gap:14px}
            .footer-note{max-width:100%;font-size:9px}
            .signature{width:100%;max-width:none;min-width:0}
        }
        @media(max-width:420px){
            body{padding:6px}
            .toolbar{grid-template-columns:1fr 1fr;gap:6px}
            .toolbar button,.toolbar a{font-size:12px;padding:10px 6px}
            .certificate{padding:18px 11px;border-width:4px;outline-offset:-10px}
            .brand-logo{width:108px;height:38px}.brand-name{font-size:12px}.brand-sub{font-size:9px}
            h1{font-size:24px}.recipient-name{font-size:20px}
            .stats{gap:5px}.stat strong{font-size:18px}.stat span{font-size:8px}
            .details{grid-template-columns:1fr}
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
    
        .btn-report{background:#eef4fa;color:#265784;border:1px solid #c9d8e7}
        .btn-report:hover{background:#e3edf7}
    </style>
</head>
<body>
    <div id="shareMessage" class="share-message"></div>

    <div class="toolbar">
        <a class="btn-back" href="{{ url('/aprende') }}">
            <i class="bi bi-arrow-left"></i> Volver a Aprende
        </a>
        <button class="btn-share" type="button" onclick="compartirCertificado()">
            <i class="bi bi-share-fill"></i> Compartir certificado
        </button>
        <button class="btn-platform" type="button" onclick="compartirPlataforma()">
            <i class="bi bi-megaphone-fill"></i> Compartir plataforma
        </button>
        <button class="btn-report" type="button" onclick="descargarReporte()">
            <i class="bi bi-clipboard-data-fill"></i> Descargar reporte
        </button>
        <button class="btn-print" type="button" onclick="descargarCertificadoPDF()">
            <i class="bi bi-file-earmark-pdf-fill"></i> Guardar PDF
        </button>
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
        Ha completado satisfactoriamente el recorrido
        <strong>“Un Sorbito Hoy, Un Problema Mañana”</strong>,
        orientado a la prevención, la reflexión y el fortalecimiento del diálogo familiar.
    </p>
            <div class="completion-badge"><i class="bi bi-check-circle-fill"></i> Recorrido educativo completado</div>

            <footer class="footer">
                <div class="footer-note">
                    Este certificado acredita la participación en el programa educativo.
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
    const participacionId = @json(session('participacion_id') ?: 'anon');
    const shareMessage = document.getElementById('shareMessage');

    function mostrarMensajeCompartir(mensaje) {
        shareMessage.textContent = mensaje;
        shareMessage.style.display = 'block';
        setTimeout(() => shareMessage.style.display = 'none', 4500);
    }

    async function obtenerPDFCertificado() {
        const respuesta = await fetch(@json(route('aprende.certificado.pdf')), {
            method: 'GET',
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/pdf'
            }
        });

        const contentType = (respuesta.headers.get('content-type') || '').toLowerCase();

        if (!respuesta.ok || !contentType.includes('application/pdf')) {
            let detalle = `HTTP ${respuesta.status}`;
            try {
                const texto = await respuesta.text();
                if (texto) detalle += ` - ${texto.substring(0, 180)}`;
            } catch (e) {}
            throw new Error(
                'El servidor no devolvió un PDF válido. ' + detalle
            );
        }

        const blob = await respuesta.blob();

        if (blob.size < 1000) {
            throw new Error('El PDF recibido está vacío o es inválido.');
        }

        return new File(
            [blob],
            'Certificado-Un-Sorbito-Hoy-Un-Problema-Manana.pdf',
            { type: 'application/pdf' }
        );
    }

    async function descargarBlobComoPDF(file) {
        const url = URL.createObjectURL(file);

        try {
            const enlace = document.createElement('a');
            enlace.href = url;
            enlace.download = file.name;
            enlace.style.display = 'none';

            document.body.appendChild(enlace);
            enlace.click();
            enlace.remove();

            mostrarMensajeCompartir('Certificado PDF descargado correctamente.');
        } finally {
            setTimeout(() => URL.revokeObjectURL(url), 60000);
        }
    }

    async function descargarCertificadoPDF() {
        try {
            mostrarMensajeCompartir('Generando certificado PDF...');

            const file = await obtenerPDFCertificado();

            await descargarBlobComoPDF(file);
        } catch (error) {
            console.error('Error al descargar certificado:', error);
            mostrarMensajeCompartir(
                error.message || 'No se pudo generar el certificado PDF.'
            );
        }
    }

    async function compartirCertificado() {
        const texto =
            'He completado el recorrido educativo “Un Sorbito Hoy, Un Problema Mañana”.';

        try {
            mostrarMensajeCompartir('Generando certificado PDF...');

            const file = await obtenerPDFCertificado();

            /*
             * Compartir el ARCHIVO PDF, no la URL.
             * navigator.canShare({files}) permite verificar si el
             * navegador/dispositivo soporta compartir archivos.
             */
            if (
                navigator.share &&
                navigator.canShare &&
                navigator.canShare({ files: [file] })
            ) {
                try {
                    await navigator.share({
                        title: 'Mi certificado | Un Sorbito Hoy, Un Problema Mañana',
                        text: texto,
                        files: [file]
                    });

                    mostrarMensajeCompartir('Certificado compartido correctamente.');
                    return;
                } catch (error) {
                    if (error && error.name === 'AbortError') {
                        return;
                    }
                }
            }

            /*
             * Si el navegador no permite compartir archivos,
             * descargamos el PDF. El usuario podrá adjuntarlo
             * directamente en WhatsApp, correo, etc.
             */
            await descargarBlobComoPDF(file);

        } catch (error) {
            console.error('Error al compartir certificado:', error);
            mostrarMensajeCompartir(
                error.message || 'No se pudo generar el certificado PDF.'
            );
        }
    }

    async function descargarReporte() {
        try {
            mostrarMensajeCompartir('Preparando el reporte de respuestas...');

            const registros = obtenerRegistrosReporte();

            if (!registros.length) {
                mostrarMensajeCompartir('No se encontraron respuestas guardadas para generar el reporte.');
                return;
            }

            const respuesta = await fetch(@json(route('aprende.reporte.resultados')), {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/pdf',
                    'X-CSRF-TOKEN': @json(csrf_token())
                },
                body: JSON.stringify({ registros })
            });

            if (!respuesta.ok) {
                let mensaje = 'No se pudo generar el reporte.';
                try {
                    const error = await respuesta.json();
                    if (error.mensaje) mensaje = error.mensaje;
                } catch (e) {}
                throw new Error(mensaje);
            }

            const blob = await respuesta.blob();
            const url = URL.createObjectURL(blob);
            const enlace = document.createElement('a');
            enlace.href = url;
            enlace.download = 'Reporte-resultados-Un-Sorbito-Hoy-Un-Problema-Manana.pdf';
            document.body.appendChild(enlace);
            enlace.click();
            enlace.remove();
            setTimeout(() => URL.revokeObjectURL(url), 60000);

            mostrarMensajeCompartir('Reporte descargado correctamente.');
        } catch (error) {
            mostrarMensajeCompartir(error.message || 'No se pudo generar el reporte.');
        }
    }

    function obtenerRegistrosReporte() {
        const registros = [];
        const banco = [
            {
                nivel: 1,
                preguntas: [
                    {
                        texto: "Tu hijo llega con los ojos rojos un sábado y dice que “solo comió mucho”. ¿Cuál es la primera acción recomendable?",
                        opciones: [
                            "Confrontarlo de inmediato y registrar su cuarto.",
                            "Observar si se repite el patrón y preparar una conversación calmada.",
                            "Ignorarlo — los adolescentes exageran.",
                            "Castigarlo preventivamente.",
                        ],
                        correcta: 1
                    },
                    {
                        texto: "¿Cuál combinación de señales debe generar mayor preocupación en un padre?",
                        opciones: [
                            "Cambios de humor + amigos nuevos.",
                            "Consumo abierto + mentiras frecuentes + dinero desaparecido.",
                            "Bajas en notas únicamente.",
                            "Distanciamiento de la familia.",
                        ],
                        correcta: 1
                    }
                ]
            },
            {
                nivel: 2,
                preguntas: [
                    {
                        texto: "¿Cuál es el factor de riesgo individual más fuerte para el inicio del consumo en Colombia?",
                        opciones: [
                            "Tener bajas calificaciones académicas.",
                            "Vacíos emocionales como ansiedad, soledad o baja autoestima.",
                            "No tener dinero para consumir.",
                            "Vivir en una ciudad grande.",
                        ],
                        correcta: 1
                    },
                    {
                        texto: "¿Por qué el cerebro adolescente evalúa el riesgo diferente al adulto?",
                        opciones: [
                            "Porque son naturalmente rebeldes por actitud.",
                            "Porque el lóbulo prefrontal (juicio y autocontrol) no madura hasta los 25 años.",
                            "Porque tienen menor inteligencia.",
                            "Porque producen más hormonas.",
                        ],
                        correcta: 1
                    }
                ]
            },
            {
                nivel: 3,
                preguntas: [
                    {
                        texto: "Tu hija de 16 años llega a las 2am con olor a alcohol. ¿Qué haces primero?",
                        opciones: [
                            "Confrontarla inmediatamente y quitarle el celular.",
                            "Verificar que está bien, dejarla dormir y hablar mañana con calma.",
                            "Ignorarlo — casi es adulta.",
                            "Llamar al colegio al día siguiente para reportarlo.",
                        ],
                        correcta: 1
                    },
                    {
                        texto: "¿Cuál frase abre mejor la conversación sobre consumo con tu hijo?",
                        opciones: [
                            "“¿Estás consumiendo drogas? Necesito que me digas la verdad ya.”",
                            "“Tu primo nunca hizo esto — ¿por qué tú sí?”",
                            "“¿Cómo son las fiestas a las que vas? ¿Qué suele pasar ahí?”",
                            "“Si te vuelvo a encontrar tomando, te quedas sin salidas dos meses.”",
                        ],
                        correcta: 2
                    }
                ]
            },
            {
                nivel: 4,
                preguntas: [
                    {
                        texto: "Tu hijo de 14 años admite haber consumido marihuana 3 veces. ¿Cuál es la ruta correcta?",
                        opciones: [
                            "Internarlo de inmediato en un centro de rehabilitación.",
                            "Hablar con calma, entender el contexto y buscar orientación si se repite.",
                            "Probar la droga tú mismo para entender el efecto.",
                            "Ignorarlo — probar una vez no es el fin del mundo.",
                        ],
                        correcta: 1
                    },
                    {
                        texto: "En Colombia, ¿a qué línea llamar si tu hijo está en una crisis de consumo?",
                        opciones: [
                            "Línea 123 (Policía).",
                            "Línea 106 de Salud Mental — gratuita 24/7.",
                            "Línea 141 del ICBF.",
                            "Esperar a que pase y hablar mañana.",
                        ],
                        correcta: 1
                    }
                ]
            }
        ];

        banco.forEach(grupo => {
            const clave = `pp_quiz_${participacionId}_${grupo.nivel}`;
            let guardado = {};
            try {
                guardado = JSON.parse(localStorage.getItem(clave) || '{}');
            } catch (e) {}

            const respuestas = guardado && guardado.respuestas &&
                typeof guardado.respuestas === 'object'
                ? guardado.respuestas : {};

            grupo.preguntas.forEach((pregunta, indice) => {
                const tieneRespuesta = Object.prototype.hasOwnProperty.call(respuestas, indice);
                const elegida = tieneRespuesta ? Number(respuestas[indice]) : null;
                const respuestaValida = Number.isInteger(elegida) && !!pregunta.opciones[elegida];

                // Siempre incluimos la pregunta en el reporte, incluso si no fue respondida.
                // Así el reporte representa TODO el cuestionario y no solamente las respuestas registradas.
                registros.push({
                    nivel: grupo.nivel,
                    pregunta: pregunta.texto,
                    elegida: respuestaValida ? pregunta.opciones[elegida] : 'No respondida',
                    respuestaCorrecta: pregunta.opciones[pregunta.correcta],
                    correcta: respuestaValida && elegida === pregunta.correcta,
                    respondida: respuestaValida
                });
            });
        });

        return registros;
    }

    async function compartirPlataforma() {
        const url = @json(url('/aprende'));
        const texto = 'Conoce “Un Sorbito Hoy, Un Problema Mañana”, una plataforma educativa de prevención y reflexión.';

        if (navigator.share) {
            try {
                await navigator.share({
                    title: 'Un Sorbito Hoy, Un Problema Mañana',
                    text: texto,
                    url: url
                });
                return;
            } catch (error) {
                if (error && error.name === 'AbortError') return;
            }
        }

        try {
            await navigator.clipboard.writeText(url);
            mostrarMensajeCompartir('Enlace de la plataforma copiado. Ya puedes compartirlo con otras personas.');
        } catch (error) {
            window.open(
                'https://wa.me/?text=' + encodeURIComponent(texto + ' ' + url),
                '_blank',
                'noopener,noreferrer'
            );
        }
    }
</script>

</body>
</html>
