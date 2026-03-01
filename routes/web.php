<?php

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
});

require __DIR__.'/settings.php';
