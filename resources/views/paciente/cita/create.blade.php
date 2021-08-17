@extends('adminlte::page')

@section('title', 'Servi Natal')

@section('content_header')
    
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
  #section-radio-no,
	#section-radio-si{
		display: none;
	}

</style>
@endsection

@section('content')
<div class="card-body">
  @if (session('notificacion'))
  <div class="alert alert-success" role="alert">
    {{ session('notificacion') }}
  </div>
  @endif
</div> 
<div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Registrar nueva cita</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('home') }}" class="btn btn-sm btn-danger">
            Cancelar y volver
          </a>
        </div>
      </div>
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ url('reserva') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label for="descripcion">Descripción</label>
          <input name="descripcion" value="{{ old('descripcion') }}" id="descripcion" type="text" class="form-control" placeholder="Describe brevemente la consulta">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="especialidad">Especialidad</label>
                <select name="especialidad_id" id="especialidad" class="form-control" required>
                    <option value="">Seleccionar especialidad</option>
                 @foreach ($especialidades as $especialidad)
                    <option value="{{ $especialidad->id }}" @if(old('especialidad_id') == $especialidad->id) selected @endif>{{ $especialidad->nombre }}</option>
                @endforeach 
                </select>
            </div>
          
            <div class="form-group col-md-6">
                <label for="medico">Médico</label>
                <select name="medico_id" id="medico" class="form-control" required>
                  @foreach ($medicos as $medico)
                    <option value="{{ $medico->id }}" @if(old('medico_id') == $medico->id) selected @endif> {{ $medico->nombres }} {{$medico->apellidos}}</option>
                  @endforeach 
                </select>
            </div>
        </div>
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

        <div class="form-group">
          <label>Tipo <b class="required" title="Campos Requeridos">*</b> </label>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo" value="Consulta">
            <label class="form-check-label" for="consulta">Consulta</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo"  value="Examen">
            <label class="form-check-label" for="examen">Examen</label>
          </div>
        </div>

        <div class="card-body" id="section-radio-no">
          <input type="file" name="examen" accept="image/*">
          @error('examen')
              <small class="text-danger">{{$mensajes}}</small>
          @enderror
        </div>
      
        <button type="submit" class="btn btn-primary">
          Guardar
        </button>
      </form>
    </div>
  </div>


@stop


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('/js/citas/create.js') }}"></script>
  <script>
    $(".form-check-input").click( function(){
		 if($(this).val() == 'Consulta'){
			$('#section-radio-si').show();
			$('#section-radio-no').hide();
		 }
		 else if($(this).val() == 'Examen'){
			$('#section-radio-si').hide();
			$('#section-radio-no').show();
		 }
		
		
	})
  </script>
@stop