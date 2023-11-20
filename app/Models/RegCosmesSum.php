<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegCosmesSum extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'reg_cosmes_sum';
    protected $fillable = [
        'id_cosme',
        'concepto',
        'comprobante',
        'tipo',
        'fecha',
    ];
}
