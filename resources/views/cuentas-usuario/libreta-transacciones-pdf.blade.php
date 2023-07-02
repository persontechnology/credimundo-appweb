<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libreta</title>
    <style>
        html{
            font-size: small;
        }
        /* td{
            background-color: blue;
        } */
        td{
            padding-top: 2px;
            padding-bottom: 1px;
        }
    </style>
</head>
<body>
    <table style="width: 100%; text-align: center;">
     
       {{-- espacio de datos de persona --}}
        @if ($fila_inicial===1)
            @for ($f = 1; $f <5; $f++)
            <tr>
                <td style="text-align: left; width: 20%; color: white;">
                    .
                </td>
                <td style="text-align: center; width: 20%; color: white;">
                    .
                </td>
                <td style="text-align: center; width: 20%; color: white;">
                    .
                </td>
                <td style="text-align: right; width: 20%; color: white;">
                    .
                </td>
            </tr>
            @endfor
        @endif


        {{-- restamos espacio de acuerdo al numero de fila --}}
        @for ($i = $fila_inicial; $i < $numero; $i++)
            <tr>
                <td style="text-align: left; width: 20%; color: white;">
                    {{ $i }}
                </td>
                <td style="text-align: center; width: 20%; color: white;">
                    .
                </td>
                <td style="text-align: center; width: 20%; color: white;">
                    .
                </td>
                <td style="text-align: right; width: 20%; color: white;">
                    .
                </td>
            </tr>
        @endfor
        
        {{-- se imprime los datos --}}
        @foreach ($transacciones as $tran)
            <tr>
                <td style="text-align: left; width: 20%;">
                    {{ $tran->created_at->toDateString() }} 
                </td>
                <td style="text-align: center; width: 20%;">
                    {{ $tran->tipoTransaccion->tipo_signo }} {{ $tran->tipoTransaccion->codigo }}
                </td>
                <td style="text-align: center; width: 20%;">
                    {{ $tran->valor }}
                </td>
                <td style="text-align: right; width: 20%;">
                    {{ $tran->valor_disponible }}
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>