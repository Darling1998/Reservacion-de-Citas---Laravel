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
       

       //admin
       Permission::create(['name'=>'admin.especialidades.index','descripcion'=>'Ver Listado Usuarios'])->syncRoles($rol1); 
       Permission::create(['name'=>'admin.especialidades.create','descripcion'=>'Crear Especialidad'])->syncRoles($rol1);
       Permission::create(['name'=>'admin.especialidades.edit','descripcion'=>'Editar Especialidad'])->syncRoles($rol1);
       Permission::create(['name'=>'admin.especialidades.destroy','descripcion'=>'Eliminar Especialidad'])->syncRoles($rol1);

       Permission::create(['name'=>'admin.medicos.index','descripcion'=>'Ver Listado Médicos'])->syncRoles($rol1); 
       Permission::create(['name'=>'admin.medicos.create','descripcion'=>'Crear Médico'])->syncRoles($rol1);
       Permission::create(['name'=>'admin.medicos.edit','descripcion'=>'Editar Médico'])->syncRoles($rol1);
       Permission::create(['name'=>'admin.medicos.destroy','descripcion'=>'Eliminar Medico'])->syncRoles($rol1);


       Permission::create(['name'=>'pacientes.edit','descripcion'=>'Editar Horario'])->syncRoles($rol2); 
       Permission::create(['name'=>'pacinetes.store','descripcion'=>'Guardar Horario'])->syncRoles($rol2);


       //medicos
       Permission::create(['name'=>'medicos.edit','descripcion'=>'Editar Horario'])->syncRoles($rol3); 
       Permission::create(['name'=>'medicos.store','descripcion'=>'Guardar Horario'])->syncRoles($rol3);
    }
}
