<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Empleado</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Detalles del Empleado</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $empleado->getNombre() }}</h5>
                <p class="card-text"><strong>ID:</strong> {{ $empleado->getId() }}</p>
                <p class="card-text"><strong>Tipo:</strong> {{ class_basename($empleado) }}</p>
                <p class="card-text"><strong>Contacto:</strong> {{ $empleado->getInfoContacto() }}</p>
                <p class="card-text"><strong>Salario:</strong> S/{{ number_format($empleado->calcularSalario(), 2) }}</p>
                <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>