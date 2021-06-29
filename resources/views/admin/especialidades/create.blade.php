@extends('adminlte::page')

@section('title', 'Especialidades')


@section('content_header')

    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nueva Especialidad</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('especialidades')}}" class="btn btn-sm btn-primary">Cancelar y Volver</a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if( $errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!! Form::open(['route'=>'admin.especialidades.store']) !!}

                @include('admin.especialidades.parciales.form')
            {!! Form::submit('Crear Especialidad', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>

    </div>
@stop
