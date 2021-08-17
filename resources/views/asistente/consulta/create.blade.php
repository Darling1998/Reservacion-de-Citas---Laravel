@extends('adminlte::page')

@section('content')
<div class="card">
  <div class="card-body">
    @if (session('notificacion'))
    <div class="alert alert-success" role="alert">
      {{ session('notificacion') }}
    </div>
    @endif
</div> 
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
                <input type="text" class="form-control" placeholder="1.30 mts" id="talla" name="talla" required=""  value="" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
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
                <input type="text" class="form-control" placeholder="55.5 Kg" id="peso" name="peso"   value="" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
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
                <input type="text" class="form-control" name="presion" id="presion" required="" placeholder="130/80 mmHg" value="" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" >
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
                <input type="text" class="form-control" placeholder="36°" name="temperatura" id="temperatura" required=""  value="" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
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


@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js" integrity="sha512-6Jym48dWwVjfmvB0Hu3/4jn4TODd6uvkxdi9GNbBHwZ4nGcRxJUCaTkL3pVY6XUQABqFo3T58EMXFQztbjvAFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/inputmask.js" integrity="sha512-5buUHzxCQlwfawU8sjDMpR8nLDp6mB3yI4toPQva+fAFP93hDBnp1EB67rflpTXuLrBV7N3/FyBBMAcqijZQ8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      $(":input").inputmask();
      
      $("#talla").inputmask({"mask": "9.99 mts"});
      $("#peso").inputmask({"mask": "999.9 kg"});
      $("#temperatura").inputmask({"mask": "99.9º"});
      $("#presion").inputmask({"mask": "999/99 mmHg"});
    </script>
@stop