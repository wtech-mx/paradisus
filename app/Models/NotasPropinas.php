<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasPropinas extends Model
{
    use HasFactory;

    protected $table = 'notas_propinas';

    protected $fillable = [
        'id_nota',
        'id_user',
        'propina',
        'metdodo_pago',
    ];

    public function Notas()
    {
        return $this->belongsTo(Notas::class, 'id_nota');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
