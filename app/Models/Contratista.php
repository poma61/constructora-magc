<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratista extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombres",
        'apellido_paterno',
        'apellido_materno',
        'id_contrato',
        'estado',
        'monto',
        'descripcion',
        'fecha_inicio',
        'status',
    ];

    protected $hidden = [
        'status',
        'updated_at',
    ];
}
