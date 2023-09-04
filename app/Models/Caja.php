<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;
    protected $table = 'caja';

    protected $fillable = [
        'fecha',
        'ingresos',
        'egresos',
        'total',
        'inicio',
    ];
}
