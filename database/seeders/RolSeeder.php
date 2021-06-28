<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $rol1= Role::create(['name'=>'admin']);
       $rol2= Role::create(['name'=>'paciente']);
       $rol3= Role::create(['name'=>'doctor']);
       $rol4= Role::create(['name'=>'asistente']);

       //usuarios
       Permission::create(['name'=>'admin.users.index','descripcion'=>'Ver Listado Usuarios'])->syncRoles($rol1); 
       Permission::create(['name'=>'admin.users.edit','descripcion'=>'Asignar un Rol'])->syncRoles($rol1); 
    }
}
