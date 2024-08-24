<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiracoraHorariosAlertas extends Model
{
    use HasFactory;
    protected $table = 'bitacora_horarios_alertas';

    protected $fillable = [
        'id_horario',
        'id_cosmetologa_faltante',
        'id_cosmetologa_sustituye',
        'comentario',
        'estatus',
        'fecha_inicio',
        'fecha_fin',
    ];
}
