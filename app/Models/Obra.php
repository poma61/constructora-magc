<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    use HasFactory;


    protected $fillable = [
        'id_contrato',
        'estado',
        'fecha_inicio',
        'fecha_finalizacion',
        'monto_pago_contratista',
        'descripcion',
        'status',
    ];

    protected $hidden = [
        'updated_at',
        'status',
    ];
}
