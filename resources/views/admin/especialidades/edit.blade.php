@extends('adminlte::page')

@section('title', 'Especialidades')

@section('content_header')
<div class="card-header border-0">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0">Editar Especialidad</h3>
        </div>
        <div class="col text-right">
            <a href="{{url('especialidades')}}" class="btn btn-sm btn-danger">Cancelar y volver</a>
        </div>
    </div>
</div>
@stop


@section('content')
   @if (session('info'))
      <div class="alert alert-success">
         {{session('info')}}
      </div>
   @endif
   <div class="card">
      <div class="card-body">
         {!! Form::model($especialidade, ['route'=>['admin.especialidades.update',$especialidade],'method'=>'put']) !!}

            @include('admin.especialidades.parciales.form')
            {!! Form::submit('Editar Especialidad', ['class'=>'btn btn-primary']) !!}

         {!! Form::close() !!}
      </div>
   </div>
@stop
