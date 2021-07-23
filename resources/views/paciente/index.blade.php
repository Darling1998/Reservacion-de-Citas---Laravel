@extends('adminlte::page')

@section('title', 'Pacientes')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    
@stop

@section('content_header')
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Pacientes</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('pacientes/create')}}" class="btn btn-sm btn-primary">Nuevo Paciente</a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (session('notificacion'))
            <div class="alert alert-success" role="alert">
              {{ session('notificacion') }}
            </div>
            @endif
        </div> 

       <div class="card-body">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id="pacientes">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Cédula</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach( $pacientes as $item)
                    <tr>
                        <th scope="row">
                            {{$item->nombres}}
                        </th>
                        <th scope="row">
                            {{$item->apellidos}}
                        </th>
                        <td>
                            {{$item->cedula}}
                        </td>
                        <td>
                            {{$item->email}}
                        </td>
                        <td>
                            
                            <form action="{{url('/pacientes/'.$item->id)}}" method="POST">
                                @csrf
                                @method('DELETE')                            
                                <a href="{{url('/pacientes/'.$item->id.'/edit')}}" class="btn btn-sm btn-success">Editar</a>
                            <button href="" class="btn btn-sm btn-danger" type="submit">Eliminar</button>
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
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    


    <script>
         $('#pacientes').DataTable({
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

