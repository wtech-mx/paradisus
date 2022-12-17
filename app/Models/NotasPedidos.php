<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasPedidos extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'notas_pedidos';

    protected $fillable = [
        'id_user',
        'id_client',
        'metodo_pago',
        'fecha',
        'total',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function Client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
    public function Pedido()
    {
        return $this->hasMany('App\Models\Pedido', 'id_nota', 'id');
    }
}
