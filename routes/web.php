<?php

use App\Http\Controllers\Admin\CategoriasController;
use App\Http\Controllers\Admin\ColoresController;
use App\Http\Controllers\Admin\PermisosController;
use App\Http\Controllers\Admin\ProductosController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TamanosController;
use App\Http\Controllers\Admin\UsuariosController;
use App\Http\Controllers\ProductosPublicController;
use Illuminate\Support\Facades\Route;

// frontend routes

Route::view('/', 'home')->name('home');

Route::view('/nosotros', 'acerca-de-ambiderm')->name('nosotros');

Route::get('/productos', [ProductosPublicController::class, 'index'])->name('productos');
Route::get('/productos/{slug}', [ProductosPublicController::class, 'show'])->name('producto.detalle');

// Redirects legacy (301)
Route::redirect('/producto-detalle', '/productos', 301)->name('producto-detalle');
Route::redirect('/guantes-vynil', '/productos', 301)->name('guantes-vynil');


// backend routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Admin: Usuarios (CRUD)
    Route::prefix('admin')->name('admin.')->group(function () {
        // Usuarios
        Route::view('/', 'dashboard')->name('dashboard');
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
    });
});

require __DIR__.'/settings.php';
