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
        <form action="{{ url('consulta/diagnostico') }}" method="post"> 
          @csrf
           <input  name="consulta_id" type="hidden" value="{{$consulta->id}}"> 
            <div class="row ">
                <div class="form-group col-md-6 col-lg-6">
                    <label class="col-form-label"><strong>Motivo Consulta:</strong></label>
                    {!! Form::textarea('motivo', $citas->motivo, ['class'=>'form-control']) !!}
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <label class="col-form-label"><strong>Exámen Adjunto:</strong></label>
                    <div class="card">
                        <img src="{{asset($citas->examen)}}" alt="">
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="select-diagnostico"><strong>Diagnostico:</strong></label>
                    <div class="search_select_box">
                        <select class="form-control multiple-select"  name="diagnosticos[]" id="select-diagnostico" multiple>
                            @foreach ($diagnosticos as $item)
                                <option value="{{$item->id}}"> {{$item->codigo}}- {{$item->descripcion}}</option>
                            @endforeach 
                           
                          </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label class="col-form-label"><strong>Observación:</strong></label>
                   
                      {!! Form::textarea('observacion',null, ['class'=>'form-control']) !!}

                </div>
            </div>

            
            @if ( auth()->user()->hasRole('doctor')) 
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

