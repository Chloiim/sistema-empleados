<?php

namespace App\Services;

use App\Contracts\ContratoEmpleado;
use App\Repositories\RepositorioEmpleado;
use App\Contracts\Notificable;
use Illuminate\Contracts\Container\Container;

class SistemaGestionEmpleados
{
    protected $repositorio;
    protected $calculadorSalario;
    protected $notificacionEmail;
    protected $notificacionSMS;

    public function __construct(RepositorioEmpleado $repositorio, CalculadorSalario $calculadorSalario, Notificable $notificacionEmail, Notificable $notificacionSMS
    ) {
        $this->repositorio = $repositorio;
        $this->calculadorSalario = $calculadorSalario;
        $this->notificacionEmail = $notificacionEmail;
        $this->notificacionSMS = $notificacionSMS;
    }

    /**
     * Agregar un empleado al sistema.
     *
     * @param ContratoEmpleado $empleado
     * @return void
     */
    public function agregarEmpleado(ContratoEmpleado $empleado): void
    {
        $this->repositorio->guardar($empleado);
    }

    /**
     * Obtener un empleado por ID.
     *
     * @param int $id
     * @return ContratoEmpleado|null
     */
    public function obtenerEmpleado(int $id): ?ContratoEmpleado
    {
        return $this->repositorio->obtener($id);
    }

    /**
     * Listar todos los empleados.
     *
     * @return array
     */
    public function listarTodos(): array
    {
        return $this->repositorio->listarTodos();
    }

    /**
     * Procesar pago para un empleado y enviar notificaciones.
     *
     * @param int $id
     * @return float
     */
    public function procesarPago(int $id): float
    {
        $empleado = $this->obtenerEmpleado($id);
        if ($empleado) {
            // Depuración temporal
            if ($empleado instanceof \App\Contracts\ContratoEmpleado) {
                \Log::info('Empleado en procesarPago implementa ContratoEmpleado: ' . get_class($empleado));
            } else {
                \Log::error('Empleado en procesarPago NO implementa ContratoEmpleado: ' . get_class($empleado));
            }

            $salario = $this->calculadorSalario->calcular($empleado); // Línea 66
            $this->notificacionEmail->enviar($empleado, $salario);
            if (preg_match('/^\+?[0-9]{10,}$/', $empleado->getInfoContacto())) {
                $this->notificacionSMS->enviar($empleado, $salario);
            }
            return $salario;
        }
        return 0.0;
    }

    /**
     * Eliminar un empleado del sistema.
     *
     * @param int $id
     * @return void
     */
    public function eliminarEmpleado(int $id): void
    {
        $this->repositorio->eliminar($id);
    }
}