@extends('adminlte::page')

@section('title', 'Citas')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    
@stop

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Mis citas</h3>
        </div>
      </div>
    </div>
    <div class="card-body">
      @if (session('notificacion'))
      <div class="alert alert-success" role="alert">
        {{ session('notificacion') }}
      </div>
      @endif

      <ul class="nav nav-tabs" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="pill" href="#citas-confirmadas" role="tab" >
            Mis próximas citas
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#citas-pendientes-por-confirmar" role="tab" >
            Citas por confirmar
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#historial-citas" role="tab" >
            Historial de citas
          </a>
        </li>
      </ul>
    </div>    

    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="citas-confirmadas" role="tabpanel">
        @include('citas.tablas.confirmadas')
       
      </div>
      <div class="tab-pane fade" id="citas-pendientes-por-confirmar" role="tabpanel">
        @include('citas.tablas.pendientes')
      
      </div>
       <div class="tab-pane fade" id="historial-citas" role="tabpanel">
         @include('citas.tablas.historial')
      
      </div> 
    </div> 
    
  </div>
@stop


@section('js')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    


    <script>
      $('#confirmadas').DataTable({
          responsive:true,
          autoWidth:false,
          "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search":"Buscar:",
            "paginate":{
                "next":"Siguiente",
                "previous":"Anterior"
            }
        }
      });
    </script>

    <script>
      $('#reservadas').DataTable({
          responsive:true,
          autoWidth:false,
          "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search":"Buscar:",
            "paginate":{
                "next":"Siguiente",
                "previous":"Anterior"
            }
        }
      });
    </script>

    <script>
      $('#historial').DataTable({
          responsive:true,
          autoWidth:false,
          "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search":"Buscar:",
            "paginate":{
                "next":"Siguiente",
                "previous":"Anterior"
            }
        }
      });
    </script>
@stop
