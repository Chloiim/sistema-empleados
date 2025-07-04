<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class EmpleadoExport implements FromArray
{
    protected $datos;

    public function __construct(array $datos)
    {
        $this->datos = $datos;
    }

    public function array(): array
    {
        return $this->datos;
    }
}