<?php

namespace App\Models\Employees;

class EmpleadoTiempoCompleto extends Empleado
{
    protected $salarioMensual;

    public function __construct(?int $id, string $nombre, string $infoContacto, float $salarioMensual)
    {
        parent::__construct($id, $nombre, $infoContacto);
        $this->salarioMensual = $salarioMensual;
    }

    /**
     * Calcular salario mensual en PEN (soles).
     *
     * @return float
     */
    public function calcularSalario(): float
    {
        return $this->salarioMensual;
    }

    public function getDatosAdicionales(): array
    {
        return ['salario_mensual' => $this->salarioMensual];
    }
}