<?php

namespace App\Services\Reports;

use App\Contracts\Reporteable;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;

class ReportePDF implements Reporteable
{
    /**
     * Generar un reporte en formato PDF.
     *
     * @param array $datos
     * @return string
     */
    public function generar(array $datos): string
    {
        $dompdf = new Dompdf();
        $html = '<h1>Informe de Empleado</h1>';
        $html .= '<p><strong>Nombre:</strong> ' . htmlspecialchars($datos['nombre']) . '</p>';
        $html .= '<p><strong>Salario:</strong> S/' . number_format($datos['salario'], 2) . '</p>';
        $html .= '<p><strong>Fecha:</strong> ' . htmlspecialchars($datos['fecha']) . '</p>';

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->output();
    }
}