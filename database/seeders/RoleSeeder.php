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
         $role1= Role::create(['name' => 'Admin']);
         $role2= Role::create(['name' => 'Encargado']);

         Permission::create(['name' => 'user.editarusuarios'])->syncRoles([$role1]);
         Permission::create(['name' => 'user.eliminarusuarios'])->syncRoles([$role1]);
         Permission::create(['name' => 'clientes.crearclientes'])->syncRoles([$role1,$role2]);
         Permission::create(['name' => 'clientes.editarclientes'])->syncRoles([$role1,$role2]);
         Permission::create(['name' => 'dashboard'])->syncRoles([$role1,$role2]);

         Permission::create(['name' => 'zonas.create'])->syncRoles([$role1,$role2]);
         Permission::create(['name' => 'zonas.edit'])->syncRoles([$role1,$role2]);

         Permission::create(['name' => 'ciudades.create'])->syncRoles([$role1,$role2]);
         Permission::create(['name' => 'ciudades.edit'])->syncRoles([$role1,$role2]); 


    }
}
