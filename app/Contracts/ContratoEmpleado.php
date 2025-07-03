<?php

namespace App\Contracts;

interface ContratoEmpleado
{
    /**
     * Calcular el salario del empleado en PEN (soles).
     *
     * @return float
     */
    public function getId(): string;
    public function getNombre(): string;
    public function getInfoContacto(): string;
    public function calcularSalario(): float;
}