

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
            
        }
        
    </style>
</head>
<body>
    
        <p style="text-align: right;">Fecha de apertura: {{ $cuentaUser->created_at }}</p>
        <p>
            Mg. Ing. David Criollo <br>
            Presidente de 
            {{ config('app.name','CREDIMUNDO') }} <br>
            <strong>Presente</strong>
        </p>
        <p>Estimado Presidente:</p>
        <p>
            Por la presente me permito solicitar mi incorporación como Socio de <strong>{{ config('app.name','CREDIMUNDO') }}</strong>, para lo cual indico a continuación los antecedentes necesarios, declarando, desde luego, que me comprometo a respetar y a aplicar los Estatutos de la Institución.
        </p>
        
        
        <table>
            <thead>
                <tr>
                    <th scope="col" colspan="3">DATOS DE LA CUENTA</th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td scope="row">
                        <strong>Nombre de cuenta:</strong> {{ $cuentaUser->tipoCuenta->nombre }}
                    </td>
                    <td colspan="2">
                        <strong>N°:</strong> {{ $cuentaUser->numero_cuenta }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Valor apertura:</strong> $ {{ $cuentaUser->valor_apertura }}
                    </td>
                    <td>
                        <strong>Valor débito:</strong> $ {{ $cuentaUser->valor_debito }}
                    </td>
                    <td>
                        <strong>Saldo para socio:</strong> $ {{ $cuentaUser->valor_apertura-$cuentaUser->valor_debito }}
                    </td>
                </tr>
            </tbody>
        </table>
        
        <br>
        
        <table>
            <thead>
                <tr>
                    <th colspan="3">
                        ANTECEDENTES DEL SOCIO
                    </th>
                </tr>
                <tr>
                    <td scope="col" colspan="3"><strong>Apellidos y Nombres:</strong> {{ $user->apellidos_nombres }}</td>
                    
                    
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td scope="row">
                        <strong>Identificación:</strong> {{ $user->identificacion }}
                    </td>
                    <td>
                        <strong>Sexo:</strong> {{ $user->sexo }}
                    </td>
                    <td>
                        <strong>Celular:</strong> {{ $user->celular }}
                    </td>
                </tr>
                <tr class="">
                    <td scope="row">
                        <strong>Provincia:</strong> {{ $user->provincia }}
                    </td>
                    <td>
                        <strong>Cantón:</strong> {{ $user->canton }}
                    </td>
                    <td>
                        <strong>Parroquía:</strong> {{ $user->parroquia }}
                    </td>
                </tr>
                <tr class="">
                    <td scope="row">
                        <strong>Recinto, referencia:</strong> {{ $user->recinto }}
                    </td>
                    <td colspan="2">
                        <strong>Dirección:</strong> {{ $user->direccion }}
                    </td>
                </tr>
                <tr class="">
                    <td scope="row">
                        <strong>Nacionalidad:</strong> {{ $user->nacionalidad }}
                    </td>
                    <td colspan="2">
                        <strong>Estado civil:</strong> {{ $user->estado_civil }}
                    </td>
                </tr>
                <tr class="">
                    <td scope="row">
                        <strong>Email:</strong> {{ $user->email }}
                    </td>
                    <td colspan="2">
                        <strong>Teléfono:</strong> {{ $user->telefono }}
                    </td>
                </tr>
                <tr class="">
                    <td scope="row">
                        <strong>Lugar de nacimiento:</strong> {{ $user->lugar_nacimiento }}
                    </td>
                    <td colspan="2">
                        <strong>Fecha de nacimiento:</strong> {{ $user->fecha_nacimiento }}
                    </td>
                </tr>
                <tr>
                    <th colspan="3">
                        DATOS DEL CONYUGE
                    </th>
                </tr>
                <tr class="">
                    <td scope="row">
                        <strong>Apellidos y Nombres:</strong> {{ $user->nombre_conyuge }}
                    </td>
                    <td>
                        <strong>Identificación:</strong> {{ $user->identificacion_conyuge }}
                    </td>
                    <td>
                        <strong>Celular:</strong> {{ $user->celular_conyuge }}
                    </td>
                </tr>
                <tr>
                    <th colspan="3">
                        DATOS DEL REPRESENTANTE EN CASO DE FALLECIMIENTO
                    </th>
                </tr>
                <tr class="">
                    <td scope="row" colspan="2">
                        <strong>Apellidos y Nombres:</strong> {{ $user->nombre_representante }}
                    </td>
                    <td>
                        <strong>Identificacion:</strong> {{ $user->identificacion_representante }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Parentesco:</strong> {{ $user->parentesco_representante }}
                    </td>
                    <td>
                        <strong>Celular:</strong> {{ $user->celular_representante }}
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <p>
            Declaro que los fondos recibidos y entregados del <strong>{{ config('app.name','') }}</strong>, provienen y serán utilizados en actividades lícitas y no serán destinados a la realización o financiamiento de alguna actividad ilícita.
        </p>
        <p>          
            Saluda a usted muy atentamente,
        </p>
        <p style="padding-top: 15px; text-align: center;">
            <br><br>
            .................................................................... <br>
            Firma socio <br>
            <strong>{{ $user->apellidos_nombres }}</strong> <br>
            <strong>DNI:{{ $user->identificacion }}</strong>
        </p>
        <br>
        <br>
        <br>
        <p>
            <strong>Para el socio:</strong> <br>
            1. Con este documento prosiga a cancelar $<strong>{{ $cuentaUser->valor_apertura }} </strong> en la caja, retire su nueva libreta junto con el recibo. <br>
            2. Acerque a información para activar su cuenta.            
        </p>
   
</body>
</html>