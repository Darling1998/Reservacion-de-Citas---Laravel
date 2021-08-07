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
{{--     <script>
        const report=Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Especialidades más demandadas'
            },
            xAxis: {
                categories: [],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                text: 'Citas Atendidas'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                pointPadding: 0.2,
                borderWidth: 0
                }
            },
            series: []
        });

        function fetchData(){
        const inicioFecha = $inicio.val();
        const finFecha = $fin.val();

        // Fetch API
        const url = `/reportes/especialidades/barras/infor?inicio=${inicioFecha}&fin=${finFecha}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
            console.log(data);
            report.xAxis[0].setCategories(data.categorias);

            if (report.series.length > 0) {
               // report.series[1].remove();            
                report.series[0].remove();
            }
            
            report.addSeries(data.series[0]); 
            report.addSeries(data.series[1]); 
            });
    }

        $(function () {
            $inicio = $('#dia_inicio');
            $fin = $('#dia_fin');

            fetchData();
            
            $inicio.change(fetchData);
            $fin.change(fetchData);
    }); 


    </script>--}}
    <script>
        $('.input-daterangeE input').each(function() {
            $(this).datepicker('clearDates');
        });

       const report= Highcharts.chart('containerEspe', {
          chart: {
              type: 'pie',
              options3d: {
                  enabled: true,
                  alpha: 45,
                  beta: 0
              }
          },
          title: {
              text: 'Especialidades más demandadas'
          },
          accessibility: {
              point: {
                  valueSuffix: '%'
              }
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  depth: 35,
                  dataLabels: {
                      enabled: true,
                      format: '{point.name}'
                  }
              }
          },
          series: [ {
              type: 'pie',
              name: 'Browser share',
              data: [
                  ['Firefox', 45.0],
                  ['IE', 26.8],
                  {
                      name: 'Chrome',
                      y: 12.8,
                      sliced: true,
                      selected: true
                  },
                  ['Safari', 8.5],
                  ['Opera', 6.2],
                  ['Others', 0.7]
              ]
          } 
        ]
      });
    
    </script>
@stop 
