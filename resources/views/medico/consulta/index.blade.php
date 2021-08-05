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

    <div class="card card-primary card-outline">
      <div class="card-header row align-items-center">
        <h3 class="card-title">
            @foreach ($info as $item)
            <div class="card-body ">
              <h3> {{$item->nombres}} {{$item->apellidos}}</h3>
            </div>
            @endforeach
        </h3>
        <div class="col text-right">
          <form action="{{ url('consulta/terminar') }}" method="post"> 
              @csrf
            <input type="hidden" name="cita_id" value="{{$citas->cita_id}}">
             <button type="submit" class="btn btn-sm btn-danger">
                 Terminar Consulta
             </button>
         </form>
        </div>
      </div>

      <div class="card-body">
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active"  data-toggle="pill" href="#signos" role="tab" >Signos Vitales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  data-toggle="pill" href="#consulta" role="tab"  >Consulta</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#tratamiento" role="tab" >Tratamiento</a>
          </li> 
        </ul>
        <div class="tab-content" id="custom-tabs-three-tabContent">
          @if (auth()->user()->hasRole('doctor') || auth()->user()->hasRole('asistente')) 
            <div class="tab-pane fade show active" id="signos" role="tabpanel" >
                @include('medico.consulta.tablas.signos')
            </div>
          @endif
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
  </div>
  

@endsection


@section('js')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            $('<input>').attr('type','text').addClass('form-control').attr('name','descripcion[]')
          )
        )
        .append
        (
          $('<td>')
          .append
          (
            $('<input>').attr('type','text').addClass('form-control').attr('name','cantidad[]')
          )
        )
        .append
        (
          $('<td>')
          .append
          (
            $('<input>').attr('type','text').addClass('form-control').attr('name','indicaciones[]')
          )
        )
        .append
        (
          $('<td>').addClass('text-center')
          .append
          (
            $('<div>').addClass('btn btn-danger').text('Eliminar')
          )
        )
      );
    }
  
  </script>

  
{{--     @if (session('receta')=='Ok')
    <script>
      Swal.fire(
        'Creada',
        '',
        'success'
      )
    </script>

      
  @endif --}}

  <script>
    $('.formulario-receta').submit(function(e){
      e.preventDefault();
      Swal.fire({
        title: 'Crear Receta?',
        /* text: "You won't be able to revert this!", */
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si,Imprimir!'
      }).then((result) => {

        if(result.value){
          this.submit();
        }
      })
    })
  </script>


@stop

