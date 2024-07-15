<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertasCosmes extends Model
{
    use HasFactory;
    protected $table = "alertas_cosmes";
    protected $primarykey = "id";

    protected $fillable = [
        'id_alerta',
        'id_user',
    ];

    public function Alertas()
    {
        return $this->belongsTo(Alertas::class, 'id_alerta');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'id_especialist');
    }
}
