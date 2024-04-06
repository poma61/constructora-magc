<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialPagoContratista extends Model
{
    use HasFactory;

    protected $table = "historial_pago_contratista";
    protected $fillable = [
        'monto',
        'id_contratista',
        'fecha_pago',
        'status',
    ];

    protected $hidden = [
        'updated_at',
        'status',
    ];
}
