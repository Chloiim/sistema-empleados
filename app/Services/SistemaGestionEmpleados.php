<?php

namespace App\Services;

use App\Contracts\ContratoEmpleado;
use App\Repositories\RepositorioEmpleado;

class SistemaGestionEmpleados
{
    protected $repositorio;
    protected $calculadorSalario;

    public function __construct(RepositorioEmpleado $repositorio, CalculadorSalario $calculadorSalario)
    {
        $this->repositorio = $repositorio;
        $this->calculadorSalario = $calculadorSalario;
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
     * @param string $id
     * @return ContratoEmpleado|null
     */
    public function obtenerEmpleado(string $id): ?ContratoEmpleado
    {
        return $this->repositorio->obtener($id);
    }

    /**
     * Procesar pago para un empleado (se implementará completamente en Hito 5).
     *
     * @param string $id
     * @return float
     */
    public function procesarPago(string $id): float
    {
        $empleado = $this->obtenerEmpleado($id);
        if ($empleado) {
            return $this->calculadorSalario->calcular($empleado);
        }
        return 0.0;
    }
}