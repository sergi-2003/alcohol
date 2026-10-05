<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\AprendeController;
use App\Http\Controllers\ParticipacionController;
use App\Http\Controllers\Admin\EstadisticasController;
use App\Http\Controllers\GraduacionController;
use App\Http\Controllers\Admin\IndicadoresController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AvanceEscenaController;
use App\Http\Controllers\Admin\ReportesController;
use App\Http\Controllers\RespuestaEscenaController;

/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/juego-prueba', function () {
    return view('juegos.prueba');
})->name('juego.prueba');


/*
|--------------------------------------------------------------------------
| CLIENTE / PARTICIPANTE
| SIN LOGIN
|--------------------------------------------------------------------------
*/

// Escenas
Route::get('/escena', function () {
    return view('escenas.escena1');
})->name('escena');

Route::get('/aprende/escena/2', function () {
    return view('escenas.escena2');
})->name('escenas.escena2');

Route::get('/aprende/escena/3', function () {
    return view('escenas.escena3');
})->name('escenas.escena3');

Route::get('/aprende/escena/4', function () {
    return view('escenas.escena4');
})->name('escenas.escena4');

// Participación
Route::get('/participacion', [ParticipacionController::class, 'create'])
    ->name('participacion.create');

Route::post('/participacion', [ParticipacionController::class, 'store'])
    ->name('participacion.store');

Route::get('/participacion/avatar', [ParticipacionController::class, 'avatar'])
    ->name('participacion.avatar');

Route::post('/participacion/avatar', [ParticipacionController::class, 'guardarAvatar'])
    ->name('participacion.avatar.guardar');

// Graduación
Route::get('/aprende/graduacion', [GraduacionController::class, 'show'])
    ->name('aprende.graduacion');

Route::get('/aprende/graduacion/pdf', [GraduacionController::class, 'pdf'])
    ->name('aprende.graduacion.pdf');

Route::post('/aprende/reporte-resultados', [GraduacionController::class, 'reporte'])
    ->name('aprende.reporte.resultados');

// Guardado de avance y respuestas de las escenas
Route::post('/avance-escena', [AvanceEscenaController::class, 'guardar'])
    ->name('avance.escena');

Route::post('/respuestas-escena', [RespuestaEscenaController::class, 'guardar'])
    ->name('respuestas.escena');

// Temas educativos
Route::get('/aprende', [AprendeController::class, 'index'])
    ->name('aprende.index');

// Contenidos de un tema
Route::get('/aprende/tema/{tema}', [AprendeController::class, 'tema'])
    ->name('aprende.tema');


/*
|--------------------------------------------------------------------------
| Imágenes (media) - SIN LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/media/temas/{filename}', function ($filename) {

    $filename = basename($filename);
    $path = 'temas/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(Storage::disk('public')->path($path));

})->name('media.tema');

Route::get('/media/contenidos/{filename}', function ($filename) {

    $filename = basename($filename);
    $path = 'contenidos/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(Storage::disk('public')->path($path));

})->name('media.contenido');

Route::get('/media/recursos/{filename}', function ($filename) {

    $filename = basename($filename);
    $path = 'contenidos/recursos/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(Storage::disk('public')->path($path));

})->name('media.recurso');


/*
|--------------------------------------------------------------------------
| Autenticación
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google - Login administrativo
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])
    ->name('google.login');

Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])
    ->name('google.callback');

// Registro de participantes
Route::get('/registro', [AuthController::class, 'showRegistro'])->name('registro');
Route::post('/registro', [AuthController::class, 'registro'])->name('registro.submit');

// Google - Registro de participante
Route::get('/registro/google', [AuthController::class, 'redirectToGoogleRegister'])
    ->name('google.register');

Route::get('/registro/google/callback', [AuthController::class, 'handleGoogleRegisterCallback'])
    ->name('google.register.callback');


/*
|--------------------------------------------------------------------------
| Panel administrativo
| REQUIERE LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/admin', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('admin');

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

    // Reportes
    Route::get('/reportes', [ReportesController::class, 'index'])
        ->name('admin.reportes');

    // Indicadores
    Route::get('/indicadores', [IndicadoresController::class, 'index'])
        ->name('admin.indicadores');

    // Estadísticas / mapa de calor (URL: /admin/estadisticas)
    Route::get('/estadisticas', [EstadisticasController::class, 'index'])
        ->name('admin.estadisticas.index');


    /*
    |--------------------------------------------------------------------------
    | USUARIOS
    |--------------------------------------------------------------------------
    */

    Route::get('/usuarios', [UsuarioController::class, 'index'])
        ->middleware('permiso:usuarios.ver')
        ->name('admin.usuarios.index');

    Route::get('/usuarios/crear', [UsuarioController::class, 'create'])
        ->middleware('permiso:usuarios.crear')
        ->name('admin.usuarios.create');

    Route::post('/usuarios', [UsuarioController::class, 'store'])
        ->middleware('permiso:usuarios.crear')
        ->name('admin.usuarios.store');

    Route::get('/usuarios/{usuario}/editar', [UsuarioController::class, 'edit'])
        ->middleware('permiso:usuarios.editar')
        ->name('admin.usuarios.edit');

    Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])
        ->middleware('permiso:usuarios.editar')
        ->name('admin.usuarios.update');

    Route::patch('/usuarios/{usuario}/estado', [UsuarioController::class, 'toggleActivo'])
        ->middleware('permiso:usuarios.editar')
        ->name('admin.usuarios.toggle');


    /*
    |--------------------------------------------------------------------------
    | ROLES Y PERMISOS
    |--------------------------------------------------------------------------
    */

    Route::get('/roles', [RolController::class, 'index'])
        ->name('admin.roles.index');

    Route::put('/roles/{rol}/permisos', [RolController::class, 'updatePermisos'])
        ->name('admin.roles.permisos.update');


    /*
    |--------------------------------------------------------------------------
    | TEMAS EDUCATIVOS
    |--------------------------------------------------------------------------
    */

    Route::get('/temas', [TemaController::class, 'index'])
        ->middleware('permiso:contenidos.ver')
        ->name('admin.temas.index');

    Route::get('/temas/crear', [TemaController::class, 'create'])
        ->middleware('permiso:contenidos.crear')
        ->name('admin.temas.create');

    Route::post('/temas', [TemaController::class, 'store'])
        ->middleware('permiso:contenidos.crear')
        ->name('admin.temas.store');

    Route::get('/temas/{tema}/editar', [TemaController::class, 'edit'])
        ->middleware('permiso:contenidos.editar')
        ->name('admin.temas.edit');

    Route::put('/temas/{tema}', [TemaController::class, 'update'])
        ->middleware('permiso:contenidos.editar')
        ->name('admin.temas.update');

    Route::patch('/temas/{tema}/estado', [TemaController::class, 'toggleActivo'])
        ->middleware('permiso:contenidos.editar')
        ->name('admin.temas.toggle');


    /*
    |--------------------------------------------------------------------------
    | RECURSOS DE IMÁGENES (AJAX / tiempo real)
    | URLs resultantes: /admin/contenidos/{contenido}/recursos, /admin/recursos/...
    |--------------------------------------------------------------------------
    */

    Route::middleware('permiso:contenidos.editar')->group(function () {

        Route::post('/contenidos/{contenido}/recursos', [ContenidoController::class, 'storeRecurso'])
            ->name('admin.recursos.store');

        Route::patch('/recursos/{recurso}/posicion', [ContenidoController::class, 'updatePosicionRecurso'])
            ->name('admin.recursos.posicion');

        Route::post('/recursos/{recurso}/reemplazar', [ContenidoController::class, 'replaceRecurso'])
            ->name('admin.recursos.replace');

        Route::delete('/recursos/{recurso}', [ContenidoController::class, 'destroyRecurso'])
            ->name('admin.recursos.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | CONTENIDOS EDUCATIVOS
    |--------------------------------------------------------------------------
    */

    Route::get('/contenidos', [ContenidoController::class, 'index'])
        ->middleware('permiso:contenidos.ver')
        ->name('admin.contenidos.index');

    Route::get('/contenidos/crear', [ContenidoController::class, 'create'])
        ->middleware('permiso:contenidos.crear')
        ->name('admin.contenidos.create');

    Route::post('/contenidos', [ContenidoController::class, 'store'])
        ->middleware('permiso:contenidos.crear')
        ->name('admin.contenidos.store');

    Route::get('/contenidos/{contenido}/editar', [ContenidoController::class, 'edit'])
        ->middleware('permiso:contenidos.editar')
        ->name('admin.contenidos.edit');

    Route::put('/contenidos/{contenido}', [ContenidoController::class, 'update'])
        ->middleware('permiso:contenidos.editar')
        ->name('admin.contenidos.update');

    Route::patch('/contenidos/{contenido}/estado', [ContenidoController::class, 'toggleActivo'])
        ->middleware('permiso:contenidos.editar')
        ->name('admin.contenidos.toggle');

    Route::delete('/contenidos/{contenido}', [ContenidoController::class, 'destroy'])
        ->middleware('permiso:contenidos.eliminar')
        ->name('admin.contenidos.destroy');
});