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
        'id_especialist',
        'color',
        'resourceId',
        'title',
        'start',
        'end',
        'descripcion',
        'estatus',
        'check',
        'image',
        'telefono',
    ];

    public function scopeTitulo($query,$titulo)
    {
        if ($titulo)
            return $query->where('titulo','LIKE',"%$titulo%");
    }

    public function Client()
    {
       return $this->belongsTo(Client::class,'id_client');
    }

    public function Servicios()
    {
       return $this->belongsTo(Colores::class,'color');
    }

}

