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

        EmpleadoModel::updateOrCreate(
            ['id' => $empleado->getId()],
            [
                'nombre' => $empleado->getNombre(),
                'tipo' => $tipo,
                'info_contacto' => $empleado->getInfoContacto(),
                'datos_adicionales' => $datosAdicionales,
            ]
        );
    }

    /**
     * Obtener un empleado por ID.
     *
     * @param string $id
     * @return Empleado|null
     */
    public function obtener(string $id): ?Empleado
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
    }
}