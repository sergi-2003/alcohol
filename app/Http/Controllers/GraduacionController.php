<?php

namespace App\Http\Controllers;

use App\Models\Participantes;
use Illuminate\Http\Request;

class GraduacionController extends Controller
{
    /**
     * Muestra el certificado final del recorrido educativo.
     * La participación se identifica con la sesión creada al registrar al participante.
     */
    public function show(Request $request)
    {
        $participacionId = $request->session()->get('participacion_id');

        if (!$participacionId) {
            return redirect()
                ->route('participacion.create')
                ->with('error', 'Completa el formulario de participación antes de generar tu certificado.');
        }

        $participante = Participantes::with('avatar')->findOrFail($participacionId);

        $avatarArchivo = optional($participante->avatar)->imagen
            ?? optional($participante->avatar)->ruta
            ?? 'cuerpo.webp';

        if (preg_match('/^https?:\/\//i', $avatarArchivo)) {
            $avatarRuta = $avatarArchivo;
        } elseif (str_starts_with($avatarArchivo, '/')) {
            $avatarRuta = asset(ltrim($avatarArchivo, '/'));
        } elseif (str_starts_with($avatarArchivo, 'build/')) {
            $avatarRuta = asset($avatarArchivo);
        } else {
            $avatarRuta = asset('build/img/avatars/' . ltrim($avatarArchivo, '/'));
        }

        $nombreVisible = !empty($participante->es_anonimo)
            ? 'Participante anónimo'
            : ($participante->nombre_completo ?: 'Participante');

        $codigoCertificado = 'PP-' . now()->format('Ymd') . '-' . str_pad((string) $participante->id, 5, '0', STR_PAD_LEFT);

        return view('aprende.graduacion', compact(
            'participante',
            'avatarRuta',
            'nombreVisible',
            'codigoCertificado'
        ));
    }
}
