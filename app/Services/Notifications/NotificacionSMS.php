<?php

namespace App\Services\Notifications;

use App\Contracts\ContratoEmpleado;
use App\Contracts\Notificable;
use Twilio\Rest\Client;

class NotificacionSMS implements Notificable
{
    protected $twilio;

    public function __construct()
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $from = env('TWILIO_FROM');
        $this->twilio = new Client($sid, $token);
    }

    /**
     * Enviar notificación por SMS.
     *
     * @param ContratoEmpleado $empleado
     * @param float $salario
     * @return bool
     */
    public function enviar(ContratoEmpleado $empleado, float $salario): bool
    {
        try {
            $this->twilio->messages->create(
                $empleado->getInfoContacto(), // Asumimos que info_contacto es un número de teléfono
                [
                    'from' => env('TWILIO_FROM'),
                    'body' => "Hola {$empleado->getNombre()}, tu salario de S/{$salario} ha sido procesado el " . now()->format('d/m/Y H:i')
                ]
            );
            return true;
        } catch (\Exception $e) {
            \Log::error('Error enviando SMS: ' . $e->getMessage());
            return false;
        }
    }
}