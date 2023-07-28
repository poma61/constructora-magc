<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
    protected $table = "ciudades";
    protected $fillable = [
        'city_name',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
