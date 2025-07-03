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
        <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">Agregar Empleado</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Contacto</th>
                    <th>Salario (PEN)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->getId() }}</td>
                        <td>{{ $empleado->getNombre() }}</td>
                        <td>{{ class_basename($empleado) }}</td>
                        <td>{{ $empleado->getInfoContacto() }}</td>
                        <td>S/{{ number_format($empleado->calcularSalario(), 2) }}</td>
                        <td>
                            <a href="{{ route('empleados.show', $empleado->getId()) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('empleados.reporte.pdf', $empleado->getId()) }}" class="btn btn-warning btn-sm">PDF</a>
                            <a href="{{ route('empleados.reporte.excel', $empleado->getId()) }}" class="btn btn-success btn-sm">Excel</a>
                            <a href="{{ route('empleados.reporte.json', $empleado->getId()) }}" class="btn btn-secondary btn-sm">JSON</a>
                            <form action="{{ route('empleados.procesar.pago', $empleado->getId()) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-primary btn-sm">Procesar Pago</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay empleados registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>