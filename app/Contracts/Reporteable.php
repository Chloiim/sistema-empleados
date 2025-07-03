<?php

namespace App\Contracts;

interface Reporteable
{
    /**
     * Generar un reporte en el formato especificado.
     *
     * @param array $datos
     * @return string
     */
    public function generarReporte(array $datos): string;
}