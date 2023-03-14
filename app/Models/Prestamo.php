<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $table = 'prestamo';
    public $timestamps = false;

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
        'id_modo_pago'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function interes()
    {
        return $this->belongsTo(Interes::class, 'id_interes');
    }

    public function modoPago()
    {
        return $this->belongsTo(ModoPago::class, 'id_modo_pago');
    }
}
