<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoModel extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'tipo', 'info_contacto', 'datos_adicionales'];

    protected $casts = [
        'datos_adicionales' => 'array',
    ];
}