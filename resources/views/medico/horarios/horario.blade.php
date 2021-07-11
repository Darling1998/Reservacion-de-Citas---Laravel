@extends('adminlte::page')

@section('title', 'Horarios')

@section('content_header')
    
@stop

@section('content')
<form  action="{{url('horarios')}}"  method="post">
    @csrf
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Registrar Horario</h3>
                </div>
                <div class="col text-right">
                    <button type="submit" class="btn btn-sm btn-success">Guardar cambios</button>
                </div>
            </div>
        </div>
         <div class="card-body">
            @if(session('notificacion'))
                <div class="alert alert-success" role="alert">
                    {{session('notificacion')}}
                </div> 
            @endif
        </div>

        <div class="card-body">
            @if(session('alertas'))
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach (session('alertas') as $alert)
                        <li>{{$alert}}</li>
                        @endforeach
                    </ul>
                </div> 
            @endif
        </div> 

        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Dia</th>
                        <th>Estado</th>
                        <th>Turno Mañana</th>
                        <th>Turno Tarde</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($dias_trabajo as $aux=> $dia_tra)
                    <tr>
                        <th> {{$dias[$aux]}}</th>
                        <td>
                            <label class="custom-toggle">
                                <input type="checkbox" name="activo[]" value="{{$aux}}"
                                @if($dia_tra->activo) checked @endif
                                >
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" name="hora_inicio_mñn[]">
                                        @for($i=6;$i<=11;$i++)
                                        <option value="{{($i<10 ? '0':'').$i}}:00"  @if($i.':00 AM' ==$dia_tra->hora_inicio_mñn) selected @endif >
                                            {{$i}}:00 AM
                                        </option>
                                        <option value="{{($i<10 ? '0':'').$i}}:30"  @if($i.':30 AM' ==$dia_tra->hora_inicio_mñn) selected @endif >
                                            {{$i}}:30 AM
                                        </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" name="hora_fin_mñn[]">
                                         @for($i=6;$i<=11;$i++) 
                                        <option value="{{($i<10 ? '0':'').$i}}:00 "   @if($i.':00 AM' ==$dia_tra->hora_fin_mñn) selected @endif  >
                                             {{$i}}:00 AM 
                                        </option>
                                        <option value="{{($i<10 ? '0':'').$i}}:30 "   @if($i.':30 AM' ==$dia_tra->hora_fin_mñn) selected @endif  >
                                             {{$i}}:30 AM 
                                        </option>
                                         @endfor 
                                    </select>
                                </div>

                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" name="hora_inicio_tarde[]">
                                         @for($i=1;$i<=8;$i++) 
                                        <option value="{{$i+12}}:00 "   @if($i.':00 PM' ==$dia_tra->hora_inicio_tarde) selected @endif  >
                                             {{$i+12}}:00 PM 
                                        </option>
                                        <option value="{{$i+12}}:30 "   @if($i.':30 PM' ==$dia_tra->hora_inicio_tarde) @endif  >
                                             {{$i+12}}:30 PM 
                                        </option>
                                         @endfor 
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" name="hora_fin_tarde[]">
                                         @for($i=1;$i<=8;$i++) 
                                        <option value="{{$i+12}}:00 "   @if($i.':00 PM' ==$dia_tra->hora_fin_tarde) selected @endif  >
                                             {{$i+12}}:00 PM 
                                        </option>
                                        <option value="{{$i+12}}:30 "   @if($i.':30 PM' ==$dia_tra->hora_fin_tarde) selected @endif  >
                                             {{$i+12}}:30 PM 
                                        </option>
                                         @endfor 
                                    </select>
                                </div>

                            </div>
                        </td>
                        
                        <td></td>
                        
                    </tr>
                 @endforeach
    
                </tbody>
            </table>
        </div>

    </div>
</form>

@stop
