<?php

namespace App\Reports;

use App\Contracts\Reporteable;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleadoExport;

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
        $export = new EmpleadoExport($datos);
        return Excel::raw($export, \Maatwebsite\Excel\Excel::XLSX);
    }
}