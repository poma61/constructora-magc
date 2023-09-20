<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisionDisenio extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'revisiones';

    protected $fillable = [
        "fecha_rev_plano",
        "fecha_rev_3D",
        "status",
        "id_disenio",
    ];

    protected $hidden = [
        'status',
        'updated_at',
    ];
}
