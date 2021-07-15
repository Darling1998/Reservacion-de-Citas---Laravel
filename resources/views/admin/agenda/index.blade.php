@extends('adminlte::page')

@section('title', 'Servi Natal')

@section('content_header')
    
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.css">    
@stop
@section('content')
    <div class="container">
        <div id="agenda">
           
        </div>
    </div>

    
    <!-- Modal -->
    <div class="modal fade" id="citaM" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agendar Cita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="card card-danger">
                            <div class="card-header">
                              <h3 class="card-title">Información del Paciente</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <input type="text" class="form-control" placeholder="Cédula">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" placeholder="Nombres">
                                    </div>
                                    <div class="col-5">
                                        <input type="text" class="form-control" placeholder="Apellidos">
                                    </div>
                                </div>
                                <br>
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
                                            <option value="medico_id">Seleccione Médico</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <input class="form-control datepicker" type="hidden"
                                    placeholder="Seleccionar fecha" 
                                    id="date" 
                                    name="fecha_cita"
                                    value="{{old('fecha_cita',date('Y-m-d'))}}">
                                
                                </div>
                                <br>

                                <label>Hora de atención</label>
                                <div id="horas">
                                    @if ($intervalos)
                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                @foreach ($intervalos['mñn'] as $key=> $interval)
                                                <div class="custom-control custom-radio mb-2" id="hm">
                                                <input name="hora_cita" value="{{$interval['inicio']}}" class="custom-control-input" id="intervalMñn{{$key}}" 
                                                type="radio" required>
                                                <label class="custom-control-label" for="intervalMñn{{$key}}">{{$interval['inicio']}} - {{$interval['fin']}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="carousel-item">
                                                @foreach ($intervalos['tarde'] as $key=>  $int)
                                                <div class="custom-control custom-radio mb-2" id="ht" >
                                                    <input name="hora_cita" value="{{$int['inicio']}}" class="custom-control-input" id="intervalTarde{{$key}}" 
                                                    type="radio" required>
                                                    <label class="custom-control-label" for="intervalTarde{{$key}}">{{$int['inicio']}} - {{$int['fin']}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                          <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                          <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                    @else
                                      <div class="alert alert-info" role="alert">
                                        Selecciona un médico y una fecha, para ver sus horarios de atención
                                      </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/locales-all.js"></script>
    <script src="{{ asset('js/agenda/agenda.js') }}" defer></script>
@endsection
