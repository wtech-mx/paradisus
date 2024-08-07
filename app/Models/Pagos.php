<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'pagos';

    protected $fillable = [
        'id_nota',
        'fecha',
        'cosmetologa',
        'pago',
        'forma_pago',
        'nota',
        'foto',
    ];

    public function Notas()
    {
        return $this->belongsTo(Notas::class, 'id_nota');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'cosmetologa');
    }
}
