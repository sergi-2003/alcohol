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


Route::get('/participacion', [
    ParticipacionController::class,
    'create'
])->name('participacion.create');

Route::post('/participacion', [
    ParticipacionController::class,
    'store'
])->name('participacion.store');

Route::get('/participacion/avatar', [
    ParticipacionController::class,
    'avatar'
])->name('participacion.avatar');

Route::post('/participacion/avatar', [
    ParticipacionController::class,
    'guardarAvatar'
])->name('participacion.avatar.guardar');

Route::get('/participacion', [
    ParticipacionController::class,
    'create'
])->name('participacion.create');

Route::get('/aprende/graduacion', [GraduacionController::class, 'show'])
    ->name('aprende.graduacion');

Route::get('/aprende/graduacion/pdf', [GraduacionController::class, 'pdf'])
    ->name('aprende.graduacion.pdf');
    
Route::post('/aprende/reporte-resultados', [GraduacionController::class, 'reporte'])
    ->name('aprende.reporte.resultados');

    
    Route::post('/avance-escena', [AvanceEscenaController::class, 'guardar'])
    ->name('avance.escena');
Route::post('/respuestas-escena', [RespuestaEscenaController::class, 'guardar'])
    ->name('respuestas.escena');

    Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

    // Dashboard
    // ...

    // Reportes
    Route::get('/reportes', [
        ReportesController::class,
        'index'
    ])->name('admin.reportes');

    // Indicadores
    Route::get('/indicadores', [
        IndicadoresController::class,
        'index'
    ])->name('admin.indicadores');

    // Estadísticas / mapa de calor
    Route::get('/estadisticas', [
        EstadisticasController::class,
        'index'
    ])->name('admin.estadisticas.index');

    // ...
});
    
/*
|--------------------------------------------------------------------------
| CLIENTE / PARTICIPANTE
| SIN LOGIN
|--------------------------------------------------------------------------
*/

/*
| Temas educativos
*/

Route::get('/aprende', [
    AprendeController::class,
    'index'
])->name('aprende.index');


/*
| Contenidos de un tema
*/

Route::get('/aprende/tema/{tema}', [
    AprendeController::class,
    'tema'
])->name('aprende.tema');


/*
|--------------------------------------------------------------------------
| Imágenes de temas
| SIN LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/media/temas/{filename}', function ($filename) {

    $filename = basename($filename);

    $path = 'temas/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(
        Storage::disk('public')->path($path)
    );

})->name('media.tema');


/*
|--------------------------------------------------------------------------
| Autenticación
|--------------------------------------------------------------------------
*/


// Mostrar login
Route::get('/login', [
    AuthController::class,
    'showLogin'
])->name('login');


// Procesar login
Route::post('/login', [
    AuthController::class,
    'login'
])->name('login.submit');


// Cerrar sesión
Route::post('/logout', [
    AuthController::class,
    'logout'
])->name('logout');


/*
|--------------------------------------------------------------------------
| Google - Login administrativo
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [
    AuthController::class,
    'redirectToGoogle'
])->name('google.login');


Route::get('/auth/google/callback', [
    AuthController::class,
    'handleGoogleCallback'
])->name('google.callback');


/*
|--------------------------------------------------------------------------
| Registro de participantes
|--------------------------------------------------------------------------
*/


// Mostrar formulario
Route::get('/registro', [
    AuthController::class,
    'showRegistro'
])->name('registro');


// Procesar registro
Route::post('/registro', [
    AuthController::class,
    'registro'
])->name('registro.submit');


/*
|--------------------------------------------------------------------------
| Google - Registro de participante
|--------------------------------------------------------------------------
*/

Route::get('/registro/google', [
    AuthController::class,
    'redirectToGoogleRegister'
])->name('google.register');


Route::get('/registro/google/callback', [
    AuthController::class,
    'handleGoogleRegisterCallback'
])->name('google.register.callback');


/*
|--------------------------------------------------------------------------
| Panel administrativo
| REQUIERE LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/admin', [
    DashboardController::class,
    'index'
])->middleware('auth')->name('admin');

Route::get('/media/contenidos/{filename}', function ($filename) {

    $filename = basename($filename);

    $path = 'contenidos/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(
        Storage::disk('public')->path($path)
    );

})->name('media.contenido');

// Recursos de imágenes: AJAX / tiempo real
Route::post(
    '/admin/contenidos/{contenido}/recursos',
    [ContenidoController::class, 'storeRecurso']
)->middleware('auth')
  ->name('admin.recursos.store');

Route::patch(
    '/admin/recursos/{recurso}/posicion',
    [ContenidoController::class, 'updatePosicionRecurso']
)->middleware('auth')
  ->name('admin.recursos.posicion');

Route::post(
    '/admin/recursos/{recurso}/reemplazar',
    [ContenidoController::class, 'replaceRecurso']
)->middleware('auth')
  ->name('admin.recursos.replace');

Route::delete(
    '/admin/recursos/{recurso}',
    [ContenidoController::class, 'destroyRecurso']
)->middleware('auth')
  ->name('admin.recursos.destroy');

Route::get('/media/recursos/{filename}', function ($filename) {

    $filename = basename($filename);

    $path = 'contenidos/recursos/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(
        Storage::disk('public')->path($path)
    );


})->name('media.recurso');

/*
|--------------------------------------------------------------------------
| ADMINISTRACIÓN
| TODO LO DE AQUÍ REQUIERE LOGIN
|--------------------------------------------------------------------------
*/



Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {


    /*
    |--------------------------------------------------------------------------
    | USUARIOS
    |--------------------------------------------------------------------------
    */

    // Listar usuarios
    Route::get('/usuarios', [
        UsuarioController::class,
        'index'
    ])
        ->middleware('permiso:usuarios.ver')
        ->name('admin.usuarios.index');


    // Crear usuario
    Route::get('/usuarios/crear', [
        UsuarioController::class,
        'create'
    ])
        ->middleware('permiso:usuarios.crear')
        ->name('admin.usuarios.create');


    Route::post('/usuarios', [
        UsuarioController::class,
        'store'
    ])
        ->middleware('permiso:usuarios.crear')
        ->name('admin.usuarios.store');


    // Editar usuario
    Route::get('/usuarios/{usuario}/editar', [
        UsuarioController::class,
        'edit'
    ])
        ->middleware('permiso:usuarios.editar')
        ->name('admin.usuarios.edit');


    Route::put('/usuarios/{usuario}', [
        UsuarioController::class,
        'update'
    ])
        ->middleware('permiso:usuarios.editar')
        ->name('admin.usuarios.update');


    // Activar / desactivar usuario
    Route::patch('/usuarios/{usuario}/estado', [
        UsuarioController::class,
        'toggleActivo'
    ])
        ->middleware('permiso:usuarios.editar')
        ->name('admin.usuarios.toggle');



// Indicadores administrativos
Route::get('/indicadores', [
    IndicadoresController::class,
    'index'
])
    ->name('admin.indicadores');



    /*
    |--------------------------------------------------------------------------
    | ROLES Y PERMISOS
    |--------------------------------------------------------------------------
    */

    Route::get('/roles', [
        RolController::class,
        'index'
    ])
        ->name('admin.roles.index');


    Route::put('/roles/{rol}/permisos', [
        RolController::class,
        'updatePermisos'
    ])
        ->name('admin.roles.permisos.update');


    /*
    |--------------------------------------------------------------------------
    | TEMAS EDUCATIVOS - ADMIN
    |--------------------------------------------------------------------------
    */

    // Listar temas
    Route::get('/temas', [
        TemaController::class,
        'index'
    ])
        ->middleware('permiso:contenidos.ver')
        ->name('admin.temas.index');


    // Crear tema
    Route::get('/temas/crear', [
        TemaController::class,
        'create'
    ])
        ->middleware('permiso:contenidos.crear')
        ->name('admin.temas.create');


    Route::post('/temas', [
        TemaController::class,
        'store'
    ])
        ->middleware('permiso:contenidos.crear')
        ->name('admin.temas.store');


    // Editar tema
    Route::get('/temas/{tema}/editar', [
        TemaController::class,
        'edit'
    ])
        ->middleware('permiso:contenidos.editar')
        ->name('admin.temas.edit');


    Route::put('/temas/{tema}', [
        TemaController::class,
        'update'
    ])
        ->middleware('permiso:contenidos.editar')
        ->name('admin.temas.update');


    // Activar / desactivar tema
    Route::patch('/temas/{tema}/estado', [
        TemaController::class,
        'toggleActivo'
    ])
        ->middleware('permiso:contenidos.editar')
        ->name('admin.temas.toggle');

        Route::middleware(['auth', 'permiso:contenidos.editar'])->group(function () {

    Route::post('/admin/contenidos/{contenido}/recursos', [ContenidoController::class, 'storeRecurso'])
        ->name('admin.recursos.store');

    Route::patch('/admin/recursos/{recurso}/posicion', [ContenidoController::class, 'updatePosicionRecurso'])
        ->name('admin.recursos.posicion');

    Route::post('/admin/recursos/{recurso}/reemplazar', [ContenidoController::class, 'replaceRecurso'])
        ->name('admin.recursos.replace');

    Route::delete('/admin/recursos/{recurso}', [ContenidoController::class, 'destroyRecurso'])
        ->name('admin.recursos.destroy');
});


//*-------------------MAPA DE CALOR---------------------------------*/

// Esta ruta está dentro del grupo prefix('admin'), por eso aquí solo va '/estadisticas'.
// La URL resultante será /admin/estadisticas y conserva el middleware auth del grupo.
Route::get('/estadisticas', [EstadisticasController::class, 'index'])
    ->name('admin.estadisticas.index');






    /*
    |--------------------------------------------------------------------------
    | CONTENIDOS EDUCATIVOS
    |--------------------------------------------------------------------------
    */

    // Listar contenidos
    Route::get('/contenidos', [
        ContenidoController::class,
        'index'
    ])
        ->middleware('permiso:contenidos.ver')
        ->name('admin.contenidos.index');


    // Crear contenido
    Route::get('/contenidos/crear', [
        ContenidoController::class,
        'create'
    ])
        ->middleware('permiso:contenidos.crear')
        ->name('admin.contenidos.create');


    Route::post('/contenidos', [
        ContenidoController::class,
        'store'
    ])
        ->middleware('permiso:contenidos.crear')
        ->name('admin.contenidos.store');


    // Editar contenido
    Route::get('/contenidos/{contenido}/editar', [
        ContenidoController::class,
        'edit'
    ])
        ->middleware('permiso:contenidos.editar')
        ->name('admin.contenidos.edit');


    Route::put('/contenidos/{contenido}', [
        ContenidoController::class,
        'update'
    ])
        ->middleware('permiso:contenidos.editar')
        ->name('admin.contenidos.update');


    // Activar / desactivar contenido
    Route::patch('/contenidos/{contenido}/estado', [
        ContenidoController::class,
        'toggleActivo'
    ])
        ->middleware('permiso:contenidos.editar')
        ->name('admin.contenidos.toggle');


    // Eliminar contenido
    Route::delete('/contenidos/{contenido}', [
        ContenidoController::class,
        'destroy'
    ])


    
        ->middleware('permiso:contenidos.eliminar')
        ->name('admin.contenidos.destroy');

});