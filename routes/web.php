<?php

use App\Http\Controllers\Admin\PermisosController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsuariosController;
use Illuminate\Support\Facades\Route;

// frontend routes

Route::view('/', 'home')->name('home');

Route::view('/nosotros', 'acerca-de-ambiderm')->name('nosotros');

Route::view('/productos', 'productos-ambiderm')->name('productos');

Route::view('/producto-detalle', 'producto-detalle')->name('producto-detalle');

Route::view('/guantes-vynil', 'guantes-vynil')->name('guantes-vynil');


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
    });
});

require __DIR__.'/settings.php';
