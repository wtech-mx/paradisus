<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colores extends Model
{
	use HasFactory;

    public $timestamps = false;

    protected $table = 'colores';

    protected $fillable = ['servicio','color','imagen'];

}
