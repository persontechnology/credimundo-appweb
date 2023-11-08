<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        table, td, th {
            border: 1px solid;
            padding-left: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        .fondo {
            background-color: #0d6efd;
            color: white;
            line-height:25px;
            padding-left: 3px;
        }
    </style>
</head>
<body>
    
    <p style="text-align: right;">SALCEDO, A {{ now() }}</p>
    
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
         
            <tbody>
                <tr class="">
                    <td scope="row" style="text-align: left;">
                        <strong>Socio: </strong>{{ $cuentaUser->user->apellidos_nombres }} <br>
                        <strong>Identificación: </strong>{{ $cuentaUser->user->identificacion }}
                    </td>
                    <td style="text-align: left;">
                        <strong>Cuenta: </strong> {{ $cuentaUser->tipoCuenta->nombre }} <br>
                        <strong>N°: </strong> {{ $cuentaUser->numero_cuenta }}
                    </td>
                    <td style="text-align: left;">
                        <strong>DESDE: </strong> {{ $fecha_inicio }} <br>
                        <strong>HASTA: </strong> {{ $fecha_final }}
                    </td>
                    
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    @if ($transaciones->count()>0)
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">FECHA</th>
                        <th scope="col">DESCRIPCIÓN</th>
                        <th scope="col">VALOR</th>
                        
                    </tr>
                </thead>
                @php
                    $i=1;
                @endphp

                <tbody>
                    @foreach ($transaciones as $tra)
                    <tr class="">
                        <td scope="row">{{ $i }}</td>
                        <td>{{ $tra->created_at }}</td>
                        <td>{{ $tra->tipoTransaccion->tipo_signo }} {{ $tra->tipoTransaccion->nombre }}</td>
                        <td>{{ $tra->valor }}</td>
                    </tr>    

                    @php
                        $i++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        
    @else
        <div class="alert alert-danger" role="alert">
            <strong>NO TIENE MOVIMIENTOS</strong>
        </div>
        
    @endif
    
    
    
    
</body>
</html>