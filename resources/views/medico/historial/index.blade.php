@extends('adminlte::page')

@section('title', 'Servi Natal')


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    
@stop


@section('content_header')
<div class="card-header border-0">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0">Consulta el historial clinico</h3>
        </div>

    </div>
</div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
           
            <table class="table align-items-center table-flush" id="historial">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Cédula</th>
                        <th scope="col">Nombres/Apellidos</th>
                        <th scope="col">Motivo Consulta</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($historia as $item)
                        <tr>
                            <th scope="row">
                                {{$item->cedula}}
                            </th>
                            <td scope="row">
                                {{$item->nombres}}
                            </td>
                            <td>
                                {{$item->motivo}}
                            </td>
                            <td>
                                {{$item->fecha}}
                            </td>
                            <td>
                                <form action="{{ url('/historia-pdf') }}" method="post" target="_blank">
                                    
                                    @csrf
                                    <input  name="cedula" type="hidden" value="{{$item->cedula}}"> 
                                    <input  name="cita_id" type="hidden" value="{{$item->cita_id}}"> 
                                    
                                    <button type="submit" class="btn btn-primary">  <i class="fas fa-cloud-download-alt"></i></button>
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
         $('#historial').DataTable({
             responsive:true,
             autoWidth:false,
             "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nada encontrado - disculpa",
                "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search":"Buscar:",
                "searchPlaceholder": "Cédula, Nombres",
                "paginate":{
                    "next":"Siguiente",
                    "previous":"Anterior"
                }
            }
         });
    </script>
@stop
