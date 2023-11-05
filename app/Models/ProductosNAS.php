<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosNAS extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'productos_nas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_rebajado',
        'precio_normal',
        'imagenes',
    ];
}
