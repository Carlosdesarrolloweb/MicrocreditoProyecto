<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePago extends Model
{
    protected $fillable = ['fecha_pago', 'monto', 'id_prestamo', 'id_pago'];

    public function pago()
    {
        return $this->belongsTo(Pago::class, 'id_pago');
    }

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class, 'id_prestamo');
    }
}
