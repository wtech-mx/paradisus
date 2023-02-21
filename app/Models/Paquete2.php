<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete2 extends Model
{
    use HasFactory;
    protected $table = 'paquetes_servicios2';
    public $timestamps = false;

    protected $fillable = [
        'id_paquete',
        'fecha5',
        'notas5',
        'id_user5',
        'talla5_a',
        'talla5_d',
        'abdomen5_a',
        'abdomen5_d',
        'cintura5_a',
        'cintura5_d',
        'cadera5_a',
        'cadera5_d',
        'gluteo5_a',
        'gluteo5_d',
        'firma5',
        'fecha6',
        'notas6',
        'id_user6',
        'talla6_a',
        'talla6_d',
        'abdomen6_a',
        'abdomen6_d',
        'cintura6_a',
        'cintura6_d',
        'cadera6_a',
        'cadera6_d',
        'gluteo6_a',
        'gluteo6_d',
        'firma6',
        'fecha7',
        'notas7',
        'id_user7',
        'talla7_a',
        'talla7_d',
        'abdomen7_a',
        'abdomen7_d',
        'cintura7_a',
        'cintura7_d',
        'cadera7_a',
        'cadera7_d',
        'gluteo7_a',
        'gluteo7_d',
        'firma7',
        'fecha8',
        'notas8',
        'id_user8',
        'talla8_a',
        'talla8_d',
        'abdomen8_a',
        'abdomen8_d',
        'cintura8_a',
        'cintura8_d',
        'cadera8_a',
        'cadera8_d',
        'gluteo8_a',
        'gluteo8_d',
        'firma8',
    ];
}
