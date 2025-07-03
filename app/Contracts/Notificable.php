<?php

namespace App\Contracts;

interface Notificable
{
    /**
     * Enviar una notificación con el mensaje especificado.
     *
     * @param string $mensaje
     * @return void
     */
    public function enviarNotificacion(string $mensaje): void;
}