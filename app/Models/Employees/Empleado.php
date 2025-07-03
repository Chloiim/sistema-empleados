<?php

namespace App\Models\Employees;

use App\Contracts\ContratoEmpleado;

abstract class Empleado implements ContratoEmpleado
{
    protected $id;
    protected $nombre;
    protected $infoContacto;

    public function __construct(?int $id, string $nombre, string $infoContacto)
    {
        $this->id = $id ?? 0;
        $this->nombre = $nombre;
        $this->infoContacto = $infoContacto;
    }

    public function getId(): string
    {
        return (string)$this->id;
    }

    /**
     * Establecer el ID del empleado (usado después de guardar en la base de datos).
     *
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getInfoContacto(): string
    {
        return $this->infoContacto;
    }

    abstract public function calcularSalario(): float;
}