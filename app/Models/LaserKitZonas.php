<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaserKitZonas extends Model
{
    use HasFactory;
    protected $table = 'laser_kit_zonas';

    protected $fillable = [
        'id_laser_kit',
        'id_laser_zona',
    ];
    public function LaserKit(){
        return $this->belongsTo(LaserKit::class, 'id_laser_kit');
    }
    public function Laser(){
        return $this->belongsTo(Laser::class, 'id_laser_zona');
    }
}
