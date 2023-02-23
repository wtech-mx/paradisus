<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;
    protected $table = 'reporte';
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'tipo',
        'id_nota',
        'id_producto',
        'id_paquete',
        'id_client',
        'monto',
        'restante',
        'metodo_pago',
    ];

    public function Notas()
    {
        return $this->belongsTo(Notas::class, 'id_nota');
    }
    public function NotasPedidos()
    {
        return $this->belongsTo(NotasPedidos::class, 'id_producto');
    }
    public function NotasPaquete()
    {
        return $this->belongsTo(NotasPaquetes::class, 'id_paquete');
    }

    // ========================================================Filtros====================================================================

    public function scopeTipo($query, $tipo) {
    	if ($tipo) {
    		return $query->where('tipo','like',"%$tipo%");
    	}
    }

    public function scopePago($query, $metodo_pago) {
    	if ($metodo_pago) {
    		return $query->where('metodo_pago','like',"%$metodo_pago%");
    	}
    }
}
