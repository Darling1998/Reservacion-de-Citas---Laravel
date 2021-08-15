@extends('adminlte::page')

@section('title', 'Servi Natal')

@section('content_header')
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nuevo Usuario</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('users')}}" class="btn btn-sm btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ url('users') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control"  placeholder="Ingrese Nombre" name="nombres"  value="{{ old('nombres') }}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90)|| (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)">
                            @error('nombres')
                                <small class="text-danger">*{{$message}}</small>
                             @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control"  placeholder="Ingrese Apellidos" name="apellidos"  value="{{ old('apellidos') }}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90)|| (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)">
                            @error('nombres')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Cédula</label>
                            <input type="number" class="form-control" placeholder="Ingrese Cédula" name="cedula"  value="{{ old('cedula') }}" onkeypress="return (event.charCode != 43 && event.charCode != 46  && event.charCode != 45)">
                            @error('cedula')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Teléfono</label>
                            <input type="tel" class="form-control" placeholder="Ingrese Teléfono" name="telefono"  value="{{ old('telefono') }}" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                            @error('telefono')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" placeholder="Ingrese email" name="email"  value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" placeholder="Minimo 8 caracteres" name="password"  value="{{ old('password') }}">
                            @error('password')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Género</label>
                            <div class="checkbox icheck">
                                <label >
                                  <input type="radio" name="genero" value="M"  > Masculino&nbsp;&nbsp;
                                  <input type="radio" name="genero" value="F" > Femenino
                                </label>
                                @error('genero')
                                    <small class="text-danger">*{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tipo Usuario</label>
                            <div class="checkbox icheck">
                                <label >
                                  <input type="radio" name="role" value="admin" >Administrador &nbsp;&nbsp;
                                  <input type="radio" name="role" value="asistente" > Asistente
                                </label>
                                @error('role')
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
            </form>
        </div>

    </div>
@stop


 @section('css')
   
@stop

@section('js')
@stop

{{-- <form role="form" id="main-form" autocomplete="off">
    <input type="hidden" id="_url" value="{{ url('user') }}">
    <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <div class="card-body">
      <div class="form-group pading">
        <label class="font-weight-bolder" for="name">Nombres</label>
        <input class="form-control" style="font-size: 15px;" id="name" name="name" placeholder="Nombres">
        <span class="missing_alert text-danger" id="name_alert"></span>
      </div>
      <div class="form-group">
        <label class="font-weight-bolder" for="last_name">Apellidos</label>
        <input class="form-control" style="font-size: 15px;" id="last_name" name="lastname" placeholder="Apellidos">
        <span class="missing_alert text-danger" id="last_name_alert"></span>
      </div>
       <div class="form-group">
        <label class="font-weight-bolder" for="status">Género</label>
        <div class="checkbox icheck">
          <label class="font-weight-bolder">
            <input type="radio" name="genero" value="M" checked> Masculino&nbsp;&nbsp;
            <input type="radio" name="genero" value="F"> Femenino
          </label>
        </div>
      </div>
      <div class="form-group pading">
        <label class="font-weight-bolder" for="username">Usuario</label>
        <input class="form-control" style="font-size: 15px;" id="username" name="username" placeholder="Ingrese el usuario">
        <span class="missing_alert text-danger" id="username_alert"></span>
      </div>
      <div class="form-group">
        <label class="font-weight-bolder" for="email">Correo Electrónico</label>
        <input class="form-control" style="font-size: 15px;" id="email" name="email" placeholder="Correo electrónico">
        <span class="missing_alert text-danger" id="email_alert"></span>
      </div>
      <div class="form-group">
        <label  for="role">Tipo de usuario</label>
        <div class="checkbox icheck">
          <label class="font-weight-bolder">
            <input type="radio" name="role" value="Usuario" checked> Usuario&nbsp;&nbsp;
            <input type="radio" name="role" value="Administrador"> Administrador
          </label>
        </div>
      </div>
      <div class="form-group">
        <label class="font-weight-bolder" for="password">Contraseña</label>
        <input type="password" style="font-size: 15px;" class="form-control" id="password" name="password" placeholder="Contraseña">
        <span class="missing_alert text-danger" id="password_alert"></span>
      </div>
      <div class="form-group">
        <label class="font-weight-bolder" for="password_confirmation">Confirmar Contraseña</label>
        <input type="password" style="font-size: 15px;" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Contraseña">
        <span class="missing_alert text-danger" id="password_confirmation_alert"></span>
      </div>
      <div class="form-group">
        <label class="font-weight-bolder" for="status">Acceso al sistema</label>
        <div class="checkbox icheck">
          <label class="font-weight-bolder">
            <input type="radio" name="status" value="1" checked> Activo&nbsp;&nbsp;
            <input type="radio" name="status" value="0"> Deshabilitado
          </label>
        </div>
      </div>
    </div>
      <div class="">
        <button type="submit" class="btn blue darken-4 text-white  ajax" id="submit">
          <i id="ajax-icon" class="fa fa-save"></i> Ingresar
        </button>
       
      </div>
    </form> --}}