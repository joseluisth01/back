<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservaHecha extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
  
    public $nombre;
    public $apellidos;
    public $matricula;
    public $asientosSeleccionados;
    public $productos;
    public function __construct($nombre,$apellidos,$matricula,$asientosSeleccionados,$productos)
    {
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
        $this->matricula=$matricula;
        $this->asientosSeleccionados=$asientosSeleccionados;
        $this->productos=$productos;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reserva confirmada en TAPACOS AUTOCINEMAS',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->from('tapacosautocinemas@gmail.com', env('MAIL_FROM_NAME'))
                    ->view('reservaConfirmada')
                    ->subject('Confirmación de Reserva en TAPACOS AUTOCINEMAS')
                    /* ->attach(public_path('img/logo.png'), [
                        'as' => 'logo.png',
                        'mime' => 'image/png',
                    ]) */
                    ->with([
                        'nombre' => $this->nombre,
                        'apellidos' => $this->apellidos,
                        'matricula' => $this->matricula,
                        'asientosSeleccionados' => $this->asientosSeleccionados,
                        'productos' => $this->productos,
                    ]);
    }
    

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
