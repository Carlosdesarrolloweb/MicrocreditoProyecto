<?php

namespace App\Models;
use App\Models\Prestamo;

use Illuminate\Database\Eloquent\Model;

class GananciaDia extends Model
{
    protected $table = 'ganancia_dia';
    public $timestamps = false;
    protected $fillable = [
        'fecha',
        'monto',
        'efectivo'
    ];

    public function prestamo()
{
    return $this->hasOne(Prestamo::class, 'fecha_prestamo', 'fecha');
}
}
