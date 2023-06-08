<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alertas extends Model
{
    use HasFactory;

    protected $table = "alertas";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id_client',
        'titulo',
        'descripcion',
        'img',
        'color',
        'start',
        'end',
        'status',
    ];

    public function scopeTitulo($query, $titulo)
    {
        if ($titulo)
            return $query->where('titulo', 'LIKE', "%$titulo%");
    }

    public function Client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function Status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function Colores()
    {
        return $this->belongsTo(Colores::class, 'id_color');
    }
}
