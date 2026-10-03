<?php

namespace App\Http\Controllers;

use App\Models\Participante;
use App\Models\RespuestaEscena;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RespuestaEscenaController extends Controller
{
    /**
     * Respuestas correctas de cada nivel.
     *
     * Índices utilizados por JavaScript:
     * 0 = primera opción
     * 1 = segunda opción
     * 2 = tercera opción
     * 3 = cuarta opción
     */
    private const CORRECTAS = [
        1 => [1, 1],
        2 => [1, 1],
        3 => [1, 2],
        4 => [1, 1],
    ];

    /**
     * Guarda las respuestas de una escena.
     */
    public function guardar(Request $request): JsonResponse
    {
        // Participante de la sesión actual
        $participanteId = session('participacion_id');

        if (!$participanteId) {
            return response()->json([
                'ok' => false,
                'message' => 'No hay una participación activa.',
            ], 401);
        }

        // Verificar que el participante exista
        $participante = Participante::find($participanteId);

        if (!$participante) {
            return response()->json([
                'ok' => false,
                'message' => 'Participante no encontrado.',
            ], 404);
        }

        // Validar información recibida
        $validated = $request->validate([
            'nivel' => [
                'required',
                'integer',
                'between:1,4',
            ],

            'respuestas' => [
                'required',
                'array',
                'size:2',
            ],

            'respuestas.*' => [
                'required',
                'integer',
                'between:0,3',
            ],
        ]);

        $nivel = (int) $validated['nivel'];
        $respuestas = $validated['respuestas'];

        $correctasNivel = self::CORRECTAS[$nivel];

        $guardadas = 0;

        foreach ($respuestas as $indicePregunta => $respuesta) {

            /*
             * JavaScript trabaja las preguntas desde 0:
             *
             * pregunta 0 = pregunta 1
             * pregunta 1 = pregunta 2
             *
             * Por eso sumamos 1 para guardar en BD.
             */
            $pregunta = (int) $indicePregunta + 1;

            $respuesta = (int) $respuesta;

            // Determinar si la respuesta es correcta
            $correcta = isset($correctasNivel[$indicePregunta])
                && $respuesta === $correctasNivel[$indicePregunta];

            RespuestaEscena::updateOrCreate(
                [
                    'participante_id' => $participanteId,
                    'nivel' => $nivel,
                    'pregunta' => $pregunta,
                ],
                [
                    'respuesta' => $respuesta,
                    'correcta' => $correcta,
                    'respondida_en' => now(),
                ]
            );

            $guardadas++;
        }

        return response()->json([
            'ok' => true,
            'message' => 'Respuestas guardadas correctamente.',
            'nivel' => $nivel,
            'guardadas' => $guardadas,
        ]);
    }
}