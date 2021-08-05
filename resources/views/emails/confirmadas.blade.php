<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Cita médica Confirmada</h1>

    <h3>Hola {{$info['paciente']}}</h3>
    <label for=""> Su cita ha sido confirmada con exito, a continuacion se detalla</label>
    <p>Médico: {{$info['medico']}}</p>
    <p>Especialidad: {{$info['especialidad']}}</p>
    <p>Fecha: {{$info['fecha']}}</p>
    <p>Hora: {{$info['hora']}}</p>

    <label for=""> No te olvides de asistir</label>
</body>
</html>