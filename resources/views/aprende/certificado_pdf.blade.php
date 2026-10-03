<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Certificado de participación</title>
    <style>
        @page { margin: 0; }
        html, body { margin: 0; padding: 0; }
        body { font-family: 'DejaVu Sans', sans-serif; color: #2C3E50; font-size: 11px; }
        table { border-collapse: collapse; width: 100%; }

        .marco { margin: 16px; border: 6px solid #1E8449; padding: 4px; }
        .interior { border: 2px solid #F1C40F; padding: 20px 34px 16px; }

        .top td { vertical-align: middle; padding-bottom: 10px; border-bottom: 2px solid #F1C40F; }
        .logo { height: 46px; }
        .marca { font-size: 12px; font-weight: bold; color: #1E8449; letter-spacing: 0.5px; }
        .marca-sub { font-size: 9px; color: #607080; margin-top: 3px; }
        .codigo { text-align: right; font-size: 9px; color: #607080; line-height: 1.6; }

        .titulo { text-align: center; padding: 18px 0 6px; }
        .eyebrow { font-size: 9px; letter-spacing: 3px; font-weight: bold; color: #1E8449; text-transform: uppercase; }
        h1 { margin: 8px 0 6px; font-size: 30px; color: #15276A; }
        .subtitulo { margin: 0; font-size: 11px; color: #607080; }

        .destinatario { width: auto; margin: 16px auto 12px; }
        .destinatario td { vertical-align: middle; }
        .avatar { width: 84px; height: 84px; border: 3px solid #F1C40F; background: #E8F6F3; text-align: center; }
        .avatar img { height: 78px; }
        .d-info { padding-left: 18px; text-align: left; }
        .d-label { font-size: 10px; color: #607080; }
        .d-nombre { font-size: 24px; font-weight: bold; color: #1E8449; margin: 4px 0; }
        .d-nota { font-size: 10px; color: #607080; }

        .declaracion { text-align: center; font-size: 12px; line-height: 1.6; margin: 10px 70px 14px; }
        .insignia { width: auto; margin: 0 auto 14px; }
        .insignia td { padding: 9px 20px; background: #E8F6F3; border: 1px solid #d8eee6; color: #1E8449; font-weight: bold; font-size: 12px; text-align: center; }

        .pie { margin-top: 10px; border-top: 1px solid #D8E5E8; }
        .pie td { vertical-align: bottom; padding-top: 10px; }
        .nota { font-size: 9px; color: #607080; line-height: 1.5; width: 62%; }
        .firma { text-align: center; width: 38%; }
        .firma-linea { border-top: 1px solid #8a9aa7; width: 190px; margin: 0 auto 5px; }
        .firma strong { display: block; font-size: 10px; color: #15276A; }
        .firma span { font-size: 9px; color: #607080; }
    </style>
</head>
<body>
    <div class="marco">
        <div class="interior">

            <table class="top">
                <tr>
                    <td style="width:60%">
                        <table style="width:auto">
                            <tr>
                                @if($logoDataUri)
                                    <td style="padding:0 12px 0 0; border:0"><img class="logo" src="{{ $logoDataUri }}" alt=""></td>
                                @endif
                                <td style="padding:0; border:0">
                                    <div class="marca">UN SORBITO HOY, UN PROBLEMA MAÑANA</div>
                                    <div class="marca-sub">Prevención, educación y decisiones saludables</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="codigo">
                        <strong>CERTIFICADO DE FINALIZACIÓN</strong><br>
                        Código: {{ $codigoCertificado }}<br>
                        Fecha: {{ $fecha }}
                    </td>
                </tr>
            </table>

            <div class="titulo">
                <div class="eyebrow">Reconocimiento de aprendizaje</div>
                <h1>Certificado de participación</h1>
                <p class="subtitulo">Se otorga a quien completó el recorrido educativo de prevención y reflexión.</p>
            </div>

            <table class="destinatario">
                <tr>
                    @if($avatarDataUri)
                        <td class="avatar"><img src="{{ $avatarDataUri }}" alt=""></td>
                    @endif
                    <td class="d-info">
                        <div class="d-label">Este reconocimiento se entrega a</div>
                        <div class="d-nombre">{{ $nombreVisible }}</div>
                        <div class="d-nota">Por completar las actividades educativas y reflexionar sobre decisiones saludables.</div>
                    </td>
                </tr>
            </table>

            <p class="declaracion">
                Ha completado satisfactoriamente el recorrido
                <strong>“Un Sorbito Hoy, Un Problema Mañana”</strong>,
                orientado a la prevención, la reflexión y el fortalecimiento del diálogo familiar.
            </p>

            <table class="insignia"><tr><td>✓ Recorrido educativo completado</td></tr></table>

            <table class="pie">
                <tr>
                    <td class="nota">
                        Este certificado acredita la participación en el programa educativo.<br>
                        Código de referencia: {{ $codigoCertificado }}.
                    </td>
                    <td class="firma">
                        <div class="firma-linea"></div>
                        <strong>Programa educativo</strong>
                        <span>Un Sorbito Hoy, Un Problema Mañana</span>
                    </td>
                </tr>
            </table>

        </div>
    </div>

    {{-- Librerías para generar el PDF en el navegador si el servidor no puede (plan B) --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
(() => {
    const participacionId = @json(session('participacion_id') ?: 'anon');
    const URL_PDF = @json(route('aprende.certificado.pdf'));
    const URL_REPORTE = @json(route('aprende.reporte.resultados'));
    const CSRF = @json(csrf_token());
    const NOMBRE_PDF = 'Certificado-Un-Sorbito-Hoy-Un-Problema-Manana.pdf';
    const shareMessage = document.getElementById('shareMessage');

    function mostrarMensajeCompartir(mensaje, ms = 4500) {
        shareMessage.textContent = mensaje;
        shareMessage.style.display = 'block';
        clearTimeout(mostrarMensajeCompartir.t);
        mostrarMensajeCompartir.t = setTimeout(() => shareMessage.style.display = 'none', ms);
    }

    /* ---------------- PDF del certificado ---------------- */

    // 1) Intenta con el PDF real que genera Laravel
    async function obtenerPDFServidor() {
        const respuesta = await fetch(URL_PDF, {
            method: 'GET',
            credentials: 'same-origin',
            headers: { 'Accept': 'application/pdf' },
            cache: 'no-store'
        });

        const tipo = (respuesta.headers.get('content-type') || '').toLowerCase();

        if (!respuesta.ok || !tipo.includes('application/pdf')) {
            let detalle = 'HTTP ' + respuesta.status;
            try { detalle += ' · ' + (await respuesta.text()).substring(0, 160).replace(/\s+/g, ' '); } catch (e) {}
            throw new Error('El servidor no devolvió un PDF válido (' + detalle + ')');
        }

        const blob = await respuesta.blob();
        if (blob.size < 1000) throw new Error('El PDF del servidor está vacío.');

        return new File([blob], NOMBRE_PDF, { type: 'application/pdf', lastModified: Date.now() });
    }

    // 2) Plan B: se dibuja el certificado de la pantalla y se convierte en PDF
    async function generarPDFEnNavegador() {
        if (!window.html2canvas || !window.jspdf) {
            throw new Error('No se cargaron las librerías para generar el PDF en el navegador.');
        }

        const nodo = document.querySelector('.certificate');
        const canvas = await html2canvas(nodo, { scale: 2, backgroundColor: '#ffffff', useCORS: true });

        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF({ orientation: 'landscape', unit: 'mm', format: 'a4' });
        const W = pdf.internal.pageSize.getWidth();
        const H = pdf.internal.pageSize.getHeight();
        const margen = 8;
        const ratio = canvas.width / canvas.height;

        let w = W - margen * 2;
        let h = w / ratio;
        if (h > H - margen * 2) { h = H - margen * 2; w = h * ratio; }

        pdf.addImage(canvas.toDataURL('image/jpeg', 0.92), 'JPEG', (W - w) / 2, (H - h) / 2, w, h);

        return new File([pdf.output('blob')], NOMBRE_PDF, { type: 'application/pdf', lastModified: Date.now() });
    }

    // Se prepara al abrir la página para poder compartir al instante al tocar el botón
    let certificadoArchivo = null;
    let certificadoPromesa = null;

    function prepararCertificado() {
        if (!certificadoPromesa) {
            certificadoPromesa = obtenerPDFServidor()
                .then(f => { console.info('Certificado listo (PDF del servidor).'); return f; })
                .catch(err => {
                    console.warn('PDF del servidor no disponible: ' + err.message);
                    return generarPDFEnNavegador().then(f => { console.info('Certificado listo (generado en el navegador).'); return f; });
                })
                .then(f => { certificadoArchivo = f; return f; })
                .catch(e => { certificadoPromesa = null; throw e; });
        }
        return certificadoPromesa;
    }

    window.addEventListener('load', () => { prepararCertificado().catch(e => console.error(e)); });

    function descargarArchivoPDF(file) {
        const url = URL.createObjectURL(file);
        const enlace = document.createElement('a');
        enlace.href = url;
        enlace.download = file.name;
        enlace.style.display = 'none';
        document.body.appendChild(enlace);
        enlace.click();
        enlace.remove();
        setTimeout(() => URL.revokeObjectURL(url), 60000);
    }

    /* ---------------- Botón: Guardar PDF ---------------- */
    window.descargarCertificadoPDF = async function () {
        try {
            mostrarMensajeCompartir('Generando certificado PDF...');
            const file = certificadoArchivo || await prepararCertificado();
            descargarArchivoPDF(file);
            mostrarMensajeCompartir('Certificado PDF descargado correctamente.');
        } catch (error) {
            console.error(error);
            mostrarMensajeCompartir('No se pudo generar el PDF. ' + (error.message || ''), 9000);
        }
    };

    /* ---------------- Botón: Compartir certificado ----------------
       Comparte SIEMPRE el archivo PDF, nunca el enlace de la página. */
    window.compartirCertificado = async function () {
        try {
            let archivo = certificadoArchivo;
            if (!archivo) {
                mostrarMensajeCompartir('Preparando el certificado...');
                archivo = await prepararCertificado();
            }

            if (navigator.canShare && navigator.canShare({ files: [archivo] })) {
                try {
                    await navigator.share({ files: [archivo], title: 'Mi certificado' });
                    return;
                } catch (error) {
                    if (error && error.name === 'AbortError') return; // la persona canceló
                    console.warn('No se pudo abrir el menú de compartir:', error);
                }
            }

            descargarArchivoPDF(archivo);
            mostrarMensajeCompartir('Este navegador no permite compartir archivos desde la página. Se descargó el PDF para que lo adjuntes.', 8000);
        } catch (error) {
            console.error(error);
            mostrarMensajeCompartir('No fue posible generar el PDF para compartir. ' + (error.message || ''), 9000);
        }
    };

    /* ---------------- Reporte de respuestas ---------------- */
    window.descargarReporte = async function () {
        try {
            mostrarMensajeCompartir('Preparando el reporte de respuestas...');

            const registros = obtenerRegistrosReporte();
            if (!registros.length) {
                mostrarMensajeCompartir('No se encontraron respuestas guardadas para generar el reporte.');
                return;
            }

            const respuesta = await fetch(URL_REPORTE, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/pdf',
                    'X-CSRF-TOKEN': CSRF
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
            descargarArchivoPDF(new File([blob], 'Reporte-resultados-Un-Sorbito-Hoy-Un-Problema-Manana.pdf', { type: 'application/pdf' }));
            mostrarMensajeCompartir('Reporte descargado correctamente.');
        } catch (error) {
            mostrarMensajeCompartir(error.message || 'No se pudo generar el reporte.', 8000);
        }
    };

    function obtenerRegistrosReporte() {
        const registros = [];
        const banco = [
            { nivel: 1, preguntas: [
                { texto: "Tu hijo llega con los ojos rojos un sábado y dice que “solo comió mucho”. ¿Cuál es la primera acción recomendable?",
                  opciones: ["Confrontarlo de inmediato y registrar su cuarto.", "Observar si se repite el patrón y preparar una conversación calmada.", "Ignorarlo — los adolescentes exageran.", "Castigarlo preventivamente."], correcta: 1 },
                { texto: "¿Cuál combinación de señales debe generar mayor preocupación en un padre?",
                  opciones: ["Cambios de humor + amigos nuevos.", "Consumo abierto + mentiras frecuentes + dinero desaparecido.", "Bajas en notas únicamente.", "Distanciamiento de la familia."], correcta: 1 }
            ]},
            { nivel: 2, preguntas: [
                { texto: "¿Cuál es el factor de riesgo individual más fuerte para el inicio del consumo en Colombia?",
                  opciones: ["Tener bajas calificaciones académicas.", "Vacíos emocionales como ansiedad, soledad o baja autoestima.", "No tener dinero para consumir.", "Vivir en una ciudad grande."], correcta: 1 },
                { texto: "¿Por qué el cerebro adolescente evalúa el riesgo diferente al adulto?",
                  opciones: ["Porque son naturalmente rebeldes por actitud.", "Porque el lóbulo prefrontal (juicio y autocontrol) no madura hasta los 25 años.", "Porque tienen menor inteligencia.", "Porque producen más hormonas."], correcta: 1 }
            ]},
            { nivel: 3, preguntas: [
                { texto: "Tu hija de 16 años llega a las 2am con olor a alcohol. ¿Qué haces primero?",
                  opciones: ["Confrontarla inmediatamente y quitarle el celular.", "Verificar que está bien, dejarla dormir y hablar mañana con calma.", "Ignorarlo — casi es adulta.", "Llamar al colegio al día siguiente para reportarlo."], correcta: 1 },
                { texto: "¿Cuál frase abre mejor la conversación sobre consumo con tu hijo?",
                  opciones: ["“¿Estás consumiendo drogas? Necesito que me digas la verdad ya.”", "“Tu primo nunca hizo esto — ¿por qué tú sí?”", "“¿Cómo son las fiestas a las que vas? ¿Qué suele pasar ahí?”", "“Si te vuelvo a encontrar tomando, te quedas sin salidas dos meses.”"], correcta: 2 }
            ]},
            { nivel: 4, preguntas: [
                { texto: "Tu hijo de 14 años admite haber consumido marihuana 3 veces. ¿Cuál es la ruta correcta?",
                  opciones: ["Internarlo de inmediato en un centro de rehabilitación.", "Hablar con calma, entender el contexto y buscar orientación si se repite.", "Probar la droga tú mismo para entender el efecto.", "Ignorarlo — probar una vez no es el fin del mundo."], correcta: 1 },
                { texto: "En Colombia, ¿a qué línea llamar si tu hijo está en una crisis de consumo?",
                  opciones: ["Línea 123 (Policía).", "Línea 106 de Salud Mental — gratuita 24/7.", "Línea 141 del ICBF.", "Esperar a que pase y hablar mañana."], correcta: 1 }
            ]}
        ];

        banco.forEach(grupo => {
            const clave = `pp_quiz_${participacionId}_${grupo.nivel}`;
            let guardado = {};
            try { guardado = JSON.parse(localStorage.getItem(clave) || '{}'); } catch (e) {}

            const respuestas = guardado && guardado.respuestas && typeof guardado.respuestas === 'object'
                ? guardado.respuestas : {};

            grupo.preguntas.forEach((pregunta, indice) => {
                const tiene = Object.prototype.hasOwnProperty.call(respuestas, indice);
                const elegida = tiene ? Number(respuestas[indice]) : null;
                const valida = Number.isInteger(elegida) && !!pregunta.opciones[elegida];

                // Siempre se incluye la pregunta, aunque no esté respondida
                registros.push({
                    nivel: grupo.nivel,
                    pregunta: pregunta.texto,
                    elegida: valida ? pregunta.opciones[elegida] : 'No respondida',
                    respuestaCorrecta: pregunta.opciones[pregunta.correcta],
                    correcta: valida && elegida === pregunta.correcta,
                    respondida: valida
                });
            });
        });

        return registros;
    }

    /* ---------------- Compartir la plataforma (enlace) ---------------- */
    window.compartirPlataforma = async function () {
        const url = @json(url('/aprende'));
        const texto = 'Conoce “Un Sorbito Hoy, Un Problema Mañana”, una plataforma educativa de prevención y reflexión.';

        if (navigator.share) {
            try {
                await navigator.share({ title: 'Un Sorbito Hoy, Un Problema Mañana', text: texto, url: url });
                return;
            } catch (error) {
                if (error && error.name === 'AbortError') return;
            }
        }

        try {
            await navigator.clipboard.writeText(url);
            mostrarMensajeCompartir('Enlace de la plataforma copiado. Ya puedes compartirlo con otras personas.');
        } catch (error) {
            window.open('https://wa.me/?text=' + encodeURIComponent(texto + ' ' + url), '_blank', 'noopener,noreferrer');
        }
    };
})();
</script>
</body>
</html>