<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Empleado</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Agregar Nuevo Empleado</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('empleados.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="info_contacto" class="form-label">Información de Contacto (Email/Teléfono)</label>
                <input type="text" name="info_contacto" id="info_contacto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Empleado</label>
                <select name="tipo" id="tipo" class="form-control" required onchange="toggleFields()">
                    <option value="tiempo_completo">Tiempo Completo</option>
                    <option value="medio_tiempo">Medio Tiempo</option>
                    <option value="contratista">Contratista</option>
                </select>
            </div>
            <div id="tiempo_completo_fields" class="mb-3" style="display: none;">
                <label for="salario_mensual" class="form-label">Salario Mensual (PEN)</label>
                <input type="number" step="0.01" name="salario_mensual" id="salario_mensual" class="form-control">
            </div>
            <div id="medio_tiempo_fields" class="mb-3" style="display: none;">
                <label for="tarifa_hora" class="form-label">Tarifa por Hora (PEN)</label>
                <input type="number" step="0.01" name="tarifa_hora" id="tarifa_hora" class="form-control">
                <label for="horas_trabajadas" class="form-label">Horas Trabajadas</label>
                <input type="number" step="0.01" name="horas_trabajadas" id="horas_trabajadas" class="form-control">
            </div>
            <div id="contratista_fields" class="mb-3" style="display: none;">
                <label for="monto_contrato" class="form-label">Monto del Contrato (PEN)</label>
                <input type="number" step="0.01" name="monto_contrato" id="monto_contrato" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <script>
        function toggleFields() {
            const tipo = document.getElementById('tipo').value;
            document.getElementById('tiempo_completo_fields').style.display = tipo === 'tiempo_completo' ? 'block' : 'none';
            document.getElementById('medio_tiempo_fields').style.display = tipo === 'medio_tiempo' ? 'block' : 'none';
            document.getElementById('contratista_fields').style.display = tipo === 'contratista' ? 'block' : 'none';
        }
        // Ejecutar al cargar la página
        toggleFields();
    </script>
</body>
</html>