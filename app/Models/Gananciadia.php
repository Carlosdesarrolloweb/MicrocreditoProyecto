<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gananciadia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'monto',
        'fecha',
        'id_cliente',
        'id_pago',
        'id_usuario',

    ];

}
