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
        @if( $errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ url('pacientes') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="num_his">Historia Clínica N°</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  disabled
                             name="num_his" required value="{{ old('num_his')}}" >
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="nombres">Nombres</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                            maxlength="150" minlength="4" name="nombres" required value="{{ old('nombres')}}" >
                        </div>
                    </div>
                
                    <div class="form-group col-md-4">
                        <label for="apellidos">Apellidos</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                            maxlength="150" minlength="4" name="apellidos" required value="{{ old('apellido')}}" >
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="cedula">Cédula</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                            maxlength="150" minlength="4" name="cedula" required value="{{ old('apellido')}}" >
                        </div>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="nombres">Género</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="genero">
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                              </select>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="fecha_nacimiento">Fecha Nacimiento</label>
                        <div class="input-group date" data-provide="datepicker">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
              
                            <input class="form-control datepicker" 
                                name="fecha_nacimiento"
                                value="{{old('fecha_nacimiento')}}">
                          </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="telefono">Teléfono</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                             name="telefono" required value="{{ old('telefono')}}" >
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="correo">Correo</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                             name="correo" required value="{{ old('correo')}}" >
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="direccion">Dirección</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  
                             name="direccion" required value="{{ old('direccion')}}" >
                        </div>
                    </div>
                </div>

            </div>

{{--             <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="ante_per"><strong>Antecedentes Personales:</strong> <small>Clínicos, Quirúrgicos</small></label>
                        <textarea class="form-control" name="ante_per"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label"><strong>Historia Personal:</strong> <small>Causa muerte padre, madre o hijos</small></label>
                        <textarea class="form-control" name="historia_personal"></textarea>
                    </div>
                </div>

                <label class="col-form-label"><strong>Antecedentes Gineco-Obstetricos:</strong></label>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="col-form-label"><strong>Ciclos:</strong></label>
                        <div class="input-group">
                        <input type="text" class="form-control"   name="ciclos">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="col-form-label"><strong>Fecha Ultima Menstruación:</strong></label>
                        <div class="input-group date" data-provide="datepicker">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
            
                            <input class="form-control datepicker" 
                                name="fecha_menstr"
                                value="{{old('fecha_menstr')}}">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="col-form-label"><strong>Gestas:</strong></label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="gestas"  required="">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="col-form-label"><strong>Parto:</strong></label>
                        <div class="input-group">
                            <input type="text" class="form-control"  name="parto" required="">
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label class="col-form-label"><strong>Menarquia:</strong></label>
                        <div class="input-group">
                            <input type="text" class="form-control" required="" name="menarquia">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="col-form-label"><strong>Cesáreas:</strong></label>
                        <div class="input-group">
                            <input type="text" class="form-control" required="" name="numCesa">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="col-form-label"><strong>Abortos:</strong></label>
                        <div class="input-group">
                            <input type="text" class="form-control" required="" name="numAbortos" >
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="col-form-label"><strong>Hijos:</strong></label>
                        <div class="input-group">
                            <input type="text" class="form-control" required="" name="numHijos">
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="col-form-label"><strong>Vida Sexual Activa:</strong></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activo" value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                            Si
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activo" value="0">
                            <label class="form-check-label" for="exampleRadios2">
                            No
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label"><strong>Hábitos Psicobiologicos:</strong> <small>Uso de drogas, Alcohol</small></label>
                        <textarea class="form-control"  name="habiPsicobiologicos"></textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="col-form-label"><strong>Examen Funcional:</strong></label>
                        <textarea class="form-control"  name="v" required></textarea>
                    </div>
                </div>

            </div> --}}

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