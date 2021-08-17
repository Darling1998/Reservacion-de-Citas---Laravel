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
       Permission::create(['name'=>'admin.medicos.update','descripcion'=>'Actualizar Médico'])->syncRoles($rol1);
       Permission::create(['name'=>'admin.medicos.destroy','descripcion'=>'Eliminar Medico'])->syncRoles($rol1);
       Permission::create(['name'=>'admin.reportes.barra','descripcion'=>'Ver Reportes'])->syncRoles($rol1);


       Permission::create(['name'=>' admin.notificar','descripcion'=>'Generar Noticia'])->syncRoles($rol1);
      

    
       Permission::create(['name'=>'admin.pacientes.index','descripcion'=>'Ver Listado Pacientes'])->syncRoles($rol1,$rol4,$rol3); 
       Permission::create(['name'=>'admin.pacientes.create','descripcion'=>'Crear Paciente'])->syncRoles($rol1,$rol4,$rol3);
       Permission::create(['name'=>'admin.pacientes.update','descripcion'=>'Actualizar Paciente'])->syncRoles($rol1,$rol4,$rol3);
       Permission::create(['name'=>'admin.pacientes.edit','descripcion'=>'Editar Paciente'])->syncRoles($rol1,$rol4,$rol3);
       Permission::create(['name'=>'admin.pacientes.destroy','descripcion'=>'Eliminar Paciente'])->syncRoles($rol1,$rol3);

       //medicos
       Permission::create(['name'=>'medicos.horarios.edit','descripcion'=>'Editar Horario'])->syncRoles($rol3); 
       Permission::create(['name'=>'medicos.horarios.store','descripcion'=>'Guardar Horario'])->syncRoles($rol3);
       Permission::create(['name'=>'medico.guardarDiagnostico','descripcion'=>'GuardarDiagnostico'])->syncRoles($rol3);
       Permission::create(['name'=>'medico.guardarReceta','descripcion'=>'Generar Receta'])->syncRoles($rol3); 
       Permission::create(['name'=>'medico.terminarConsulta','descripcion'=>'Terminar Consulta'])->syncRoles($rol3);
       Permission::create(['name'=>'medico.comfirmarCita','descripcion'=>'Confirmar Cita'])->syncRoles($rol3,$rol1);
       Permission::create(['name'=> 'medico.consulta.receta','descripcion'=>'Generar Receta'])->syncRoles($rol3);

       Permission::create(['name'=>'medico.historial','descripcion'=>'Ver  Historial'])->syncRoles($rol3,$rol1,$rol4);
       Permission::create(['name'=> 'medico.historial.generate','descripcion'=>'Generar Doc Historial'])->syncRoles($rol3,$rol1,$rol4);

       

       

       //pacientes
       Permission::create(['name'=>'pacientes.reserva.index','descripcion'=>'Reservar como Paciente'])->syncRoles($rol2);
       Permission::create(['name'=>'pacientes.reserva.create','descripcion'=>'Guardar Reserva como Paciente'])->syncRoles($rol2);
     


        //asistente
       Permission::create(['name'=>' asistente.guardarSignos','descripcion'=>'Guardar Signos'])->syncRoles($rol4);
       Permission::create(['name'=>'asistente.guardarAntecedentes','descripcion'=>'Guardar Antecedentes'])->syncRoles($rol4); 
       Permission::create(['name'=>'asistente.reserva.create','descripcion'=>'Reservar como Asistente'])->syncRoles($rol4);
       Permission::create(['name'=>'asistente.reserva.store','descripcion'=>'Guardar reserva'])->syncRoles($rol4); 
      
       


       //medicos - asistentes
       Permission::create(['name'=>'medico.consulta.create','descripcion'=>'Crear Consulta'])->syncRoles($rol4,$rol3); 
       
       

       //todos
       Permission::create(['name'=>'citas.listar','descripcion'=>'Listar Citas'])->syncRoles($rol1,$rol2,$rol3,$rol4);


       //medicos-admin
       Permission::create(['name'=>'agenda.index','descripcion'=>'Ver Agenda'])->syncRoles($rol3,$rol1);
       

    }
}
