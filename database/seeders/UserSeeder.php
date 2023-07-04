<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $roleEncargado = Role::firstOrCreate(['name' => 'Encargado']);

        $permissions = [
            'ver:role',
            'crear:role',
            'editar:role',
            'eliminar:role',
            'ver:permiso',
            'ver:usuario',
            'crear:usuario',
            'editar:usuario',
            'eliminar:usuario',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $roleAdmin->syncPermissions($permissions);
        $roleEncargado->syncPermissions(['ver:role', 'editar:role', 'ver:usuario', 'editar:usuario']);

       /*  User::create([
            // Datos del usuario admin...
        ])->assignRole('admin'); */

        /* User::factory(9)->create()->each(function ($user) use ($roleEncargado) {
            $user->assignRole($roleEncargado);
        }); */
    }
}
