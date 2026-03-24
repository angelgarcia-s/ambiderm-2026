<?php

use App\Http\Controllers\Admin\CategoriasController;
use App\Http\Controllers\Admin\ColoresController;
use App\Http\Controllers\Admin\PaginasController;
use App\Http\Controllers\Admin\PermisosController;
use App\Http\Controllers\Admin\ProductosController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TamanosController;
use App\Http\Controllers\Admin\UsuariosController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\ProductosPublicController;
use App\Http\Controllers\VerificacionProfesionalController;
use Illuminate\Support\Facades\Route;

// frontend routes

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/nosotros', [NosotrosController::class, 'index'])->name('nosotros');

Route::get('/contacto', fn () => redirect('/#contacto'))->name('contacto');
Route::post('/contacto', [ContactoController::class, 'send'])->name('contacto.send')->middleware('throttle:3,1');

// Verificación profesional de la salud
Route::get('/verificacion-profesional', [VerificacionProfesionalController::class, 'show'])
    ->name('verificacion-profesional');
Route::post('/verificacion-profesional/aceptar', [VerificacionProfesionalController::class, 'aceptar'])
    ->name('verificacion-profesional.aceptar')
    ->middleware('throttle:10,1');

Route::middleware('profesional.salud')->group(function () {
    Route::get('/productos', [ProductosPublicController::class, 'index'])->name('productos');
    Route::get('/productos/{slug}', [ProductosPublicController::class, 'show'])->name('producto.detalle');
});

// Páginas legales y bolsa de trabajo
Route::get('/terminos-y-condiciones', [LegalController::class, 'terminos'])->name('terminos');
Route::get('/aviso-de-privacidad', [LegalController::class, 'privacidad'])->name('privacidad');
Route::get('/politica-de-cookies', [LegalController::class, 'cookies'])->name('cookies');
Route::get('/bolsa-de-trabajo', [LegalController::class, 'bolsaDeTrabajo'])->name('bolsa-de-trabajo');

// Redirects legacy (301)
Route::redirect('/producto-detalle', '/productos', 301)->name('producto-detalle');
Route::redirect('/guantes-vynil', '/productos', 301)->name('guantes-vynil');


// backend routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin: Usuarios (CRUD)
    Route::prefix('admin')->name('admin.')->group(function () {
        // Usuarios
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
        Route::get('usuarios/crear', [UsuariosController::class, 'create'])->name('usuarios.create');
        Route::post('usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');
        Route::get('usuarios/{usuario}/editar', [UsuariosController::class, 'edit'])->name('usuarios.edit');
        Route::put('usuarios/{usuario}', [UsuariosController::class, 'update'])->name('usuarios.update');
        Route::delete('usuarios/{usuario}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

        // Roles
        Route::get('roles', [RolesController::class, 'index'])->name('roles.index');
        Route::get('roles/crear', [RolesController::class, 'create'])->name('roles.create');
        Route::post('roles', [RolesController::class, 'store'])->name('roles.store');
        Route::get('roles/{rol}/editar', [RolesController::class, 'edit'])->name('roles.edit');
        Route::put('roles/{rol}', [RolesController::class, 'update'])->name('roles.update');
        Route::delete('roles/{rol}', [RolesController::class, 'destroy'])->name('roles.destroy');

        // Permisos (solo listado)
        Route::get('permisos', [PermisosController::class, 'index'])
            ->middleware('can:permisos.ver')
            ->name('permisos.index');

        // Categorías (ADR-003)
        Route::get('categorias', [CategoriasController::class, 'index'])
            ->middleware('can:categorias.ver')
            ->name('categorias.index');

        // Productos (ADR-003)
        Route::get('productos', [ProductosController::class, 'index'])
            ->middleware('can:productos.ver')
            ->name('productos.index');
        Route::get('productos/crear', [ProductosController::class, 'create'])
            ->middleware('can:productos.crear')
            ->name('productos.create');
        Route::get('productos/{producto}/editar', [ProductosController::class, 'edit'])
            ->middleware('can:productos.editar')
            ->name('productos.edit');

        // Catálogos auxiliares (ADR-003)
        Route::get('tamanos', [TamanosController::class, 'index'])
            ->middleware('can:productos.crear')
            ->name('tamanos.index');
        Route::get('colores', [ColoresController::class, 'index'])
            ->middleware('can:productos.crear')
            ->name('colores.index');

        // Páginas públicas CMS (ADR-002)
        Route::get('paginas', [PaginasController::class, 'index'])
            ->middleware('can:paginas.ver')
            ->name('paginas.index');
        Route::get('paginas/{pagina}/{seccion}/editar', [PaginasController::class, 'edit'])
            ->middleware('can:paginas.editar')
            ->name('paginas.edit');
    });
});

//landings PRODUCTOS
Route::get('/landings/vinyl_synmax', function () {
    return view('landings.vinyl_synmax');
})->name('landing.vinyl_synmax');

Route::get('/landings/toallitas', function () {
    return view('landings.toallitas');
})->name('landing.toallitas');

Route::get('/landings/ortopedico', function () {
    return view('landings.ortopedico');
})->name('landing.ortopedico');

Route::post('/brevo/rfc-trigger', [App\Http\Controllers\BrevoRfcTriggerController::class, 'handle'])->name('brevo.rfc-trigger');

require __DIR__.'/settings.php';
