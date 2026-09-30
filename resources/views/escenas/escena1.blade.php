{{-- Escena educativa: Reconocer. El contenido sigue la información entregada por el usuario. --}}
@php
    $escenaActual = isset($escenaActual) ? (int) $escenaActual : 1;
    $totalEscenas = 4;
    // Posición (0-100) de cada nivel sobre la barra
    $posicion = fn ($n) => (($n - 1) / max($totalEscenas - 1, 1)) * 100;
    $porcentajeRecorrido = $posicion($escenaActual);

    /*
     * Recuperar el avatar guardado al finalizar la selección.
     * ParticipacionController guarda participacion_id y participante_avatar_id
     * en la sesión, y Participantes tiene la relación avatar().
     */
    $participanteActual = null;

    if (session()->has('participacion_id') && session('participacion_id')) {
        $participanteActual = \App\Models\Participantes::with('avatar')
            ->find(session('participacion_id'));
    }

    $avatarSeleccionado = $avatarSeleccionado
        ?? optional($participanteActual)->avatar;

    if (!$avatarSeleccionado && session()->has('participante_avatar_id') && session('participante_avatar_id')) {
        $avatarSeleccionado = \App\Models\Avatar::find(session('participante_avatar_id'));
    }

    $avatarNombre = optional($avatarSeleccionado)->nombre ?: 'Tu compañero';

    // La tabla avatares guarda el nombre de archivo en la columna imagen.
    $avatarArchivo = $avatarImagen
        ?? (isset($avatarSeleccionado) ? ($avatarSeleccionado->imagen ?? $avatarSeleccionado->ruta ?? null) : null)
        ?? session('avatar_imagen')
        ?? 'cuerpo.webp';

    if (str_starts_with($avatarArchivo, 'http://') || str_starts_with($avatarArchivo, 'https://')) {
        $avatarRuta = $avatarArchivo;
    } elseif (str_starts_with($avatarArchivo, '/')) {
        $avatarRuta = asset(ltrim($avatarArchivo, '/'));
    } elseif (str_starts_with($avatarArchivo, 'build/')) {
        $avatarRuta = asset($avatarArchivo);
    } else {
        $avatarRuta = asset('build/img/avatars/' . ltrim($avatarArchivo, '/'));
    }

    $avatarFallback = asset('build/img/avatars/cuerpo.webp');

    // Etapas del recorrido
    $etapas = ['Reconocer','Entender','Hablar','Prevenir'];

    // Señales: tipo (icono) y nivel de alerta
    $niveles = [
        'leve'     => ['Leve', 'bi-circle-fill'],
        'moderado' => ['Moderado', 'bi-circle-fill'],
        'grave'    => ['Grave', 'bi-exclamation-triangle-fill'],
        'ayuda'    => ['Busque ayuda ya', 'bi-telephone-fill'],
    ];
    $tipos = ['Física' => 'bi-heart-pulse', 'Conductual' => 'bi-person-lines-fill', 'Social' => 'bi-people'];

    $senales = [
        ['Ojos rojos, olor en ropa o aliento', 'Física', 'moderado'],
        ['Cambios bruscos de humor o irritabilidad', 'Conductual', 'moderado'],
        ['Bajón en notas, abandona actividades', 'Social', 'moderado'],
        ['Nuevos amigos que no quiere presentar', 'Social', 'leve'],
        ['Dinero o cosas desaparecidas en casa', 'Conductual', 'grave'],
        ['Aislamiento extremo o mentiras frecuentes', 'Conductual', 'grave'],
        ['Consume abiertamente sin esconderse', 'Conductual', 'ayuda'],
    ];

    // Preguntas del cuestionario
    $preguntas = [
        [
            'texto' => 'Tu hijo llega con los ojos rojos un sábado y dice que “solo comió mucho”. ¿Cuál es la primera acción recomendable?',
            'opciones' => [
                'Confrontarlo de inmediato y registrar su cuarto.',
                'Observar si se repite el patrón y preparar una conversación calmada.',
                'Ignorarlo — los adolescentes exageran.',
                'Castigarlo preventivamente.',
            ],
            'correcta' => 1,
            'ok'  => 'Observar el patrón antes de actuar y hablar desde la calma es la estrategia más efectiva.',
            'mal' => 'La respuesta recomendable es observar si se repite el patrón y preparar una conversación calmada.',
        ],
        [
            'texto' => '¿Cuál combinación de señales debe generar mayor preocupación en un padre?',
            'opciones' => [
                'Cambios de humor + amigos nuevos.',
                'Consumo abierto + mentiras frecuentes + dinero desaparecido.',
                'Bajas en notas únicamente.',
                'Distanciamiento de la familia.',
            ],
            'correcta' => 1,
            'ok'  => 'La combinación de varias señales preocupantes requiere atención y una conversación calmada para buscar apoyo.',
            'mal' => 'La combinación más preocupante es consumo abierto, mentiras frecuentes y dinero desaparecido.',
        ],
    ];
    $letras = ['A','B','C','D'];

    // Siguiente nivel. AJUSTA la URL a tu ruta real (o pásala desde el controlador como $urlSiguiente).
    $hayNivelSiguiente = $escenaActual < $totalEscenas;
    // Rutas de las escenas: la 1 vive en /escena y las demás en /aprende/escena/{n}
    $rutaEscena = fn ($n) => $n <= 1 ? url('/escena') : url('/aprende/escena/' . $n);
    $urlSiguiente = $urlSiguiente ?? ($hayNivelSiguiente ? $rutaEscena($escenaActual + 1) : url('/aprende'));
    $urlAnterior = $urlAnterior ?? ($escenaActual > 1 ? $rutaEscena($escenaActual - 1) : url('/aprende'));
    $posSiguiente = $hayNivelSiguiente ? $posicion($escenaActual + 1) : 100;
    $nombreMedalla = 'Detective de señales';
    // Copia medalla.webp en public/build/img/ (o pasa $medallaImagen desde el controlador)
    $medallaImagen = $medallaImagen ?? asset('build/img/medalla.webp');
    // Clave para recordar las respuestas de este participante en esta escena
    $claveQuiz = 'pp_quiz_' . (session('participacion_id') ?: 'anon') . '_' . $escenaActual;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reconocer señales | Aprende</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Nunito:wght@600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root{
            --navy:#152d4f; --blue:#2469b3; --blue-soft:#eaf2fc;
            --green:#1f7a55; --green-soft:#e6f4ec;
            --gold:#e9b530; --gold-soft:#fdf3d3; --gold-ink:#7a5a05;
            --red:#b3272f; --red-soft:#fde8e8;
            --amber:#a56a00; --amber-soft:#fff1cf;
            --ink:#1d2b40; --muted:#5f6d80; --paper:#fbf8f2; --card:#ffffff; --line:#e7e1d4;
            --r:16px; --blue-deep:#17457c;
            --font-title:"Nunito","Poppins",system-ui,sans-serif;
            --font-body:"Inter","Nunito",system-ui,-apple-system,"Segoe UI",sans-serif;
        }
        *,*::before,*::after{box-sizing:border-box}
        html{scroll-behavior:smooth}
        body{margin:0;background:var(--paper);color:var(--ink);font-family:var(--font-body);font-size:17px;line-height:1.65;-webkit-font-smoothing:antialiased}
        img{max-width:100%;display:block}
        :focus-visible{outline:3px solid var(--gold);outline-offset:3px}

        /* ---------- NAV CON PROGRESO ---------- */
        .nav{position:sticky;top:0;z-index:50;background:rgba(255,255,255,.95);border-bottom:1px solid var(--line);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px)}
        .nav-inner{max-width:1080px;margin:0 auto;padding:12px 24px 10px}
        .nav-row{display:flex;align-items:center;justify-content:space-between;gap:14px}
        .brand{display:flex;align-items:center;gap:12px;min-width:0}
        .back{flex:0 0 auto;width:42px;height:42px;display:grid;place-items:center;border:1px solid var(--line);border-radius:12px;background:#fff;color:var(--navy);font-size:18px;text-decoration:none;transition:background .2s}
        .back:hover{background:var(--blue-soft)}
        .brand-title{font-family:var(--font-title);font-size:21px;font-weight:800;line-height:1.1;color:var(--blue-deep)}
        .brand-sub{font-size:14px;color:var(--muted)}
        .scene-count{flex:0 0 auto;text-align:right;line-height:1.2}
        .scene-count strong{display:block;font-size:16px;color:var(--navy)}
        .scene-count span{font-size:14px;color:var(--muted)}

        .progress{padding:18px 0 0}
        .track-area{position:relative;margin:0 44px}
        .track{position:relative;height:8px;border-radius:99px;background:#e9e4d8}
        .fill{height:100%;width:{{ $porcentajeRecorrido }}%;border-radius:inherit;background:linear-gradient(90deg,var(--blue),var(--gold));transition:width .6s ease}
        .stops{position:absolute;inset:0}
        .stop{position:absolute;top:50%;width:16px;height:16px;transform:translate(-50%,-50%);border-radius:50%;background:#fff;border:3px solid #cfc8b8}
        .stop.done{border-color:var(--gold);background:var(--gold)}
        .stop.current{border-color:var(--blue)}
        .marker{position:absolute;z-index:2;top:50%;left:{{ $porcentajeRecorrido }}%;width:36px;height:36px;transform:translate(-50%,-50%);border:3px solid #fff;border-radius:50%;background:var(--blue-soft);box-shadow:0 0 0 3px rgba(36,105,179,.35),0 4px 10px rgba(21,45,79,.28);overflow:hidden;transition:left .6s ease}
        .marker img{width:100%;height:100%;object-fit:cover;object-position:center top}
        .labels{position:relative;height:24px;margin-top:16px}
        .labels span{position:absolute;top:0;transform:translateX(-50%);text-align:center;font-size:14px;color:#8a8577;font-weight:700;white-space:nowrap}
        .labels .done{color:var(--gold-ink)}
        .labels .current{color:var(--blue)}

        /* ---------- PÁGINA ---------- */
        .page{max-width:1080px;margin:0 auto;padding:36px 24px 64px}
        .tag{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:99px;background:var(--green-soft);color:var(--green);font-size:14px;font-weight:700}
        h1{max-width:860px;margin:16px 0 14px;font-family:var(--font-title);font-size:clamp(34px,5.4vw,54px);font-weight:900;line-height:1.1;letter-spacing:-.02em;color:var(--blue-deep)}
        .lead{max-width:740px;margin:0 0 32px;font-size:clamp(18px,2.2vw,21px);font-weight:500;line-height:1.6;color:#48576b}

        .section-title{display:flex;align-items:center;gap:10px;margin:0 0 8px;font-family:var(--font-title);font-size:clamp(25px,3.4vw,32px);font-weight:800;line-height:1.2;letter-spacing:-.01em;color:var(--green)}
        .section-title i{color:var(--blue);font-size:.85em}
        #quiz-title{color:var(--blue-deep)}
        .section-sub{margin:0 0 18px;color:#48576b;font-size:18px;font-weight:500}
        section+section,.block{margin-top:36px}

        /* Dato destacado */
        .stat{display:grid;grid-template-columns:auto 1fr;align-items:center;gap:22px;padding:22px 26px;border:1px solid #cfe0f5;border-radius:var(--r);background:var(--blue-soft)}
        .stat-num{font-family:var(--font-title);font-size:56px;line-height:1;font-weight:900;color:var(--blue)}
        .stat h3{margin:0 0 4px;font-family:var(--font-title);font-size:21px;font-weight:800;color:var(--blue-deep)}
        .stat p{margin:0;font-size:17px;color:#3f4e64}

        /* Leyenda */
        .legend{display:flex;flex-wrap:wrap;gap:8px 16px;margin:0 0 14px;font-size:14px;color:var(--muted)}
        .legend span{display:inline-flex;align-items:center;gap:6px}
        .dot{width:10px;height:10px;border-radius:50%}

        /* Lista de señales */
        .signals{display:grid;gap:10px;margin:0;padding:0;list-style:none}
        .signal{display:grid;grid-template-columns:44px 1fr auto;align-items:center;gap:14px;padding:14px 16px;border:1px solid var(--line);border-left-width:5px;border-radius:14px;background:var(--card)}
        .signal.leve{border-left-color:#3aa574}.signal.moderado{border-left-color:var(--gold)}.signal.grave{border-left-color:#e0563c}.signal.ayuda{border-left-color:var(--red)}
        .signal-icon{width:44px;height:44px;display:grid;place-items:center;border-radius:12px;background:var(--blue-soft);color:var(--blue);font-size:20px}
        .signal-text{font-size:17px;font-weight:600;color:var(--ink);line-height:1.35}
        .signal-type{display:block;margin-top:2px;font-size:14px;font-weight:500;color:var(--muted)}
        .badge{display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border-radius:99px;font-size:14px;font-weight:700;white-space:nowrap}
        .badge.leve{background:var(--green-soft);color:var(--green)}
        .badge.moderado{background:var(--amber-soft);color:var(--amber)}
        .badge.grave,.badge.ayuda{background:var(--red-soft);color:var(--red)}
        .badge .bi-circle-fill{font-size:7px}

        .note{display:flex;gap:16px;margin-top:18px;padding:18px 22px;border:1px solid #f0d99a;border-radius:var(--r);background:var(--gold-soft)}
        .note>i{font-size:24px;color:var(--amber);line-height:1.3}
        .note h3{margin:0 0 4px;font-family:var(--font-title);font-size:20px;font-weight:800;color:var(--blue-deep)}
        .note p{margin:0;font-size:17px;color:#5b5238}

        /* ---------- CUESTIONARIO ---------- */
        .quiz-head{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;flex-wrap:wrap;margin-bottom:18px}
        .xp{display:flex;align-items:center;gap:12px;padding:10px 18px;border:1px solid #f0d99a;border-radius:14px;background:var(--gold-soft)}
        .xp i{font-size:24px;color:var(--amber)}
        .xp strong{display:block;font-size:20px;line-height:1.1;color:#634700}
        .xp small{font-size:13px;color:#7d6a35}

        .quiz{display:grid;grid-template-columns:250px minmax(0,1fr);gap:22px;align-items:start}
        .coach{position:sticky;top:150px;padding:22px 18px;text-align:center;border:1px solid var(--line);border-radius:var(--r);background:var(--card);box-shadow:0 6px 20px rgba(60,45,10,.06)}
        .coach-img{width:100%;max-width:190px;aspect-ratio:3/4;margin:0 auto 14px;display:flex;align-items:flex-end;justify-content:center;border-radius:20px 20px 12px 12px;background:linear-gradient(170deg,#e4efff,#fdf3d3);overflow:hidden}
        .coach-img img{width:100%;height:100%;object-fit:contain;object-position:center bottom}
        .coach h3{margin:0;font-family:var(--font-title);font-size:23px;font-weight:800;color:var(--blue-deep)}
        .coach small{display:block;margin:2px 0 10px;font-size:14px;color:var(--muted)}
        .coach p{margin:0;font-size:15px;line-height:1.5;color:var(--muted)}
        .quiz-meter{margin-top:16px;text-align:left;font-size:14px;color:var(--muted)}
        .quiz-meter div{display:flex;justify-content:space-between;margin-bottom:6px}
        .quiz-meter strong{color:var(--navy)}
        .meter-track{height:8px;border-radius:99px;background:#e9e4d8;overflow:hidden}
        .meter-fill{height:100%;width:0;border-radius:inherit;background:linear-gradient(90deg,var(--blue),var(--green));transition:width .35s}

        .questions{display:grid;gap:16px;min-width:0}
        .q{padding:24px;border:1px solid var(--line);border-radius:var(--r);background:var(--card);box-shadow:0 4px 16px rgba(60,45,10,.05)}
        .q-top{display:flex;justify-content:space-between;align-items:center;gap:10px;margin-bottom:10px}
        .q-num{font-size:15px;font-weight:700;color:var(--blue)}
        .q-xp{font-size:14px;font-weight:700;color:var(--amber);background:var(--gold-soft);padding:3px 10px;border-radius:99px}
        .q h3{margin:0 0 16px;font-family:var(--font-title);font-size:21px;font-weight:800;line-height:1.4;color:var(--blue-deep)}
        .answers{display:grid;gap:10px}
        .answer{display:flex;align-items:flex-start;gap:14px;width:100%;padding:14px 16px;text-align:left;border:2px solid #e4dfd2;border-radius:12px;background:#fff;color:var(--ink);font:inherit;font-size:17px;line-height:1.45;cursor:pointer;transition:border-color .18s,background .18s}
        .answer .letter{flex:0 0 30px;width:30px;height:30px;display:grid;place-items:center;border-radius:50%;background:#f1ede2;color:var(--navy);font-size:15px;font-weight:700}
        .answer:hover:not(:disabled){border-color:var(--blue);background:#f6faff}
        .answer:disabled{cursor:default}
        .answer.correct{border-color:#3aa574;background:#f0faf4}
        .answer.correct .letter{background:#3aa574;color:#fff}
        .answer.incorrect{border-color:#e0563c;background:#fff5f3}
        .answer.incorrect .letter{background:#e0563c;color:#fff}
        .feedback{display:flex;gap:10px;margin-top:14px;padding:14px 16px;border-radius:12px;font-size:16px;line-height:1.5}
        .feedback.good{background:var(--green-soft);color:#155c3f}
        .feedback.bad{background:var(--red-soft);color:#8f1f26}
        .feedback[hidden]{display:none}

        .finish{display:flex;align-items:center;gap:14px;padding:18px 20px;border:1px solid #b9e2cb;border-radius:var(--r);background:var(--green-soft)}
        .finish[hidden]{display:none}
        .finish>i{font-size:30px;color:var(--green)}
        .finish strong{display:block;font-family:var(--font-title);font-size:19px;font-weight:800;color:#155c3f}
        .finish p{margin:2px 0 0;font-size:16px;color:#3f7659}

        /* ---------- ACCIONES ---------- */
        .actions{display:flex;justify-content:space-between;align-items:center;gap:14px;flex-wrap:wrap;margin-top:40px;padding-top:24px;border-top:1px solid var(--line)}
        .hint{flex-basis:100%;margin:0;font-size:15px;color:var(--red)}
        .hint[hidden]{display:none}
        .btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;min-height:50px;padding:12px 22px;border:2px solid #d9d3c4;border-radius:12px;background:#fff;color:var(--navy);font:inherit;font-size:16px;font-weight:700;text-decoration:none;cursor:pointer;transition:transform .2s,box-shadow .2s}
        .btn:hover{transform:translateY(-1px)}
        .btn-primary{border-color:var(--gold);background:var(--gold);box-shadow:0 8px 18px rgba(200,150,20,.25)}
        .btn:disabled{opacity:.75;cursor:default;transform:none}

        .locked-note{display:flex;align-items:flex-start;gap:10px;padding:14px 16px;border:1px solid #f0d99a;border-radius:12px;background:var(--gold-soft);color:#5b5238;font-size:16px;line-height:1.5}
        .locked-note[hidden]{display:none}
        .locked-note i{margin-top:2px;font-size:18px;color:var(--amber)}
        .answer:disabled:not(.correct):not(.incorrect){opacity:.7}

        /* ---------- RECOMPENSAS: MEDALLA Y RESULTADO ---------- */
        .rewards{display:flex;align-items:center;gap:12px;flex-wrap:wrap}
        .medal-chip{display:inline-flex;align-items:center;gap:10px;padding:10px 16px;border:1px solid #f0d99a;border-radius:14px;background:#fff;color:#634700;font:inherit;font-size:15px;font-weight:700;cursor:pointer;animation:pop .5s cubic-bezier(.34,1.56,.64,1)}
        .medal-chip img{width:34px;height:34px;object-fit:contain}
        .medal-chip[hidden]{display:none}
        .modal{position:fixed;inset:0;z-index:100;display:grid;place-items:center;padding:20px;background:rgba(15,32,58,.62);backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px)}
        .modal[hidden]{display:none}
        .modal-card{position:relative;z-index:2;width:min(460px,100%);max-height:calc(100vh - 40px);overflow:auto;padding:28px 24px 24px;text-align:center;border-radius:24px;background:#fff;box-shadow:0 30px 70px rgba(10,25,50,.4);animation:pop .5s cubic-bezier(.34,1.56,.64,1)}
        .medal-stage{width:176px;height:176px;margin:0 auto 4px}
        .medal{width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 10px 14px rgba(160,110,10,.3));transform-origin:50% 60%;animation:swing 1.6s ease-out .25s both}
        .almost{width:104px;height:104px;margin:14px auto 18px;display:grid;place-items:center;border-radius:50%;background:var(--blue-soft);color:var(--blue);font-size:46px}
        .medal[hidden],.almost[hidden]{display:none}
        .modal-card h2{margin:4px 0 8px;font-family:var(--font-title);font-size:clamp(26px,6vw,32px);font-weight:900;line-height:1.15;color:var(--blue-deep)}
        .modal-card p{margin:0 auto 18px;max-width:36ch;font-size:17px;color:#48576b}
        .modal-stats{display:flex;justify-content:center;gap:12px;margin-bottom:22px}
        .modal-stats div{flex:1;max-width:150px;padding:10px;border-radius:14px;background:var(--gold-soft)}
        .modal-stats strong{display:block;font-family:var(--font-title);font-size:28px;font-weight:900;line-height:1.1;color:#634700}
        .modal-stats span{font-size:14px;color:#7d6a35}
        .modal-actions{display:grid;gap:10px}
        .confetti{position:absolute;inset:0;z-index:1;pointer-events:none;overflow:hidden}
        .confetti i{position:absolute;top:-20px;width:10px;height:16px;border-radius:2px;animation:fall linear forwards}
        @keyframes pop{from{opacity:0;transform:scale(.75)}to{opacity:1;transform:scale(1)}}
        @keyframes swing{0%{transform:rotate(-16deg) scale(.5);opacity:0}40%{transform:rotate(9deg) scale(1.06);opacity:1}70%{transform:rotate(-4deg)}100%{transform:rotate(0)}}
        @keyframes fall{to{transform:translate3d(var(--dx),110vh,0) rotate(var(--rot))}}

        /* ---------- RESPONSIVE ---------- */
        @media(max-width:860px){
            .quiz{grid-template-columns:1fr}
            .coach{position:static;display:grid;grid-template-columns:110px 1fr;column-gap:16px;align-items:center;text-align:left;padding:16px}
            .coach-img{grid-row:1 / span 3;max-width:none;margin:0}
            .quiz-meter{grid-column:1 / -1}
        }
        @media(max-width:640px){
            body{font-size:16px}
            .nav-inner{padding:10px 14px 8px}
            .brand-sub{display:none}
            .brand-title{font-size:18px}
            .progress{padding:16px 0 0}
            .track-area{margin:0 36px}
            .marker{width:32px;height:32px}
            .labels{margin-top:14px}
            .labels span{font-size:13px}
            .page{padding:26px 16px 48px}
            .lead{font-size:17px}
            .stat{grid-template-columns:1fr;gap:8px;padding:18px}
            .stat-num{font-size:44px}
            .signal{grid-template-columns:40px 1fr;gap:12px;padding:12px 14px}
            .signal-icon{width:40px;height:40px;font-size:18px}
            .signal .badge{grid-column:2;justify-self:start}
            .q{padding:18px 16px}
            .q h3{font-size:20px}
            .section-sub{font-size:17px}
            .signal-type,.legend,.hint,.quiz-meter,.coach p,.coach small,.feedback,.finish p,.note p,.stat p,.xp small,.q-num,.tag{font-size:16px}
            .answer{font-size:16px;padding:12px}
            .coach{grid-template-columns:90px 1fr}
            .actions{flex-direction:column-reverse;align-items:stretch}
            .btn{width:100%}
        }
        @media(prefers-reduced-motion:reduce){*,*::before,*::after{transition:none!important;animation:none!important;scroll-behavior:auto!important}}
    </style>
</head>
<body>

{{-- ============ NAV + PROGRESO ============ --}}
<header class="nav">
    <div class="nav-inner">
        <div class="nav-row">
            <div class="brand">
                <a href="{{ url('/aprende') }}" class="back" aria-label="Volver a Aprende"><i class="bi bi-arrow-left"></i></a>
                <div>
                    <div class="brand-title">Aprende</div>
                    <div class="brand-sub">Comprender también es prevenir</div>
                </div>
            </div>
            <div class="scene-count">
                <strong>Nivel {{ $escenaActual }} de {{ $totalEscenas }}</strong>
                <span>{{ $etapas[$escenaActual - 1] ?? '' }}</span>
            </div>
        </div>

        <div class="progress" role="progressbar" aria-label="Progreso del recorrido"
             aria-valuemin="1" aria-valuemax="{{ $totalEscenas }}" aria-valuenow="{{ $escenaActual }}"
             aria-valuetext="Nivel {{ $escenaActual }} de {{ $totalEscenas }}: {{ $etapas[$escenaActual - 1] ?? '' }}">
            <div class="track-area">
                <div class="track">
                    <div class="fill"></div>
                    <div class="stops">
                    @for($i = 1; $i <= $totalEscenas; $i++)
                        <span class="stop {{ $i < $escenaActual ? 'done' : '' }} {{ $i === $escenaActual ? 'current' : '' }}" style="left:{{ $posicion($i) }}%"></span>
                    @endfor
                    </div>
                    <div class="marker" title="{{ $avatarNombre }}">
                        <img src="{{ $avatarRuta }}" alt="{{ $avatarNombre }} en el recorrido" onerror="this.onerror=null;this.src='{{ $avatarFallback }}'">
                    </div>
                </div>
                <div class="labels">
                    @foreach($etapas as $index => $label)
                        <span class="{{ ($index + 1) < $escenaActual ? 'done' : '' }} {{ ($index + 1) === $escenaActual ? 'current' : '' }}" style="left:{{ $posicion($index + 1) }}%">{{ $label }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>

<main class="page">

    {{-- ============ ENCABEZADO ============ --}}
    <div class="tag"><i class="bi bi-search"></i> Nivel 1 · Reconocer señales</div>
    <h1>¿Cómo saber si mi hijo/a está consumiendo?</h1>
    <p class="lead">En Colombia, la edad de inicio de consumo de alcohol es de 12 años en promedio. Las señales no siempre son obvias — aprenderlas es el primer paso.</p>

    {{-- ============ DATO ============ --}}
    <section class="stat" aria-label="Dato informativo">
        <div class="stat-num">34%</div>
        <div>
            <h3>Dato Quindio 2022</h3>
            <p>En el Quindío, el 27,5 % de los estudiantes ha consumido alcohol. La edad de inicio se encuentra alrededor de los 13 años, por lo que la prevención y el acompañamiento familiar son fundamentales desde edades tempranas. el alcohol puede convertirse en una de las primeras sustancias exploradas durante la adolescencia. La sustancia exploratoria es aquella que un adolescente prueba por curiosidad, presión de grupo o deseo de experimentar. Prevenir también significa acompañar ese primer acercamiento y hablar a tiempo.</p>
        </div>
    </section>

    {{-- ============ SEÑALES ============ --}}
    <section aria-labelledby="senales-title">
        <h2 class="section-title" id="senales-title"><i class="bi bi-eye"></i> Señales físicas, conductuales y sociales</h2>
        <p class="section-sub">Cada señal indica un nivel de alerta. Fíjese en cuántas aparecen juntas.</p>

        <div class="legend" aria-hidden="true">
            <span><i class="dot" style="background:#3aa574"></i> Leve</span>
            <span><i class="dot" style="background:var(--gold)"></i> Moderado</span>
            <span><i class="dot" style="background:#e0563c"></i> Grave</span>
            <span><i class="dot" style="background:var(--red)"></i> Busque ayuda ya</span>
        </div>

        <ul class="signals">
            @foreach($senales as [$texto, $tipo, $nivel])
                <li class="signal {{ $nivel }}">
                    <span class="signal-icon"><i class="bi {{ $tipos[$tipo] }}"></i></span>
                    <span class="signal-text">{{ $texto }}<span class="signal-type">Señal {{ strtolower($tipo) }}</span></span>
                    <span class="badge {{ $nivel }}"><i class="bi {{ $niveles[$nivel][1] }}"></i> {{ $niveles[$nivel][0] }}</span>
                </li>
            @endforeach
        </ul>

        <aside class="note">
            <i class="bi bi-lightbulb"></i>
            <div>
                <h3>No lo confunda con adolescencia normal</h3>
                <p>Lo que preocupa es la intensidad, la frecuencia y la combinación de varias señales a la vez — no una señal aislada.</p>
            </div>
        </aside>
    </section>

    {{-- ============ CUESTIONARIO ============ --}}
    <section aria-labelledby="quiz-title">
        <div class="quiz-head">
            <div>
                <div class="tag"><i class="bi bi-controller"></i> Actividad interactiva</div>
                <h2 class="section-title" id="quiz-title" style="margin-top:12px">Ponga a prueba lo aprendido</h2>
                <p class="section-sub" style="margin:0">Elija con calma: cada pregunta se responde una sola vez. Solo los aciertos suman XP; si acierta todas, gana un bono.</p>
            </div>
            <div class="rewards">
                <div class="xp" aria-live="polite">
                    <i class="bi bi-lightning-charge-fill"></i>
                    <div><strong><span id="xpTotal">0</span> XP</strong><small>Experiencia ganada</small></div>
                </div>
                <button type="button" class="medal-chip" id="medalChip" hidden>
                    <img src="{{ $medallaImagen }}" alt="" onerror="this.hidden=true"> {{ $nombreMedalla }}
                </button>
            </div>
        </div>

        <div class="quiz">
            <aside class="coach">
                <div class="coach-img">
                    <img src="{{ $avatarRuta }}" alt="{{ $avatarNombre }}, tu compañero" onerror="this.onerror=null;this.src='{{ $avatarFallback }}'">
                </div>
                <h3>{{ $avatarNombre }}</h3>
                <small>Tu compañero · Nivel {{ $escenaActual }}</small>
                <p>Piense con calma y elija la opción que ayude a conversar y buscar apoyo.</p>

                <div class="quiz-meter">
                    <div><span>Respondidas</span><strong><span id="quizAnswered">0</span> de {{ count($preguntas) }}</strong></div>
                    <div class="meter-track"><div class="meter-fill" id="quizProgressFill"></div></div>
                    <div style="margin:10px 0 0"><span>Aciertos</span><strong><span id="quizCorrect">0</span> de {{ count($preguntas) }}</strong></div>
                </div>
            </aside>

            <div class="questions">
                <p class="locked-note" id="lockedNote" role="status" hidden><i class="bi bi-lock-fill"></i> <span>Ya respondió este cuestionario. Solo se puede contestar una vez, por eso sus respuestas quedan guardadas.</span></p>
                @foreach($preguntas as $n => $p)
                    <article class="q" data-correct="{{ $p['correcta'] }}" data-ok="{{ $p['ok'] }}" data-mal="{{ $p['mal'] }}">
                        <div class="q-top">
                            <span class="q-num">Pregunta {{ $n + 1 }} de {{ count($preguntas) }}</span>
                            <span class="q-xp">+10 XP</span>
                        </div>
                        <h3>{{ $p['texto'] }}</h3>
                        <div class="answers">
                            @foreach($p['opciones'] as $i => $opcion)
                                <button type="button" class="answer" data-option="{{ $i }}">
                                    <span class="letter">{{ $letras[$i] }}</span>
                                    <span>{{ $opcion }}</span>
                                </button>
                            @endforeach
                        </div>
                        <div class="feedback" role="status" aria-live="polite" hidden></div>
                    </article>
                @endforeach

                <div class="finish" id="quizFinish" hidden>
                    <i class="bi bi-trophy-fill"></i>
                    <div>
                        <strong>¡Cuestionario completado!</strong>
                        <p id="quizFinishText"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ ACCIONES ============ --}}
    <div class="actions">
        <a class="btn" href="{{ url('/aprende') }}"><i class="bi bi-arrow-left"></i> Volver al recorrido</a>
        <button class="btn btn-primary" id="btnCompletar" type="button" onclick="completarEscena()">
            {{ $hayNivelSiguiente ? 'Continuar al Nivel ' . ($escenaActual + 1) : 'Finalizar recorrido' }} <i class="bi bi-arrow-right"></i>
        </button>
        <p class="hint" id="quizHint" role="alert" hidden>Responda las dos preguntas para continuar al siguiente nivel.</p>
    </div>

</main>

{{-- ============ RESULTADO / MEDALLA ============ --}}
<div class="modal" id="resultModal" hidden>
    <div class="confetti" id="confetti" aria-hidden="true"></div>
    <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="medal-stage">
            <img class="medal" id="medalImg" src="{{ $medallaImagen }}" alt="Medalla dorada con una estrella" hidden>
            <div class="almost" id="almostIcon" hidden><i class="bi bi-flag-fill"></i></div>
        </div>
        <h2 id="modalTitle"></h2>
        <p id="modalText"></p>
        <div class="modal-stats">
            <div><strong id="modalXp">0</strong><span>XP ganados</span></div>
            <div><strong id="modalAciertos">0</strong><span>Aciertos</span></div>
        </div>
        <div class="modal-actions">
            <button type="button" class="btn btn-primary" id="modalNext">
                {{ $hayNivelSiguiente ? 'Continuar al Nivel ' . ($escenaActual + 1) : 'Finalizar recorrido' }} <i class="bi bi-arrow-right"></i>
            </button>
            <button type="button" class="btn" id="modalClose">Revisar mis respuestas</button>
        </div>
    </div>
</div>

<script>
    (() => {
        const PUNTOS = 10;
        const BONO = 10;
        let xp = 0;
        let respondidas = 0;
        let aciertos = 0;

        const xpTotal = document.getElementById('xpTotal');
        const quizAnswered = document.getElementById('quizAnswered');
        const quizCorrect = document.getElementById('quizCorrect');
        const quizProgressFill = document.getElementById('quizProgressFill');
        const quizFinish = document.getElementById('quizFinish');
        const quizFinishText = document.getElementById('quizFinishText');
        const quizHint = document.getElementById('quizHint');
        const tarjetas = Array.from(document.querySelectorAll('.q'));

        function actualizar() {
            xpTotal.textContent = xp;
            quizAnswered.textContent = respondidas;
            quizCorrect.textContent = aciertos;
            quizProgressFill.style.width = (respondidas / tarjetas.length * 100) + '%';
        }

        function mensaje(feedback, clase, titulo, texto) {
            feedback.hidden = false;
            feedback.className = 'feedback ' + clase;
            feedback.textContent = '';
            const strong = document.createElement('strong');
            strong.textContent = titulo + ' ';
            const span = document.createElement('span');
            span.textContent = texto;
            const box = document.createElement('div');
            box.append(strong, span);
            feedback.append(box);
        }

        const ESCENA = {{ $escenaActual }};
        const HAY_SIGUIENTE = @json($hayNivelSiguiente);
        const URL_SIGUIENTE = @json($urlSiguiente);
        const POS_SIGUIENTE = {{ $posSiguiente }};
        const POS_ACTUAL = {{ $porcentajeRecorrido }};
        const CLAVE_QUIZ = @json($claveQuiz);
        const NOMBRE_MEDALLA = @json($nombreMedalla);
        let yendo = false;

        const modal = document.getElementById('resultModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalText = document.getElementById('modalText');
        const modalXp = document.getElementById('modalXp');
        const modalAciertos = document.getElementById('modalAciertos');
        const modalNext = document.getElementById('modalNext');
        const modalClose = document.getElementById('modalClose');
        const medalImg = document.getElementById('medalImg');
        // Respaldo por si la imagen no carga: medalla dibujada en SVG
        const MEDALLA_RESPALDO = 'data:image/svg+xml,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 150"><defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#ffe58a"/><stop offset=".5" stop-color="#f0b429"/><stop offset="1" stop-color="#c88a0a"/></linearGradient></defs><path d="M30 0h26l16 54H46z" fill="#2469b3"/><path d="M90 0H64L48 54h26z" fill="#1f7a55"/><circle cx="60" cy="92" r="44" fill="url(#g)"/><circle cx="60" cy="92" r="34" fill="none" stroke="#fff6cf" stroke-width="3"/><polygon points="60,70 65.3,84.7 80.9,85.2 68.6,94.8 72.9,109.8 60,101 47.1,109.8 51.4,94.8 39.1,85.2 54.7,84.7" fill="#fffbe8"/></svg>');
        medalImg.addEventListener('error', () => { medalImg.src = MEDALLA_RESPALDO; }, { once: true });
        const almostIcon = document.getElementById('almostIcon');
        const medalChip = document.getElementById('medalChip');
        let focoPrevio = null;

        function guardarProgreso() {
            try {
                const k = 'pp_progreso';
                const d = JSON.parse(sessionStorage.getItem(k) || '{}');
                d.niveles = d.niveles || {};
                d.niveles[ESCENA] = { xp: xp, aciertos: aciertos, medalla: aciertos === tarjetas.length };
                const lista = Object.values(d.niveles);
                d.xp = lista.reduce((t, n) => t + n.xp, 0);
                d.medallas = lista.filter(n => n.medalla).length;
                sessionStorage.setItem(k, JSON.stringify(d));
            } catch (e) { /* almacenamiento no disponible */ }
        }

        function confeti() {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
            const caja = document.getElementById('confetti');
            caja.textContent = '';
            const colores = ['#e9b530', '#2469b3', '#1f7a55', '#e0563c', '#8a5cf0'];
            for (let i = 0; i < 70; i++) {
                const c = document.createElement('i');
                c.style.left = (Math.random() * 100) + '%';
                c.style.background = colores[i % colores.length];
                c.style.setProperty('--dx', (Math.random() * 160 - 80) + 'px');
                c.style.setProperty('--rot', (Math.random() * 720) + 'deg');
                c.style.animationDuration = (2.2 + Math.random() * 2) + 's';
                c.style.animationDelay = (Math.random() * .7) + 's';
                caja.append(c);
            }
        }

        function mostrarResultado() {
            const perfecto = aciertos === tarjetas.length;
            guardarProgreso();
            focoPrevio = document.activeElement;

            medalImg.hidden = !perfecto;
            almostIcon.hidden = perfecto;
            modalXp.textContent = xp;
            modalAciertos.textContent = aciertos + '/' + tarjetas.length;

            if (perfecto) {
                modalTitle.textContent = '¡Medalla ganada!';
                modalText.textContent = 'Ganó la medalla “' + NOMBRE_MEDALLA + '” por acertar las ' + tarjetas.length + ' preguntas.';
                medalChip.hidden = false;
            } else {
                modalTitle.textContent = '¡Buen intento!';
                modalText.textContent = 'Acertó ' + aciertos + ' de ' + tarjetas.length + '. Repase las señales y continúe: en el próximo nivel puede ganar su medalla.';
            }

            modal.hidden = false;
            modalNext.focus();
            if (perfecto) confeti();
        }

        function cerrarModal() {
            modal.hidden = true;
            if (focoPrevio && focoPrevio.focus) focoPrevio.focus({ preventScroll: true });
        }

        modalClose.addEventListener('click', cerrarModal);
        modalNext.addEventListener('click', () => window.completarEscena());
        medalChip.addEventListener('click', mostrarResultado);
        modal.addEventListener('click', (e) => { if (e.target === modal) cerrarModal(); });
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !modal.hidden) cerrarModal(); });

        // ---- Una sola oportunidad: las respuestas se guardan al instante ----
        const lockedNote = document.getElementById('lockedNote');

        function leerGuardado() {
            try { return JSON.parse(localStorage.getItem(CLAVE_QUIZ) || '{}'); } catch (e) { return {}; }
        }
        function escribirGuardado(datos) {
            try { localStorage.setItem(CLAVE_QUIZ, JSON.stringify(datos)); } catch (e) { /* almacenamiento no disponible */ }
        }

        const guardado = leerGuardado();
        // { "0": 1, "1": 2 } → índice de pregunta : opción elegida
        const respuestasGuardadas = (guardado.respuestas && typeof guardado.respuestas === 'object') ? guardado.respuestas : {};

        function aplicarRespuesta(tarjeta, elegida) {
            const correcta = Number(tarjeta.dataset.correct);
            const opciones = Array.from(tarjeta.querySelectorAll('.answer'));
            const feedback = tarjeta.querySelector('.feedback');

            tarjeta.dataset.answered = 'true';
            respondidas += 1;

            opciones.forEach((b, i) => {
                b.disabled = true;
                if (i === correcta) b.classList.add('correct');
            });

            if (elegida === correcta) {
                xp += PUNTOS;
                aciertos += 1;
                mensaje(feedback, 'good', '✓ ¡Correcto!', tarjeta.dataset.ok);
            } else {
                if (opciones[elegida]) opciones[elegida].classList.add('incorrect');
                let por = {};
                try { por = JSON.parse(tarjeta.dataset.por || '{}'); } catch (e) { /* sin mensajes específicos */ }
                const extra = por[elegida] ? por[elegida] + ' ' : '';
                mensaje(feedback, 'bad', 'Revise esta respuesta.', extra + tarjeta.dataset.mal);
            }
            actualizar();
        }

        function finalizarCuestionario(restaurando) {
            const perfecto = aciertos === tarjetas.length;
            if (perfecto) xp += BONO;
            actualizar();

            quizFinish.hidden = false;
            quizFinishText.textContent = perfecto
                ? 'Acertó las ' + tarjetas.length + ' preguntas y ganó ' + xp + ' XP, incluido el bono de ' + BONO + ' XP por no fallar ninguna.'
                : 'Acertó ' + aciertos + ' de ' + tarjetas.length + ' preguntas y ganó ' + xp + ' XP. Repase el contenido de arriba para reforzar lo aprendido.';

            if (perfecto) medalChip.hidden = false;
            guardarProgreso();

            // Al volver a la página no se repite la celebración
            if (!restaurando) {
                quizFinish.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                setTimeout(mostrarResultado, 900);
            }
        }

        tarjetas.forEach((tarjeta, indice) => {
            tarjeta.querySelectorAll('.answer').forEach((opcion) => {
                opcion.addEventListener('click', () => {
                    if (tarjeta.dataset.answered === 'true') return;
                    const elegida = Number(opcion.dataset.option);

                    // Se guarda antes de mostrar nada: recargar o volver atrás no permite cambiarla
                    respuestasGuardadas[indice] = elegida;
                    escribirGuardado({ respuestas: respuestasGuardadas });

                    aplicarRespuesta(tarjeta, elegida);
                    quizHint.hidden = true;

                    if (respondidas === tarjetas.length) finalizarCuestionario(false);
                });
            });
        });

        // Restaurar lo ya respondido (recarga o regreso a la página)
        let hayRestauradas = false;
        tarjetas.forEach((tarjeta, indice) => {
            const previa = respuestasGuardadas[indice];
            if (Number.isInteger(previa) && previa >= 0) {
                aplicarRespuesta(tarjeta, previa);
                hayRestauradas = true;
            }
        });
        if (hayRestauradas) {
            lockedNote.hidden = false;
            if (respondidas === tarjetas.length) finalizarCuestionario(true);
        }

        window.completarEscena = function () {
            if (respondidas < tarjetas.length) {
                const pendiente = tarjetas.find(t => t.dataset.answered !== 'true');
                quizHint.hidden = false;
                if (pendiente) {
                    pendiente.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    const primera = pendiente.querySelector('.answer:not(:disabled)');
                    if (primera) primera.focus({ preventScroll: true });
                }
                return;
            }
            if (yendo) return;
            yendo = true;

            const boton = document.getElementById('btnCompletar');
            boton.innerHTML = '<i class="bi bi-check-circle-fill"></i> Avanzando…';
            boton.disabled = true;
            modalNext.disabled = true;

            guardarProgreso();
            window.dispatchEvent(new CustomEvent('escena:completada', {
                detail: { escena: ESCENA, xp: xp, aciertos: aciertos, medalla: aciertos === tarjetas.length, quizCompletado: true }
            }));

            // El avatar avanza al siguiente punto de la barra antes de cambiar de página
            modal.hidden = true;
            window.scrollTo({ top: 0, behavior: 'smooth' });
            const fill = document.querySelector('.fill');
            const marker = document.querySelector('.marker');
            if (fill) fill.style.width = POS_SIGUIENTE + '%';
            if (marker) marker.style.left = POS_SIGUIENTE + '%';

            setTimeout(() => { window.location.href = URL_SIGUIENTE; }, 900);
        };

        // Si el navegador restaura la página desde caché al volver, se reactiva el botón
        const textoBoton = document.getElementById('btnCompletar').innerHTML;
        window.addEventListener('pageshow', (e) => {
            if (!e.persisted) return;
            yendo = false;
            const b = document.getElementById('btnCompletar');
            b.innerHTML = textoBoton;
            b.disabled = false;
            modalNext.disabled = false;
            const fill = document.querySelector('.fill');
            const marker = document.querySelector('.marker');
            if (fill) fill.style.width = POS_ACTUAL + '%';
            if (marker) marker.style.left = POS_ACTUAL + '%';
        });

        actualizar();
    })();
</script>
</body>
</html>