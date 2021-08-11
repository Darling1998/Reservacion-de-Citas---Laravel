@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
   <h1>Editar Rol</h1> 
@stop

@section('content')
   @if (session('info'))
      <div class="alert alert-success">
         {{session('info')}}
      </div>
   @endif
   <div class="card">
       <div class="card-body">
         {!! Form::model($role, ['route'=>['admin.roles.update',$role],'method'=>'put']) !!}

            @include('admin.roles.parciales.form')
            {!! Form::submit('Actualizar Rol', ['class'=>'btn btn-primary']) !!}

         {!! Form::close() !!}
      </div> 

{{--       <div class="card-body">
         <form role="form" id="main-form">
         
            <input type="hidden" id="_token" value="{{ csrf_token() }}">
            <table class="table table-responsive table-striped">            
               <tr>
                  <td>
                     Ver Listado Usuarios<br>
                  <div class="checkbox icheck">
                     <label>
                     <input type="checkbox" name="permissions[]" value="admin.users.index" {{ $role->hasPermissionTo('admin.users.index') ? 'checked' : '' }}>
                     </label>
                  </div>
                  </td>
                  <td>
                     Asignar un Rol</br>
                  <div class="checkbox icheck">
                     <label>
                     <input type="checkbox" name="permissions[]" value="admin.users.edit" {{ $role->hasPermissionTo('admin.users.edit') ? 'checked' : '' }}>
                     </label>
                  </div>
                  </td>
                  <td>
                     Ver Listado Especialidades</br>
                  <div class="checkbox icheck">
                     <label>
                     
                     </label>
                  </div>
                  </td>
                  <td>
                     Crear Especialidad</br>
                  <div class="checkbox icheck">
                     <label>
                     
                     </label>
                  </div>
                  </td>
                  <td>
                     Editar Especialidad<br>
                  <div class="checkbox icheck">
                     <label>
                     
                     </label>
                  </div>
                  </td>
                  <td>
                     Eliminar Especialidad</br>
                  <div class="checkbox icheck">
                     <label>
                     
                     </label>
                  </div>
                  </td>
               </tr>
               <tr>
                  <td>
                     Ver Listado Médicos</br>
                  <div class="checkbox icheck">
                     <label>
                     
                     </label>
                  </div>
                  </td>
                  <td>
                     Crear Médico</br>
                  <div class="checkbox icheck">
                     <label>
                     
                     </label>
                  </div>
                  </td>                  
                  <td>
                     Editar Médico</br>
                  <div class="checkbox icheck">
                     <label>
                     
                     </label>
                  </div>
                  </td>
                  <td>
                     Eliminar Medico
                  </br>
                  <div class="checkbox icheck">
                     <label>
                     
                     </label>
                  </div>
                  </td>
            
               <td>
                  Ver Reportes

                  <div class="checkbox icheck">
                     <label>
                     
                     </label>
                  </div>
                  </td> 
                  <td>
                     Ver Listado Pacientes</br>
                  <div class="checkbox icheck">
                     <label>
                     
                     </label>
                  </div>
                  </td>          
               </tr>
               <tr>                        
                  <td>
                     Crear Paciente</br>
                     <div class="checkbox icheck">
                        <label>
                        
                        </label>
                     </div>
                  </td>
                  <td>
                     Editar Paciente</br>
                     <div class="checkbox icheck">
                        <label>
                        
                        </label>
                     </div>
                  </td>
                  <td>
                     Eliminar Paciente</br>
                     <div class="checkbox icheck">
                        <label>
                        
                        </label>
                     </div>
                  </td>
                  <td>
                     Listar Citas</br>
                     <div class="checkbox icheck">
                        <label>
                        
                        </label>
                     </div>
                  </td>
                  <td>
                     Ver Agenda</br>
                     <div class="checkbox icheck">
                        <label>
                        
                        </label>
                     </div>
                  </td>
               </tr>  
            </table>
            <div class="form-group pading">
               <label for="name">Contraseña actual</label>
               <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Contraseña actual">
               <span class="missing_alert text-danger" id="current_password_alert"></span>
               </div>
               <button type="submit" class="btn blue darken-4 text-white ajax" id="submit">
                  <i id="ajax-icon" class="fa fa-edit"></i> Editar
               </button>
         </form>
      </div> --}} 
   </div>
@stop
