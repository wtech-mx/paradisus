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
}
