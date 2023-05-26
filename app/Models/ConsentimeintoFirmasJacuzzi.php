<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsentimeintoFirmasJacuzzi extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'consentimiento_firmas_jacuzzi';

    protected $fillable = [
        'id_consentimiento',
        'firma',
    ];
}
