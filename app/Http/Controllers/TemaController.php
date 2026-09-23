<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TemaController extends Controller
{
   public function index()
{
    $temas = Tema::with([
        'contenidos' => function ($query) {
            $query->with('imagenes')
                ->orderBy('orden')
                ->orderBy('id');
        }
    ])
    ->withCount('contenidos')
    ->orderBy('orden')
    ->orderBy('id')
    ->get();

    return view('admin.temas.index', compact('temas'));
}

    public function create()
    {
        return view('admin.temas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:200',
            'slug' => 'nullable|string|max:200',
            'descripcion_corta' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'icono' => 'nullable|string|max:100',
            'orden' => 'nullable|integer|min:0',
        ]);

        /*
        |--------------------------------------------------------------------------
        | campaña_id
        |--------------------------------------------------------------------------
        | La tabla temas exige este campo, pero en nuestro CRUD actual
        | no existe una tabla de campañas que debamos administrar.
        |
        | Conservamos el valor 1 utilizado por la estructura actual.
        |--------------------------------------------------------------------------
        */

        $campañaId = 1;

        $imagen = null;

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen')
                ->store('temas', 'public');
        }

        $slug = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->titulo);

        Tema::create([
            'campaña_id' => $campañaId,
            'titulo' => $request->titulo,
            'slug' => $slug,
            'descripcion_corta' => $request->descripcion_corta,
            'imagen' => $imagen,
            'icono' => $request->icono,
            'orden' => $request->orden ?? 0,
            'activo' => $request->has('activo'),
        ]);

        return redirect()
            ->route('admin.temas.index')
            ->with('success', 'Tema creado correctamente.');
    }

    public function edit(Tema $tema)
    {
        return view('admin.temas.edit', compact('tema'));
    }

    public function update(Request $request, Tema $tema)
    {
        $request->validate([
            'titulo' => 'required|string|max:200',
            'slug' => 'nullable|string|max:200',
            'descripcion_corta' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'icono' => 'nullable|string|max:100',
            'orden' => 'nullable|integer|min:0',
        ]);

        $datos = [
            'titulo' => $request->titulo,
            'slug' => $request->filled('slug')
                ? Str::slug($request->slug)
                : Str::slug($request->titulo),
            'descripcion_corta' => $request->descripcion_corta,
            'icono' => $request->icono,
            'orden' => $request->orden ?? $tema->orden,
            'activo' => $request->has('activo'),
        ];

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')
                ->store('temas', 'public');
        }

        $tema->update($datos);

        return redirect()
            ->route('admin.temas.index')
            ->with('success', 'Tema actualizado correctamente.');
    }

    public function toggleActivo(Tema $tema)
    {
        $tema->update([
            'activo' => !$tema->activo,
        ]);

        return redirect()
            ->route('admin.temas.index')
            ->with('success', 'Estado del tema actualizado.');
    }

    public function destroy(Tema $tema)
    {
        if ($tema->contenidos()->exists()) {
            return redirect()
                ->route('admin.temas.index')
                ->with('error', 'No puedes eliminar este tema porque tiene contenidos asociados.');
        }

        $tema->delete();

        return redirect()
            ->route('admin.temas.index')
            ->with('success', 'Tema eliminado correctamente.');
    }
}