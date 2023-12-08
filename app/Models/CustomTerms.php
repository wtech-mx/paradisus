<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomTerms extends Model
{
    use HasFactory;

    protected $table = 'terminos_custom';

    protected $fillable = [
        'id_user',
        'titulo',
        'descripcion',
        'monto',
        'firma',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
