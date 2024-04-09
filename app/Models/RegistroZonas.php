<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroZonas extends Model
{
    use HasFactory;
    protected $table = 'registro_zonas';

    protected $fillable = [
        'id_nota',
        'id_zona',
        'sesion',
        'parametros',
        'nota',
        'fecha',
        'foto1',
        'foto2',
        'firma',
    ];

    public function NotasLacer()
    {
        return $this->belongsTo(NotasLacer::class, 'id_nota');
    }

    public function Zona()
    {
        return $this->belongsTo(Laser::class, 'id_zona');
    }
}
