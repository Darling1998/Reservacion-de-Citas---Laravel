@extends('adminlte::page')

@section('title', '')

@section('content')
  
    <div class="card-body">
        <form action="{{ url('/citas/'.$cita->id.'/cancelar') }}" method="POST">
            @csrf

            <div class="form-group">
            <label for="justificacion">Por favor cuéntanos el motivo de la cancelación:</label>
            <textarea required id="justificacion" name="justificacion" rows="3" class="form-control"></textarea>
            </div>        

            <button class="btn btn-danger" type="submit">Cancelar cita</button>
            <a href="{{ url('/citas') }}" class="btn btn-default">
            Volver al listado de citas sin cancelar
            </a>
        </form>
    </div>
@stop
