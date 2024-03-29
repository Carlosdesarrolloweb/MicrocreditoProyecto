<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Hasroles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'Carnet_usuario',
        'name',
        'apellido_usuario',
        'Nombre_usuario',
        'cargo_usuario',
        'direccion_usuario',
        'telefono_usuario',
        'email',
        'password',
        'estado_usuario',


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function adminlte_image(){
        return 'https://picsum.photos/300/300';
    }
    public function adminlte_profile_url()
    {
        return'profile/username';
    }

    public function getRole()
    {
        if ($this->cargo_usuario === 'administrador') {
            return 'Admin';
        } elseif ($this->cargo_usuario === 'encargado') {
            return 'Encargado';
        } else {
            return 'default'; // Definir un rol predeterminado si no se cumple ninguna condición
        }
    }

/*     public function can($ability, $arguments = [])
{
    // Verificar si el usuario autenticado es un administrador
    if ($this->esAdmin()) {
        return true;
    }

    // Verificar si el usuario autenticado intenta cambiar su propio estado
    if ($ability === 'updateEstado' && isset($arguments[0]) && $arguments[0]->id === $this->id) {
        return false;
    }

    return parent::can($ability, $arguments);
} */

}
