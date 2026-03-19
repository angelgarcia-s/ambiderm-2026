<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosPublicController extends Controller
{
    /**
     * Listado público de productos con filtro opcional por categoría.
     */
    public function index(Request $request)
    {
        $categorias = Categoria::activo()->ordenado()->get();

        $query = Producto::activo()->ordenado()->with('categorias');

        if ($request->filled('categoria')) {
            $query->deCategoria($request->categoria);
        }

        $productos = $query->get();

        return view('productos', compact('productos', 'categorias'));
    }

    /**
     * Detalle público de un producto por slug.
     */
    public function show(string $slug)
    {
        $producto = Producto::where('slug', $slug)
            ->activo()
            ->with(['categorias', 'tamanos', 'colores'])
            ->firstOrFail();

        // Productos relacionados: comparten al menos una categoría, excluyendo el actual
        $categoriaIds = $producto->categorias->pluck('id');

        $relacionados = Producto::activo()
            ->where('id', '!=', $producto->id)
            ->whereHas('categorias', fn ($q) => $q->whereIn('categorias.id', $categoriaIds))
            ->ordenado()
            ->with('categorias')
            ->limit(4)
            ->get();

        return view('producto-detalle', compact('producto', 'relacionados'));
    }
}
