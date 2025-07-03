<?php

namespace App\Models\Employees;

class EmpleadoMedioTiempo extends Empleado
{
    protected $tarifaHora;
    protected $horasTrabajadas;

    public function __construct(string $id, string $nombre, string $infoContacto, float $tarifaHora, float $horasTrabajadas)
    {
        parent::__construct($id, $nombre, $infoContacto);
        $this->tarifaHora = $tarifaHora;
        $this->horasTrabajadas = $horasTrabajadas;
    }

    /**
     * Calcular salario por horas trabajadas en PEN (soles).
     *
     * @return float
     */
    public function calcularSalario(): float
    {
        return $this->tarifaHora * $this->horasTrabajadas;
    }

    public function getDatosAdicionales(): array
    {
        return [
            'tarifa_hora' => $this->tarifaHora,
            'horas_trabajadas' => $this->horasTrabajadas
        ];
    }
}