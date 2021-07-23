<div class="card">
    <div class="collapse show" id="collapsedos" aria-labelledby="headidos" data-parent="#accordion" style="">
      <div class="card-body">
        <form action="{{ url('') }}" method="post"> 
          @csrf
            <div class="form-group card-body table-responsive">
                <label for="receta">
                    Receta Médica
                    <div class="btn btn-success">Nuevo</div>
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
                            <input type="text">
                        </td>

                        <td>
                            <input type="text">
                        </td>
                        <td>
                            <input type="text">
                        </td>
                        <td class="text-center">
                            <div class=" btn btn-primary">Guardar </div>
                            <div class=" btn btn-danger">Eliminar </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
      </div>
    </div>
  </div>
