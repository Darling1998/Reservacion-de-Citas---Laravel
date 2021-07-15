@extends('adminlte::page')

@section('title', 'Citas')


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
