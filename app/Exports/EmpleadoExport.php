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

    /**
     * Devolver los datos para el reporte Excel.
     *
     * @return array
     */
    public function array(): array
    {
        return [
            ['ID', 'Nombre', 'Tipo', 'Contacto', 'Salario'],
            [
                $this->datos['empleado_id'],
                $this->datos['nombre'],
                $this->datos['tipo'],
                $this->datos['info_contacto'],
                $this->datos['salario'],
            ],
        ];
    }
}