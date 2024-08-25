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
        'dia_se_semana_faltante',
        'dia_se_semana_sustituye'
    ];

    public function CosmeFaltante()
    {
        return $this->belongsTo(User::class, 'id_cosmetologa_faltante');
    }

    public function CosmeSustituye()
    {
        return $this->belongsTo(User::class, 'id_cosmetologa_sustituye');
    }

}
