<div class="card">

  <div class="card-body">
    <table class="table align-items-center table-flush" id="confirmadas">
      <thead class="thead-light">
        <tr>
          <th scope="col"></th>
          <th scope="col">Descripción</th>
          <th scope="col">Especialidad</th>
          @if (auth()->user()->hasRole('doctor'))
            <th scope="col">Paciente</th>
          @endif  
          <th scope="col">Fecha</th>
          <th scope="col">Hora</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($citasConfirmadas as $cita)
          <tr>
            <td>
              <label  class="custom-control custom-checkbox">
                  <input type="checkbox" name="" value="">
                  <span class="custom-toggle-slider rounded-circle"></span>
              </label>
            </td>
            <th scope="row">
              {{ $cita->descripcion }}
            </th>
            <td>
              {{ $cita->especialidad->nombre }}
            </td>
            @if (auth()->user()->hasRole('doctor'))
              <td>{{ $cita->paciente->persona->nombres}} {{ $cita->paciente->persona->apellidos }}</td>
            @endif 
            <td>
              {{ $cita->fecha_cita }}
            </td>
            <td>
              {{ $cita->hora_cita }}
            </td>

            <td>

              @if (auth()->user()->hasRole('asistente') ) 
              <a class="btn btn-sm btn-primary" title="Registrar Signos" href="{{url('signos/consulta/'.$cita->id.'/create')}}">
                Registrar Signos
              </a> 
              @endif  

              @if (auth()->user()->hasRole('doctor') ) 
              <a class="btn btn-sm btn-primary" title="Ir a Consulta"  href="{{url('/consulta/'.$cita->id.'/edit')}}">
                Ir a Consulta
              </a> 
              @endif  
              @if (auth()->user()->hasRole('doctor') ||auth()->user()->hasRole('admin')  ) 
              <a class="btn btn-sm btn-danger" title="Cancelar cita" 
              href="{{ url('/citas/'.$cita->id.'/cancelar') }}">
                Cancelar
              </a> 

              @endif  
            </td>
          </tr>
       @endforeach  
     </tbody>
    </table>
  </div>
</div>

{{-- 
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form  method="POST" id="formCancel">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Seguro Desea Cancelar esta Cita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Describe el motivo de la cancelación</label>
              <textarea class="form-control" name="motivo_cancel"required rows="3"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      </form>
  </div>
</div>


<script >
  

   function obtenrIDModal(id){
    var url='{{url("/citas/'+id+'/cancelar")}}';
    $('#formCancel').attr("action",url)
   }
</script> --}}