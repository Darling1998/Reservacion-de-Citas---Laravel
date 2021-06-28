@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.roles.create')}}">Nuevo Rol</a>
    <h1>Lista de Roles</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
        {{session('info')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>ID</th>
                    <th>Rol</th>
                    <th colspan="2"></th>
                </thead>

                <tbody>
                    @foreach ($roles as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                <a href="{{route('admin.roles.edit',$item)}}" class="btn btn-sm btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{route('admin.roles.destroy',$item)}}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
   {{--  <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop