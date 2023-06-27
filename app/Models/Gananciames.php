<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gananciames extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'monto',
        'fecha',
        'id_cliente',
        'id_prestamo',
        'id_usuario',

    ];



}
