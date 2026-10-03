<?php

namespace App\Http\Controllers;

use App\Models\Participantes;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class GraduacionController extends Controller
{
    /**
     * Muestra el certificado final del recorrido educativo.
     *
     * Los participantes identificados pueden acceder al certificado.
     * Los participantes anónimos pueden realizar las pruebas y completar
     * el recorrido, pero no pueden generar ni visualizar el certificado.
     */
    public function show(Request $request)
    {
        $participacionId = $request->session()->get('participacion_id');

        if (!$participacionId) {
            return redirect()
                ->route('participacion.create')
                ->with(
                    'error',
                    'Completa el formulario de participación antes de generar tu certificado.'
                );
        }

        $participante = Participantes::with('avatar')->findOrFail($participacionId);

        if ((int) $participante->es_anonimo === 1) {
            return redirect()
                ->route('aprende.index')
                ->with(
                    'error',
                    'El certificado solo está disponible para participantes identificados.'
                );
        }

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
            $avatarRuta = asset(
                'build/img/avatars/' . ltrim($avatarArchivo, '/')
            );
        }

        $nombreVisible = $participante->nombre_completo ?: 'Participante';

        $codigoCertificado = $this->codigoCertificado($participante);

        return view('aprende.graduacion', compact(
            'participante',
            'avatarRuta',
            'nombreVisible',
            'codigoCertificado'
        ));
    }

    /**
     * Entrega el certificado como un PDF real.
     * Es lo que usan los botones "Guardar PDF" y "Compartir certificado".
     */
    public function certificadoPdf(Request $request)
    {
        $participacionId = $request->session()->get('participacion_id');

        if (!$participacionId) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'No hay una participación activa.'
            ], 403);
        }

        $participante = Participantes::with('avatar')->findOrFail($participacionId);

        if ((int) $participante->es_anonimo === 1) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'El certificado solo está disponible para participantes identificados.'
            ], 403);
        }

        // Imagen del avatar (si el archivo no existe, se usa el avatar por defecto)
        $archivo = trim((string) (
            optional($participante->avatar)->imagen
            ?? optional($participante->avatar)->ruta
            ?? 'cuerpo.webp'
        ));

        $rutasAvatar = [];
        if (!preg_match('/^https?:\/\//i', $archivo)) {
            if (str_starts_with($archivo, '/')) {
                $rutasAvatar = $this->rutasPublicas(ltrim($archivo, '/'));
            } elseif (str_starts_with($archivo, 'build/')) {
                $rutasAvatar = $this->rutasPublicas($archivo);
            } else {
                $rutasAvatar = $this->rutasPublicas('build/img/avatars/' . ltrim($archivo, '/'));
            }
        }
        $rutasAvatar = array_merge($rutasAvatar, $this->rutasPublicas('build/img/avatars/cuerpo.webp'));

        $rutasLogo = array_merge(
            $this->rutasPublicas('build/img/logo.webp'),
            $this->rutasPublicas('build/img/logo.WebP'),
            $this->rutasPublicas('build/img/logo.png')
        );

        $codigo = $this->codigoCertificado($participante);

        $datos = [
            'nombreVisible'     => $participante->nombre_completo ?: 'Participante',
            'codigoCertificado' => $codigo,
            'fecha'             => now()->format('d/m/Y'),
            'avatarDataUri'     => $this->imagenDataUri($rutasAvatar),
            'logoDataUri'       => $this->imagenDataUri($rutasLogo),
        ];

        try {
            $contenido = $this->renderizarCertificado($datos);
        } catch (\Throwable $e) {
            Log::error('Certificado PDF (con imágenes): ' . $e->getMessage());

            // Segundo intento sin imágenes, por si alguna es la causa del error
            try {
                $datos['avatarDataUri'] = null;
                $datos['logoDataUri'] = null;
                $contenido = $this->renderizarCertificado($datos);
            } catch (\Throwable $e2) {
                Log::error('Certificado PDF (sin imágenes): ' . $e2->getMessage());

                return response()->json([
                    'ok' => false,
                    'mensaje' => 'No se pudo generar el PDF en el servidor.'
                ], 500);
            }
        }

        return response($contenido, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="certificado-' . $codigo . '.pdf"',
            'Cache-Control'       => 'private, no-store',
        ]);
    }

    private function renderizarCertificado(array $datos): string
    {
        return Pdf::loadView('aprende.certificado_pdf', $datos)
            ->setPaper('a4', 'landscape')
            ->output();
    }

    /**
     * Genera un reporte descargable con las respuestas del participante.
     * El certificado permanece limpio; este reporte contiene el detalle
     * de respuestas correctas e incorrectas para revisión familiar.
     */
    public function reporte(Request $request)
    {
        $participacionId = $request->session()->get('participacion_id');

        if (!$participacionId) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'No hay una participación activa.'
            ], 403);
        }

        $participante = Participantes::findOrFail($participacionId);

        if ((int) $participante->es_anonimo === 1) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'Los participantes anónimos no pueden generar reportes de resultados.'
            ], 403);
        }

        $datos = $request->validate([
            'registros' => ['required', 'array', 'max:100'],
            'registros.*.nivel' => ['required', 'integer', 'min:1', 'max:8'],
            'registros.*.pregunta' => ['required', 'string', 'max:2000'],
            'registros.*.elegida' => ['required', 'string', 'max:1000'],
            'registros.*.respuestaCorrecta' => ['required', 'string', 'max:1000'],
            'registros.*.correcta' => ['required', 'boolean'],
        ]);

        $registros = $datos['registros'];
        $total = count($registros);
        $aciertos = collect($registros)->where('correcta', true)->count();

        $nombreVisible = $participante->nombre_completo ?: 'Participante';
        $codigo = $this->codigoCertificado($participante);

        $pdf = Pdf::loadView('aprende.reporte_resultados_pdf', [
            'nombreVisible' => $nombreVisible,
            'registros' => $registros,
            'total' => $total,
            'aciertos' => $aciertos,
            'porcentaje' => $total > 0 ? round(($aciertos / $total) * 100) : 0,
            'codigo' => $codigo,
        ])->setPaper('a4', 'portrait');

        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="reporte-resultados-' . $codigo . '.pdf"',
            'Cache-Control' => 'private, no-store',
        ]);
    }

    /* ------------------------------------------------------------------ */
    /*  Utilidades                                                          */
    /* ------------------------------------------------------------------ */

    private function codigoCertificado(Participantes $participante): string
    {
        return 'PP-' . now()->format('Ymd') . '-'
            . str_pad((string) $participante->id, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Posibles ubicaciones de un archivo público. En algunos hostings la carpeta
     * "public" no es la raíz web, por eso se prueban varias.
     */
    private function rutasPublicas(string $relativa): array
    {
        $raizWeb = rtrim((string) ($_SERVER['DOCUMENT_ROOT'] ?? ''), '/\\');

        return array_values(array_filter([
            public_path($relativa),
            base_path($relativa),
            $raizWeb !== '' ? $raizWeb . '/' . $relativa : null,
        ]));
    }

    /**
     * Convierte la primera imagen que exista en un data URI.
     * DomPDF no lee WebP, así que se pasa a PNG con GD cuando hace falta.
     */
    private function imagenDataUri(array $rutas): ?string
    {
        foreach ($rutas as $ruta) {
            if (!$ruta || !is_file($ruta)) {
                continue;
            }

            $ext = strtolower(pathinfo($ruta, PATHINFO_EXTENSION));

            try {
                if ($ext === 'webp') {
                    if (!function_exists('imagecreatefromwebp')) {
                        continue;
                    }

                    $img = @imagecreatefromwebp($ruta);
                    if (!$img) {
                        continue;
                    }

                    imagealphablending($img, false);
                    imagesavealpha($img, true);

                    ob_start();
                    imagepng($img);
                    $binario = ob_get_clean();
                    imagedestroy($img);

                    return 'data:image/png;base64,' . base64_encode($binario);
                }

                $mime = match ($ext) {
                    'png'         => 'image/png',
                    'jpg', 'jpeg' => 'image/jpeg',
                    'gif'         => 'image/gif',
                    default       => null,
                };

                if ($mime) {
                    return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($ruta));
                }
            } catch (\Throwable $e) {
                continue;
            }
        }

        return null;
    }
}