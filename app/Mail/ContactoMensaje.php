<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactoMensaje extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly array $datos) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [$this->datos['correo']],
            subject: 'Nuevo mensaje de contacto — ' . $this->datos['nombre'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contacto',
        );
    }
}
