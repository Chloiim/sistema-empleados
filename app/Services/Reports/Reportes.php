<?php

namespace App\Services\Reports;

use App\Contracts\Reporteable;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteExport;

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
        $pdf = Pdf::loadView('reportes.pdf', $datos);
        return $pdf->output();
    }
}

class ReporteExcel implements Reporteable
{
    /**
     * Generar un reporte en formato Excel.
     *
     * @param array $datos
     * @return string
     */
    public function generarReporte(array $datos): string
    {
        return Excel::download(new ReporteExport($datos), 'reporte_empleados.xlsx');
    }
}

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