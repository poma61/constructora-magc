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
        'ci',
        'ci_expedido',
        'personal_responsable',
        'id_personal_responsable',
        'estado',
        'descripcion',
        'monto_inicial',
        'hora_reunion',
        'fecha_reunion',
        'seguimiento',
        'id_grupo',
        'status',
    ];

    protected $hidden = [
        'updated_at',
        'status',
    ];


    // //este metodo agrega un where a cualquier tipo de consulta
    // protected static function booted()
    // {
    //     // static::addGlobalScope('usuario_actual', function ($query) {
    //     //     $query->where('nombres', "Juan");
    //     // });
    // }

}//class
