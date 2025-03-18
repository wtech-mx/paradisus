<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaReposicion extends Model
{
    use HasFactory;
    protected $table = 'notas_reposiocion';

    protected $fillable = [
        'id_user',
        'fecha',
        'estatus_reposicion',
        'firma_reposicion',
        'nota_reposicion',
        'preparado_hora_y_guia',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function pedidos()
    {
        return $this->hasMany(NotaReposicionProducto::class, 'id_nota', 'id');
    }
}
