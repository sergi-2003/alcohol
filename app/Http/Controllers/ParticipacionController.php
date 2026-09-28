<?php

namespace App\Http\Controllers;

use App\Models\Participantes;
use App\Models\SesionParticipacion;
use App\Models\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParticipacionController extends Controller
{
    /**
     * Mostrar formulario de caracterización.
     */
    public function create()
    {
        return view('participacion.caracterizacion');
    }


    /**
     * Recibir los datos del formulario.
     *
     * Los datos se guardan temporalmente en la sesión
     * mientras el participante selecciona su avatar.
     */
  public function store(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | VALIDAR INFORMACIÓN
    |--------------------------------------------------------------------------
    */

    $validated = $request->validate([

        'nombre_completo' => [
            'required_unless:es_anonimo,1',
            'nullable',
            'string',
            'max:255',
        ],

        'tipo_documento' => [
            'nullable',
            'string',
            'max:30',
        ],

        'numero_documento' => [
            'nullable',
            'string',
            'max:50',
        ],

        'edad' => [
            'nullable',
            'integer',
            'min:1',
            'max:120',
        ],

        'institucion' => [
            'nullable',
            'string',
            'max:255',
        ],

        'grado' => [
            'nullable',
            'string',
            'max:50',
        ],

        'correo' => [
            'nullable',
            'email',
            'max:255',
        ],

        'telefono' => [
            'nullable',
            'string',
            'max:30',
        ],

        'rol_familiar' => [
            'required',
            'string',
            'max:50',
        ],

        'municipio' => [
            'required',
            'string',
            'max:100',
        ],

        'zona' => [
            'required',
            'string',
            'max:100',
        ],

        'latitud' => [
            'nullable',
            'numeric',
            'between:-90,90',
        ],

        'longitud' => [
            'nullable',
            'numeric',
            'between:-180,180',
        ],

        'ubicacion_metodo' => [
            'nullable',
            'in:manual,gps',
        ],

        'es_anonimo' => [
            'nullable',
            'boolean',
        ],

        'acepta_datos' => [
            'accepted',
        ],

    ], [

        'nombre_completo.required_unless' =>
            'Ingresa tu nombre completo o selecciona la participación anónima.',

        'rol_familiar.required' =>
            'Selecciona tu relación familiar.',

        'municipio.required' =>
            'Ingresa el municipio.',

        'zona.required' =>
            'Ingresa la zona o sector.',

        'correo.email' =>
            'Ingresa un correo electrónico válido.',

        'acepta_datos.accepted' =>
            'Debes aceptar el tratamiento de los datos para continuar.',
    ]);


    /*
    |--------------------------------------------------------------------------
    | DETERMINAR SI LA PARTICIPACIÓN ES ANÓNIMA
    |--------------------------------------------------------------------------
    */

    $esAnonimo = $request->boolean('es_anonimo');


    /*
    |--------------------------------------------------------------------------
    | SI ES ANÓNIMO, LIMPIAR DATOS PERSONALES
    |--------------------------------------------------------------------------
    */

    if ($esAnonimo) {

        $validated['nombre_completo'] =
            'Participante anónimo';

        $validated['tipo_documento'] =
            null;

        $validated['numero_documento'] =
            null;

        $validated['institucion'] =
            null;

        $validated['grado'] =
            null;

        $validated['correo'] =
            null;

        $validated['telefono'] =
            null;
    }


    /*
    |--------------------------------------------------------------------------
    | GUARDAR INFORMACIÓN TEMPORALMENTE
    |--------------------------------------------------------------------------
    */

    session([
        'participacion_formulario' => [

            'nombre_completo' =>
                $validated['nombre_completo'] ?? 'Participante anónimo',

            'tipo_documento' =>
                $validated['tipo_documento'] ?? null,

            'numero_documento' =>
                $validated['numero_documento'] ?? null,

            'edad' =>
                $validated['edad'] ?? null,

            'institucion' =>
                $validated['institucion'] ?? null,

            'grado' =>
                $validated['grado'] ?? null,

            'correo' =>
                $validated['correo'] ?? null,

            'telefono' =>
                $validated['telefono'] ?? null,

            'rol_familiar' =>
                $validated['rol_familiar'],

            'municipio' =>
                $validated['municipio'],

            'zona' =>
                $validated['zona'],

            'latitud' =>
                $validated['latitud'] ?? null,

            'longitud' =>
                $validated['longitud'] ?? null,

            'ubicacion_metodo' =>
                $validated['ubicacion_metodo'] ?? 'manual',

            'es_anonimo' =>
                $esAnonimo,

            'acepta_datos' =>
                true,
        ],
    ]);


    /*
    |--------------------------------------------------------------------------
    | IR A SELECCIÓN DE AVATAR
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('participacion.avatar');
}
    /**
     * Mostrar pantalla para seleccionar avatar.
     */
public function avatar()
{
    if (!session()->has('participacion_formulario')) {
        return redirect()
            ->route('participacion.create')
            ->with(
                'error',
                'Primero debes completar el formulario.'
            );
    }

    $avatares = Avatar::query()
        ->orderBy('id', 'asc')
        ->get();

    return view(
        'participacion.avatar',
        compact('avatares')
    );
}
    /**
     * Guardar avatar y finalizar registro.
     */
    public function guardarAvatar(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validar avatar
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'avatar_id' => [
                'required',
                'integer',
                'exists:avatares,id',
            ],
        ], [
            'avatar_id.required' =>
                'Selecciona un avatar para continuar.',

            'avatar_id.exists' =>
                'El avatar seleccionado no es válido.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Recuperar datos del formulario
        |--------------------------------------------------------------------------
        */

        $datos = session(
            'participacion_formulario'
        );


        if (!$datos) {

            return redirect()
                ->route('participacion.create')
                ->with(
                    'error',
                    'La información de participación expiró. Completa nuevamente el formulario.'
                );
        }


        try {

            DB::beginTransaction();


            /*
            |--------------------------------------------------------------------------
            | Crear participante
            |--------------------------------------------------------------------------
            */

            $participante = Participantes::create([

                'usuario_id' =>
                    null,

                'avatar_id' =>
                    $validated['avatar_id'],

                'nombre_completo' =>
                    $datos['nombre_completo'],

                'tipo_documento' =>
                    $datos['tipo_documento'] ?? null,

                'numero_documento' =>
                    $datos['numero_documento'] ?? null,

                'edad' =>
                    $datos['edad'] ?? null,

                'institucion' =>
                    $datos['institucion'] ?? null,

                'grado' =>
                    $datos['grado'] ?? null,

                'correo' =>
                    $datos['correo'] ?? null,

                'telefono' =>
                    $datos['telefono'] ?? null,

                'rol_familiar' =>
                    $datos['rol_familiar'],

                'municipio' =>
                    $datos['municipio'],

                'zona' =>
                    $datos['zona'],

                'latitud' =>
                    $datos['latitud'] ?? null,

                'longitud' =>
                    $datos['longitud'] ?? null,

                'ubicacion_metodo' =>
                    $datos['ubicacion_metodo'] ?? 'manual',

                'es_anonimo' =>
                    $datos['es_anonimo'] ?? false,

                'acepta_datos' =>
                    true,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Crear token de participación
            |--------------------------------------------------------------------------
            */

            $token = Str::random(64);


            /*
            |--------------------------------------------------------------------------
            | Crear identificador anónimo
            |--------------------------------------------------------------------------
            */

            $identificadorAnonimo =
                'PP-' . strtoupper(
                    Str::random(16)
                );


            /*
            |--------------------------------------------------------------------------
            | Crear sesión de participación
            |--------------------------------------------------------------------------
            */

            $sesion = SesionParticipacion::create([

                'participante_id' =>
                    $participante->id,

                'token' =>
                    $token,

                'identificador_anonimo' =>
                    $identificadorAnonimo,

                'fecha_inicio' =>
                    now(),

                'fecha_ultima_actividad' =>
                    now(),

                'fecha_fin' =>
                    null,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Guardar datos en la sesión del navegador
            |--------------------------------------------------------------------------
            */

            session([
                'participacion_id' =>
                    $participante->id,

                'participacion_token' =>
                    $token,

                'identificador_anonimo' =>
                    $identificadorAnonimo,

                'sesion_participacion_id' =>
                    $sesion->id,

                'participante_nombre' =>
                    $participante->nombre_completo,

                'participante_avatar_id' =>
                    $participante->avatar_id,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Eliminar datos temporales
            |--------------------------------------------------------------------------
            */

            session()->forget(
                'participacion_formulario'
            );


            /*
            |--------------------------------------------------------------------------
            | Confirmar transacción
            |--------------------------------------------------------------------------
            */

            DB::commit();


            /*
            |--------------------------------------------------------------------------
            | Ir a la primera escena
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('escena')
                ->with(
                    'success',
                    '¡Bienvenido a Ponte Pilas!'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    'No fue posible guardar la participación: ' .
                    $e->getMessage()
                );
        }
    }
}