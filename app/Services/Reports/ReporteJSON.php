<?php

namespace App\Services\Reports;

use App\Contracts\Reporteable;

class ReporteJSON implements Reporteable
{
    /**
     * Generar un reporte en formato JSON.
     *
     * @param array $datos
     * @return string
     */
    public function generarReporte(array $datos): string
    {
        return json_encode($datos, JSON_PRETTY_PRINT);
    }
}