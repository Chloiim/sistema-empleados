<?php

@component('mail::message')
# Notificación de Pago

Hola **{{ $empleado->getNombre() }}**,

Tu salario de **S/{{ number_format($salario, 2) }}** ha sido procesado exitosamente el {{ now()->format('d/m/Y H:i') }}.

Gracias por tu trabajo en el sistema.

@component('mail::button', ['url' => url('/empleados/' . $empleado->getId())])
Ver Detalles
@endcomponent

Saludos,  
**Sistema de Gestión de Empleados**
@endcomponent