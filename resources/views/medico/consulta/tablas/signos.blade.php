 <div class="card">
    <div class="collapse show" id="collapsedos" aria-labelledby="headidos" data-parent="#accordion" style="">
      <div class="card-body">
        <form action="{{ url('consulta/signos') }}" method="post"> 
          @csrf
          <div class="form-row">
            <div class="form-group col-md-3">
              <label class="col-form-label"><strong>Talla:</strong></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <img src="https://image.flaticon.com/icons/png/512/3209/3209114.png" {{-- class="rounded-circle" --}} width="30px" height="30px">
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="12 Cm" id="talla" name="talla" minlength="1" maxlength="6" pattern="\S[0-9A-Za-z, ]{1,6}" required="">
              </div>
            </div>
            <div class="form-group col-md-3">
              <label class="col-form-label"><strong>Peso:</strong></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <img src="https://image.flaticon.com/icons/png/512/2865/2865378.png" {{-- class="rounded-circle" --}} width="30px" height="30px">
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="55,5 Kg" id="peso" name="peso" minlength="1" maxlength="8" pattern="\S[A-Za-z0-9,. ]{1,8}" required="">
              </div>
            </div>
            <div class="form-group col-md-3">
              <label class="col-form-label"><strong>TA:</strong></label> {{-- Presion Arterial --}}
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <img src="https://image.flaticon.com/icons/png/512/884/884028.png" {{-- class="rounded-circle" --}} width="30px" height="30px">
                  </span>
                </div>
                <input type="text" class="form-control" name="ta"  required="">
              </div>
            </div>
            <div class="form-group col-md-3">
              <label class="col-form-label"><strong>T°:</strong></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <img src="https://image.flaticon.com/icons/png/512/2316/2316581.png" {{-- class="rounded-circle" --}} width="30px" height="30px">
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="36°" name="temperatura" minlength="1" maxlength="6" pattern="\S[A-Za-z0-9,. ]{1,6}" required="">
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label class="col-form-label"><strong>Observación:</strong></label>
              <textarea class="form-control"  name="dexamen"></textarea>
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