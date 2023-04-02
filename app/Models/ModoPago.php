<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModoPago extends Model
{
    use HasFactory;

    protected $table = 'modo_pago';


    protected $fillable = ['modalidad_pago'];

    public $timestamps = false;
}
