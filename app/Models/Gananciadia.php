<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GananciaDia extends Model
{
    protected $table = 'ganancia_dia';
    public $timestamps = false;
    protected $fillable = [
        'fecha',
        'monto'
    ];
}
