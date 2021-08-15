
 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Receta Mèdica</title>
    <style>
      .clearfix:after {
        content: "";
        display: table;
        clear: both;
      }
      a {
        color: #5D6975;
        text-decoration: underline;
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
        text-align: center;
        margin-bottom: 10px;
      }
      #logo img {
        width: 90px;
      }
      h3 {
        border-top: 1px solid  #5D6975;
        border-bottom: 1px solid  #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
        background: url(img/dimension.png);
      }
      #project {
        float: left;
      }
      #project label {
        color: #5D6975;
        text-align: right;
        width: 52px;
        margin-right: 20px;
        display: inline-block;
        font-size: 0.8em;
      }
      #company {
        float: right;
        text-align: right;
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
      table .service,
      table .desc {
        text-align: left;
      }
      table td {
        padding: 20px;
        text-align: right;
      }
      table td.service,
      table td.desc {
        vertical-align: top;
      }
      table td.unit,
      table td.qty,
      table td.total {
        font-size: 1.2em;
      }
      table td.grand {
        border-top: 1px solid #5D6975;;
      }
      #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
      }
      footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
      }
      .center {
        margin-left: auto;
        margin-right: auto;
      }
    </style>
  </head>
  <body>
    
    <header class="clearfix">
      <div id="logo">
        <img src="img/logo.png">
        <h4>Dr:{{$infoMedico->apellidos}}{{$infoMedico->nombres}}</h4>
      </div>
      <h3>Receta Médica</h3>
      <div id="project">
        
        <div> <strong>Fecha: </strong>  {{$hora->fecha}} {{$hora->hora}}</div>
        <div> <strong> Paciente: </strong>{{$infoPaciente->nombres}}{{$infoPaciente->apellidos}}</div>
        <div> <strong>Cédula: </strong> {{$infoPaciente->cedula}}</div>
        <div> <strong>Diagnosticos: </strong></div>
          <br>
          @foreach ($diagnosticos as $item)
          <div> {{$item->codigo}}-{{$item->descripcion}}</div>    
          @endforeach
      </div>

    </header>
    <label style="color: red; text-align:left;">RP</label>
    <table class="center">
      <thead>
        <tr>
          <th class="service">DESCRIPCION</th>
          <th class="desc">CANTIDAD</th>
          <th class="desc">INDICACIONES</th>
        </tr>
        
      </thead>
      <tbody>
       
        @foreach ($medicamentos as $item)
        <tr>
          <td class="service">{{$item->descripcion}} {{$item->forma_farmaceutica}}</td>
          <td class="desc">{{$item->cantidad}}</td>
          <td style="text-align:left;">{{$item->indicaciones}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>


    <footer>
     Guayaquil-Ecuador
    </footer>
  </body>
</html> 


