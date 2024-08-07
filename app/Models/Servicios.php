<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'servicios';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'duracion',
        'categoria',
        'act_descuento',
        'descuento',
        'num_sesiones',
        'color',
        'num_sesiones2',
        'duracion2',
        'imagen',
    ];
}
