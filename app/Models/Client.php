<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'clients';

    protected $fillable = [
    'name',
    'last_name',
    'email',
    'phone',
    'age',
    'occupation',
    'direction',
    'birth_date',
    'sanguineous'
    ];

    public function ConcentimientoFacial()
    {
        return $this->hasOne('App\Models\ConcentimientoFacial', 'id_client', 'id');
    }

    public function ConcentimientoCorporal()
    {
        return $this->hasOne('App\Models\ConsentimientoCorporal', 'id_client', 'id');
    }

    public function LashLifting()
    {
        return $this->hasOne('App\Models\LashLifting', 'id_client', 'id');
    }

    protected $perPage = 20;





}
