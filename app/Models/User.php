<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'usuario',
        'password',
        'status',
        'id_personal',
    ];

    protected $hidden = [
        'password',
        'updated_at',
    ];

    //para unir dos tablas en este caso unos a muchos
    // users <= muchos  a uno <= personals
    public function onPersonal()
    {
        return $this->belongsTo(Personal::class, 'id_personal');
    }
}
