@extends('adminlte::page')

@section('title', 'Paciente')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('content_header')
<div class="card-header border-0">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0">Nuevo Paciente</h3>
        </div>
        <div class="col text-right">
            <a href="{{url('pacientes')}}" class="btn btn-sm btn-danger">Cancelar</a>
        </div>
    </div>
</div>
@stop


@section('content')

    <div class="card">
        <form action="{{ url('pacientes') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-row">
                   

                    <div class="form-group col-md-4">
                        <label for="nombres">Nombres</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                            maxlength="150" minlength="4" name="nombres" required value="{{ old('nombres')}}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90)|| (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" >
                            @error('nombres')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                
                    <div class="form-group col-md-4">
                        <label for="apellidos">Apellidos</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                            maxlength="150" minlength="4" name="apellidos" required value="{{ old('apellidos')}}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90)|| (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)">
                            @error('apellidos')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="cedula">Cédula</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" 
                            maxlength="150" minlength="4" name="cedula" required value="{{ old('cedula')}}" onkeypress="return (event.charCode != 43 && event.charCode != 46  && event.charCode != 45)">
                            @error('cedula')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row">
                   
                    
                    <div class="form-group col-md-4">
                        <label for="genero">Género</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="genero">
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                              </select>
                              @error('genero')
                              <small class="text-danger">*{{$message}}</small>
                          @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="fecha_nacimiento">Fecha Nacimiento</label>
                        <div class="input-group col-sm-9 date" data-provide="datepicker">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
              
                            <input class="form-control datepicker" 
                                name="fecha_nacimiento"
                                value="{{old('fecha_nacimiento')}}">
                                @error('fecha_nacimiento')
                                    <small class="text-danger">*{{$message}}</small>
                                @enderror
                          </div>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="estado_civil">Estado Civil</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="estado_civil">
                                <option value="Soltero">Soltero</option>
                                <option value="Casado">Casado</option>
                                <option value="Divorciado">Divorciado</option>
                                <option value="Viudo">Viudo</option>
                                <option value="No_Especifica">No especifica</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="telefono">Teléfono</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                             name="telefono" required value="{{ old('telefono')}}" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" >
                             @error('telefono')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Correo</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                             name="email" required value="{{ old('email')}}" >
                             @error('email')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="direccion">Dirección</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  
                             name="direccion" required value="{{ old('direccion')}}" >
                             @error('direccion')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="ocupacion">Ocupación</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                             name="ocupacion" required value="{{ old('ocupacion')}}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90)|| (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" >
                             @error('ocupacion')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="telefono_familiar">Telefono Familiar</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                             name="telefono_familiar" required value="{{ old('telefono_familiar')}}" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" >
                             @error('telefono_familiar')
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

@endsection


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
       $.fn.datepicker.defaults.format = "yyyy-mm-dd"; 

        $('.datepicker').datepicker({startDate:0});

    </script> 
  
@stop