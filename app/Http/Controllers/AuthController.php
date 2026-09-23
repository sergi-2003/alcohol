<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

use App\Models\Usuario;
use App\Models\Participantes;
use App\Models\Avatar;
use App\Models\SesionParticipacion;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('auth.login');
    }


  public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    if (
        Auth::attempt(
            [
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ],
            $request->boolean('remember')
        )
    ) {
        $request->session()->regenerate();

        return redirect()->route('admin');
    }

    return back()
        ->withErrors([
            'email' => 'Las credenciales ingresadas no son correctas.',
        ])
        ->withInput($request->only('email'));
}


    /*
    |--------------------------------------------------------------------------
    | LOGIN CON GOOGLE
    |--------------------------------------------------------------------------
    */

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $usuario = Usuario::where('email', $googleUser->email)->first();

            if (!$usuario) {
                return redirect()
                    ->route('login')
                    ->withErrors([
                        'correo' => 'Esta cuenta de Google no está registrada en Ponte Pilas.',
                    ]);
            }

            if (!$usuario->activo) {
                return redirect()
                    ->route('login')
                    ->withErrors([
                        'correo' => 'Tu cuenta se encuentra inactiva. Comunícate con el administrador.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Guardar ID de Google
            |--------------------------------------------------------------------------
            */

            if (!$usuario->google_id) {
                $usuario->google_id = $googleUser->id;
                $usuario->save();
            }

            /*
            |--------------------------------------------------------------------------
            | Iniciar sesión
            |--------------------------------------------------------------------------
            */

            Auth::login($usuario);

            request()->session()->regenerate();

            return redirect()->route('admin');

        } catch (\Throwable $e) {

            return redirect()
                ->route('login')
                ->withErrors([
                    'correo' => 'No fue posible iniciar sesión con Google. Inténtalo nuevamente.',
                ]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTRO
    |--------------------------------------------------------------------------
    */

    public function showRegistro()
{
    $avatares = Avatar::where('activo', true)
        ->orderBy('id')
        ->get();

    return view('auth.register', compact('avatares'));
}

    /**
 * =====================================================
 * REDIRECCIÓN GOOGLE PARA REGISTRO DE PARTICIPANTE
 * =====================================================
 */
public function redirectToGoogleRegister()
{
    return Socialite::driver('google')
        ->redirect();
}


/**
 * =====================================================
 * CALLBACK GOOGLE PARA REGISTRO DE PARTICIPANTE
 * =====================================================
 */
public function handleGoogleRegisterCallback()
{
    try {

        $googleUser = Socialite::driver('google')->user();

        /*
        |--------------------------------------------------------------------------
        | VALIDAR QUE GOOGLE ENTREGÓ CORREO
        |--------------------------------------------------------------------------
        */

        if (!$googleUser->email) {

            return redirect()
                ->route('registro')
                ->withErrors([
                    'correo' => 'Google no proporcionó un correo electrónico válido.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | GUARDAR INFORMACIÓN DE GOOGLE EN LA SESIÓN
        |--------------------------------------------------------------------------
        |
        | No creamos todavía el participante.
        |
        | Primero regresamos al formulario para que la persona
        | complete los demás datos.
        |
        */

        session([
            'google_register' => [
                'google_id' => $googleUser->id,
                'nombre' => $googleUser->name,
                'correo' => $googleUser->email,
            ]
        ]);


        /*
        |--------------------------------------------------------------------------
        | REGRESAR AL FORMULARIO
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('registro')
            ->with('google_register_success', 'Datos de Google cargados. Completa los datos restantes.');

    } catch (\Throwable $e) {

        \Log::error('Error en registro con Google', [
            'message' => $e->getMessage(),
        ]);

        return redirect()
            ->route('registro')
            ->withErrors([
                'correo' => 'No fue posible continuar con Google. Inténtalo nuevamente.'
            ]);
    }
}


    /*
    |--------------------------------------------------------------------------
    | PREPARAR REGISTRO
    |--------------------------------------------------------------------------
    |
    | Recibe los datos del formulario y los guarda temporalmente
    | en la sesión mientras el participante selecciona su avatar.
    |
    */

    public function prepararRegistro(Request $request)
    {
        $datos = $request->validate([
            'nombre_completo' => [
                'required',
                'string',
                'max:150',
            ],

            'tipo_documento' => [
                'nullable',
                'in:TI,CC,CE',
            ],

            'numero_documento' => [
                'nullable',
                'string',
                'max:50',
            ],

            'edad' => [
                'required',
                'integer',
                'min:1',
                'max:120',
            ],

            'institucion' => [
                'nullable',
                'string',
                'max:200',
            ],

            'grado' => [
                'nullable',
                'integer',
                'min:1',
                'max:11',
            ],

            'correo' => [
                'nullable',
                'email',
                'max:150',
            ],

            'telefono' => [
                'nullable',
                'string',
                'max:30',
            ],

            'es_anonimo' => [
                'nullable',
                'boolean',
            ],

            'acepta_datos' => [
                'required',
                'accepted',
            ],
        ], [
            'nombre_completo.required' =>
                'El nombre completo es obligatorio.',

            'edad.required' =>
                'La edad es obligatoria.',

            'edad.integer' =>
                'La edad debe ser un número.',

            'edad.min' =>
                'La edad no es válida.',

            'edad.max' =>
                'La edad no es válida.',

            'correo.email' =>
                'El correo electrónico no es válido.',

            'acepta_datos.required' =>
                'Debes aceptar el tratamiento de datos.',

            'acepta_datos.accepted' =>
                'Debes aceptar el tratamiento de datos.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Si es anónimo
        |--------------------------------------------------------------------------
        */

        if ($request->boolean('es_anonimo')) {

            $datos['nombre_completo'] = 'Participante anónimo';
            $datos['tipo_documento'] = null;
            $datos['numero_documento'] = null;
            $datos['institucion'] = null;
            $datos['grado'] = null;
            $datos['correo'] = null;
            $datos['telefono'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Guardar temporalmente
        |--------------------------------------------------------------------------
        */

        $request->session()->put(
            'registro_participante',
            $datos
        );


        /*
        |--------------------------------------------------------------------------
        | Ir a seleccionar avatar
        |--------------------------------------------------------------------------
        */

        return redirect()->route('elegir.avatar');
    }


    /*
    |--------------------------------------------------------------------------
    | MOSTRAR AVATARES
    |--------------------------------------------------------------------------
    */

    public function elegirAvatar(Request $request)
    {
        // Verificar que haya datos de registro
        if (!$request->session()->has('registro_participante')) {
            return redirect()
                ->route('registro')
                ->with(
                    'error',
                    'Primero debes completar tus datos.'
                );
        }

        $avatares = Avatar::where('activo', true)
            ->orderBy('id')
            ->get();

        $avatarSeleccionado = $request->session()
            ->get('avatar_seleccionado');

        return view(
            'auth.elegir-avatar',
            compact(
                'avatares',
                'avatarSeleccionado'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GUARDAR AVATAR
    |--------------------------------------------------------------------------
    */

    public function guardarAvatar(Request $request)
    {
        $request->validate([
            'avatar_id' => [
                'required',
                'integer',
                'exists:avatares,id',
            ],
        ], [
            'avatar_id.required' =>
                'Debes seleccionar un avatar.',

            'avatar_id.exists' =>
                'El avatar seleccionado no existe.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Guardamos el avatar en sesión
        |--------------------------------------------------------------------------
        */

        $request->session()->put(
            'avatar_seleccionado',
            $request->avatar_id
        );


        /*
        |--------------------------------------------------------------------------
        | Volvemos al formulario
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('registro')
            ->with(
                'success',
                'Avatar seleccionado correctamente.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | FINALIZAR REGISTRO
    |--------------------------------------------------------------------------
    */

   public function registro(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | VALIDAR DATOS DEL FORMULARIO
    |--------------------------------------------------------------------------
    */

    $datos = $request->validate([
        'nombre_completo' => [
            'required',
            'string',
            'max:150',
        ],

        'tipo_documento' => [
            'nullable',
            'in:TI,CC,CE',
        ],

        'numero_documento' => [
            'nullable',
            'string',
            'max:50',
        ],

        'edad' => [
            'required',
            'integer',
            'min:1',
            'max:120',
        ],

        'institucion' => [
            'nullable',
            'string',
            'max:200',
        ],

        'grado' => [
            'nullable',
            'integer',
            'min:1',
            'max:11',
        ],

        'correo' => [
            'nullable',
            'email',
            'max:150',
        ],

        'telefono' => [
            'nullable',
            'string',
            'max:30',
        ],

        'avatar_id' => [
            'required',
            'integer',
            'exists:avatares,id',
        ],

        'es_anonimo' => [
            'nullable',
            'boolean',
        ],

        'acepta_datos' => [
            'required',
            'accepted',
        ],
    ], [

        'nombre_completo.required' =>
            'El nombre completo es obligatorio.',

        'edad.required' =>
            'La edad es obligatoria.',

        'edad.integer' =>
            'La edad debe ser un número.',

        'edad.min' =>
            'La edad no es válida.',

        'edad.max' =>
            'La edad no es válida.',

        'correo.email' =>
            'El correo electrónico no es válido.',

        'avatar_id.required' =>
            'Debes seleccionar un avatar.',

        'avatar_id.exists' =>
            'El avatar seleccionado no existe.',

        'acepta_datos.required' =>
            'Debes aceptar el tratamiento de datos.',

        'acepta_datos.accepted' =>
            'Debes aceptar el tratamiento de datos.',
    ]);


    /*
    |--------------------------------------------------------------------------
    | REGISTRO ANÓNIMO
    |--------------------------------------------------------------------------
    */

    if ($request->boolean('es_anonimo')) {

        $datos['nombre_completo'] = 'Participante anónimo';

        $datos['tipo_documento'] = null;

        $datos['numero_documento'] = null;

        $datos['institucion'] = null;

        $datos['grado'] = null;

        $datos['correo'] = null;

        $datos['telefono'] = null;
    }


    /*
    |--------------------------------------------------------------------------
    | CREAR PARTICIPANTE
    |--------------------------------------------------------------------------
    */

    $participante = Participantes::create([

        'usuario_id' => null,

        'avatar_id' => $datos['avatar_id'],

        'nombre_completo' => $datos['nombre_completo'],

        'tipo_documento' => $datos['tipo_documento'] ?? null,

        'numero_documento' => $datos['numero_documento'] ?? null,

        'edad' => $datos['edad'],

        'institucion' => $datos['institucion'] ?? null,

        'grado' => $datos['grado'] ?? null,

        'correo' => $datos['correo'] ?? null,

        'telefono' => $datos['telefono'] ?? null,

        'es_anonimo' => $datos['es_anonimo'] ?? false,

        'acepta_datos' => true,
    ]);


    /*
    |--------------------------------------------------------------------------
    | CREAR SESIÓN DE PARTICIPACIÓN
    |--------------------------------------------------------------------------
    */

    $token = bin2hex(
        random_bytes(32)
    );


    $sesion = SesionParticipacion::create([

        'participante_id' => $participante->id,

        'token' => $token,

        'fecha_inicio' => now(),

        'fecha_ultima_actividad' => now(),

        'activa' => true,
    ]);


    /*
    |--------------------------------------------------------------------------
    | GUARDAR PARTICIPANTE EN SESIÓN
    |--------------------------------------------------------------------------
    */

    $request->session()->put(
        'participante_id',
        $participante->id
    );

    $request->session()->put(
        'participacion_token',
        $sesion->token
    );


    /*
    |--------------------------------------------------------------------------
    | LIMPIAR DATOS TEMPORALES DE GOOGLE
    |--------------------------------------------------------------------------
    */

    $request->session()->forget(
        'google_register'
    );


    /*
    |--------------------------------------------------------------------------
    | ENTRAR A PONTE PILAS
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('home')
        ->with(
            'success',
            '¡Registro realizado correctamente! Bienvenido a Ponte Pilas.'
        );
}
}