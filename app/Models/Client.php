<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 *
 * @property $id
 * @property $nombre
 * @property $apellido
 * @property $edad
 * @property $sanguineo
 * @property $ocupacion
 * @property $telefono
 * @property $fecha_nacimiento
 * @property $email
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Client extends Model
{
    static $rules = [
		'name' => 'required',
		'email' => 'required',
        'phone' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','last_name','email','phone','age','occupation','direction','birth_date','sanguineous'];



}
