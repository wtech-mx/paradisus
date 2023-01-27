<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasPropinas extends Model
{
    use HasFactory;

    protected $table = 'notas_propinas';
    public $timestamps = false;

    protected $fillable = [
        'id_nota',
        'concepto',
        'propina',
    ];

    public function Notas()
    {
        return $this->belongsTo(Notas::class, 'id_nota');
    }
}
