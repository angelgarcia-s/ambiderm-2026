<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Services\ContenidoService;

class HomeController extends Controller
{
    /**
     * Página de inicio pública con contenido dinámico desde DB.
     */
    public function index()
    {
        $secciones = ContenidoService::obtenerPagina('home');
        $footer = ContenidoService::obtenerPagina('footer');

        $productosDestacados = cache()->remember('home.productos_destacados', now()->addHours(1), function () {
            return Producto::activo()
                ->destacado()
                ->ordenado()
                ->with(['colores', 'categorias'])
                ->get();
        });

        return view('home', compact('secciones', 'footer', 'productosDestacados'));
    }
}
