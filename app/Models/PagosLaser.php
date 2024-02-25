<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagosLaser extends Model
{
    use HasFactory;

    protected $table = 'pagos_laser';

    protected $fillable = [
        'id_nota',
        'id_user',
        'fecha',
        'pago',
        'cambio',
        'forma_pago',
        'foto',
        'nota',
    ];

    public function NotasLacer()
    {
        return $this->belongsTo(NotasLacer::class, 'id_nota');
    }
}
