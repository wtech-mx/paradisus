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
        'sesiones_compradas',
        'sesiones_restantes',
        'subtotal',
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
