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
        'descuento',
        'descuento_5',
        'id_servicio2',
        'num2',
        'descuento2',
        'descuento2_5',
        'id_servicio3',
        'num3',
        'descuento3',
        'descuento3_5',
        'id_servicio4',
        'num4',
        'descuento4',
        'descuento4_5',
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
