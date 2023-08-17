<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'n_de_contacto',
        'personal_responsable',
        'id_personal_responsable',
        'estado',
        'monto_inicial',
        'descripcion',
        'seguimiento',
        'id_grupo',
        'status',
    ];

    protected $hidden = [
        'updated_at',
        'status',
    ];
}
