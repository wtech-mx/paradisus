<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasLacer extends Model
{
    use HasFactory;
    protected $table = 'nota_laser';

    protected $fillable = [
        'id_user',
        'id_client',
        'total',
        'servicio',
        'restante',
        'sesion',
        'tipo',
        'fecha',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function Client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
}
