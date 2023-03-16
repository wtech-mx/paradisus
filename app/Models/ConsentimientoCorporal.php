<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsentimientoCorporal extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'concentimiento_corporal';

    protected $fillable = [
        'id_client',
        'pregunta1',
        'pregunta2',
        'pregunta3',
        'pregunta4',
        'pregunta5',
        'pregunta6',
        'pregunta7',
        'pregunta8',
        'pregunta9',
        'pregunta10',
        'pregunta11',
        'pregunta12',
        'fecha',
    ];

    public function Client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
}
