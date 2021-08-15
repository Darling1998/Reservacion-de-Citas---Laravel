@extends('adminlte::page')

@section('title', 'Uusarios')

@section('content_header')
<div class="card-header border-0">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0">Editar Usuario</h3>
        </div>
        <div class="col text-right">
            <a href="{{url('users')}}" class="btn btn-sm btn-danger">Cancelar y volver</a>
        </div>
    </div>
</div>
@stop

@section('content')
    <div class="card">
        <form action="{{url('users/'.$useru->id)}}" method="POST"method="POST">
            @csrf
            @method('PUT')   

            <input  name="user_id" type="hidden" value="{{$useru->id}}"> 
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombres">Nombres</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                            maxlength="150" minlength="4" name="nombres" required  value="{{ $useru->nombres }}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90)|| (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" >
                            @error('nombres')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="apellidos">Apellidos</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                            maxlength="150" minlength="4" name="apellidos" required  value="{{ $useru->apellidos }}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90)|| (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" >
                            @error('apellidos')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cedula">Cédula</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                            maxlength="150" minlength="4" name="cedula" required  value="{{ $useru->cedula }}" onkeypress="return (event.charCode != 43 && event.charCode != 46  && event.charCode != 45)">
                            @error('cedula')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="telefono">Teléfono</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                            maxlength="150" minlength="4" name="telefono" required  value="{{ $useru->telefono }}">
                            @error('telefono')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Correo</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                            maxlength="150" minlength="4" name="email" required  value="{{ $useru->email }}" >
                            @error('email')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="password">Contraseña</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                            maxlength="150" minlength="4" name="password" >
                            <p>Modifica este campo si quieres cambiar la contraseña</p>
                            @error('telefono')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="genero">Género</label>
                        <div class="col-sm-9">
                            
                            <select class="form-control" name="genero" required>
                                @if ($useru->genero=='M')
                                <option value="M" selected>Masculino</option>
                                <option value="F">Femenino</option>                                 
                                @else
                                <option value="M" >Masculino</option>
                                <option value="F" selected>Femenino</option>         
                                @endif
                              </select>
                              @error('genero')
                              <small class="text-danger">*{{$message}}</small>
                          @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="estado">Estado</label>
                        <div class="col-sm-6">
                            <div class="checkbox icheck">
                                <label >
                                    @if ($useru->nombres=='A')
                                    <input type="radio" name="estado" value="A" checked>Activo&nbsp;&nbsp;
                                    <input type="radio" name="estado" value="I"> Inactivo
                                    @else
                                    <input type="radio" name="estado" value="A" >Activo&nbsp;&nbsp;
                                    <input type="radio" name="estado" value="I" checked> Inactivo
                                    @endif
                                    
                                
                                </label>
                              </div>
                        </div>
                    </div>
                </div>

                 <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="password">Rol</label>
                        <div class="col-sm-9">
                            <div class="checkbox icheck">
                                <label >
                                  
                                  <input type="radio" name="role" value="admin"  {{ $user->hasRole('admin') ? 'checked' : '' }}> Administrador&nbsp;&nbsp;
                                  <input type="radio" name="role" value="doctor"  {{ $user->hasRole('doctor') ? 'checked' : '' }}> Médico
                                  <input type="radio" name="role" value="asistente" {{ $user->hasRole('asistente') ? 'checked' : '' }}> asistente
                                  <input type="radio" name="role" value="paciente" {{ $user->hasRole('paciente') ? 'checked' : '' }}> Paciente
                                </label>
                              </div>
                            @error('telefono')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div> 

            </div>
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                    <button type="submit" class="btn btn-primary"> Guardar</button>
                    </div>
                </div>
            </div>
            <br>
        </form>
    </div>

@stop
