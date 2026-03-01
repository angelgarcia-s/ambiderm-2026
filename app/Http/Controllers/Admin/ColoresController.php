<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColoresController extends Controller
{
    /**
     * Listado de colores (wrapper para Livewire component).
     */
    public function index(Request $request)
    {
        return view('admin.colores.index');
    }
}
