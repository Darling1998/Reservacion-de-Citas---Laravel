<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


    <h1>Cita médica reservada</h1>

    <h3>Hola {{$info['paciente']}}</h3>
    <label for=""> Su cita ha sido reservada con exito, a continuacion se detalla</label>
    <p>{{$info['hora']}}</p>
    <p>{{$info['especialidad']}}</p>

    <p>{{$info['medico']}}</p>
    <p>{{$info['fecha']}}</p>

    <label for=""> Espere que su medico confirme la misma</label>
</body>

</html>