@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
    <div class="card-body">
        <div class="row invoice-info">
          <div class="col-sm-3 invoice-col">
            <strong>Nombres y Apellidos</strong><br>
               {{ $user->nombres }} {{ $user->apellidos }}
          </div>
          <div class="col-sm-3 invoice-col">
            <strong>Correo electrónico</strong>
            <br>
            {{ $user->email }}
          </div>
          <div class="col-sm-3 invoice-col">
            <strong>Tipo de usuario</strong><br>
           
            @if ( $user->hasRole('admin') )
                'Administrador'
            @elseif ($user->hasRole('asistente') )
                'Asistente Médico'
            @elseif($user->hasRole('doctor'))
                ' Médico'
            @else
            ' Paciente'                              
            @endif
          </div>
        </div>
        <br>
        <div class="row invoice-info">
          <div class="col-sm-3 invoice-col">
            <strong>Contraseña</strong><br>
            ********
          </div>
          <div class="col-sm-3 invoice-col">
            <strong>Creado</strong>
            <br>
            {{ $user->created_at }}
          </div>
          <div class="col-sm-3 invoice-col">
            <strong>Actualizado</strong><br>
            {{ $user->updated_at }}
          </div>
          
        </div>
        <br>
        <div class="row invoice-info">
          <div class="col-sm-9 invoice-col">
            <strong>Permisos del usuario</strong><br><br>
            @foreach($user->getAllPermissions() as $permission)
            <span class="badge">{{  trans(''.$permission->descripcion) }}</span>&nbsp;&nbsp;
            @endforeach
          </div>
        </div>
        <br>
        <br>
        <div class="row">
          <div class="col-md-6">
            <div class="btn-group">
            {{--   @can('EditarUsuario') --}}
            
              <a  href="{{route('admin.users.edit',$user->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
             {{--  @endcan --}}
            </div>
          </div>
        </div>
          </div>
@stop