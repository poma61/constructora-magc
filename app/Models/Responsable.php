<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_personal',
        'id_cliente'
    ];

    protected $hidden = [
        'updated_at',
    ];
}
