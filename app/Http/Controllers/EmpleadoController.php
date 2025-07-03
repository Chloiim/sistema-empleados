<?php

namespace App\Http\Controllers;

use App\Models\Employees\EmpleadoTiempoCompleto;
use App\Models\Employees\EmpleadoMedioTiempo;
use App\Models\Employees\Contratista;
use App\Services\SistemaGestionEmpleados;
use App\Services\GeneradorReporte;
use App\Services\Reports\ReportePDF;
use App\Services\Reports\ReporteExcel;
use App\Services\Reports\ReporteJSON;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmpleadoController extends Controller
{
    protected $sistema;
    protected $generadorReporte;

    public function __construct(SistemaGestionEmpleados $sistema, GeneradorReporte $generadorReporte)
    {
        $this->sistema = $sistema;
        $this->generadorReporte = $generadorReporte;
    }

    /**
     * Mostrar lista de empleados.
     */
    public function index()
    {
        // Obtener todos los empleados desde la base de datos
        $empleados = $this->sistema->listarTodos();
        return view('empleados.index', compact('empleados'));
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
            'salario_mensual' => 'nullable|numeric|min:0|required_if:tipo,tiempo_completo',
            'tarifa_hora' => 'nullable|numeric|min:0|required_if:tipo,medio_tiempo',
            'horas_trabajadas' => 'nullable|numeric|min:0|required_if:tipo,medio_tiempo',
            'monto_contrato' => 'nullable|numeric|min:0|required_if:tipo,contratista',
        ]);

    
        $empleado = null;
        switch ($request->tipo) {
            case 'tiempo_completo':
                $empleado = new EmpleadoTiempoCompleto(
                    null,
                    $request->nombre,
                    $request->info_contacto,
                    $request->salario_mensual ?? 0.00
                );
                break;
            case 'medio_tiempo':
                $empleado = new EmpleadoMedioTiempo(
                    null,
                    $request->nombre,
                    $request->info_contacto,
                    $request->tarifa_hora ?? 0.00,
                    $request->horas_trabajadas ?? 0.00
                );
                break;
            case 'contratista':
                $empleado = new Contratista(
                    null,
                    $request->nombre,
                    $request->info_contacto,
                    $request->monto_contrato ?? 0.00
                );
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
     * Procesar pago y enviar notificaciones para un empleado.
     */
    public function procesarPago($id)
    {
        $salario = $this->sistema->procesarPago($id);
        if ($salario > 0) {
            return redirect()->route('empleados.index')->with('success', 'Pago procesado y notificaciones enviadas.');
        }
        return redirect()->route('empleados.index')->withErrors(['error' => 'Empleado no encontrado o error al procesar el pago.']);
    }

    /**
     * Generar reporte PDF de un empleado.
     */
    public function reportePDF($id)
    {
        $empleado = $this->sistema->obtenerEmpleado($id);
        if (!$empleado) {
            return redirect()->route('empleados.index')->withErrors(['error' => 'Empleado no encontrado']);
        }
        $this->generadorReporte->setReporteable(new \App\Services\Reports\ReportePDF());
        $datos = [
            'nombre' => $empleado->getNombre(),
            'salario' => $empleado->calcularSalario(),
            'fecha' => now()->format('d/m/Y H:i'),
        ];
        $pdf = $this->generadorReporte->generar($datos);
        return response($pdf)->header('Content-Type', 'application/pdf')->header('Content-Disposition', 'attachment; filename="reporte_' . $empleado->getId() . '.pdf"');
    }

    /**
     * Generar reporte Excel de un empleado.
     */
    public function reporteExcel($id)
    {
        $empleado = $this->sistema->obtenerEmpleado($id);
        if (!$empleado) {
            return redirect()->route('empleados.index')->withErrors(['error' => 'Empleado no encontrado']);
        }
        $this->generadorReporte->setReporteable(new \App\Services\Reports\ReporteExcel());
        $datos = [
            ['Nombre', 'Salario', 'Fecha'],
            [$empleado->getNombre(), $empleado->calcularSalario(), now()->format('d/m/Y H:i')],
        ];
        return $this->generadorReporte->generar($datos);
    }

    /**
     * Generar reporte JSON de un empleado.
     */
    public function reporteJSON($id)
    {
        $empleado = $this->sistema->obtenerEmpleado($id);
        if (!$empleado) {
            return redirect()->route('empleados.index')->withErrors(['error' => 'Empleado no encontrado']);
        }
        $this->generadorReporte->setReporteable(new \App\Services\Reports\ReporteJSON());
        $datos = [
            'nombre' => $empleado->getNombre(),
            'salario' => $empleado->calcularSalario(),
            'fecha' => now()->format('d/m/Y H:i'),
        ];
        $json = $this->generadorReporte->generar($datos);
        return response($json)->header('Content-Type', 'application/json')->header('Content-Disposition', 'attachment; filename="reporte_' . $empleado->getId() . '.json"');
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