<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasPedidos extends Model
{
    use HasFactory;

    protected $table = 'notas_pedidos';

    protected $fillable = [
        'id_user',
        'id_client',
        'metodo_pago',
        'fecha',
        'total',
        'foto',
        'estatus',
        'preparado_hora_y_guia',
        'enviado_hora_y_guia',
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

    // En el modelo NotasPedidos
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_nota', 'id');
    }


}
