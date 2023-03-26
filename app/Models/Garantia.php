<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    use HasFactory;

    protected $fillable = [
        'garantia',
        'Valor_Prenda',
        'Detalle_Prenda',
        'id_cliente',
        'id_prestamo',
        'id_foto',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class, 'id_prestamo');
    }
}