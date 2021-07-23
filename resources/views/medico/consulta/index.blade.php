@extends('adminlte::page')

@section('css')

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

@endsection



@section('content')

    <div class="card card-primary card-outline card-tabs">
      <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
         
          <li class="nav-item">
            <a class="nav-link"  data-toggle="pill" href="#signos" role="tab" >Signos Vitales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  data-toggle="pill" href="#consulta" role="tab"  >Consulta</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#tratamiento" role="tab" >Tratamiento</a>
          </li> 
        </ul>
      </div>

      <div class="card-body">
        <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade" id="signos" role="tabpanel" >
              @if (auth()->user()->hasRole('doctor') || auth()->user()->hasRole('asistente')) 
                @include('medico.consulta.tablas.signos')
              @endif
            </div>

            @if (auth()->user()->hasRole('doctor')) 
              <div class="tab-pane fade" id="consulta" role="tabpanel" >
                @include('medico.consulta.tablas.consulta')
              </div>
               <div class="tab-pane fade " id="tratamiento" role="tabpanel" >
                @include('medico.consulta.tablas.tratamiento')
              </div> 
            @endif
        </div>
      </div>
    </div>

@endsection


@section('js')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    
      $(document).ready(function() {
          $('.select').select2({
            placeholder: 'Seleccione Cie-10',
            width: '100%',
            dropdownAutoWidth : true
          });
      });
  </script>
@stop