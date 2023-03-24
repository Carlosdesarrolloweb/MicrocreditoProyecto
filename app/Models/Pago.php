<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_prestamo',
        'id_usuario',
        'monto',
        'fecha_pago'
    ];

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class, 'id_prestamo');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
