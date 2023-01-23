<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;


    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Carnet_cliente',
        'nombre_cliente',
        'apellido_cliente',
        'direccion_cliente',
        'email_cliente',
        'telefono_cliente',
        'edad_cliente',
        'telefono_referencia',
        'estado_cliente',
       

        
    
    ];
    public $timestamps = false;
}
