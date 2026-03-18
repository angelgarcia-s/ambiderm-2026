<?php

namespace App\Http\Controllers;

use App\Services\ContenidoService;

class LegalController extends Controller
{
    public function terminos()
    {
        $footer = ContenidoService::obtenerPagina('footer');
        return view('legal.terminos', compact('footer'));
    }

    public function privacidad()
    {
        $footer = ContenidoService::obtenerPagina('footer');
        return view('legal.privacidad', compact('footer'));
    }

    public function cookies()
    {
        $footer = ContenidoService::obtenerPagina('footer');
        return view('legal.cookies', compact('footer'));
    }

    public function bolsaDeTrabajo()
    {
        $footer = ContenidoService::obtenerPagina('footer');
        return view('legal.bolsa-de-trabajo', compact('footer'));
    }
}
