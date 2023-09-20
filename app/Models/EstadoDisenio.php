<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoDisenio extends Model
{
    use HasFactory;

    protected $table = 'estados';

    protected $fillable = [
        "fecha_aprobacion",
        "fecha_entrega",
        "codigo",
        "id_disenio",
    ];

    protected $hidden = [
        'updated_at',
    ];
}
