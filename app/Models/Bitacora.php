<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacora';

    protected $fillable = [
        'id_nota',
        'id_pago',
        'usuario',
        'tipo',
        'fecha',
        'antes',
        'despues',
    ];

    // Definir relaciones si es necesario
    public function nota()
    {
        return $this->belongsTo(Nota::class, 'id_nota');
    }

    public function pago()
    {
        return $this->belongsTo(Pago::class, 'id_pago');
    }
}
