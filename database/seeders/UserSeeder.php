<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'Carnet_usuario'=>'9038059',
            'name' => 'Melanio',
            'apellido_usuario'=>'Rosales',
            'Nombre_usuario' =>'Melanio',
            'cargo_usuario'=>'Administrador',
            'direccion_usuario'=>'asdasdasdasdasasd',
            'telefono_usuario'=>'77051458',
            'email' => 'carlitotuning295@gmail.com',
            'password' => bcrypt('12345678')

         ])->assignRole('Admin');

         User::factory(9)->create();
    }
}
