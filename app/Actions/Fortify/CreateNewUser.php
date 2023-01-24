<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Log;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User

    {   
        Log::info(json_encode($input));
        Log::info(json_encode($this->passwordRules()));
        Log::info(Jetstream::hasTermsAndPrivacyPolicyFeature());
        Validator::make($input, [
            'Carnet_usuario' => ['required', 'string', 'max:10','min:4'],
            'name' => ['required', 'string', 'max:18','min:4'],
            'apellido_usuario' => ['required', 'string', 'max:30','min:4'],
            'Nombre_usuario'=> ['required', 'string', 'max:12','min:4'],
            'cargo_usuario' => ['required', 'string', 'max:15','min:4'],
            'direccion_usuario' => ['required', 'string', 'max:40','min:4'],
            'telefono_usuario' => ['required', 'string', 'max:8','min:8'],
            'email' => ['required', 'string', 'email', 'max:20', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'Carnet_usuario' =>$input['Carnet_usuario'],
            'name' => $input['name'],
            'apellido_usuario' =>$input['apellido_usuario'],
            'Nombre_usuario'=>$input['Nombre_usuario'],
            'cargo_usuario'=>$input['cargo_usuario'],
            'direccion_usuario'=>$input['direccion_usuario'],
            'telefono_usuario'=>$input['telefono_usuario'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),

        ]);
        
    }
}
