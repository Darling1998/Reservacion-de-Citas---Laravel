@extends('adminlte::page')

@section('title', 'Servi Natal')

@section('content_header')
<div class="card-header border-0">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0">Historial de Mediciones</h3>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Peso</h3>
                    
                    </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                    <th scope="col">Fecha</th>
                                 
                                    <th scope="col">Peso(UM)</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($consultas as $item)
                                        <tr>
                                            <td>{{$item->fecha_cita}}</td>
                                            <td>{{$item->peso}} Kg</td>
                                        </tr>
                                    @endforeach
                                   

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <figure class="highcharts-figure">
                            <div id="containerPeso"></div>
                           
                        </figure>
                        
                        
                       
                    </div>
                </div>
            </div>

           
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                    <h3 class="card-title">Estatura</h3>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                <th scope="col">Fecha</th>
                                <th scope="col">Estatura(Cm)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultas as $item)
                                <tr>
                                    <td>{{$item->fecha_cita}}</td>
                                    <td>{{$item->estatura}} cm</td>
                                </tr>
                            @endforeach
                           

                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="containerEstatura"></div>
                           
                        </figure>
                    </div>
                </div>
            </div>
        </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
@stop

@section('css')

@stop

@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    {{-- PESO --}}
    <script>
        pesos=@JSON($dataPoints);
      
      
            Highcharts.chart('containerPeso', {

            title: {
            text: 'Solar Employment Growth by Sector, 2010-2016'
            },

            subtitle: {
            text: 'Source: thesolarfoundation.com'
            },

            xAxis: {
                accessibility: {
                    rangeDescription: 'Range: 2010 to 2017'
                }
            },
            yAxis: {
            title: {
                text: 'Number of Employees'
            }
            },


            legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
            },

            plotOptions: {
            series:[ pesos]
            },

         
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


    {{--ESTATURA--}}
    <script>
        Highcharts.chart('containerEstatura', {

        title: {
        text: 'Solar Employment Growth by Sector, 2010-2016'
        },

        subtitle: {
        text: 'Source: thesolarfoundation.com'
        },

        yAxis: {
        title: {
            text: 'Number of Employees'
        }
        },

        xAxis: {
            accessibility: {
                rangeDescription: 'Range: 2010 to 2017'
            }
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
            pointStart: 2010
        }
        },

        series: [{
        name: 'Installation',
        data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
        }, {
        name: 'Manufacturing',
        data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
        }, {
        name: 'Sales & Distribution',
        data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
        }, {
        name: 'Project Development',
        data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
        }, {
        name: 'Other',
        data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
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
@endsection