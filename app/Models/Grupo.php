<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable=[
        'grup_number',
        'id_user'
    ];

    protected $hidden=[
      'updated_at', 
    ];
}
