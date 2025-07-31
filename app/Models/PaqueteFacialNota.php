<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaqueteFacialNota extends Model
{
    use HasFactory;
    protected $table = 'paquete_facial_nota';
    public $timestamps = true;
        protected $fillable = [
        'fecha',
        'id_user',
        'id_client',
        'id_cosme_comision',
        'id_servicio',
        'monto',
        'restante',
    ];
    public function User(){
        return $this->belongsTo(User::class, 'id_user');
    }
    public function Client(){
        return $this->belongsTo(Client::class, 'id_client');
    }
    public function Cosme(){
        return $this->belongsTo(User::class, 'id_cosme_comision');
    }
    public function Servicio(){
        return $this->belongsTo(Servicios::class, 'id_servicio');
    }
}
