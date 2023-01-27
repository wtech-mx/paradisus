<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasPaquetes extends Model
{
    use HasFactory;
    protected $table = 'notas_paquetes';

    protected $fillable = [
        'id_nota',
        'id_servicio',
        'num',
        'id_servicio2',
        'num2',
        'id_servicio3',
        'num3',
        'id_servicio4',
        'num4',
    ];

    public function Notas()
    {
        return $this->belongsTo(Notas::class, 'id_nota');
    }
    public function Servicios()
    {
        return $this->belongsTo(Servicios::class, 'id_servicio');
    }
    public function Servicios2()
    {
        return $this->belongsTo(Servicios::class, 'id_servicio2');
    }
    public function Servicios3()
    {
        return $this->belongsTo(Servicios::class, 'id_servicio3');
    }
    public function Servicios4()
    {
        return $this->belongsTo(Servicios::class, 'id_servicio4');
    }
}
