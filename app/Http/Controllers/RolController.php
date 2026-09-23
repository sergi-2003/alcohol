<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Permiso;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Mostrar roles y sus permisos.
     */
    public function index()
    {
        $roles = Rol::with('permisos')
            ->orderBy('id')
            ->get();

        $permisos = Permiso::orderBy('id')
            ->get();

        return view(
            'admin.roles.index',
            compact(
                'roles',
                'permisos'
            )
        );
    }


    /**
     * Actualizar permisos de un rol.
     */
    public function updatePermisos(
        Request $request,
        Rol $rol
    ) {

        $permisos = $request->input(
            'permisos',
            []
        );


        /*
        |--------------------------------------------------------------------------
        | Validar que los permisos existan
        |--------------------------------------------------------------------------
        */

        $permisosValidos = Permiso::whereIn(
            'id',
            $permisos
        )
        ->pluck('id')
        ->toArray();


        /*
        |--------------------------------------------------------------------------
        | Sincronizar permisos
        |--------------------------------------------------------------------------
        */

        $rol->permisos()->sync(
            $permisosValidos
        );


        return redirect()
            ->route('admin.roles.index')
            ->with(
                'success',
                'Permisos actualizados correctamente.'
            );
    }
}