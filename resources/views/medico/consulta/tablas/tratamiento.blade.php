<div class="card">
  

  <div class="card-body">
    @if (session('alerta'))
    <div class="alert alert-success" role="alert">
      {{ session('alerta') }}
      <a href="{{ url('receta/imprimir/'.$consulta->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-print fa-sm text-white-50"></i>
        Imprimir
      </a>
    </div>
    @endif
  </div> 


    <div class="collapse show" id="collapsedos" aria-labelledby="headidos" data-parent="#accordion" style="">
      <div class="card-body">
        <form action="{{ url('consulta/receta') }}" method="post" class="formulario-receta"> 
          
          @csrf
          <input  name="consulta_id" type="hidden" value="{{$consulta->id}}"> 
            <div class="form-group card-body table-responsive">
                <label for="receta">
                    Receta Médica
                    <div class="btn btn-success" id="btnNuevoMedicamento">Nuevo</div>
                </label>
                <table class="table table-bordered table-hover" id="tableReceta">
                    <tr>
                        <th>Nombre Medicamento</th>
                        <th>Cantidad</th>
                        <th>Indicaciones</th>
                        <th>Opciones</th>
                    </tr>
                    <tr>
                        <td>
                        
                          <select class="js-example-basic-single" name="medicamentos[]">
                      
                              @foreach ($medicamentos as $item)
                              <option value="{{$item->id}}">{{$item->descripcion}} - {{$item->forma_farmaceutica}} - {{$item->concentracion}}</option>
                              @endforeach
                            
                            </select>
                          </select>
                      
                      
                        </td>

                        <td>
                            <input type="text" class="form-control" name="cantidad[]">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="indicaciones[]">
                        </td>
                        <td class="text-center">
                            
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

  <div class="modal fade" id="myModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Default Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h5 class="text-center">Formula Medica Registrada</h5>
          <span class="alert-success" role="alert">  </span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="imprimirreceta('129323','2021-08-04','12:35:17');">IMPRIMIR</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetearNuevo();">CERRAR</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>