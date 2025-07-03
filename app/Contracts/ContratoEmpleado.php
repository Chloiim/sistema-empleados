<?php

namespace App\Contracts;

interface ContratoEmpleado
{
    /**
     * Calcular el salario del empleado en PEN (soles).
     *
     * @return float
     */
    public function calcularSalario(): float;
}