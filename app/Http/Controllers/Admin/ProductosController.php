<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Listado de productos (wrapper para Livewire component).
     */
    public function index(Request $request)
    {
        return view('admin.productos.index');
    }

    /**
     * Formulario de creación (wrapper para Livewire form component).
     */
    public function create(Request $request)
    {
        return view('admin.productos.create');
    }

    /**
     * Formulario de edición (wrapper para Livewire form component).
     */
    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }
}
