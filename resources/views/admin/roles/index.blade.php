@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.roles.create')}}">Nuevo Rol</a>
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Administrar Roles</h1>
            </div>
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
