@extends('adminlte::page')

@section('title', 'Pacientes')


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('content')
    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active"  data-toggle="pill" href="#editar" role="tab">Editar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  data-toggle="pill" href="#antecedentes" role="tab" >Antecedentes</a>
            </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                {{-- Primer TAB --}}
                <div class="tab-pane fade show active" id="editar" role="tabpanel">
                   <div class="card">
                        <div class="collapse show" id="collapsedos" aria-labelledby="headidos" data-parent="#accordion" style="">
                            <form action="{{url('pacientes/'.$paciente->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="num_his">Historia Clínica N°</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"  disabled
                                                 name="num_his" required  value="HC--{{$paciente->cedula}}" >
                                            </div>
                                        </div>
                    
                                        <div class="form-group col-md-4">
                                            <label for="nombres">Nombres</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" 
                                                maxlength="150" minlength="4" name="nombres" required value="{{ old('nombres',$paciente->nombres)}}" >
                                            </div>
                                        </div>
                                    
                                        <div class="form-group col-md-4">
                                            <label for="apellidos">Apellidos</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" 
                                                maxlength="150" minlength="4" name="apellidos" required value="{{ old('nombres',$paciente->apellidos)}}" >
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="cedula">Cédula</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" 
                                                maxlength="150" minlength="4" name="cedula" required value="{{ old('cedula',$paciente->cedula)}}" >
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
                                            <label for="direccion">Dirección</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"  
                                                 name="direccion" required value="{{ old('direccion',$paciente->direccion)}}" >
                                            </div>
                                        </div>

                                    </div>
                    
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="telefono">Teléfono</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" 
                                                 name="telefono" required value="{{ old('telefono',$paciente->telefono)}}" >
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email">Correo</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" 
                                                 name="email" required value="{{ old('email',$paciente->email)}}"  >
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
                                                    value="{{ old('fecha_nacimiento',$paciente->fecha_nacimiento)}}"
                                                   >
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
                </div>

                {{-- 2DO TAB --}}
                <div class="tab-pane fade" id="antecedentes" role="tabpanel" >
                   
                    <div class="card">
                        <div class="collapse show" id="collapsedos" aria-labelledby="headidos" data-parent="#accordion" style="">
                            <div class="card-body">
                            <form action="{{ url('pacientes/antecedentes') }}" method="post"> 
                                @csrf
                                   
                                    <input  name="paciente_id" type="hidden" value="{{$paciente->id}}">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="ante_per"><strong>Antecedentes Personales:</strong> <small>Clínicos, Quirúrgicos</small></label>
                                        {!! Form::textarea('antecedentes_personales', $paciente->antecedentes_personales, ['class'=>'form-control']) !!}
                                       {{--  <textarea class="form-control" name="antecedentes_personales" value="{{ old('antecedentes_personales',)}}"></textarea> --}}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label"><strong>Historia Personal:</strong> <small>Causa muerte padre, madre o hijos</small></label>
                                        {!! Form::textarea('historia_personal', $paciente->historia_personal, ['class'=>'form-control']) !!}
                                        {{-- <textarea class="form-control" name="historia_personal" value="{{ old('historia_personal',$paciente->historia_personal)}}"></textarea> --}}
                                    </div>
                                </div>
                                @if ($paciente->genero=="F")
                                    <label class="col-form-label"><strong>Antecedentes Gineco-Obstetricos:</strong></label>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label"><strong>Ciclos:</strong></label>
                                            <div class="input-group">
                                            <input type="text" class="form-control"   name="ciclos" value="{{ old('ciclos',$paciente->ciclos)}}">
                                            </div>
                                        </div>
                                        {{--                                     <div class="form-group col-md-3">
                                            <label class="col-form-label"><strong>Fecha Ultima Menstruación:</strong></label>
                                            <div class="input-group date" data-provide="datepicker">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                
                                                <input class="form-control datepicker" 
                                                    name="fecha_ultima_menstruacion"
                                                    value="{{old('fecha_ultima_menstruacion',$paciente->fecha_ultima_menstruacion)}}">
                                            </div>
                                        </div> --}}
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label"><strong>Gestas:</strong></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="gestas" value="{{ old('gestas',$paciente->gestas)}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label"><strong>Parto:</strong></label>
                                        {{--   <div class="input-group">
                                                <input type="text" class="form-control"  name="parto"  value="{{ old('parto',$paciente->parto)}}" >
                                            </div> --}}
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label class="col-form-label"><strong>Menarquia:</strong></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="menarquia" value="{{ old('menarquia',$paciente->menarquia)}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label"><strong>Cesáreas:</strong></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="cesareas" value="{{ old('cesareas',$paciente->cesareas)}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label"><strong>Abortos:</strong></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="abortos" value="{{ old('abortos',$paciente->abortos)}}"  >
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="col-form-label"><strong>Hijos:</strong></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="hijos" value="{{ old('hijos',$paciente->hijos)}}" >
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
                                @endif
                               
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label"><strong>Hábitos Psicobiologicos:</strong> <small>Uso de drogas, Alcohol</small></label>
                                        {!! Form::textarea('habitos_toxicos', $paciente->habitos_toxicos, ['class'=>'form-control']) !!}
                                        {{-- <textarea class="form-control"  name="habitos_toxicos" ></textarea> --}}
                                    </div>
                    
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label"><strong>Examen Funcional:</strong></label>
                                        {!! Form::textarea('examen_funcional', $paciente->examen_funcional, ['class'=>'form-control']) !!}
                                       {{--  <textarea class="form-control"  name="examen_funcional" ></textarea> --}}
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
                            <br>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script >
     $.fn.datepicker.defaults.format = "yyyy-mm-dd"; 

    $('.datepicker').datepicker({startDate:0});

</script>
@stop