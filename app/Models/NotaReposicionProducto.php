<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaReposicionProducto extends Model
{
    use HasFactory;
    protected $table = 'notas_reposiocion_producto';

    protected $fillable = [
        'id_nota',
        'cantidad',
        'concepto',
        'importe',
    ];

    public function NotaReposicion()
    {
        return $this->belongsTo(NotaReposicion::class, 'id_nota');
    }
}
