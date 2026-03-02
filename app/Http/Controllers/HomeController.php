<?php

namespace App\Http\Controllers;

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

        return view('home', compact('secciones', 'footer'));
    }
}
