@extends('adminlte::page')

@section('css')

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

@endsection



@section('content')

  <div class="card">
    <div class="card-body">
      @if (session('notificacion'))
      <div class="alert alert-success" role="alert">
        {{ session('notificacion') }}
      </div>
      @endif
    </div> 

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
          @if (auth()->user()->hasRole('doctor') || auth()->user()->hasRole('asistente')) 
            <div class="tab-pane fade" id="signos" role="tabpanel" >
                @include('medico.consulta.tablas.signos')
            </div>
          @endif
             @if (auth()->user()->hasRole('doctor')) 
              <div class="tab-pane fade active" id="consulta" role="tabpanel" >
                @include('medico.consulta.tablas.consulta')
              </div>
               <div class="tab-pane fade " id="tratamiento" role="tabpanel" >
                @include('medico.consulta.tablas.tratamiento')
              </div> 
             @endif 
        </div>
      </div>
    </div>
  </div>
  

@endsection


@section('js')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    
      $(document).ready(function() {
       
          $('.multiple-select').select2({
            placeholder: 'Seleccione Cie-10',
            width: '100%',
            theme: "classic",
            dropdownAutoWidth : true
          });
        });
 
        $('#select-diagnostico').val(@json($id_diagnosticos));
        $('#select-diagnostico').trigger('change');
        
   
  </script>
  <script>

    $( document ).ready(function(){
      $("#btnNuevoMedicamento").on('click',funcNuevoMedicamento);
      $("table").on('click',".btn-danger",functEliminarFila)
    })
  
    function functEliminarFila(){
      $(this).parent().parent().remove();
    }

    function funcNuevoMedicamento(){
      $("#tableReceta")
      .append
      (
        $('<tr>')
        .append
        (
          $('<td>')
          .append
          (
            $('<input>').attr('type','text').addClass('form-control')
          )
        )
        .append
        (
          $('<td>')
          .append
          (
            $('<input>').attr('type','text').addClass('form-control')
          )
        )
        .append
        (
          $('<td>')
          .append
          (
            $('<input>').attr('type','text').addClass('form-control')
          )
        )
        .append
        (
          $('<td>').addClass('text-center')
          .append
          (
            $('<div>').addClass('btn btn-primary').text('Guardar')
          )
          .append
          (
            $('<div>').addClass('btn btn-danger').text('Eliminar')
          )
        )
      );
    }
  
  </script>


@stop