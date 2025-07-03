<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Empleado</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; }
        .details { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sistema de Gestión de Empleados - Perú</h1>
        <h3>Reporte de Pago</h3>
        <p>Fecha: {{ $fecha }}</p>
    </div>
    <div class="details">
        <p><strong>Nombre:</strong> {{ $nombre }}</p>
        <p><strong>Salario (PEN):</strong> S/{{ number_format($salario, 2) }}</p>
    </div>
</body>
</html>