<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZonasLaser extends Model
{
    use HasFactory;

    protected $table = 'zonas_laser';

    protected $fillable = [
        'id_nota',
        'id_zona',
        'num',
        'zona_sesiones_1',
        'zona_sesiones_2',
        'zona_sesiones_3',
        'zona_sesiones_4',
        'cantidad_1',
        'cantidad_2',
        'cantidad_3',
        'cantidad_4',
        'sesiones_compradas',
        'sesiones_restantes',
        'subtotal',
    ];

    public function NotasLacer()
    {
        return $this->belongsTo(NotasLacer::class, 'id_nota');
    }

}
