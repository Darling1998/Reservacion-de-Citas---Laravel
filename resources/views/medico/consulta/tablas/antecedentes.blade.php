<div class="card">
    <div class="collapse show" id="collapsedos" aria-labelledby="headidos" data-parent="#accordion" style="">
      <div class="card-body">
        <form action="{{ url('antecedentes') }}" method="post"> 
            @csrf
            <input  name="paciente_id" type="hidden" value="{{$info->paciente_id}}">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="col-form-label"><strong>Antecedentes Personales:</strong> <small>Clínicos, Quirúrgicos</small></label>
                    <textarea class="form-control" id="enfactual" name="ante_per"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label class="col-form-label"><strong>Historia Personal:</strong> <small>Causa muerte padre, madre o hijos</small></label>
                    <textarea class="form-control" id="antper" name="antper"></textarea>
                </div>
            </div>
            @if ($item->sexo=="F")
            <label class="col-form-label"><strong>Antecedentes Gineco-Obstetricos:</strong></label>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class="col-form-label"><strong>Ciclos:</strong></label>
                    <div class="input-group">
                    <input type="text" class="form-control"   name="ciclos">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="col-form-label"><strong>Fecha Ultima Menstruación:</strong></label>
                    <div class="input-group date" data-provide="datepicker">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
        
                        <input class="form-control datepicker" 
                            name="fecha_nacimiento"
                            value="{{old('fecha_nacimiento')}}">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="col-form-label"><strong>Gestas:</strong></label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="gestas"  required="">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="col-form-label"><strong>Parto:</strong></label>
                    <div class="input-group">
                        <input type="text" class="form-control"  name="parto" required="">
                    </div>
                </div>
            </div>
           
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label class="col-form-label"><strong>Menarquia:</strong></label>
                    <div class="input-group">
                        <input type="text" class="form-control" required="" name="menarquia">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="col-form-label"><strong>Cesáreas:</strong></label>
                    <div class="input-group">
                        <input type="text" class="form-control" required="" name="numCesa">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="col-form-label"><strong>Abortos:</strong></label>
                    <div class="input-group">
                        <input type="text" class="form-control" required="" name="numAbortos" >
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label class="col-form-label"><strong>Hijos:</strong></label>
                    <div class="input-group">
                        <input type="text" class="form-control" required="" name="numHijos">
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label class="col-form-label"><strong>Vida Sexual Activa:</strong></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="activo" value="1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                        Si
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="activo" value="0">
                        <label class="form-check-label" for="exampleRadios2">
                        No
                        </label>
                    </div>
                </div>
            </div>
            @endif
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="col-form-label"><strong>Hábitos Psicobiologicos:</strong> <small>Uso de drogas, Alcohol</small></label>
                    <textarea class="form-control"  name="habiPsicobiologicos"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label class="col-form-label"><strong>Examen Funcional:</strong></label>
                    <textarea class="form-control"  name="exaF" required></textarea>
                </div>
            </div>
            <div class="container">
                <div class="row">
                  <div class="col text-center">
                    <button type="submit" class="btn btn-primary"> Guardar</button>
                  </div>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>