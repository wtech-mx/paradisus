<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroSueldoSemanal extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'registro_sueldo_semanal';
    protected $fillable = [
        'id_cosme',
        'monto',
        'fecha',
        'puntualidad',
        'paquetes',
        'despedida',
    ];

    public function cosmetologo()
    {
        return $this->belongsTo(User::class);
    }
}
