@extends('adminlte::page')

@section('title', 'Servi Natal')

@section('content_header')
    
@stop

@section('content')
    <div class="card">
        <div class="card-content">
            <label for="">Bienvenidos al sistema de Servi Natal</label>
        </div>
  </div>
@stop

@section('css')
   {{--  <link rel="stylesheet" href="/css/admin_custom.css"> --}}
   <style>
       .box {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .box div {
            width: 100px;
            height: 100px;
        }
   </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop