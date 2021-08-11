@extends('adminlte::page')

@section('title', 'Servi Natal')


@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

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
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">Frecuencia de Citas</h3>
           
          </div>
        </div>
        <div class="card-body">
            <div id="container">

            </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card">
        <div class="card-header border-0">
          <div class="input-group input-daterange">
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
          <div id="containerM">

          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
    
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <figure class="highcharts-figure">
            <div id="containerEspe"></div>
        </figure>
        </div>
      </div>
    </div>
    
  </div>

    

@stop

@section('css')
   
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


    {{-- citas --}}
    <script  defer>
        Highcharts.chart('container', {

            title: {
                text: 'Citas registradas mensualmente'
            },
            yAxis: {
                title: {
                    text: 'Número de citas'
                }
            },

            xAxis: {
                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
                
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    
                }
            },

            series: [{
                name: 'Citas registradas',
                data: @JSON($cantidades)
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    </script>

  {{-- medicos --}}
    <script>
        $.fn.datepicker.defaults.format = "yyyy-mm-dd"; 
      $('.input-daterange input').each(function() {
        $(this).datepicker('clearDates');
      });
      const report=Highcharts.chart('containerM', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Médicos más Activos'
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
            colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
            series: []
        });

      let $inicio, $fin;

      function fetchData() {
      const inicioFecha = $inicio.val();
      const finFecha = $fin.val();

      // Fetch API
      const url = `/reportes/medicos/barras/infor?inicio=${inicioFecha}&fin=${finFecha}`;

      fetch(url)
          .then(response => response.json())
          .then(data => {
          // console.log(data);
              report.xAxis[0].setCategories(data.categorias);

              if (report.series.length > 0) {
                  report.series[1].remove();            
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
    </script>

  {{-- especialidades --}}
  <script>
    array=@JSON($especial);
    console.log(array)
    Highcharts.chart('containerEspe', {
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
      colors: [ '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4','#058DC7', '#50B432', '#ED561B',],
      series: [ {
          type: 'pie',
          name: 'Porcentaje',
          data: array,
      } 
    ]
  });

</script>


 
@endsection