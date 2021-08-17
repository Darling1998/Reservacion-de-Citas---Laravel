<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>               
   #logo {
    text-align: left;
    margin-bottom: 10px;
  }

  #logo img {
    width: 90px;
  }
  .page-break {
    page-break-after: always;
}
  </style>
</head>
  <body>  
    @foreach ($consultas as $item)
    <div style="position:absolute;left:50%;margin-left:-300px;top:0px;width:610px;height:900px" class="page-break">
      <div style="position:absolute;left:0px;top:0px">
     
        <div id="logo" >
          <img src="img/logo.png"></div>
        </div>
    
          <div style="position:absolute;left:119.65px;top:76.23px" class="cls_008"><span class="cls_008"> <strong>Historia Clínica</strong> </span></div>
        <div style="position:absolute;left:308.70px;top:84.62px" class="cls_003"><span class="cls_003"><strong>Fecha: </strong>{{$item->created_at}}</span></div>
        <div style="position:absolute;left:19.60px;top:109.42px" class="cls_003"><span class="cls_003"> <strong>Apellidos:</strong> {{$paciente->persona->apellidos}}</span></div>
        <div style="position:absolute;left:280.10px;top:109.42px" class="cls_003"><span class="cls_003"> <strong>Nombres:</strong> {{$paciente->persona->nombres}}</span></div>
        <div style="position:absolute;left:19.60px;top:135.43px" class="cls_003"><span class="cls_003"> <strong>Teléfono:</strong> {{$paciente->persona->telefono}}</span></div>
        <div style="position:absolute;left:280.10px;top:135.43px" class="cls_003"><span class="cls_003"> <strong>C.I.:</strong></span> {{$paciente->persona->cedula}}</div>
        <div style="position:absolute;left:19.60px;top:163.45px" class="cls_003"><span class="cls_003"> <strong>Dirección:</strong></span> {{$paciente->persona->direccion}}</div>
        <div style="position:absolute;left:282.50px;top:163.45px" class="cls_003"><span class="cls_003"> <strong>Estado Civil:</strong></span></div>
        <div style="position:absolute;left:444.75px;top:163.45px" class="cls_003"><span class="cls_003"> <strong>Ocupación:</strong></span></div>
    
      
      <br><br>
      <div style="position:absolute;left:35.40px;top:221.85px" class="cls_009"><span class="cls_009"><strong>MOTIVO DE CONSULTA:</strong> </span></div>
      <div style="position:absolute;left:35.40px;top:248.65px" class="cls_010"><span class="cls_010">{{$item->motivo}}</span></div>

      <div style="position:absolute;left:35.40px;top:309.28px" class="cls_009"><span class="cls_009"> <strong>ENFERMEDAD ACTUAL:</strong> </span></div>
      <div style="position:absolute;left:35.40px;top:326.08px" class="cls_010"><span class="cls_010"></span></div>

      <div style="position:absolute;left:35.40px;top:360.28px" class="cls_009"><span class="cls_009"> <strong>DIAGNOSTICO:</strong> </span></div>
      <div style="position:absolute;left:35.40px;top:380.08px" class="cls_010">
        <span class="cls_010">
          @foreach ($item->diagnosticos as $itemD)
          <div style="position:absolute;left:35.40px" class="cls_010"><span class="cls_010"></span>
            <label>{{$itemD->codigo}} - {{$itemD->descripcion}}</label><br>
          </div><br>
          @endforeach
        </span>
      </div>

      <div style="position:absolute;left:35.40px;top:420.33px" class="cls_009"><span class="cls_009"> <strong>SIGNOS VITALES:</strong> </span><br><br>
        <label> TA:  {{$item->presion}}    mmHg   &nbsp; &nbsp; &nbsp; &nbsp;    Peso:  {{$item->peso}} kg  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;   Talla: {{$item->talla}}  mts</label>
     </div>
     
      <div style="position:absolute;left:35.40px;top:630.35px" class="cls_009"> <strong>FECHA:</strong> <label>{{$item->fecha_cita}}  &nbsp; &nbsp; &nbsp; <strong>MÉDICO:</strong> {{$item->nombres}}{{$item->apellidos}} </label></div>
      </div>
            
      </div>
     
    @endforeach
  </body>
</html>