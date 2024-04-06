<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'id_personal',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
