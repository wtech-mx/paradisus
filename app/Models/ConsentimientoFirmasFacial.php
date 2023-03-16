<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsentimientoFirmasFacial extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'concentimiento_firmas_facial';

    protected $fillable = [
        'id_consentimiento',
        'firma',
    ];
}
