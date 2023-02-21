<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete3 extends Model
{
    use HasFactory;
    protected $table = 'paquetes_servicios3';
    public $timestamps = false;

    protected $fillable = [
        'id_paquete',
        'fecha9',
        'notas9',
        'id_user9',
        'talla9_a',
        'talla9_d',
        'abdomen9_a',
        'abdomen9_d',
        'cintura9_a',
        'cintura9_d',
        'cadera9_a',
        'cadera9_d',
        'gluteo9_a',
        'gluteo9_d',
        'firma9',
        'fecha10',
        'notas10',
        'id_user10',
        'talla10_a',
        'talla10_d',
        'abdomen10_a',
        'abdomen10_d',
        'cintura10_a',
        'cintura10_d',
        'cadera10_a',
        'cadera10_d',
        'gluteo10_a',
        'gluteo10_d',
        'firma10',
    ];
}
