<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Editar Empleado</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('empleados.update', $empleado->getId()) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $empleado->getNombre()) }}" required>
            </div>
            <div class="mb-3">
                <label for="info_contacto" class="form-label">Contacto</label>
                <input type="text" name="info_contacto" id="info_contacto" class="form-control" value="{{ old('info_contacto', $empleado->getInfoContacto()) }}" required>
            </div>
            @if (class_basename($empleado) === 'EmpleadoTiempoCompleto')
                <div class="mb-3">
                    <label for="salario_mensual" class="form-label">Salario Mensual (PEN)</label>
                    <input type="number" step="0.01" name="salario_mensual" id="salario_mensual" class="form-control" value="{{ old('salario_mensual', $empleado->calcularSalario()) }}" required>
                </div>
            @elseif (class_basename($empleado) === 'EmpleadoMedioTiempo')
                <div class="mb-3">
                    <label for="tarifa_hora" class="form-label">Tarifa por Hora (PEN)</label>
                    <input type="number" step="0.01" name="tarifa_hora" id="tarifa_hora" class="form-control" value="{{ old('tarifa_hora', $empleado->getDatosAdicionales()['tarifa_hora'] ?? 0.0) }}" required>
                </div>
                <div class="mb-3">
                    <label for="horas_trabajadas" class="form-label">Horas Trabajadas</label>
                    <input type="number" step="0.01" name="horas_trabajadas" id="horas_trabajadas" class="form-control" value="{{ old('horas_trabajadas', $empleado->getDatosAdicionales()['horas_trabajadas'] ?? 0.0) }}" required>
                </div>
            @elseif (class_basename($empleado) === 'Contratista')
                <div class="mb-3">
                    <label for="monto_contrato" class="form-label">Monto del Contrato (PEN)</label>
                    <input type="number" step="0.01" name="monto_contrato" id="monto_contrato" class="form-control" value="{{ old('monto_contrato', $empleado->calcularSalario()) }}" required>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>