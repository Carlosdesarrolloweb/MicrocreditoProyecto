<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $table = 'prestamo';

    protected $fillable = [
        'monto_prestamo',
        'duracion_prestamo',
        'calculo_cuota',
        'garantia',
        'cantidad_cuotas',
        'monto_cancelado',
        'monto_prestado',
        'id_cliente',
        'id_usuario',
        'id_interes',
        'id_mododepago',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
