<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaqueteFacialPago extends Model
{
    use HasFactory;
    protected $table = 'paquete_facial_pago';
    public $timestamps = true;
    protected $fillable = [
        'id_nota',
        'fecha',
        'pago',
        'cambio',
        'monto',
        'restante',
        'id_user',
    ];
    public function Nota(){
        return $this->belongsTo(PaqueteFacialNota::class, 'id_nota');
    }
    public function User(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
