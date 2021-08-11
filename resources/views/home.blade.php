@extends('adminlte::page')

@section('title', 'Servi Natal')

@section('content_header')
    
@stop

@section('content')
  @if (auth()->user()->hasRole('admin'))
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Usuarios Registrados</span>
            <span class="info-box-number">
             {{$users}}
             
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-nurse"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Médicos</span>
            <span class="info-box-number">{{$medicos}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-stethoscope"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Especialidades</span>
            <span class="info-box-number">{{$especialidades}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-injured"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Pacientes</span>
            <span class="info-box-number">{{$pacientes}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-7">
        <!-- MAP & BOX PANE -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Notificaciones General</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="card shadow">
                <div class="card-body">
                @if (session('notification'))
                  <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                  </div>
                @endif
        
                  <form action="{{ url('correo/comunicar') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="title">Asunto</label>
                      <input value="" type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="form-group">
                      <label for="body">Mensaje</label>
                      <textarea name="body" id="body" rows="2" class="form-control" required></textarea>
                    </div>
                    <button class="btn btn-primary">Enviar notificación</button>
                  </form>
                </div>
              </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->


      </div>
      <!-- /.col -->

      <div class="col-md-5">
        <!-- DIRECT CHAT -->
        <div class="card direct-chat direct-chat-warning">
          <div class="card-header">
            <h3 class="card-title">Afluencia por Día</h3>

            <div class="card-tools">

              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div>
              <canvas id="myChart"></canvas>
            </div>
                         
          </div>
          <!-- /.card-body -->
          <!-- /.card-footer-->
        </div>
        <!--/.direct-chat -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Citas en Curso</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Paciente</th>
                  <th>Especialidad</th>
                  
                </tr>
                </thead>
                <tbody>

                  @foreach ($citasCurso as $item)
                  <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->nombres}} {{$item->apellidos}}</td>
                    <td><span class="badge badge-success">{{$item->nombreEspe}}</span></td>
                  </tr>
                  @endforeach
               

                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <!-- /.card-footer -->
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title"></h5>
        <p class="card-text"><strong>Bienvendos al sistema ServiNatal.</strong></p>
                    
    </div>
  </div>

  @endif 


 @stop




 @section('css')
   
@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
  const labels = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
  const data = {
    labels: labels,
    datasets: [{
      label: 'Citas por Semana',
      data: @JSON($citasPorDia),
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
  };


  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };
    
  var myChart = new Chart(
     document.getElementById('myChart'),
     config
  );
  </script>
@stop