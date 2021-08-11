@extends('adminlte::page')


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop


@section('content')
    <div class="card">
        <form action="{{ url('asistente/reservar/guardar') }}" method="post"> 
            @csrf
            <div class="card-body">
                @if (session('notificacion'))
                <div class="alert alert-success" role="alert">
                  {{ session('notificacion') }}
                </div>
                @endif
          

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="cedula">Cédula</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-success"><i class="fas fa-search"></i></button>
                            </div>
                            
                            <input type="number" class="form-control"  name="cedula" value="{{ old('cedula')}}">
                            @error('cedula')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                        </div>
                    </div>
                </div>

                <div class="row">             
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control" placeholder="Ingrese Nombres"  name="nombres" value="{{ old('nombres')}}">
                            @error('nombres')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Apellidos</label>
                            <input type="text" class="form-control" placeholder="Ingrese Apellidos"  name="apellidos" value="{{ old('apellidos')}}">
                            @error('apellidos')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="exampleInputEmail1">Teléfono</label>
                        <input type="tel" class="form-control" placeholder="Ingrese Telefono"  name="telefono" value="{{ old('telefono')}}">
                        @error('telefono')
                            <small class="text-danger">*{{$message}}</small>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Ingrese Correo"  name="email" value="{{ old('email')}}">
                            @error('email')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <select name="especialidad_id" id="especialidad" class="form-control" required>
                            <option value="especialidad_id">Seleccionar especialidad</option>
                            @foreach ($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}" @if(old('especialidad_id') == $especialidad->id) selected @endif>{{ $especialidad->nombre }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-6">
                        <select name="medico_id" id="medico" class="form-control" required>
                            @foreach ($medicos as $medico)
                                <option value="{{ $medico->id }}" @if(old('medico_id') == $medico->id) selected @endif> {{ $medico->nombres }} {{$medico->apellidos}}</option>
                            @endforeach 
                            </select>
                    </div>
                </div>

                <br>
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <div class="input-group date" data-provide="datepicker">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
        
                    <input class="form-control datepicker" 
                        placeholder="Seleccionar fecha" 
                        id="date" 
                        name="fecha_cita"
                        value="{{old('fecha_cita',date('Y-m-d'))}}"
                    >
                    </div>
                </div>
            
                <div class="form-group">
                    <label for="horas">Hora de atención</label>
                    <div id="horas">
                    @if ($intervalos)
                        @foreach ($intervalos['mñn'] as $key=> $interval)
                        <div class="custom-control custom-radio mb-2">
                            <input name="hora_cita" value="{{$interval['inicio']}}" class="custom-control-input" id="intervalMñn{{$key}}" 
                            type="radio" required>
                            <label class="custom-control-label" for="intervalMñn{{$key}}">{{$interval['inicio']}} - {{$interval['fin']}}</label>
                        </div>
                        @endforeach
                        @foreach ($intervalos['tarde'] as $key=>  $int)
                            <div class="custom-control custom-radio mb-2">
                            <input name="hora_cita" value="{{$int['inicio']}}" class="custom-control-input" id="intervalTarde{{$key}}" 
                            type="radio" required>
                            <label class="custom-control-label" for="intervalTarde{{$key}}">{{$int['inicio']}} - {{$int['fin']}}</label>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info" role="alert">
                        Selecciona un médico y una fecha, para ver sus horarios de atención
                        </div>
                    @endif
                    </div>
                </div>
                
            </div>
            <div class="container">
                <div class="row">
                  <div class="col text-center">
                    <button type="submit" class="btn btn-primary"> Reservar</button>
                  </div>
                </div>
              </div>
              <br>
        </form>
    </div>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('/js/citas/create.js') }}"></script>
@stop

