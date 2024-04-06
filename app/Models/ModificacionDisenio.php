<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModificacionDisenio extends Model
{
    use HasFactory;

    protected $table = "modificaciones";

    protected $fillable = [
        'fecha',
        'observacion',
        'id_disenio',
        'status',
    ];

    protected $hidden = [
        'updated_at',
        'status',
    ];
}
