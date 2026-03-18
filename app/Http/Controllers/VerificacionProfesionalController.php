<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificacionProfesionalController extends Controller
{
    public function show()
    {
        return view('verificacion-profesional');
    }

    public function aceptar(Request $request)
    {
        $request->validate([
            'acepta' => ['accepted'],
        ], [
            'acepta.accepted' => 'Debes confirmar que eres un profesional de la salud.',
        ]);

        $url = $request->session()->pull('url.intended_profesional', route('home'));

        // Cookie con TTL de 30 días (minutos)
        return redirect($url)->cookie('profesional_salud', '1', 60 * 24 * 30);
    }
}
