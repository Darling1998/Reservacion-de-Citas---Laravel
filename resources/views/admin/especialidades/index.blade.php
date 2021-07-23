@extends('adminlte::page')

@section('title', 'Especialidades')


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    
@stop


@section('content_header')
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Especialidades</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('especialidades/create')}}" class="btn btn-sm btn-primary">Agregar Especialidad</a>
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
            <table class=" table1 table align-items-center table-flush" id="especialidades">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($especialidades as $especialidad)
                        <tr>
                            <td>{{$especialidad->nombre}}</td>
                            <td>{{$especialidad->descripcion}}</td>
                            <td>
                                <a href="{{route('admin.especialidades.edit',$especialidad)}}" class="btn btn-sm btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{route('admin.especialidades.destroy',$especialidad)}}" method="POST">
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

@section('js')
     <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    


    <script>
         $('#especialidades').DataTable({
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

