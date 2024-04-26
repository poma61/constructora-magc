<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasPermiso extends Model
{
    use HasFactory;
    protected $table ="users_has_permisos";
    protected $fillable = [
        'id_user',
        'id_permiso',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'status',
    ];
}
