

<div class="card">
  <div class="card-body">
    <table class="table align-items-center table-flush" id="reservadas">
      <thead class="thead-light" >
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

{{--               @if(auth()->user()->hasRole('admin'))
                <a class="btn btn-sm btn-primary" title="Ver cita" 
                href="{{ url('/reserva/'.$cita->id) }}">
                  Ver
              </a> 
              @endif --}}
              
              @if (auth()->user()->hasRole('admin') ||auth()->user()->hasRole('doctor')) 
              <form action="{{ url('/reserva/'.$cita->id.'/confirmar') }}"
                method="POST" class="d-inline-block">
                @csrf
                <button class="btn btn-sm btn-success" type="submit" 
                  data-toggle="tooltip" title="Confirmar cita">
                  Confirmar
                </button>
              </form>
            @endif    
            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('doctor')) 
              <form action=" {{url('citas/'.$cita->id.'/cancelar') }}" 
                method="POST" class="d-inline-block">
                @csrf
    
                <button class="btn btn-sm btn-danger" type="submit" 
                  data-toggle="tooltip" title="Cancelar cita">
                  <i class="ni ni-fat-delete">Cancelar</i>
                </button>
              </form>        

            @endif 

            </td>
          </tr>
        @endforeach  
      </tbody>
    </table>
  </div>
</div>

