<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Encuestas extends Model
{
    use HasFactory;
    protected $table = 'encuestas';

    protected $fillable = [
        'id_user',
        'id_nota',
        'fecha',
        'tipo',
        'p1',
        'p2',
        'p3',
        'p4',
        'p5',
        'p6',
        'p7',
        'p8',
        'p9',
        'p10',
        'p11',
        'p12',
        'p13',
        'p14',
        'p15',
        'p16',
        'p17',
        'comentario',
        'nombre',
        'telefono',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function Notas()
    {
        return $this->belongsTo(Notas::class, 'id_nota');
    }

    public function scopeNegativas(Builder $query): Builder
    {
        $malas = ['mala', 'muy mala'];
        $keywords = ['mal','malo','peor','falta','horrible', 'terrible', 'desagradable',
        'descontento', 'descontenta', 'descontentos', 'descontentas', 'insatisfecho',
        'insatisfecha', 'insatisfechos', 'insatisfechas', 'ruido', 'ruidoso', 'pero'];

        return $query
            // las preguntas con opción mala/muy mala
            ->whereIn('p1', $malas)
            ->orWhereIn('p2', $malas)
            ->orWhereIn('p3', $malas)
            ->orWhereIn('p7', $malas)
            ->orWhereIn('p8', $malas)
            ->orWhereIn('p9', $malas)

            // la pregunta de tiempo de sesión: “no” es negativo
            ->orWhere('p4', 'no')
            ->orWhere('p14', 'no')

            // o bien el comentario contiene alguna palabra de disgusto
            ->orWhere(function($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('comentario', 'like', "%{$word}%");
                }
            });
    }
}
