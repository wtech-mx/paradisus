<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasExtras extends Model
{
    use HasFactory;
    protected $table = 'notas_extras';
    public $timestamps = false;

    protected $fillable = [
        'id_nota',
        'concepto',
        'precio',
    ];

    public function Notas()
    {
        return $this->belongsTo(Notas::class, 'id_nota');
    }
}
