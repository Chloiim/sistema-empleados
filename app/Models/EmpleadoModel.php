<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoModel extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'nombre', 'tipo', 'info_contacto', 'datos_adicionales'];

    protected $casts = [
        'datos_adicionales' => 'array',
    ];
}