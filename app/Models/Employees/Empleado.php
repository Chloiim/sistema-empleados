<?php

namespace App\Models\Employees;

use App\Contratos\ContratoEmpleado;

abstract class Empleado implements ContratoEmpleado
{
    protected $id;
    protected $nombre;
    protected $infoContacto;

    public function __construct(string $id, string $nombre, string $infoContacto)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->infoContacto = $infoContacto;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getInfoContacto(): string
    {
        return $this->infoContacto;
    }
}