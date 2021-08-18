@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Cita # {{$cita->id}}</h3>
            </div>
        </div>
    </div>
    <div class="card-body">
        <ul>
            <li>
                <strong>Fecha: </strong>{{$cita->fecha_cita}}
            </li>
            <li>
                <strong>Hora: </strong>{{$cita->hora_cita}}
            </li>
          {{--   @if ($role ==1) --}}
            <li>
                <strong>Medico: </strong>{{$cita->medico->persona->nombres}} &nbsp; {{$cita->medico->persona->apellidos}}
            </li>
       {{--      @endif --}}

            {{-- @if ($role ==1 || $role==2) --}}
            <strong>Paciente: </strong>{{$cita->paciente->persona->nombres}}&nbsp;{{$cita->paciente->persona->apellidos}}
            {{-- @endif --}}
            <li>
                <strong>Especialidad: </strong>{{$cita->especialidad->nombre}}
            </li>
            <li>
                <strong>Tipo</strong>{{$cita->tipo}}
            </li>
            <li>
                <strong>Estado</strong>
                @if ($cita->estado =='A')
                    <span class="badge badge-success"> Atendida</span>
                @elseif ($cita->estado =='CL')
                    <span class="badge badge-danger">Cancelada</span>
                @endif
               
            </li>
            @if ($cita->estado=='CL')
            <li>
                <strong>Motivo de cancelación: </strong>{{$cita->motivo_cancel}}
            </li>
            <li>
                <strong>Fecha de cancelación: </strong>{{$cita->updated_at}}
            </li>
            
        @endif
               
           
        </ul> 
        <a href="{{url('/citas')}}" class="btn btn-default">
            Volver
        </a>
    </div>    
</div>
@stop

