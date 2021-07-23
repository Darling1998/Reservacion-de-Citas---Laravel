@extends('adminlte::page')

@section('title', 'Pacientes')


@section('content')
    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show"  data-toggle="pill" href="#editar" role="tab">Editar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  data-toggle="pill" href="#antecedentes" role="tab" >Antecedentes</a>
            </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                {{-- Primer TAB --}}
                <div class="tab-pane fade" id="editar" role="tabpanel">
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
                                                 name="num_his" required  value="HC--00{{old('num_his'),$paciente->num_his}}" >
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
                                                <input type="text" class="form-control" 
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
                                                 name="correo" required value="{{ old('email',$paciente->email)}}"  >
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
                                        <textarea class="form-control" name="ante_per"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label"><strong>Historia Personal:</strong> <small>Causa muerte padre, madre o hijos</small></label>
                                        <textarea class="form-control" name="historia_personal"></textarea>
                                    </div>
                                </div>
                                {{-- @if ($item->sexo=="F") --}}
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
                  
                </div>
            </div>
        </div>
    </div>
@stop