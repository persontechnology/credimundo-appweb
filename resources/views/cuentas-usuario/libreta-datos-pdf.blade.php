<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libreta</title>
    <style>
        html{
            font-size: medium;
        }
    </style>
</head>
<body>
    <table style="width: 100%;">
        
        <tr>
            <td style="text-align: right;">{{ $cuentaUser->numero_cuenta }}</td>
        </tr>
        <tr>
            <td style="text-align: right;">{{ Str::limit($cuentaUser->user->apellidos,15,'') }} {{ Str::limit($cuentaUser->user->nombres,10,'') }}</td>
        </tr>
        <tr>
            <td style="text-align: right;">{{ $cuentaUser->user->identificacion }}</td>
        </tr>
        
    </table>
</body>
</html>