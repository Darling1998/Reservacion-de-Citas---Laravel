<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <table>
    <thead></thead>
    <tbody>
      <tr>
        <td class="border-b-4 border-grey-200 pb-5 mb-5">
            @foreach ($consultas as $item)
            <tr>
              <td>
                <table width="100%" class="mb-5" style="width:100%" border="0" cellpadding="0">

                  <table style="width: 90%" border="1">
                    <thead>
                      <tr>
                          <td><strong> APELLIDOS </strong> <br>
                            {{$paciente->persona->apellidos}}
                          </td>
                          <td> <strong>NOMBRES </strong> <br>
                            {{$paciente->persona->apellidos}}
                          </td>
                          <td rowspan="2"></td>
                          
                      </tr>
                      <tr>
                          <td> <strong>TELÉFONO </strong> <br>
                            {{$paciente->persona->telefono}}
                          </td>
                          <td> <strong>CÉDULA </strong> <br>
                            {{$paciente->persona->cedula}}
                          </td>
                      </tr>
                      <tr  colspan="2">
                          <td> <strong>DIRECCIÓN </strong><br>
                            {{$paciente->persona->direccion}}
                          </td>
                          <td> <strong>ESTADO CIVIL </strong> <br>
                              
                          </td>
                          <td> <strong>OCUPACIÓN </strong> <br>

                          </td>
                      </tr>
                    </thead>

                  </table>
               </table>

               <div><strong> Antecedentes</strong> </div>
               @foreach ($antecedentes as $item)
               <div class="markdown text-grey-700"></div>
               <label>Antecedentes Personales:{{$item->antecedentes_personales}}</label><br><br>
               <label>Historia Personal:{{$item->historia_personal}}</label><br><br>
               <label>Habitos Tóxicos:{{$item->habitos_toxicos}}</label><br><br>
               <label>Exámen Funcional:{{$item->examen_funcional}}</label><br><br>
               @endforeach
              
 
                <div><strong>Motivo de Consulta</strong> </div>
                {{$item->motivo}}
                <br>
                <div> <strong> Enfermedad Actual</strong></div>
                <br>
                <div><strong>Diagnosticos</strong> </div>



                <div style=" text-align: center;"><strong>Exámen Fisico</strong> </div>
                <label> TA:  {{$item->presion}}    mmHg   &nbsp; &nbsp; &nbsp; &nbsp;    Peso:  {{$item->peso}} kg  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;   Talla: {{$item->talla}}  cms</label>
                <br>
                <br>
                <div >FECHA:</span><span > ____________________________________</span><span>  </span><span >NOMBRE DEL MEDICO:</span><span >  ______________________1</span></div>
                <div></div>
              </td>
              
            </tr>
            
            @endforeach
        </td>
      </tr>
    </tbody>
  </table>
</body>
</html>