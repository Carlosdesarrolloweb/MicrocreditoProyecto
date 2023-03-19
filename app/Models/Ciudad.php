<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';

    protected $fillable = [
        'cod_ciudad',
        'nombre_ciudad',
        'zona_id'
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }
}
