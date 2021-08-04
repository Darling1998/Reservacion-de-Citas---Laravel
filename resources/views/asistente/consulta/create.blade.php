@extends('adminlte::page')

@section('content')
<div class="card">
    <div class="collapse show" id="collapsedos" aria-labelledby="headidos" data-parent="#accordion" style="">
      <div class="card-body">
        <form action="{{ url('signos') }}" method="post"> 
          @csrf
          <input  name="cita_id" type="hidden" value="{{$citas->id}}">
          <input  name="paciente_id" type="hidden" value="{{$citas->paciente_id}}">
          <div class="form-row">
            <div class="form-group col-md-3">
              <label class="col-form-label"><strong>Talla:</strong></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <img src="https://image.flaticon.com/icons/png/512/3209/3209114.png"  class="rounded-circle" width="30px" height="30px">
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="12 Cm" id="talla" name="talla" required=""  value="" >
              </div>
            </div>
            <div class="form-group col-md-3">
              <label class="col-form-label"><strong>Peso:</strong></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <img src="https://image.flaticon.com/icons/png/512/2865/2865378.png"  class="rounded-circle" width="30px" height="30px">
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="55,5 Kg" id="peso" name="peso"   value="">
              </div>
            </div>
            <div class="form-group col-md-3">
              <label class="col-form-label"><strong>TA:</strong></label>  Presion Arterial
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <img src="https://image.flaticon.com/icons/png/512/884/884028.png"  class="rounded-circle" width="30px" height="30px">
                  </span>
                </div>
                <input type="text" class="form-control" name="presion"  required=""  value="" >
              </div>
            </div>
            <div class="form-group col-md-3">
              <label class="col-form-label"><strong>T°:</strong></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <img src="https://image.flaticon.com/icons/png/512/2316/2316581.png"  class="rounded-circle" width="30px" height="30px">
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="36°" name="temperatura"  required=""  value="">
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label class="col-form-label"><strong>Observación:</strong></label> 
              {!! Form::textarea('observacion', null, ['class'=>'form-control']) !!}
            </div>
          </div>
           @if ( auth()->user()->hasRole('asistente')) 
          <div class="container">
            <div class="row">
              <div class="col text-center">
                <button type="submit" class="btn btn-primary"> Guardar</button>
              </div>
            </div>
          </div>
           @endif

         
        </form>
      </div>
    </div>
  </div>
@endsection
