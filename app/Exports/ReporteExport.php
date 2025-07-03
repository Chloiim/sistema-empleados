<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class ReporteExport implements FromArray
{
    protected $datos;

    public function __construct(array $datos)
    {
        $this->datos = $datos;
    }

    /**
     * Devolver los datos para el archivo Excel.
     *
     * @return array
     */
    public function array(): array
    {
        return $this->datos;
    }
}