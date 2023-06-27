<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosInventario extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'productos_inventario';

    protected $fillable = [
        'id_cabina_inv',
        'id_producto',
        'estatus',
        'cantidad',
    ];
}
