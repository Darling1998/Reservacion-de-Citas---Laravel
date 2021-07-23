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
    <div class="row">
        <div class="col-md-12">
            <div class="card card-line-primary">
                <div class="card-body">
                    <form action="{{url('users/'.$useru->id)}}" method="POST"method="POST">
                        @csrf
                        @method('PUT')   
                        <div class="box-body">
                            <div class="form-group pading">
                                <label for="nombres">Nombres</label>
                                <input type="nombres" class="form-control @error('nombres') is-invalid @enderror" name="nombres" value="{{ $useru->nombres }}"  autofocus >
                                    @error('nombres')
                                        <span class="invalid-feedback text-center" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input id="apellidos" type="apellidos" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ $useru->apellidos }}" autofocus>
                                    @error('apellidos')
                                        <span class="invalid-feedback text-center" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bolder" for="status">Género</label>
                                <div class="checkbox icheck">
                                    <label class="font-weight-bolder">
                                        @if ($useru->genero == 'F')
                                            <input type="radio" name="genero" value="F" checked> Femenino &nbsp;&nbsp;
                                            <input type="radio" name="genero" value="M"> Masculino
                                        @else
                                        <input type="radio" name="genero" value="F" > Femenino &nbsp;&nbsp;
                                        <input type="radio" name="genero" value="M" checked> Masculino
                                        @endif
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="last_name">Cédula</label>
                                <input  type="text" class="form-control @error('cedula') is-invalid @enderror"name="cedula" value="{{ $useru->cedula }}" autofocus>
                                    @error('cedula')
                                        <span class="invalid-feedback text-center" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"name="email" value="{{ $useru->email }}"  autocomplete="email" autofocus placeholder="Contraseña">
                                    @error('email')
                                        <span class="invalid-feedback text-center" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Nueva Contraseña</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"name="password" value="{{ old('password') }}"  autocomplete="password" autofocus placeholder="Contraseña">
                                    @error('password')
                                        <span class="invalid-feedback text-center" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">
                                <i id="ajax-icon" class="fa fa-edit"></i> Guardar Cambios
                            </button>
                        </div>

                    </form>
                 </div>
            </div>
        </div>
    </div>
@stop
