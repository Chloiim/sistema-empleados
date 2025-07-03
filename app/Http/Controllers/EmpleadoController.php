<?php

namespace App\Http\Controllers;

use App\Models\Employees\EmpleadoTiempoCompleto;
use App\Models\Employees\EmpleadoMedioTiempo;
use App\Models\Employees\Contratista;
use App\Services\SistemaGestionEmpleados;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmpleadoController extends Controller
{
    protected $sistema;

    public function __construct(SistemaGestionEmpleados $sistema)
    {
        $this->sistema = $sistema;
    }

    /**
     * Mostrar lista de empleados.
     */
    public function index()
    {
        // En este punto, mostramos una vista básica; la lista se implementará completamente en Hito 6
        return view('empleados.index');
    }

    /**
     * Mostrar formulario para crear empleado.
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Guardar nuevo empleado.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:tiempo_completo,medio_tiempo,contratista',
            'info_contacto' => 'required|string|max:255',
            'salario_mensual' => 'required_if:tipo,tiempo_completo|numeric|min:0',
            'tarifa_hora' => 'required_if:tipo,medio_tiempo|numeric|min:0',
            'horas_trabajadas' => 'required_if:tipo,medio_tiempo|numeric|min:0',
            'monto_contrato' => 'required_if:tipo,contratista|numeric|min:0',
        ]);

        $id = Str::uuid()->toString();

        switch ($request->tipo) {
            case 'tiempo_completo':
                $empleado = new EmpleadoTiempoCompleto($id, $request->nombre, $request->info_contacto, $request->salario_mensual);
                break;
            case 'medio_tiempo':
                $empleado = new EmpleadoMedioTiempo($id, $request->nombre, $request->info_contacto, $request->tarifa_hora, $request->horas_trabajadas);
                break;
            case 'contratista':
                $empleado = new Contratista($id, $request->nombre, $request->info_contacto, $request->monto_contrato);
                break;
            default:
                return redirect()->back()->withErrors(['tipo' => 'Tipo de empleado inválido']);
        }

        $this->sistema->agregarEmpleado($empleado);

        return redirect()->route('empleados.index')->with('success', 'Empleado agregado exitosamente.');
    }

    /**
     * Mostrar detalles de un empleado.
     */
    public function show($id)
    {
        $empleado = $this->sistema->obtenerEmpleado($id);
        if (!$empleado) {
            return redirect()->route('empleados.index')->withErrors(['error' => 'Empleado no encontrado']);
        }
        return view('empleados.show', compact('empleado'));
    }

    /**
     * Mostrar formulario para editar empleado.
     */
    public function edit($id)
    {
        // Se implementará en Hito 6
    }

    /**
     * Actualizar empleado.
     */
    public function update(Request $request, $id)
    {
        // Se implementará en Hito 6
    }

    /**
     * Eliminar empleado.
     */
    public function destroy($id)
    {
        // Se implementará en Hito 6
    }
}