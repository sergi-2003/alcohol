<?php

namespace App\Http\Controllers;

use App\Models\Contenido;
use App\Models\Tema;
use App\Models\RecursoContenido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContenidoController extends Controller
{
    public function index()
    {
        $contenidos = Contenido::with('tema')
            ->withCount('imagenes')
            ->orderBy('orden')
            ->orderBy('id')
            ->get();

        return view('admin.contenidos.index', compact('contenidos'));
    }


    public function create()
    {
        $temas = Tema::where('activo', true)
            ->orderBy('orden')
            ->orderBy('id')
            ->get();

        return view('admin.contenidos.create', compact('temas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'tema_id' => 'required|exists:temas,id',

            'titulo' => 'required|string|max:255',

            'contenido' => 'nullable|string',

            // Imagen principal antigua
            'imagen' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            // Imágenes múltiples
            'imagenes' => 'nullable|array',

            'imagenes.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'video_url' => 'nullable|url|max:500',

            'iframe' => 'nullable|string',

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

            $orden = 1;

            foreach ($request->file('imagenes') as $archivo) {

                $ruta = $archivo->store(
                    'contenidos/recursos',
                    'public'
                );

                RecursoContenido::create([
                    'contenido_id' => $contenido->id,

                    'tipo' => 'imagen',

                    'titulo' => null,

                    'ruta' => $ruta,

                    'url' => null,

                    'configuracion' => null,

                    'orden' => $orden,

                    'activo' => true,
                ]);

                $orden++;
            }
        }


        return redirect()
            ->route('admin.contenidos.index')
            ->with(
                'success',
                'Contenido creado correctamente.'
            );
    }


    public function edit(Contenido $contenido)
    {
        $temas = Tema::where('activo', true)
            ->orderBy('orden')
            ->orderBy('id')
            ->get();

        $contenido->load([
            'imagenes' => function ($query) {
                $query->orderBy('orden')
                    ->orderBy('id');
            }
        ]);

        return view(
            'admin.contenidos.edit',
            compact('contenido', 'temas')
        );
    }


    public function update(
        Request $request,
        Contenido $contenido
    ) {
        $request->validate([
            'tema_id' => 'required|exists:temas,id',

            'titulo' => 'required|string|max:255',

            'contenido' => 'nullable|string',

            // Imagen principal antigua
            'imagen' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            // Nuevas imágenes
            'imagenes' => 'nullable|array',

            'imagenes.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'video_url' => 'nullable|url|max:500',

            'iframe' => 'nullable|string',

            'orden' => 'nullable|integer|min:0',
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

            $datos['imagen'] = $request->file('imagen')
                ->store('contenidos', 'public');
        }


        $contenido->update($datos);


        /*
        |--------------------------------------------------------------------------
        | AGREGAR NUEVAS IMÁGENES
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('imagenes')) {

            $ultimoOrden = RecursoContenido::where(
                'contenido_id',
                $contenido->id
            )->max('orden');

            $orden = ($ultimoOrden ?? 0) + 1;


            foreach ($request->file('imagenes') as $archivo) {

                $ruta = $archivo->store(
                    'contenidos/recursos',
                    'public'
                );


                RecursoContenido::create([
                    'contenido_id' => $contenido->id,

                    'tipo' => 'imagen',

                    'titulo' => null,

                    'ruta' => $ruta,

                    'url' => null,

                    'configuracion' => null,

                    'orden' => $orden,

                    'activo' => true,
                ]);

                $orden++;
            }
        }


        return redirect()
            ->route('admin.contenidos.index')
            ->with(
                'success',
                'Contenido actualizado correctamente.'
            );
    }


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


    /*
    |--------------------------------------------------------------------------
    | ELIMINAR UNA IMAGEN INDIVIDUAL
    |--------------------------------------------------------------------------
    */

    public function destroyRecurso(
        RecursoContenido $recurso
    ) {
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


        $recurso->delete();


        return back()->with(
            'success',
            'Imagen eliminada correctamente.'
        );
    }
}