<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePago extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'detalle_pago';

    protected $fillable = [
        'fecha_pago',
        'monto',
        'id_prestamo',
        'id_pago',
    ];

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class, 'id_prestamo');
    }
}
