<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleContrato extends Model
{
    use HasFactory;
    protected $table='detalles_contratos';
    protected $fillable = [
        'id_contrato',
        'n_lote',
        'n_uv',
        'zona',
        'barrio',
        'calle',
        'superficie_terreno',
        'numero_distrito',
        'numero_identificacion_terreno',
        'norte_medida_terreno',
        'norte_colinda_lote',
        'sur_medida_terreno',
        'sur_colinda_lote',
        'este_medida_terreno',
        'este_colinda_lote',
        'oeste_medida_terreno',
        'oeste_colinda_lote',
        'valor_monto_total_construccion_literal',
        'valor_couta_inicial_literal',
        'valor_couta_mensual_literal',
        'cantidad_couta_mensual',
        'lugar_firma_contrato',
        'status',
    ];

    protected $hidden = [
        'updated_at',
        'status',
    ];
}
