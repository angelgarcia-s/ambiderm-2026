<?php

namespace App\Http\Controllers;

use App\Services\ContenidoService;

class NosotrosController extends Controller
{
    /**
     * Página "Acerca de" pública con contenido dinámico desde DB.
     */
    public function index()
    {
        $secciones = ContenidoService::obtenerPagina('nosotros');
        $footer = ContenidoService::obtenerPagina('footer');

        return view('acerca-de', compact('secciones', 'footer'));
    }
}
