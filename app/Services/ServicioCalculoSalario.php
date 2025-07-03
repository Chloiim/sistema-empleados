<?php

namespace App\Services;

use App\Contratos\ContratoEmpleado;

class ServicioCalculoSalario
{
    /**
     * Calcular el salario de un empleado.
     *
     * @param ContratoEmpleado $empleado
     * @return float
     */
    public function calcular(ContratoEmpleado $empleado): float
    {
        return $empleado->calcularSalario();
    }
}