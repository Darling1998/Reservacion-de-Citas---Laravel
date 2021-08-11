@extends('adminlte::page')

@section('title', 'Médicos')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@stop


@section('content_header')
<div class="card-header border-0">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0">Nuevo Médico</h3>
        </div>
        <div class="col text-right">
            <a href="{{url('medicos')}}" class="btn btn-sm btn-danger">Cancelar</a>
        </div>
    </div>
</div>
@stop

@section('content')
    <div class="card">
        <form action="{{url('medicos')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group row">
                            <label for="nombres" class="col-sm-4 col-form-label">Nombres</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control danger letras-vd" placeholder="Darling"
                                maxlength="150" minlength="4" name="nombres" required value="{{ old('nombres')}}" >
                                @error('nombres')
                                    <small class="text-danger">*{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                    <div class="form-group row">
                        <label for="apellidos" class="col-sm-4 col-form-label">Apellidos</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control letras-vd" placeholder="De La Cruz"
                        maxlength="150" minlength="4"  required name="apellidos" value="{{ old('apellidos')}}">
                        @error('apellidos')
                            <small class="text-danger">*{{$message}}</small>
                        @enderror
                        </div>
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group row">
                            <label for="cedula" class="col-sm-4 col-form-label @error('cedula') is-invalid @enderror">Cédula</label>
                            <div class="col-sm-8">
                            <input id="cedula" type="number" class="form-control @error('cedula') is-invalid @enderror" name="cedula" 
                            value="{{ old('cedula') }}" required autocomplete="cedula" autofocus placeholder="092816837" maxlength="10" minlength="10">
                            @error('cedula')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Correo</label>
                            <div class="col-sm-8">
                            <input type="email" class="form-control" placeholder="correo@ejemplo.com" name="email" required value="{{ old('email')}}">
                            @error('email')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group row">
                            <label for="telefono" class="col-sm-4 col-form-label">Teléfono</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="4515095-0986653745"
                                maxlength="10" minlength="7"  name="telefono" required value="{{ old('telefono')}}">
                                @error('telefono')
                                    <small class="text-danger">*{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label">Contraseña</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="minimo 8 caracteres" minlength="8"  name="password" required  value="{{ old('contra',Str::random(8))}}">
                            @error('password')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                            </div>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group row">
                            <label for="direccion" class="col-sm-4 col-form-label">Dirección</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control"
                                 name="direccion" required value="{{ old('direccion')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group row">
                            <label for="genero" class="col-sm-4 col-form-label">Género</label>
                            <div class="col-md-6">
                                <div class="checkbox icheck">
                                    <label >
                                      <input type="radio" name="genero" value="M" > Masculino&nbsp;&nbsp;
                                      <input type="radio" name="genero" value="F"> Femenino
                                    </label>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="especialidades">Especialidades</label>
                    <select name="especialidades[]" id="especialidades" class="form-control selectpicker" data-style="btn-primary" multiple title="Asigne una o más especialidades">
                        @foreach ($especialidades as $item)
                            <option value="{{$item->id}}">{{$item->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
            
        </form> 
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@stop

