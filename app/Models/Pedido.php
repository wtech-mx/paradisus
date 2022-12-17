<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'pedido';

    protected $fillable = [
        'id_nota',
        'cantidad',
        'concepto',
        'importe',
    ];

    public function NotasPedidos()
    {
        return $this->belongsTo(NotasPedidos::class, 'id_nota');
    }
}
