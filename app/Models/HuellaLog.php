<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HuellaLog extends Model
{
    use HasFactory;
    protected $table = 'huellas_log';
    public $timestamps = false;
    protected $fillable = ['huella_id', 'fidelidad', 'fecha_hora'];
}
