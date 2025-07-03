<?php


use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('empleados', EmpleadoController::class);
Route::get('/empleados/{id}/reporte-pdf', [EmpleadoController::class, 'reportePDF'])->name('empleados.reporte.pdf');
Route::get('/empleados/{id}/reporte-excel', [EmpleadoController::class, 'reporteExcel'])->name('empleados.reporte.excel');
Route::get('/empleados/{id}/reporte-json', [EmpleadoController::class, 'reporteJSON'])->name('empleados.reporte.json');
Route::post('/empleados/{id}/procesar-pago', [EmpleadoController::class, 'procesarPago'])->name('empleados.procesar.pago');