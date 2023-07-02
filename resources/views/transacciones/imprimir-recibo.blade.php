<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'Recibo N° '.$trans->numero }}</title>
    <style>
        html{
            font-size: small;
        }
    </style>
</head>
<body>
    <div style="align-items: center">
        <p style="text-align: center">
            <img src="{{ public_path('img/logo.png') }}" alt="" width="220px">
        </p>
        <p>
            {{ Str::limit($trans->tipoTransaccion->nombre,30,'.') }} <br>
            {{ Str::limit($trans->cuentaUser->tipoCuenta->nombre,30,'.') }} <br>
            DNI: {{ Str::mask($trans->cuentaUser->user->identificacion, '.', -4) }} <br>
            NOMBRE: {{ Str::limit($trans->cuentaUser->user->apellidos_nombres,30,'.') }} <br>
            DOCUMENTO: {{ $trans->numero }} <br>
            OFICINA: {{ Str::limit($trans->creadoPor->canton,30,'.') }} <br>
            FECHA: {{ $trans->created_at->toDateString() }} <br>
            USUARIO: {{ Str::limit($trans->creadoPor->name,30,'') }} <br>
            VALOR:{{ $trans->valor }}
            @if ($trans->quien_realiza_transaccion==='otro')
            <br>
            XDNI: {{ Str::mask($trans->identificacion_otra_persona, '.', -4) }} <br>
            XNOMBRE:{{ Str::limit($trans->nombre_otra_persona, 7, '...') }}
            @endif
        </p>
    </div>
</body>
</html>