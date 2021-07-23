<div class="card">
    <div class="collapse show" id="collapsedos" aria-labelledby="headidos" data-parent="#accordion" style="">
      <div class="card-body">
        <form action="{{ url('') }}" method="post"> 
          @csrf

            <div class="row ">
                <div class="form-group col-md-6 col-lg-6">
                    <label class="col-form-label"><strong>Motivo Consulta:</strong></label>
                    <textarea class="form-control" id="motivo" name="motivo"></textarea>
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <label class="col-form-label"><strong>Exámen Adjunto:</strong></label>
                    <div class="card">
                        <iframe src="http://www.previs.es:8080/fdecontrol/documents/2814anamnesis_cas.pdf" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="select-diagnostico"><strong>Diagnostico:</strong></label>
                    <div class="search_select_box">
                        <select class="select"  name="diagnosticos[]" id="select-diagnostico">
                            @foreach ($diagnosticos as $item)
                                <option value="{{$item->codigo}}"> {{$item->codigo}}- {{$item->descripcion}}</option>
                            @endforeach
                           
                          </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label class="col-form-label"><strong>Observación:</strong></label>
                    <textarea class="form-control" id="observacion" name="observacion"></textarea>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>



{{-- 
 --}}
{{-- 
<div class="card direct-chat direct-chat-primary">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">Crear Receta</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    
    <div class="card-body" style="display: block;">

    </div>

    
</div>
 --}}
