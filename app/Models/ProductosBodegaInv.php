<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosBodegaInv extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'productos_bodega_inv';

    protected $fillable = [
        'id_productos_bodega',
        'id_producto',
        'comentario',
        'cantidad',
        'fecha',
    ];

    public function ProductosBodega()
    {
        return $this->belongsTo(ProductosBodega::class, 'id_productos_bodega');
    }

    public function Productos()
    {
        return $this->belongsTo(Productos::class, 'id_producto');
    }
}
