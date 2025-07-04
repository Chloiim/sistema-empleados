<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Empleado</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Crear Empleado</h1>
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

        <form action="{{ route('empleados.store') }}" method="POST" id="empleadoForm">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Empleado</label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value="tiempo_completo" {{ old('tipo') == 'tiempo_completo' ? 'selected' : '' }}>Tiempo Completo</option>
                    <option value="medio_tiempo" {{ old('tipo') == 'medio_tiempo' ? 'selected' : '' }}>Medio Tiempo</option>
                    <option value="contratista" {{ old('tipo') == 'contratista' ? 'selected' : '' }}>Contratista</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="info_contacto" class="form-label">Contacto</label>
                <input type="text" name="info_contacto" id="info_contacto" class="form-control" value="{{ old('info_contacto') }}" required>
            </div>
            <div id="campos_adicionales" class="mb-3">
                @if (old('tipo') == 'tiempo_completo' || !old('tipo'))
                    <label for="salario_mensual" class="form-label">Salario Mensual (PEN)</label>
                    <input type="number" step="0.01" name="salario_mensual" id="salario_mensual" class="form-control" value="{{ old('salario_mensual', 0) }}" required>
                @elseif (old('tipo') == 'medio_tiempo')
                    <label for="tarifa_hora" class="form-label">Tarifa por Hora (PEN)</label>
                    <input type="number" step="0.01" name="tarifa_hora" id="tarifa_hora" class="form-control" value="{{ old('tarifa_hora', 0) }}" required>
                    <label for="horas_trabajadas" class="form-label">Horas Trabajadas</label>
                    <input type="number" step="0.01" name="horas_trabajadas" id="horas_trabajadas" class="form-control" value="{{ old('horas_trabajadas', 0) }}" required>
                @elseif (old('tipo') == 'contratista')
                    <label for="monto_contrato" class="form-label">Monto del Contrato (PEN)</label>
                    <input type="number" step="0.01" name="monto_contrato" id="monto_contrato" class="form-control" value="{{ old('monto_contrato', 0) }}" required>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>

        <script>
            document.getElementById('tipo').addEventListener('change', function() {
                const tipo = this.value;
                const campos = document.getElementById('campos_adicionales');
                campos.innerHTML = ''; // Limpiar campos anteriores

                if (tipo === 'tiempo_completo') {
                    campos.innerHTML = `
                        <label for="salario_mensual" class="form-label">Salario Mensual (PEN)</label>
                        <input type="number" step="0.01" name="salario_mensual" id="salario_mensual" class="form-control" value="0" required>
                    `;
                } else if (tipo === 'medio_tiempo') {
                    campos.innerHTML = `
                        <label for="tarifa_hora" class="form-label">Tarifa por Hora (PEN)</label>
                        <input type="number" step="0.01" name="tarifa_hora" id="tarifa_hora" class="form-control" value="0" required>
                        <label for="horas_trabajadas" class="form-label">Horas Trabajadas</label>
                        <input type="number" step="0.01" name="horas_trabajadas" id="horas_trabajadas" class="form-control" value="0" required>
                    `;
                } else if (tipo === 'contratista') {
                    campos.innerHTML = `
                        <label for="monto_contrato" class="form-label">Monto del Contrato (PEN)</label>
                        <input type="number" step="0.01" name="monto_contrato" id="monto_contrato" class="form-control" value="0" required>
                    `;
                }
            });
        </script>
    </div>
</body>
</html>