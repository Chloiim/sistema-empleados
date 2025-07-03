<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Contracts\ContratoEmpleado;

class NotificacionPago extends Mailable
{
    use Queueable, SerializesModels;

    public $empleado;
    public $salario;

    /**
     * Create a new message instance.
     */
    public function __construct(ContratoEmpleado $empleado, float $salario)
    {
        $this->empleado = $empleado;
        $this->salario = $salario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.notificacion-pago')
                    ->subject('Notificación de Pago - Sistema de Gestión de Empleados');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificacion Pago',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.notificacion-pago',
        );
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
