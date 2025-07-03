<?php

namespace App\Services\Reports;

use App\Contracts\Reporteable;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportePDF implements Reporteable
{
    /**
     * Generar un reporte en formato PDF.
     *
     * @param array $datos
     * @return string
     */
    public function generarReporte(array $datos): string
    {
        $pdf = Pdf::loadView('reports.pdf', $datos);
        return $pdf->download('reporte_empleado_' . $datos['empleado_id'] . '.pdf')->getOriginalContent();
    }
}