<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    use HasFactory;

    protected $table = 'notas';

    protected $fillable = [
        'id_user',
        'id_client',
        'id_servicio',
        'fecha',
        'nota',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function Client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
    public function Servicios()
    {
        return $this->belongsTo(Servicios::class, 'id_servicio');
    }
}
