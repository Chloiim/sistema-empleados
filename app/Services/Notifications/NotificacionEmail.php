<?php

namespace App\Services\Notifications;

use App\Contracts\ContratoEmpleado;
use App\Contracts\Notificable;
use App\Mail\NotificacionPago;
use Illuminate\Support\Facades\Mail;

class NotificacionEmail implements Notificable
{
    /**
     * Enviar notificación por email.
     *
     * @param ContratoEmpleado $empleado
     * @param float $salario
     * @return bool
     */
    public function enviar(ContratoEmpleado $empleado, float $salario): bool
    {
        try {
            Mail::to($empleado->getInfoContacto())->send(new NotificacionPago($empleado, $salario));
            return true;
        } catch (\Exception $e) {
            \Log::error('Error enviando email: ' . $e->getMessage());
            return false;
        }
    }
}