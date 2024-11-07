<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaserKit extends Model
{
    use HasFactory;
    protected $table = 'laser_kit';

    protected $fillable = [
        'nombre',
        'fecha_caducidad',
        'precio',
        'num_sesiones',
    ];
}
