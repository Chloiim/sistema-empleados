<?php

namespace App\Services;

use App\Contratos\ContratoEmpleado;

class CalculadorSalario
{
    /**
     * Calcular salario de un empleado.
     *
     * @param ContratoEmpleado $empleado
     * @return float
     */
    public function calcular(ContratoEmpleado $empleado): float
    {
        return $empleado->calcularSalario();
    }
}