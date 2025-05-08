<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsentimientoLaser extends Model
{
    use HasFactory;
    protected $table = 'consentimiento_laser';

    protected $fillable = [
        'id_cliente',
        'edad',
        'domicilio',
        'firma',
        'firma_aviso',
    ];

    public function Client()
    {
        return $this->belongsTo(Client::class, 'id_cliente');
    }
}
