<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .titulo{
            text-align: center
        }
    </style>
</head>
<body>
    <div class="titulo"> <h1> Receta Medica</h1></div>
    <table>
        <thead>
            <th>
                <td></td>
                <td>Cantidad</td>
                <td>Medicamento</td>
                <td>Indicaciones</td>
            </th>
        </thead>


        <tbody>
            @foreach ($medicamentos as $aux=> $item)
                <tr>
                    <td>{{$aux}}</td>
                    <td>{{$item->cantidad}}</td>
                    <td>{{$item->nombre_medicamento}}</td>
                    <td>{{$item->indicaciones}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>