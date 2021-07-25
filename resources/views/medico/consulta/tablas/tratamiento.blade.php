<div class="card">
    <div class="collapse show" id="collapsedos" aria-labelledby="headidos" data-parent="#accordion" style="">
      <div class="card-body">
        <form action="{{ url('') }}" method="post"> 
          @csrf
            <div class="form-group card-body table-responsive">
                <label for="receta">
                    Receta Médica
                    <div class="btn btn-success" id="btnNuevoMedicamento">Nuevo</div>
                </label>
                <table class="table table-bordered table-hover" id="tableReceta">
                    <tr>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Indicaciones</th>
                        <th>Opciones</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control">
                        </td>

                        <td>
                            <input type="text" class="form-control">
                        </td>
                        <td>
                            <input type="text" class="form-control">
                        </td>
                        <td class="text-center">
                            <div class=" btn btn-primary">Guardar </div>
                            <div class=" btn btn-danger">Eliminar </div>
                        </td>
                    </tr>
                </table>
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

{{--   <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
 --}}