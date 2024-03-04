<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionLaser extends Model
{
    use HasFactory;
    protected $table = 'configuracion_laser';

    protected $fillable = [
        'id_cliente',
        'area',
        'skyn_type',
        'hair_type',
        'hair_density',
        'hair_tickness',
    ];
    public function Client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
}
