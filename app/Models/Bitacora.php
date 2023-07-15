<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bitacora extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos (opcional si el nombre es el mismo que el plural del modelo)
    protected $table = 'bitacora';


    protected $fillable = [
        'usuario_id',
        'accion',
        'tabla_afectada',
        'fecha_registro',
    ];
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
