<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroSemanal extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'registros_semanales';
    protected $fillable = [
        'cosmetologo_id',
        'puntualidad',
        'dias_trabajados',
        'cosmetologo_cubriendo',
        'fecha',
        'hora_inicio',
    ];

    public function cosmetologo()
    {
        return $this->belongsTo(User::class);
    }

    public function cosmetologoCubriendo()
    {
        return $this->belongsTo(User::class, 'cosmetologo_cubriendo');
    }
}
