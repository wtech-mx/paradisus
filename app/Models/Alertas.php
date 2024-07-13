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
        'id_nota',
        'titulo',
        'descripcion',
        'img',
        'color',
        'start',
        'end',
        'status',
        'id_servicio',
    ];

    public function scopeTitulo($query, $titulo)
    {
        if ($titulo)
            return $query->where('titulo', 'LIKE', "%$titulo%");
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'id_especialist');
    }

    public function Client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function Status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function Servicios()
    {
        return $this->belongsTo(Servicios::class, 'id_color');
    }

    public function Servicios_id()
    {
        return $this->belongsTo(Servicios::class, 'id_servicio');
    }

    public function cosmes()
    {
        return $this->hasMany(AlertasCosmes::class, 'id_alerta');
    }
}
