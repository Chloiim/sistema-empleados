<?php

namespace App\Services;

use App\Contratos\GeneradorReporte;

class ServicioGeneracionReporte
{
    protected GeneradorReporte $generador;

    public function __construct(GeneradorReporte $generador)
    {
        $this->generador = $generador;
    }

    /**
     * Generar un reporte con los datos proporcionados.
     *
     * @param array $datos
     * @return string
     */
    public function generar(array $datos): string
    {
        return $this->generador->generarReporte($datos);
    }
}