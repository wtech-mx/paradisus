<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinaFoto extends Model
{
    use HasFactory;
    protected $table = 'cabina_foto';

    protected $fillable = [
        'id_cabina',
        'id_inv',
        'foto',
    ];
}
