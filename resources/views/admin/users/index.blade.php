@extends('adminlte::page')

@section('title', 'Usuarios')


@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.users.create')}}">Nuevo Usuario</a>
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Lista de Usuarios</h1>
            </div>
          </div>
        </div>
    </div>
@stop

@section('content')
  <div class="card-body">
    @if (session('notificacion'))
      <div class="alert alert-success" role="alert">
        {{ session('notificacion') }}
      </div>
    @endif
  </div> 
    @livewire('admin.users-index')
@stop

