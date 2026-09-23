<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Mostrar usuarios.
     */
    public function index()
    {
        $usuarios = Usuario::with('rol')
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'admin.usuarios.index',
            compact('usuarios')
        );
    }


    /**
     * Mostrar formulario para crear.
     */
    public function create()
    {
        $roles = Rol::orderBy('id')->get();

        return view(
            'admin.usuarios.create',
            compact('roles')
        );
    }


    /**
     * Guardar usuario.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'rol_id' => [
                'required',
                'integer',
                'exists:roles,id',
            ],

            'nombre' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:usuarios,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'activo' => [
                'nullable',
                'boolean',
            ],
        ], [

            'rol_id.required' =>
                'Debes seleccionar un rol.',

            'rol_id.exists' =>
                'El rol seleccionado no existe.',

            'nombre.required' =>
                'El nombre es obligatorio.',

            'email.required' =>
                'El correo electrónico es obligatorio.',

            'email.email' =>
                'El correo electrónico no es válido.',

            'email.unique' =>
                'Este correo ya está registrado.',

            'password.required' =>
                'La contraseña es obligatoria.',

            'password.min' =>
                'La contraseña debe tener mínimo 8 caracteres.',

            'password.confirmed' =>
                'Las contraseñas no coinciden.',
        ]);


        Usuario::create([
            'rol_id' => $datos['rol_id'],
            'nombre' => $datos['nombre'],
            'email' => $datos['email'],
            'password' => $datos['password'],
            'activo' => $request->boolean('activo'),
        ]);


        return redirect()
            ->route('admin.usuarios.index')
            ->with(
                'success',
                'Usuario creado correctamente.'
            );
    }


    /**
     * Mostrar formulario de edición.
     */
    public function edit(Usuario $usuario)
    {
        $roles = Rol::orderBy('id')->get();

        return view(
            'admin.usuarios.edit',
            compact(
                'usuario',
                'roles'
            )
        );
    }


    /**
     * Actualizar usuario.
     */
public function update(Request $request, Usuario $usuario)
{
    $datos = $request->validate([
        'rol_id' => [
            'required',
            'integer',
            'exists:roles,id',
        ],

        'nombre' => [
            'required',
            'string',
            'max:150',
        ],

        'email' => [
            'required',
            'email',
            'max:255',
            'unique:usuarios,email,' . $usuario->id,
        ],

        'password' => [
            'nullable',
            'string',
            'min:8',
            'confirmed',
        ],

        'activo' => [
            'nullable',
            'boolean',
        ],
    ], [
        'rol_id.required' =>
            'Debes seleccionar un rol.',

        'rol_id.exists' =>
            'El rol seleccionado no existe.',

        'nombre.required' =>
            'El nombre es obligatorio.',

        'email.required' =>
            'El correo electrónico es obligatorio.',

        'email.email' =>
            'El correo electrónico no es válido.',

        'email.unique' =>
            'Este correo ya está registrado.',

        'password.min' =>
            'La contraseña debe tener mínimo 8 caracteres.',

        'password.confirmed' =>
            'Las contraseñas no coinciden.',
    ]);


    $usuario->rol_id = $datos['rol_id'];

    $usuario->nombre = $datos['nombre'];

    $usuario->email = $datos['email'];

    $usuario->activo = $request->boolean('activo');


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR CONTRASEÑA
    |--------------------------------------------------------------------------
    |
    | Si el campo está vacío, no modificamos la contraseña actual.
    |
    */

    if (!empty($datos['password'])) {

        $usuario->password = $datos['password'];
    }


    $usuario->save();


    return redirect()
        ->route('admin.usuarios.index')
        ->with(
            'success',
            'Usuario actualizado correctamente.'
        );
}


    /**
     * Activar / desactivar usuario.
     */
    public function toggleActivo(
        Usuario $usuario
    ) {
        $usuario->activo =
            !$usuario->activo;

        $usuario->save();


        return back()
            ->with(
                'success',
                $usuario->activo
                    ? 'Usuario activado correctamente.'
                    : 'Usuario desactivado correctamente.'
            );
    }
}