<?php

namespace App\Http\Controllers;

use App\Models\Contenido;
use App\Models\Tema;
use App\Models\RecursoContenido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContenidoController extends Controller
{
    /**
     * Mostrar listado de contenidos.
     */
    public function index()
    {
        $contenidos = Contenido::with('tema')
            ->withCount('imagenes')
            ->orderBy('orden')
            ->orderBy('id')
            ->get();

        return view(
            'admin.contenidos.index',
            compact('contenidos')
        );
    }


    /**
     * Mostrar formulario para crear contenido.
     */
    public function create()
    {
        $temas = Tema::where('activo', true)
            ->orderBy('orden')
            ->orderBy('id')
            ->get();

        return view(
            'admin.contenidos.create',
            compact('temas')
        );
    }


    /**
     * Guardar nuevo contenido.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDACIÓN
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'tema_id' => 'required|exists:temas,id',

            'titulo' => 'required|string|max:255',

            'contenido' => 'nullable|string',

            /*
             * Imagen principal
             */
            'imagen' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            /*
             * Imágenes múltiples
             */
            'imagenes' => 'nullable|array',

            'imagenes.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            /*
             * Posición de cada imagen
             *
             * Ejemplos:
             * inicio
             * 1
             * 2
             * 3
             * final
             */
            'imagenes_posiciones' => 'nullable|array',

            'imagenes_posiciones.*' => [
                'nullable',
                'string',
                'max:20',
            ],

            /*
             * Video
             */
            'video_url' => 'nullable|url|max:500',

            /*
             * Iframe
             */
            'iframe' => 'nullable|string',

            /*
             * Orden del contenido
             */
            'orden' => 'nullable|integer|min:0',
        ]);


        /*
        |--------------------------------------------------------------------------
        | IMAGEN PRINCIPAL
        |--------------------------------------------------------------------------
        */

        $imagen = null;

        if ($request->hasFile('imagen')) {

            $imagen = $request->file('imagen')
                ->store('contenidos', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | CREAR CONTENIDO
        |--------------------------------------------------------------------------
        */

        $contenido = Contenido::create([
            'tema_id' => $request->tema_id,

            'titulo' => $request->titulo,

            'contenido' => $request->contenido,

            'imagen' => $imagen,

            'video_url' => $request->video_url,

            'iframe' => $request->iframe,

            'orden' => $request->orden ?? 0,

            'activo' => $request->has('activo'),

            'creado_por' => auth()->id(),

            'actualizado_por' => auth()->id(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | GUARDAR MÚLTIPLES IMÁGENES
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('imagenes')) {

            /*
             * El orden comienza en 1
             */
            $orden = 1;

            /*
             * Posiciones recibidas desde create.blade.php
             */
            $posiciones = $request->input(
                'imagenes_posiciones',
                []
            );


            foreach (
                $request->file('imagenes')
                as $indice => $archivo
            ) {

                /*
                 * Guardar archivo físicamente
                 */
                $ruta = $archivo->store(
                    'contenidos/recursos',
                    'public'
                );


                /*
                 * Obtener posición de esta imagen
                 *
                 * Ejemplo:
                 *
                 * imagenes[0]
                 * imagenes_posiciones[0]
                 */
                $posicion = $posiciones[$indice] ?? 'final';


                /*
                 * Crear recurso
                 */
                RecursoContenido::create([
                    'contenido_id' => $contenido->id,

                    'tipo' => 'imagen',

                    'titulo' => null,

                    'ruta' => $ruta,

                    'url' => null,

                    /*
                     * Aquí guardamos la posición
                     */
                    'configuracion' => [
                        'posicion' => $posicion,
                    ],

                    /*
                     * Conservamos el orden
                     * en que fueron seleccionadas
                     */
                    'orden' => $orden,

                    'activo' => true,
                ]);

                $orden++;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECCIÓN
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.contenidos.index')
            ->with(
                'success',
                'Contenido creado correctamente.'
            );
    }


    /**
     * Mostrar formulario para editar contenido.
     */
    public function edit(Contenido $contenido)
    {
        $temas = Tema::where('activo', true)
            ->orderBy('orden')
            ->orderBy('id')
            ->get();

        /*
         * Cargar imágenes respetando el orden
         */
        $contenido->load([
            'imagenes' => function ($query) {

                $query->orderBy('orden')
                    ->orderBy('id');
            }
        ]);

        return view(
            'admin.contenidos.edit',
            compact(
                'contenido',
                'temas'
            )
        );
    }


    /**
     * Actualizar contenido.
     */
public function update(
    Request $request,
    Contenido $contenido
) {

    /*
    |--------------------------------------------------------------------------
    | VALIDACIÓN
    |--------------------------------------------------------------------------
    */

    $request->validate([

        'tema_id' => [
            'required',
            'exists:temas,id',
        ],

        'titulo' => [
            'required',
            'string',
            'max:255',
        ],

        'contenido' => [
            'nullable',
            'string',
        ],

        /*
         * Imagen principal
         */
        'imagen' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:4096',
        ],

        /*
         * NUEVAS IMÁGENES
         */
        'imagenes' => [
            'nullable',
            'array',
        ],

        'imagenes.*' => [
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:4096',
        ],

        /*
         * POSICIONES DE LAS NUEVAS IMÁGENES
         */
        'imagenes_posiciones' => [
            'nullable',
            'array',
        ],

        'imagenes_posiciones.*' => [
            'nullable',
            'string',
            'max:20',
        ],

        /*
         * POSICIONES DE IMÁGENES EXISTENTES
         */
        'imagenes_existentes_posiciones' => [
            'nullable',
            'array',
        ],

        'imagenes_existentes_posiciones.*' => [
            'nullable',
            'string',
            'max:20',
        ],

        /*
         * REEMPLAZAR IMÁGENES EXISTENTES
         */
        'imagenes_reemplazo' => [
            'nullable',
            'array',
        ],

        'imagenes_reemplazo.*' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:4096',
        ],

        /*
         * VIDEO
         */
        'video_url' => [
            'nullable',
            'url',
            'max:500',
        ],

        /*
         * IFRAME
         */
        'iframe' => [
            'nullable',
            'string',
        ],

        /*
         * ORDEN
         */
        'orden' => [
            'nullable',
            'integer',
            'min:0',
        ],
    ]);


    /*
    |--------------------------------------------------------------------------
    | DATOS DEL CONTENIDO
    |--------------------------------------------------------------------------
    */

    $datos = [

        'tema_id' => $request->tema_id,

        'titulo' => $request->titulo,

        'contenido' => $request->contenido,

        'video_url' => $request->video_url,

        'iframe' => $request->iframe,

        'orden' => $request->orden ?? $contenido->orden,

        'activo' => $request->has('activo'),

        'actualizado_por' => auth()->id(),
    ];


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR IMAGEN PRINCIPAL
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('imagen')) {

        /*
         * Eliminar imagen principal anterior
         */
        if (
            $contenido->imagen &&
            Storage::disk('public')->exists(
                $contenido->imagen
            )
        ) {

            Storage::disk('public')->delete(
                $contenido->imagen
            );
        }


        /*
         * Guardar nueva imagen principal
         */
        $datos['imagen'] =
            $request->file('imagen')
                ->store(
                    'contenidos',
                    'public'
                );
    }


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR CONTENIDO
    |--------------------------------------------------------------------------
    */

    $contenido->update($datos);


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR IMÁGENES EXISTENTES
    |--------------------------------------------------------------------------
    */

    $posicionesExistentes =
        $request->input(
            'imagenes_existentes_posiciones',
            []
        );

    $reemplazos =
        $request->file(
            'imagenes_reemplazo',
            []
        );


    foreach ($contenido->imagenes as $imagen) {

        $cambios = [];


        /*
         * CAMBIAR POSICIÓN
         */
        if (
            isset(
                $posicionesExistentes[$imagen->id]
            )
        ) {

            $configuracion =
                is_array($imagen->configuracion)
                    ? $imagen->configuracion
                    : [];

            $configuracion['posicion'] =
                $posicionesExistentes[$imagen->id];

            $cambios['configuracion'] =
                $configuracion;
        }


        /*
         * REEMPLAZAR IMAGEN
         */
        if (
            isset($reemplazos[$imagen->id]) &&
            $reemplazos[$imagen->id]
        ) {

            /*
             * Eliminar archivo anterior
             */
            if (
                $imagen->ruta &&
                Storage::disk('public')->exists(
                    $imagen->ruta
                )
            ) {

                Storage::disk('public')->delete(
                    $imagen->ruta
                );
            }


            /*
             * Guardar nueva imagen
             */
            $nuevaRuta =
                $reemplazos[$imagen->id]
                    ->store(
                        'contenidos/recursos',
                        'public'
                    );


            $cambios['ruta'] =
                $nuevaRuta;


            $cambios['titulo'] =
                $reemplazos[$imagen->id]
                    ->getClientOriginalName();
        }


        /*
         * Guardar cambios de la imagen
         */
        if (!empty($cambios)) {

            $imagen->update($cambios);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | AGREGAR NUEVAS IMÁGENES
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('imagenes')) {

        /*
         * Obtener último orden
         */
        $ultimoOrden =
            RecursoContenido::where(
                'contenido_id',
                $contenido->id
            )
            ->where(
                'tipo',
                'imagen'
            )
            ->max('orden');


        /*
         * Empezar después de la última imagen
         */
        $orden =
            ($ultimoOrden ?? 0) + 1;


        /*
         * Obtener posiciones
         */
        $posiciones =
            $request->input(
                'imagenes_posiciones',
                []
            );


        /*
         * Recorrer todas las imágenes
         */
        foreach (
            $request->file('imagenes')
            as $indice => $archivo
        ) {

            /*
             * Verificar que sea válido
             */
            if (!$archivo->isValid()) {
                continue;
            }


            /*
             * Guardar archivo
             */
            $ruta =
                $archivo->store(
                    'contenidos/recursos',
                    'public'
                );


            /*
             * Posición seleccionada
             */
            $posicion =
                $posiciones[$indice]
                ?? 'final';


            /*
             * Crear recurso
             */
            RecursoContenido::create([

                'contenido_id' =>
                    $contenido->id,

                'tipo' =>
                    'imagen',

                'titulo' =>
                    $archivo->getClientOriginalName(),

                'ruta' =>
                    $ruta,

                'url' =>
                    null,

                'configuracion' => [
                    'posicion' =>
                        $posicion,
                ],

                'orden' =>
                    $orden,

                'activo' =>
                    true,
            ]);


            /*
             * Incrementar orden
             */
            $orden++;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | REDIRECCIÓN
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route(
            'admin.contenidos.edit',
            $contenido
        )
        ->with(
            'success',
            'Contenido actualizado correctamente.'
        );
}

public function storeRecurso(
    Request $request,
    Contenido $contenido
) {
    $request->validate([
        'imagen' => [
            'required',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:4096',
        ],

        'posicion' => [
            'nullable',
            'string',
            'max:20',
        ],
    ]);

    $ultimoOrden = RecursoContenido::where(
        'contenido_id',
        $contenido->id
    )
    ->where('tipo', 'imagen')
    ->max('orden');

    $orden = ($ultimoOrden ?? 0) + 1;

    $ruta = $request->file('imagen')->store(
        'contenidos/recursos',
        'public'
    );

    $recurso = RecursoContenido::create([

        'contenido_id' => $contenido->id,

        'tipo' => 'imagen',

        'titulo' =>
            $request->file('imagen')
                ->getClientOriginalName(),

        'ruta' => $ruta,

        'url' => null,

        'configuracion' => [
            'posicion' =>
                $request->input(
                    'posicion',
                    'final'
                ),
        ],

        'orden' => $orden,

        'activo' => true,
    ]);

    return response()->json([
        'success' => true,

        'message' =>
            'Imagen guardada correctamente.',

        'recurso' => [

            'id' => $recurso->id,

            'titulo' => $recurso->titulo,

            'ruta' => $recurso->ruta,

            'orden' => $recurso->orden,

            'configuracion' =>
                $recurso->configuracion,

            'url' =>
                route(
                    'media.recurso',
                    [
                        'filename' =>
                            basename($recurso->ruta)
                    ]
                ),

            'position_url' =>
                route(
                    'admin.recursos.posicion',
                    $recurso
                ),

            'replace_url' =>
                route(
                    'admin.recursos.replace',
                    $recurso
                ),

            'delete_url' =>
                route(
                    'admin.recursos.destroy',
                    $recurso
                ),
        ],
    ]);
}

public function replaceRecurso(
    Request $request,
    RecursoContenido $recurso
) {
    $request->validate([
        'imagen' => [
            'required',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:4096',
        ],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Eliminar archivo anterior
    |--------------------------------------------------------------------------
    */

    if (
        $recurso->ruta &&
        Storage::disk('public')->exists(
            $recurso->ruta
        )
    ) {
        Storage::disk('public')->delete(
            $recurso->ruta
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Guardar nueva imagen
    |--------------------------------------------------------------------------
    */

    $ruta = $request->file('imagen')
        ->store(
            'contenidos/recursos',
            'public'
        );


    /*
    |--------------------------------------------------------------------------
    | Actualizar registro
    |--------------------------------------------------------------------------
    */

    $recurso->update([

        'ruta' => $ruta,

        'titulo' =>
            $request->file('imagen')
                ->getClientOriginalName(),
    ]);


    return response()->json([
        'success' => true,

        'message' =>
            'Imagen reemplazada correctamente.',

        'recurso' => [

            'id' =>
                $recurso->id,

            'url' =>
                route(
                    'media.recurso',
                    [
                        'filename' =>
                            basename($ruta)
                    ]
                ),
        ],
    ]);
}

public function updatePosicionRecurso(
    Request $request,
    RecursoContenido $recurso
) {
    $request->validate([
        'posicion' => [
            'required',
            'string',
            'max:20',
        ],
    ]);

    $configuracion =
        is_array($recurso->configuracion)
            ? $recurso->configuracion
            : [];

    $configuracion['posicion'] =
        $request->posicion;

    $recurso->update([
        'configuracion' => $configuracion,
    ]);

    return response()->json([
        'success' => true,

        'message' =>
            'Posición actualizada correctamente.',

        'posicion' =>
            $request->posicion,
    ]);
}
    /**
     * Activar / desactivar contenido.
     */
    public function toggleActivo(Contenido $contenido)
    {
        $contenido->update([
            'activo' => !$contenido->activo,

            'actualizado_por' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.contenidos.index')
            ->with(
                'success',
                'Estado del contenido actualizado.'
            );
    }

    

    /**
     * Eliminar contenido completo.
     */
    public function destroy(Contenido $contenido)
    {
        /*
        |--------------------------------------------------------------------------
        | ELIMINAR IMÁGENES MÚLTIPLES
        |--------------------------------------------------------------------------
        */

        foreach ($contenido->imagenes as $imagen) {

            if (
                $imagen->ruta &&
                Storage::disk('public')->exists(
                    $imagen->ruta
                )
            ) {

                Storage::disk('public')->delete(
                    $imagen->ruta
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | ELIMINAR RECURSOS
        |--------------------------------------------------------------------------
        */

        $contenido->recursos()->delete();


        /*
        |--------------------------------------------------------------------------
        | ELIMINAR IMAGEN PRINCIPAL
        |--------------------------------------------------------------------------
        */

        if (
            $contenido->imagen &&
            Storage::disk('public')->exists(
                $contenido->imagen
            )
        ) {

            Storage::disk('public')->delete(
                $contenido->imagen
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ELIMINAR CONTENIDO
        |--------------------------------------------------------------------------
        */

        $contenido->delete();


        return redirect()
            ->route('admin.contenidos.index')
            ->with(
                'success',
                'Contenido eliminado correctamente.'
            );
    }


    /**
     * Eliminar una imagen individual.
     *
     * IMPORTANTE:
     * Esto solamente elimina la imagen seleccionada.
     * NO elimina el contenido completo.
     */
public function destroyRecurso(Request $request, RecursoContenido $recurso)
{
    try {
        if ($recurso->ruta && Storage::disk('public')->exists($recurso->ruta)) {
            Storage::disk('public')->delete($recurso->ruta);
        }

        $recurso->delete();

    } catch (\Throwable $e) {
        report($e);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo eliminar la imagen.',
            ], 500);
        }

        return back()->with('error', 'No se pudo eliminar la imagen.');
    }

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Imagen eliminada correctamente.',
            'id'      => $recurso->id,
        ]);
    }

    return back()->with('success', 'Imagen eliminada correctamente.');
}

    
}