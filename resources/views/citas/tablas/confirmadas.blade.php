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
              {{--  @if ($role == 1) 
                <a class="btn btn-sm btn-primary" title="Ver cita" 
                  href="{{ url('/citas/'.$cita->id) }}">
                    Ver
                </a> 
              @endif  --}}
              <a class="btn btn-sm btn-danger" title="Cancelar cita" 
                href="{{ url('/citas/'.$cita->id.'/cancelar') }}">
                  Cancelar
              </a>

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

            </td>
          </tr>
       @endforeach  
     </tbody>
    </table>
  </div>
</div>