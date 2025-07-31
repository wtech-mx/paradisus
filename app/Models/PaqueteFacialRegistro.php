<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaqueteFacialRegistro extends Model
{
    use HasFactory;
    protected $table = 'paquete_facial_registro';
    public $timestamps = true;
    protected $fillable = [
        'id_nota',
        'sesiones_restantes',
        'fecha',
        'id_cosme',
        'observaciones',
        'productos_usados',
        'masaje',
        'facial',
        'talla_antes',
        'talla_despues',
        'abdomen_antes',
        'abdomen_despues',
        'cintura_antes',
        'cintura_despues',
        'cadera_antes',
        'cadera_despues',
        'gluteos_antes',
        'gluteos_despues',
        'celulitis_antes',
        'celulitis_despues',
        'textura_antes',
        'textura_despues',
        'firma',
    ];
    public function Nota(){
        return $this->belongsTo(PaqueteFacialNota::class, 'id_nota');
    }
    public function User(){
        return $this->belongsTo(User::class, 'id_cosme');
    }
}
