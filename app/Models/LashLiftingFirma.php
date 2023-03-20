<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LashLiftingFirma extends Model
{
    use HasFactory;
    protected $table = 'lash_lifting_firma';
    public $timestamps = false;

    protected $fillable = [
        'id_consentimiento',
        'firma',
    ];
}
