<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\RegisteredUsuarioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CursoController as AdminCursoController;
use App\Http\Controllers\Estudiante\CursoController as EstudianteCursoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\Estudiante\InscripcionController;

use Illuminate\Support\Facades\Mail;


#Route::get('/test-mail', function () {

 #   Mail::raw('Correo de prueba desde Laravel', function ($message) {
    #    $message->to('sandychoquegh@gmail.com')
   #             ->subject('Test Laravel');
    #});

   # return "Correo enviado";
#});

use App\Models\SeccionInicio;

Route::get('/', function () {

    $secciones = SeccionInicio::where('estado','activo')->get();

    return view ('welcome', compact('secciones'));

});

Route::post(
    '/guardar-progreso-modulo',
    [App\Http\Controllers\Estudiante\CursoController::class, 'guardarProgresoModulo']
);


/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

Route::post('/inscripcion/store', [RegisteredUsuarioController::class, 'store'])
    ->name('inscripcion.store');

Route::get('/inscripcion/qr/{id}', [RegisteredUsuarioController::class, 'generarQR']);

Route::get('/inscripcion/info/{id}', [RegisteredUsuarioController::class, 'info']);

Route::post('/comprobantes/enviar', [App\Http\Controllers\Auth\RegisteredUsuarioController::class, 'enviarComprobante'])
    ->name('comprobantes.enviar');

 Route::post('/inscripcion/aprobar/{id}', [App\Http\Controllers\Admin\InscripcionController::class, 'aprobar']);





Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

Route::get('/empresas', function () {
    return view('empresas');
})->name('empresas');


/*
|--------------------------------------------------------------------------
| Redirección después de login
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $usuario = Auth::user();


    switch($usuario->rol_id){

        case 1:
            return redirect()->route('admin.dashboard');


        case 2:
            return redirect()->route('estudiante.dashboard');


        default:
            abort(403);
    }


})->middleware('auth')
->name('dashboard');





/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/


Route::middleware(['auth','admin'])
->group(function(){


    Route::get('/admin/dashboard', function(){

        return view('admin.dashboard');

    })->name('admin.dashboard');


});





/*
|--------------------------------------------------------------------------
| ESTUDIANTE
|--------------------------------------------------------------------------
*/


Route::middleware(['auth','estudiante'])
->group(function(){


    Route::get('/estudiante/dashboard',
    [EstudianteController::class,'dashboard'])

    ->name('estudiante.dashboard');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get(
    '/estudiante/cursos/empresarios/finanzas',
    [App\Http\Controllers\Estudiante\FinanzaController::class, 'index']
)->name('estudiante.cursos.empresarios.finanzas');
Route::post(
    '/estudiante/cursos/empresarios/finanzas/inscripcion',
    [App\Http\Controllers\Estudiante\FinanzaController::class, 'store']
)->name('estudiante.cursos.empresarios.finanzas.store');

Route::post(
    '/estudiante/cursos/empresarios/finanzas/comprobante',
    [App\Http\Controllers\Estudiante\FinanzaController::class, 'enviarComprobante']
)->name('comprobanteth.enviar');



Route::post('/cursos/{curso}/inscribirse', [CursoController::class, 'inscribirse'])->name('cursos.inscribirse');

// estas rutas son para los cursos y certificados

Route::get('/', [App\Http\Controllers\Estudiante\CursoController::class, 'index'])
        ->name('');
        

Route::middleware(['auth'])->group(function () {

      Route::get('/estudiante.cursos', [App\Http\Controllers\Estudiante\CursosController::class, 'index'])
        ->name('estudiante.cursos');

    Route::get('/estudiante.certificados', [App\Http\Controllers\Estudiante\CertificadoController::class, 'index'])->name('estudiante.certificados');


});


Route::get(
    '/estudiante/certificados',
    [App\Http\Controllers\Estudiante\CertificadoController::class, 'certificados']
)->name('estudiante.certificados');

//ESTO ES PARA EL ESTUDIANTE 

Route::post(
    '/inscripciones/store',
    [App\Http\Controllers\Estudiante\DashboardController::class, 'store']
)->name('inscripciones.store');

Route::post('/comprobanteth/enviar',
    [App\Http\Controllers\Estudiante\DashboardController::class,'enviarComprobante'])
    ->name('comprobanteth.enviar');

// web.php

Route::post('/guardar-tiempo-video', [App\Http\Controllers\Estudiante\CursoController::class, 'guardarTiempo']);
Route::get('/progreso/video/{video_id}', [App\Http\Controllers\Estudiante\CursoController::class, 'obtenerTiempo']);



Route::post('/cursos', [App\Http\Controllers\Estudiante\CursoController::class, 'store'])->name('cursos.store');
Route::post('/estudiante.cursos', [App\Http\Controllers\Estudiante\CursosController::class, 'store'])->name('cursos.store');
// web.php

Route::post('/inscripcion/{id}/comprobante', 
    [App\Http\Controllers\Estudiante\CursoController::class, 'subirComprobante'])
    ->name('inscripciones.comprobante');


    Route::post('/inscripcion/whatsapp', [App\Http\Controllers\Estudiante\CursoController::class, 'inscripcionWhatsapp'])
    ->name('inscripcion.whatsapp');
    
    Route::get('/inscripcion/estado/{cursoId}', [App\Http\Controllers\Estudiante\CursoController::class, 'estado']);

Route::get('/estudiante/videos/{curso}', [App\Http\Controllers\Estudiante\CursoController::class, 'verVideos'])
    ->name('estudiante.videos');

Route::post('/marcar-pendiente', [App\Http\Controllers\Estudiante\CursoController::class, 'marcarPendiente']);

// web.php
Route::get('/certificado/{inscripcion}', [App\Http\Controllers\Estudiante\CertificadoController::class, 'generar'])
    ->name('certificado.generar');


// routes/web.php

use App\Http\Controllers\ProgresoModuloController;

Route::post(

    '/guardar-progreso-modulo',

    [App\Http\Controllers\Estudiante\ProgresoModuloController::class, 'guardar']

)->name('.guardar-progreso-modulo');



Route::post(
    '/comprobante/enviar',
    [App\Http\Controllers\Estudiante\InscripcionController::class, 'enviarComprobante']
)->name('.comprobante.enviar');

Route::post(
    '/evaluacion/completar/{id}',
    [App\Http\Controllers\Estudiante\CursoController::class, 'completarEvaluacion']
)->name('evaluacion.completar');
    
//esto es para el administrador



Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->name('admin.dashboard');

use App\Http\Controllers\Admin\DashboardController;

Route::get(
    '/admin/dashboard/exportar',
    [App\Http\Controllers\Admin\DashboardController::class, 'exportarExcel']
)->name('admin.dashboard.exportar');

    Route::get('/admin/usuarios', [App\Http\Controllers\Admin\UsuarioController::class, 'index'])
        ->name('admin.usuarios');

     Route::delete('/admin/usuarios/{id}',
        [App\Http\Controllers\Admin\UsuarioController::class,'destroy']
    )->name('admin.usuarios');



Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::resource('cursos', AdminCursoController::class)
            ->names('admin.cursos');
            

});

Route::get('/admin/inscripciones', [App\Http\Controllers\Admin\InscripcionController::class, 'index'])->name('admin.inscripciones');

Route::post('/admin/inscripciones/aprobar/{id}', [App\Http\Controllers\Admin\InscripcionController::class, 'aprobar']);
Route::post('/admin/inscripciones/rechazar/{id}', [App\Http\Controllers\Admin\InscripcionController::class, 'rechazar']);


// ===============================
// USUARIOS NUEVOS
// ===============================
use App\Http\Controllers\Admin\UsuarioNuevoController;
Route::get(
    '/admin/usuariosNuevo',
    [UsuarioNuevoController::class, 'usuariosNuevos']
)->name('admin.usuarios.nuevos');


// Aprobar usuario nuevo

Route::post(
    '/admin/usuariosNuevo/{id}/aprobar',
    [UsuarioNuevoController::class, 'aprobarUsuario']
)->name('admin.usuarios.aprobar');


// Rechazar usuario nuevo

Route::post(
    '/admin/usuariosNuevo/{id}/rechazar',
    [UsuarioNuevoController::class, 'rechazarUsuario']
)->name('admin.usuarios.rechazar');

Route::prefix('admin')->group(function () {

    Route::get('cursos/{curso}/modulos', [App\Http\Controllers\Admin\ModuloController::class, 'index'])
        ->name('admin.modulos.index');
    
        Route::get('cursos/{curso}/modulos/create', [App\Http\Controllers\Admin\ModuloController::class, 'create'])
        ->name('admin.modulos.create');

    Route::post('modulos', [App\Http\Controllers\Admin\ModuloController::class, 'store'])
        ->name('admin.modulos.store');

    Route::get('modulos/{modulo}/edit', [App\Http\Controllers\Admin\ModuloController::class, 'edit'])
    ->name('admin.modulos.edit');

    Route::put('modulos/{modulo}', [App\Http\Controllers\Admin\ModuloController::class, 'update'])
        ->name('admin.modulos.update');

    Route::delete('modulos/{modulo}', [App\Http\Controllers\Admin\ModuloController::class, 'destroy'])
        ->name('admin.modulos.destroy');
});



Route::prefix('admin')->group(function () {

    Route::get('modulos/{modulo}/videos', [App\Http\Controllers\Admin\VideoController::class, 'index'])
    ->name('admin.videos.index');

Route::post('modulos/{modulo}/videos', [App\Http\Controllers\Admin\VideoController::class, 'store'])
    ->name('admin.videos.store');

    Route::get('cursos/{curso}/videos/create', [App\Http\Controllers\Admin\VideoController::class, 'create'])
        ->name('admin.videos.create');

   
    Route::delete('videos/{id}', [App\Http\Controllers\Admin\VideoController::class, 'destroy'])
        ->name('admin.videos.destroy');
});


Route::post('/admin/videos/ordenar', [App\Http\Controllers\Admin\VideoController::class, 'ordenar'])
    ->name('admin.videos.ordenar');

Route::put('/admin/videos/{id}', [App\Http\Controllers\Admin\VideoController::class, 'update'])
    ->name('admin.videos.update');

use App\Http\Controllers\Admin\CertificadoController;


Route::prefix('admin')->middleware(['auth'])->group(function(){

    Route::get('/certificados',
        [CertificadoController::class,'index']
    )->name('admin.certificados.index');


    Route::get('/certificados/create',
        [CertificadoController::class,'create']
    )->name('admin.certificados.create');

});


Route::get(
'/dashboard/exportar-inscripciones-cursos',
[DashboardController::class, 'exportarInscripcionesCursos']
)->name('admin.dashboard.exportar.inscripciones.cursos');
use App\Http\Controllers\Admin\BannerController;


Route::prefix('admin')->middleware(['auth'])->group(function(){

    Route::get('/banners',
        [App\Http\Controllers\Admin\BannerController::class,'index']
    )->name('admin.banners.index');

});
Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/seccion_inicios',
        [App\Http\Controllers\Admin\SeccionInicioController::class,'index'])
        ->name('admin.seccion_inicios.index');

    Route::get('/seccion_inicios/create',
        [App\Http\Controllers\Admin\SeccionInicioController::class,'create'])
        ->name('admin.seccion_inicios.create');

    Route::post('/seccion_inicios',
        [App\Http\Controllers\Admin\SeccionInicioController::class,'store'])
        ->name('admin.seccion_inicios.store');

    Route::get('/seccion_inicios/{id}/edit',
    [App\Http\Controllers\Admin\SeccionInicioController::class,'edit'])
    ->name('admin.seccion_inicios.edit');

    Route::put('/seccion_inicios/{id}',
        [App\Http\Controllers\Admin\SeccionInicioController::class,'update'])
        ->name('admin.seccion_inicios.update');

    Route::delete('/seccion_inicios/{id}',
        [App\Http\Controllers\Admin\SeccionInicioController::class,'destroy'])
        ->name('admin.seccion_inicios.destroy');

});


use App\Http\Controllers\Admin\InfoController;
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        Route::resource('infors', InfoController::class);
        Route::get('/infors/{id}/edit',[InfoController::class,'edit'])
    ->name('admin.infors.edit');

    });
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        Route::resource(
            'sobre_nosotros',
            App\Http\Controllers\Admin\SobreNosotrosController::class
        );
        

    });
    Route::get('/sobre_nosotros/{id}/edit',
[SobrenosotrosController::class,'edit']);
   use App\Http\Controllers\Admin\SeccionEmpresarialController;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        Route::resource(
            'secciones_empresariales',
            SeccionEmpresarialController::class
        );

    });
use App\Http\Controllers\Admin\SeccionEmpresaController;

    Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {


        Route::resource(
            'secciones_empresas',
            SeccionEmpresaController::class
        );


    });

  