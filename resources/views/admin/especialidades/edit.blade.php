@extends('adminlte::page')

@section('title', 'Citas')


@section('content')
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar Especialidad</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('especialidades')}}" class="btn btn-sm btn-primary">Cancelar</a>
                </div>
            </div>
        </div>

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
{{--             <form action="{{url('especialidades/'.$especialidad->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre de la especialidad</label>
                    <input type="text" name="nombre" class="form-control" required value="{{ old('nombre',$especialidad->nombre)}}"></input>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion',$especialidad->descripcion)}}"></input>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form> --}}  
        </div>

    </div>
@stop