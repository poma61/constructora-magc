<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_cliente',
        'n_contrato',
        'fecha_firma_contrato',
        'monto_total_construccion',
        'couta_inicial',
        'couta_mensual',
        'fecha_pago_couta_mensual',
        'descripcion',
        'archivo_pdf',
        'status',
    ];

    protected $hidden=[
        'updated_at',
        'status',
    ];
}
