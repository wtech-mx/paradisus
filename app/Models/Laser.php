<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laser extends Model
{
    use HasFactory;
    protected $table = 'laser';

    protected $fillable = [
        'zona',
        'tipo_zona',
        'precio_sesion',
        'precio_paquete',
    ];
}
