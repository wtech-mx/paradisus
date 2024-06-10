<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasCosmes extends Model
{
    use HasFactory;

    protected $table = 'notas_cosmes';
    public $timestamps = false;

    protected $fillable = [
        'id_nota',
        'id_user',
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
