<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disenio extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_cliente",
        "requerimiento",
        "fecha",
        "arquitecto",
        "status",
    ];

    protected $hidden = [
        'status',
        'updated_at',
    ];
}//class
