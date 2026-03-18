<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function send(Request $request)
    {
        // Honeypot: los bots llenan este campo, los humanos no lo ven
        if ($request->filled('website')) {
            return redirect('/#contacto')->with('contacto_enviado', true);
        }

        $data = $request->validate([
            'nombre'  => ['required', 'string', 'max:100'],
            'correo'  => ['required', 'email', 'max:150'],
            'mensaje' => ['required', 'string', 'max:2000'],
        ]);

        // Guard de idempotencia: evita doble envío si el navegador re-envía el form
        $cacheKey = 'contacto_enviado_' . md5($data['correo'] . $data['mensaje']);
        if (cache()->has($cacheKey)) {
            return redirect('/#contacto')->with('contacto_enviado', true);
        }
        cache()->put($cacheKey, true, now()->addMinutes(2));

        Mail::to(config('mail.contact_address'))->send(new ContactoMensaje($data));

        return redirect('/#contacto')->with('contacto_enviado', true);
    }
}
