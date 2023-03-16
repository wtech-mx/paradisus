<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsentimientoFirmasCorporal extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'concentimiento_firmas_corporal';

    protected $fillable = [
        'id_consentimiento',
        'firma',
    ];
}
