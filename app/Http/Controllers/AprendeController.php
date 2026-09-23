<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Contenido;

class AprendeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Temas educativos
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $temas = Tema::where('activo', true)
            ->withCount([
                'contenidos' => function ($query) {
                    $query->where('activo', true);
                }
            ])
            ->orderBy('orden')
            ->orderBy('id')
            ->get();

        return view('aprende.index', compact('temas'));
    }


    /*
    |--------------------------------------------------------------------------
    | Contenidos de un tema
    |--------------------------------------------------------------------------
    */

    public function tema(Tema $tema)
    {
        abort_unless($tema->activo, 404);

        $contenidos = Contenido::where('tema_id', $tema->id)
            ->where('activo', true)
            ->orderBy('orden')
            ->orderBy('id')
            ->get();

        return view('aprende.tema', compact('tema', 'contenidos'));
    }
}