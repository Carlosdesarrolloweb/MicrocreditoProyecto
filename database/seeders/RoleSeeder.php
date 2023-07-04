<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
/*         $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin = Role::create(['name' => 'encargado']);

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
            Permission::create(['name' => $permission]);
        }

        $roleAdmin->givePermissionTo($permissions);
 */

    }
}
