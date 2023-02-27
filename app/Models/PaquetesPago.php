<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaquetesPago extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'paquetes_pago';

    protected $fillable = [
        'id_paquete',
        'fecha',
        'id_user',
        'pago',
        'forma_pago',
        'nota',
        'foto',
    ];

    public function Paquetes()
    {
        return $this->belongsTo(Paquetes::class, 'id_paquete');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
