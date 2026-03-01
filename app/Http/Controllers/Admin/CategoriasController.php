<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Listado de categorías (wrapper para Livewire component).
     */
    public function index(Request $request)
    {
        return view('admin.categorias.index');
    }
}
