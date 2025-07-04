<?php

namespace App\Services;

use App\Contracts\Reporteable;

class GeneradorReporte
{
    protected $reporteable;

    public function __construct(Reporteable $reporteable)
    {
        $this->reporteable = $reporteable ?: app(Reporteable::class); // Usar el binding por defecto si no se pasa
    }

    /**
     * Establecer una implementación de reporteable manualmente.
     *
     * @param Reporteable $reporteable
     * @return void
     */
    public function setReporteable(Reporteable $reporteable): void
    {
        $this->reporteable = $reporteable;
    }

    /**
     * Generar reporte con los datos proporcionados.
     *
     * @param array $datos
     * @return string
     */
    public function generar(array $datos): mixed
    {
        if ($this->reporteable) {
            return $this->reporteable->generar($datos);
        }
        throw new \Exception('No se ha establecido un reporteable');
    }
}