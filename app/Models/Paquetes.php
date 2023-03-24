<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquetes extends Model
{
    use HasFactory;
    protected $table = 'paquetes_servicios';
    public $timestamps = false;

    protected $fillable = [
        'id_client',
        'num_paquete',
        'descuento_5',
        'fecha_inicial',
        'fecha1',
        'notas1',
        'id_user1',
        'talla1_a',
        'talla1_d',
        'abdomen1_a',
        'abdomen1_d',
        'cintura1_a',
        'cintura1_d',
        'cadera1_a',
        'cadera1_d',
        'gluteo1_a',
        'gluteo1_d',
        'firma1',
        'fecha2',
        'notas2',
        'id_user2',
        'talla2_a',
        'talla2_d',
        'abdomen2_a',
        'abdomen2_d',
        'cintura2_a',
        'cintura2_d',
        'cadera2_a',
        'cadera2_d',
        'gluteo2_a',
        'gluteo2_d',
        'firma2',
        'fecha3',
        'notas3',
        'id_user3',
        'talla3_a',
        'talla3_d',
        'abdomen3_a',
        'abdomen3_d',
        'cintura3_a',
        'cintura3_d',
        'cadera3_a',
        'cadera3_d',
        'gluteo3_a',
        'gluteo3_d',
        'firma3',
        'fecha4',
        'notas4',
        'id_user4',
        'talla4_a',
        'talla4_d',
        'abdomen4_a',
        'abdomen4_d',
        'cintura4_a',
        'cintura4_d',
        'cadera4_a',
        'cadera4_d',
        'gluteo4_a',
        'gluteo4_d',
        'firma4',
    ];

    public function Client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
    public function Servicios()
    {
        return $this->belongsTo(Servicios::class, 'id_servicio');
    }
    public function User1()
    {
        return $this->belongsTo(User::class, 'id_user1');
    }
    public function User2()
    {
        return $this->belongsTo(User::class, 'id_user2');
    }
    public function User3()
    {
        return $this->belongsTo(User::class, 'id_user3');
    }
    public function User4()
    {
        return $this->belongsTo(User::class, 'id_user4');
    }
}
