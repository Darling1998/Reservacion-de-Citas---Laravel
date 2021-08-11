
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width" />
        <title>Historial Clinico</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" 
            integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
            <style>
                .clearfix:after {
                  content: "";
                  display: table;
                  clear: both;
                }
                body {
                  position: relative;
                  width: 20cm;  
                  height: 26.7cm; 
                  margin: 0 auto; 
                  color: #001028;
                  background: #FFFFFF; 
                  font-family: Arial, sans-serif; 
                  font-size: 12px; 
                  font-family: Arial;
                }
                header {
                  padding: 10px 0;
                  margin-bottom: 30px;
                }
                #logo {
                  text-align: left;
                  margin-bottom: 10px;
                }
                #hed{
                  text-align: center;
                }
                #logo img {
                  width: 90px;
                }

                table {
                  width: 100%;
                  border-collapse: collapse;
                  border-spacing: 0;
                  margin-bottom: 20px;
                }
                table tr:nth-child(2n-1) td {
                  background: #F5F5F5;
                }
                table th,
                table td {
                  text-align: center;
                }
                table th {
                  padding: 5px 20px;
                  color: #5D6975;
                  border-bottom: 1px solid #C1CED9;
                  white-space: nowrap;        
                  font-weight: normal;
                }
                table td {
                  padding: 20px;
                  text-align: right;
                }
                               
              </style>
    </head>
      {{--     <body>
        <div class="container body-content">
            <div class="container">
                <div class="row justify-content-end" style="padding-top:10px;">
                    <h1></h1>
                </div>
                <div class="row" style="padding-top:10px;">
                    <div class="col-6" style="padding-top:10px;">
                        <img witdth="100px" height="100px"src="{{ public_path('img/logo.png') }}" />
                    </div>
                </div>

         
                <table>
                    <tbody>
                        <tr>
                            Nombres y Apellidos: {{$infoPaciente->nombres}}{{$infoPaciente->apellidos}}
                        </tr>
                    </tbody>
                </table>
        
                
                
            </div>
        </div>
     </body> --}}

    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="img/logo.png">
            </div>
            <div id=hed>
                <strong>HISTORIA CLINICA</strong>
            </div>
    
        </header>
    
        <table style="width: 90%" border="1">
            <thead>
                <tr>
                    <th><strong> APELLIDOS </strong> <br>
                        {{$infoPaciente->apellidos}}
                    </th>
                    <th> <strong>NOMBRES </strong> <br>
                        {{$infoPaciente->nombres}}
                    </th>
                    <td rowspan="2"></td>
                    
                </tr>
                <tr>
                    <th> <strong>TELÉFONO </strong> <br>
                        {{$infoPaciente->telefono}}
                    </th>
                    <th> <strong>CÉDULA </strong> <br>
                        {{$infoPaciente->cedula}}
                    </th>
                </tr>
                <tr  colspan="2">
                    <th> <strong>DIRECCIÓN </strong><br>
                        {{$infoPaciente->direccion}}
                    </th>
                    <th> <strong>ESTADO CIVIL </strong> <br>
                        
                    </th>
                    <th> <strong>OCUPACIÓN </strong> <br>

                    </th>
                </tr>
            </thead>
        </table>
        <div><strong>MOTIVO DE CONSULTA</strong></div>
        <div class="row">
          <div>
              <label for=""> {{$consult->motivo}}</label>
          </div>
          <br>
          <br>
        </div>
        <div><strong>Enfermedad Actual</strong></div>
          <div class="row">
            <div>
                <label for=""> </label>
            </div>
            <br>
            <br>
          </div>
        <div><strong>DIAGNOSTICOS</strong></div>
        <div class="row">
            <div>
                @foreach ($diagnosticos as $item)
                    <label>  {{$item->codigo}} {{$item->descripcion}}</label> <br>
                @endforeach
            </div>
            <br><br>
            <br><br>
        </div>
       
        
        <footer>
          <div class="row">
            <table>
              <tr>
                <th> <strong>Fecha:</strong> {{$consult->fecha}} </th>
                <th> <strong> Nombre Médico:</strong>  {{$infoC->nombres}} {{$infoC->apellidos}}</th>
              </tr>
            </table>
          </div>
        </footer>

      </body>
</html>
