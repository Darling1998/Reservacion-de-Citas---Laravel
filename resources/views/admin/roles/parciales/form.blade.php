<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese el nombre del nuevo Rol']) !!}
 
    @error('name')
        <small class="text-danger">
           {{$message}}
        </small>
    @enderror
 
 </div>

 <h2 class="h3">Lista de Permisos</h2>
 @foreach ($permissions as $permission)
     <div>
        <label>
           {!! Form::checkbox('permissions[]', $permission->id, null, ['class'=>'mr-1']) !!}
           {{$permission->descripcion}}
        </label>
     </div>
 @endforeach


{{--  
 <h2 class="h3">Lista de Permisos</h2>
 <table class="table table-responsive table-striped">
   @foreach ($permissions as $permission)
    <tr>
       <td>
         <label>
            {!! Form::checkbox('permissions[]', $permission->id, null, ['class'=>'mr-1']) !!}
            {{$permission->descripcion}}
         </label>
       </td>
    </tr>
   @endforeach
 </table>
 

 --}}
