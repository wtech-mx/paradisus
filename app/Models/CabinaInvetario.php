<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinaInvetario extends Model
{
    use HasFactory;

    protected $table = 'cabina_inventario';

    protected $fillable = [
        'num_cabina',
        'num_semana',
        'fecha',
    ];

}
