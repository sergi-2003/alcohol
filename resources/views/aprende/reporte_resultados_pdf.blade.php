<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de resultados</title>
<style>
@page { margin: 14mm; }
body { font-family: DejaVu Sans, sans-serif; color:#183453; font-size:11px; }
.header { border-bottom:3px solid #d6ac56; padding-bottom:12px; margin-bottom:18px; }
.brand { font-size:15px; font-weight:bold; color:#265784; }
.subtitle { color:#71829b; margin-top:4px; }
h1 { font-size:22px; margin:18px 0 5px; }
.meta { color:#596d83; font-size:10px; }
.summary { margin:16px 0; padding:12px; border:1px solid #dbe3ec; background:#f7fafc; }
.summary strong { font-size:16px; }
.level { margin-top:18px; page-break-inside:avoid; }
.level-title { background:#eef4f9; border-left:4px solid #265784; padding:8px 10px; margin-bottom:10px; font-size:13px; font-weight:bold; color:#183453; }
.item { border:1px solid #dbe3ec; padding:11px; margin-bottom:10px; page-break-inside:avoid; }
.item-head { font-weight:bold; margin-bottom:8px; color:#265784; }
.question { margin-bottom:7px; line-height:1.45; }
.answer { margin:4px 0; line-height:1.4; }
.status { margin-top:8px; font-weight:bold; }
.correct { color:#287a52; }
.incorrect { color:#a54b4b; }
.unanswered { color:#a56a00; }
.footer { margin-top:18px; border-top:1px solid #dbe3ec; padding-top:10px; color:#71829b; font-size:9px; }
</style>
</head>
<body>
<div class="header">
    <div class="brand">UN SORBITO HOY, UN PROBLEMA MAÑANA</div>
    <div class="subtitle">Reporte de resultados del recorrido educativo</div>
    <h1>Retroalimentación para la familia</h1>
    <div class="meta">Participante: {{ $nombreVisible }} &nbsp; | &nbsp; Código: {{ $codigo }}</div>
    <div class="meta">Fecha de generación: {{ now()->format('d/m/Y H:i') }}</div>
</div>

<div class="summary">
    <strong>{{ $aciertos }} de {{ $total }} respuestas acertadas</strong><br>
    Resultado general: {{ $porcentaje }}%.
    Este reporte muestra las respuestas registradas para facilitar la conversación y el acompañamiento familiar.
</div>

@php
    // Agrupa las preguntas por nivel para que la numeración reinicie en cada nivel.
    $registrosPorNivel = collect($registros)->groupBy('nivel')->sortKeys();
@endphp

@forelse($registrosPorNivel as $nivel => $preguntasNivel)
    <section class="level">
        <div class="level-title">NIVEL {{ $nivel }}</div>

        @foreach($preguntasNivel->values() as $indice => $registro)
            <div class="item">
                <div class="item-head">Pregunta {{ $indice + 1 }}</div>
                <div class="question"><strong>Pregunta:</strong> {{ $registro['pregunta'] }}</div>
                <div class="answer"><strong>Respuesta seleccionada:</strong> {{ $registro['elegida'] }}</div>
                <div class="answer"><strong>Respuesta correcta:</strong> {{ $registro['respuestaCorrecta'] }}</div>

                @if(isset($registro['respondida']) && !$registro['respondida'])
                    <div class="status unanswered">• Pregunta no respondida</div>
                @else
                    <div class="status {{ $registro['correcta'] ? 'correct' : 'incorrect' }}">
                        {{ $registro['correcta'] ? '✓ Respuesta acertada' : '• Respuesta por reforzar' }}
                    </div>
                @endif
            </div>
        @endforeach
    </section>
@empty
    <div class="item">No se encontraron preguntas registradas.</div>
@endforelse

<div class="footer">
    Este documento es un reporte educativo de retroalimentación y no reemplaza una valoración profesional.
</div>
</body>
</html>
