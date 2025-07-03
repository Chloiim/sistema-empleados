<?php

namespace Tests\Feature;

use App\Models\Employees\EmpleadoTiempoCompleto;
use App\Models\Employees\EmpleadoMedioTiempo;
use App\Models\Employees\Contratista;
use App\Services\SistemaGestionEmpleados;
use App\Repositories\RepositorioEmpleado;
use App\Services\CalculadorSalario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpleadoTest extends TestCase
{
    use RefreshDatabase;

    protected $sistema;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sistema = new SistemaGestionEmpleados(new RepositorioEmpleado(), new CalculadorSalario());
    }

    /**
     * Verificar que la página de lista de empleados carga correctamente.
     */
    public function test_pagina_lista_empleados_carga_correctamente()
    {
        $response = $this->get('/empleados');
        $response->assertStatus(200);
    }

    /**
     * Verificar que se puede agregar un empleado de tiempo completo.
     */
    public function test_agregar_empleado_tiempo_completo()
    {
        $response = $this->post('/empleados', [
            'nombre' => 'Juan Pérez',
            'tipo' => 'tiempo_completo',
            'info_contacto' => 'juan@example.com',
            'salario_mensual' => 3000.00,
        ]);

        $response->assertRedirect('/empleados');
        $this->assertDatabaseHas('empleados', [
            'nombre' => 'Juan Pérez',
            'tipo' => 'EmpleadoTiempoCompleto',
            'info_contacto' => 'juan@example.com',
        ]);
    }

    /**
     * Verificar cálculo de salario para empleado de tiempo completo.
     */
    public function test_calculo_salario_tiempo_completo()
    {
        $empleado = new EmpleadoTiempoCompleto('1', 'Juan Pérez', 'juan@example.com', 3000.00);
        $this->sistema->agregarEmpleado($empleado);
        $salario = $this->sistema->procesarPago('1');
        $this->assertEquals(3000.00, $salario);
    }

    /**
     * Verificar cálculo de salario para empleado de medio tiempo.
     */
    public function test_calculo_salario_medio_tiempo()
    {
        $empleado = new EmpleadoMedioTiempo('2', 'Ana Gómez', 'ana@example.com', 20.00, 80);
        $this->sistema->agregarEmpleado($empleado);
        $salario = $this->sistema->procesarPago('2');
        $this->assertEquals(1600.00, $salario);
    }

    /**
     * Verificar cálculo de salario para contratista.
     */
    public function test_calculo_salario_contratista()
    {
        $empleado = new Contratista('3', 'Carlos López', 'carlos@example.com', 5000.00);
        $this->sistema->agregarEmpleado($empleado);
        $salario = $this->sistema->procesarPago('3');
        $this->assertEquals(5000.00, $salario);
    }
}