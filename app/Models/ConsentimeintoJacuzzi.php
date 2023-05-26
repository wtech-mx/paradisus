<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsentimeintoJacuzzi extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'consentimiento_jacuzzi';

    protected $fillable = [
        'id_client',
        'pregunta1',
        'pregunta2',
        'pregunta3',
        'pregunta4',
        'pregunta5',
        'pregunta6',
        'pregunta7',
        'fecha',
    ];

    public function Client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
}
