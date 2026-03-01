<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TamanosController extends Controller
{
    /**
     * Listado de tamaños (wrapper para Livewire component).
     */
    public function index(Request $request)
    {
        return view('admin.tamanos.index');
    }
}
