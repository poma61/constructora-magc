<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'ci',
        'ci_expedido',
        'telefono',
        'direccion',
        'cargo',
        'status',
        'id_ciudad',
        'foto',
    ];
    protected $hidden = [
        'updated_at',
        'status',
    ];
}
