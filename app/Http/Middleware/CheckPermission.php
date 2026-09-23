<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(
        Request $request,
        Closure $next,
        string $permiso
    ): Response {

        $usuario = $request->user();


        /*
        |--------------------------------------------------------------------------
        | USUARIO NO AUTENTICADO
        |--------------------------------------------------------------------------
        */

        if (!$usuario) {

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Debes iniciar sesión para acceder.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | USUARIO SIN ROL
        |--------------------------------------------------------------------------
        */

        if (!$usuario->rol) {

            abort(
                403,
                'Tu cuenta no tiene un rol asignado.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | COMPROBAR PERMISO
        |--------------------------------------------------------------------------
        */

        if (!$usuario->rol->tienePermiso($permiso)) {

            abort(
                403,
                'No tienes permisos para realizar esta acción.'
            );
        }


        return $next($request);
    }
}