<?php

namespace App\Services;

use App\Contracts\Reporteable;

class GeneradorReporte
{
    protected $reporteable;

    public function __construct(Reporteable $reporteable)
    {
        $this->reporteable = $reporteable;
    }

    /**
     * Generar reporte con los datos proporcionados.
     *
     * @param array $datos
     * @return string
     */
    public function generar(array $datos): string
    {
        return $this->reporteable->generarReporte($datos);
    }
}