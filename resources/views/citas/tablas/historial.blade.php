<div class="table-responsive">
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">Especialidad</th>
          <th scope="col">Fecha</th>
          <th scope="col">Hora</th>
             {{-- @if ($role == 1 || $role == 2)
            <th scope="col">Estado</th>
            @endif
             --}}
             <th scope="col">Estado</th>
             <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
         @foreach ($citasViejas as $cita)
        <tr>
          <td>
            {{ $cita->especialidad->nombre }}
          </td>
          <td>
            {{ $cita->fecha_cita }}
          </td>
          <td>
            {{ $cita->hora_cita }}
          </td>
          <td>
            @if ( $cita->estado  == "C")
              Confirmada 
            @elseif($cita->estado  == "A")  
              Atendida
            @endif
          
          </td>
          <td>
              <a class="btn btn-sm btn-primary" title="Ver cita" 
                href="{{ url('/citas/'.$cita->id) }}">
                  Ver
              </a>
          </td>
        </tr>
        @endforeach 
      </tbody>
    </table>
  </div>
