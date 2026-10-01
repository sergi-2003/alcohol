<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvanceEscenaController extends Controller
{
    private const PUNTOS_POR_ACIERTO = 10;
    private const BONO_PERFECTO = 10;

    /**
     * Guarda el resultado de una escena. Solo cuenta el PRIMER resultado de cada
     * participante en cada escena (índice único + insertOrIgnore).
     * El XP y la medalla se calculan aquí, no se toman del navegador.
     */
    public function guardar(Request $request)
    {
        $participanteId = session('participacion_id');

        if (!$participanteId || !DB::table('participantes')->where('id', $participanteId)->exists()) {
            return response()->json(['ok' => false, 'mensaje' => 'No hay una participación activa.'], 403);
        }

        $datos = $request->validate([
            'escena'     => ['required', 'integer', 'between:1,8'],
            'aciertos'   => ['required', 'integer', 'min:0', 'max:20'],
            'total'      => ['required', 'integer', 'between:1,20'],
            'respuestas' => ['nullable', 'array'],
        ]);

        $total = $datos['total'];
        $aciertos = min($datos['aciertos'], $total);
        $perfecto = $aciertos === $total;
        $xp = $aciertos * self::PUNTOS_POR_ACIERTO + ($perfecto ? self::BONO_PERFECTO : 0);

        $insertados = DB::table('avance_escenas')->insertOrIgnore([[
            'participante_id' => $participanteId,
            'escena'          => $datos['escena'],
            'xp'              => $xp,
            'aciertos'        => $aciertos,
            'total_preguntas' => $total,
            'medalla'         => $perfecto,
            'respuestas'      => json_encode($datos['respuestas'] ?? null),
            'completado_en'   => now(),
            'created_at'      => now(),
            'updated_at'      => now(),
        ]]);

        return response()->json(['ok' => true, 'nuevo' => $insertados > 0]);
    }
}