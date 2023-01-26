<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasSesion extends Model
{
    use HasFactory;
    protected $table = 'notas_sesion';
    public $timestamps = false;

    protected $fillable = [
        'id_nota',
        'fecha',
        'sesion',
    ];

    public function Notas()
    {
        return $this->belongsTo(Notas::class, 'id_nota');
    }
}
