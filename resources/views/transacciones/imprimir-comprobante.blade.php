<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'Comprobante N° '.$trans->numero }}</title>
    <style>
        html{
            font-size: small;
        }
    </style>
</head>
<body>
    <p style="padding-top: 2px;">
        {{ Str::limit($trans->tipoTransaccion->nombre,30,'') }}<br>
        {{ $trans->cuentaUser->tipoCuenta->codigo }}: {{ $trans->cuentaUser->numero_cuenta }} <br>
        SOCIO: {{ $trans->cuentaUser->user->identificacion }} {{ Str::limit($trans->cuentaUser->user->apellidos_nombres.'',30,'.') }} <br>
        DOCUMENTO: {{ $trans->numero }} <br>
        OFICINA: {{ $trans->creadoPor->canton }} <br>
        FECHA: {{ $trans->created_at->toDateString() }} <br>
        VALOR:  {{ $trans->valor }} <br>
        DISPONIBLE: {{ $trans->cuentaUser->valor_disponible }} <br>
        USUARIO: {{ Str::limit($trans->creadoPor->name,30,'') }} <br>
        @if ($trans->quien_realiza_transaccion==='otro')
            XDNI: {{ $trans->identificacion_otra_persona }} 
            {{ Str::limit($trans->nombre_otra_persona.'', 30, '') }} <br>
        @endif
        @foreach ($ultimos_trans as $ultr)
                {{ $ultr->created_at->toDateString() }}
                {{ $ultr->tipoTransaccion->tipo==='SUMAR'?'+':'-' }}{{ $ultr->tipoTransaccion->codigo }}
                V: {{ $ultr->valor_efectivo }}
                D: {{ $ultr->valor_disponible }} 
        <br>
        @endforeach
    </p>
</body>
</html>