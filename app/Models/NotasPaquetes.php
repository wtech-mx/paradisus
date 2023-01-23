<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasPaquetes extends Model
{
    use HasFactory;
    protected $table = 'notas_paquetes';

    protected $fillable = [
        'id_user',
        'id_servicio',
    ];

    public function Notas()
    {
        return $this->belongsTo(Notas::class, 'id_nota');
    }
    public function Servicios()
    {
        return $this->belongsTo(Servicios::class, 'id_servicio');
    }
}
