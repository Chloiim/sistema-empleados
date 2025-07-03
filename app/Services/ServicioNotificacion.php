<?php

namespace App\Services;

use App\Contracts\Notificable;

class ServicioNotificacion
{
    protected $notificadores;

    public function __construct(array $notificadores)
    {
        $this->notificadores = $notificadores;
    }

    /**
     * Enviar notificación a todos los notificadores.
     *
     * @param string $mensaje
     * @return void
     */
    public function notificar(string $mensaje): void
    {
        foreach ($this->notificadores as $notificador) {
            $notificador->enviarNotificacion($mensaje);
        }
    }
}