
<div class="table-responsive">
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
            <th scope="col"></th>
          <th scope="col">Descripción</th>
          <th scope="col">Especialidad</th>
         {{--  @if ($role == 2) 
            <th scope="col">Paciente</th>
           @endif  --}}
          <th scope="col">Fecha</th>
          <th scope="col">Hora</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
         @foreach ($citasPendientes as $cita)
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
            {{--@if ($role == 2)
              <td>{{ $cita->paciente->name }}</td>
            @endif --}}
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
            </td>
          </tr>
        @endforeach  
      </tbody>
    </table>
</div>