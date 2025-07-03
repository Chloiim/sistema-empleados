<?php

namespace App\Models\Employees;

class Contratista extends Empleado
{
    protected $montoContrato;

    public function __construct(?int $id, string $nombre, string $infoContacto, float $montoContrato)
    {
        parent::__construct($id, $nombre, $infoContacto);
        $this->montoContrato = $montoContrato;
    }

    /**
     * Calcular monto fijo del contrato en PEN (soles).
     *
     * @return float
     */
    public function calcularSalario(): float
    {
        return $this->montoContrato;
    }

    public function getDatosAdicionales(): array
    {
        return ['monto_contrato' => $this->montoContrato];
    }
}