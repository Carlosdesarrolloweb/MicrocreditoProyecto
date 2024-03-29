<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Foto;
use App\Models\Garantia;
use App\Models\Zona;

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
        'zona_id',





    ];
    public function foto()
    {
        return $this->hasOne(Foto::class,"id","id_foto");
    }
    public function fotocarnet()
    {
        return $this->hasOne(Foto::class,"id","id_fotocarnet");
    }
    public function fotorecibo()
    {
        return $this->hasOne(Foto::class,"id","id_fotorecibo");
    }
    public function fotocroquis()
    {
        return $this->hasOne(Foto::class,"id","id_fotocroquis");
    }
    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    //se modifico prestamos por prestamo en caso de error volver atras
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'id_cliente');
    }
    public function images()
    {
        return $this->morphMany(Foto::class, 'imageable');
    }

    public $timestamps = false;

}
