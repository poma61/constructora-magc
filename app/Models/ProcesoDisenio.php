<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcesoDisenio extends Model
{
    use HasFactory;

    protected $table = 'procesos';

    protected $fillable = [
        "id_disenio",
        "planos",
        "elevaciones",
        "instalaciones",
        "p3D",
    ];

    protected $hidden = [
        'updated_at',
    ];
}
