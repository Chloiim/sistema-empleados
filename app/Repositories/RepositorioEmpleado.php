<?php

namespace App\Repositories;

use App\Models\Employees\Empleado;
use App\Models\Employees\EmpleadoTiempoCompleto;
use App\Models\Employees\EmpleadoMedioTiempo;
use App\Models\Employees\Contratista;
use App\Models\EmpleadoModel;

class RepositorioEmpleado
{
    /**
     * Guardar un empleado en la base de datos.
     *
     * @param Empleado $empleado
     * @return void
     */
    public function guardar(Empleado $empleado): void
    {
        $tipo = class_basename($empleado);
        $datosAdicionales = method_exists($empleado, 'getDatosAdicionales') ? 
        $empleado->getDatosAdicionales() : [];

        $modelo = new EmpleadoModel();
        $modelo->nombre = $empleado->getNombre();
        $modelo->tipo = $tipo;
        $modelo->info_contacto = $empleado->getInfoContacto();
        $modelo->datos_adicionales = $datosAdicionales;
        $modelo->save();

        // Asignar el ID generado por la base de datos al objeto empleado
        $empleado->setId($modelo->id);
    }

    /**
     * Eliminar un empleado de la base de datos.
     *
     * @param int $id
     * @return void
     */
    public function eliminar(int $id): void
    {
        EmpleadoModel::destroy($id);
    }
    
    /**
     * Obtener un empleado por ID.
     *
     * @param int $id
     * @return Empleado|null
     */
    public function obtener(int $id): ?Empleado
    {
        $modelo = EmpleadoModel::find($id);
        if (!$modelo) {
            return null;
        }

        switch ($modelo->tipo) {
            case 'EmpleadoTiempoCompleto':
                return new EmpleadoTiempoCompleto(
                    $modelo->id,
                    $modelo->nombre,
                    $modelo->info_contacto,
                    $modelo->datos_adicionales['salario_mensual'] ?? 0.0
                );
            case 'EmpleadoMedioTiempo':
                return new EmpleadoMedioTiempo(
                    $modelo->id,
                    $modelo->nombre,
                    $modelo->info_contacto,
                    $modelo->datos_adicionales['tarifa_hora'] ?? 0.0,
                    $modelo->datos_adicionales['horas_trabajadas'] ?? 0.0
                );
            case 'Contratista':
                return new Contratista(
                    $modelo->id,
                    $modelo->nombre,
                    $modelo->info_contacto,
                    $modelo->datos_adicionales['monto_contrato'] ?? 0.0
                );
            default:
                return null;
        }
        // Depuración temporal
        if ($empleado instanceof \App\Contracts\ContratoEmpleado) {
            \Log::info('Empleado implementa ContratoEmpleado: ' . get_class($empleado));
        } else {
            \Log::error('Empleado NO implementa ContratoEmpleado: ' . get_class($empleado));
        }

        return $empleado;
    }

    /**
     * Obtener todos los empleados.
     *
     * @return array
     */
    public function listarTodos(): array
    {
        $empleados = [];
        $modelos = EmpleadoModel::all();
        foreach ($modelos as $modelo) {
            $empleado = $this->obtener($modelo->id);
            if ($empleado) {
                $empleados[] = $empleado;
            }
        }
        return $empleados;
    }
}