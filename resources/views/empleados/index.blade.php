<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Sistema de Gestión de Empleados</h1>
        <p>Bienvenido al sistema de gestión de empleados (Perú).</p>
        <a href="{{ route('empleados.create') }}" class="btn btn-primary">
            Agregar Empleado
        </a>
    </div>
</body>
</html>