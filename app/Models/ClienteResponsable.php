<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteResponsable extends Model
{
    use HasFactory;
    protected $table = 'clientes_responsables';

    protected $fillable = [
        'id_responsable',
        'id_cliente',
    ];

    protected $hidden = [
        'updated_at',

    ];
}
