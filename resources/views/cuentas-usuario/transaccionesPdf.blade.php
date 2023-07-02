<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'Cuenta N° '.$cuentaUser->numero }} {{ $cuentaUser->user->apellidos_nombres }}</title>
    <style>
        html{
            font-size: small;
        }
        table{
            width: 100%
        }
    </style>
</head>
<body>
    <div>
        <table>
            @for ($i = 0; $i < 165; $i++)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endfor
            @foreach ($transacciones as $tran)
                <tr>
                    <td style="width: 20%;">{{ $tran->created_at->toDateString() }}</td>
                    <td style="width: 20%;">{{ $tran->tipoTransaccion->codigo }}</td>
                    <td style="width: 20%; text-align: center;">{{ $tran->valor_efectivo }}</td>
                    <td style="width: 20%; text-align: center;">{{ $tran->valor_disponible }}</td>
                    <td style="width: 20%; text-align: right;">{{ $tran->cuentaUser->valor_disponible }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>