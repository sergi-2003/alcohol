<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvanceEscenaController extends Controller
{
    private const PUNTOS_POR_ACIERTO = 10;
    private const BONO_PERFECTO = 10;

    /**
     * Guarda o actualiza el resultado de una escena.
     */
    public function guardar(Request $request)
    {
        $participanteId = session('participacion_id');

        if (
            !$participanteId ||
            !DB::table('participantes')
                ->where('id', $participanteId)
                ->exists()
        ) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'No hay una participación activa.'
            ], 403);
        }

        $datos = $request->validate([
            'escena' => [
                'required',
                'integer',
                'between:1,8'
            ],
            'aciertos' => [
                'required',
                'integer',
                'min:0',
                'max:20'
            ],
            'total' => [
                'required',
                'integer',
                'between:1,20'
            ],
            'respuestas' => [
                'nullable',
                'array'
            ],
        ]);

        $total = $datos['total'];
        $aciertos = min($datos['aciertos'], $total);
        $perfecto = $aciertos === $total;

        $xp = ($aciertos * self::PUNTOS_POR_ACIERTO)
            + ($perfecto ? self::BONO_PERFECTO : 0);

        $ahora = now();

        DB::table('avance_escenas')->updateOrInsert(
            [
                'participante_id' => $participanteId,
                'escena' => $datos['escena'],
            ],
            [
                'xp' => $xp,
                'aciertos' => $aciertos,
                'total_preguntas' => $total,
                'medalla' => $perfecto ? 1 : 0,
                'respuestas' => json_encode($datos['respuestas'] ?? null),
                'completado_en' => $ahora,
                'updated_at' => $ahora,
            ]
        );

        return response()->json([
            'ok' => true,
            'participante_id' => $participanteId,
            'escena' => $datos['escena'],
            'xp' => $xp,
            'aciertos' => $aciertos,
            'total' => $total,
            'medalla' => $perfecto,
        ]);
    }
}
