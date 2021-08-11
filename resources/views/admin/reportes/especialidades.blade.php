@extends('adminlte::page')

@section('title', 'Servi Natal')


@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Reportes</h1>
      </div>
    </div>
  </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header border-0">
        <div class="input-group input-daterangeE">
            <div class="input-group-prepend">
            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
            </div>
            <input id="dia_inicio" type="text" class="form-control" value="{{$inicio}}"  placeholder="Fecha Inicio">
                <div class="input-group-addon">Hasta</div>
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
            </div>
                <input type="text"  placeholder="Fecha Fin" class="form-control"  value="{{$fin}}" id="dia_fin">
            </div>
        </div>
        
        <div class="card-body">
        <figure class="highcharts-figure">
            <div id="containerEspe"></div>
        </figure>
        </div>
    </div>

@stop

 @section('js')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="https://code.highcharts.com/highcharts.js"></script>
 <script src="https://code.highcharts.com/modules/series-label.js"></script>
 <script src="https://code.highcharts.com/modules/exporting.js"></script>
 <script src="https://code.highcharts.com/modules/export-data.js"></script>
 <script src="https://code.highcharts.com/modules/accessibility.js"></script>

@stop 
