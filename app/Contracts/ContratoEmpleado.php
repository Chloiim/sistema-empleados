<?php

namespace App\Contracts;

interface ContratoEmpleado
{
    //Obtener el ID del empleado.
    public function getId(): string;

    //Obtener el nombre del empleado.
    public function getNombre(): string;

    //Obtener la información de contacto.
    public function getInfoContacto(): string;

    //Calcular el salario del empleado.
    public function calcularSalario(): float;
}