<!DOCTYPE html>
<html lang="en">
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
    
    <h2 style="text-align: center;">Debito de Seguro de Crédito en su Préstamo</h2>
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
         
            <tbody>
                <tr class="">
                    <td scope="row" style="text-align: left;">
                        <strong>Socio: </strong>{{ $credito->cuentaUser->user->apellidos_nombres }} <br>
                        <strong>Identificación: </strong>{{ $credito->cuentaUser->user->identificacion }}
                    </td>
                    <td style="text-align: left;">
                        <strong>Cuenta: </strong> {{ $credito->cuentaUser->tipoCuenta->nombre }} <br>
                        <strong>N°: </strong> {{ $credito->cuentaUser->numero_cuenta }}
                    </td>
                    <td><strong>N° RFR-CREDITO: </strong>{{ $credito->numero }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <p>
        Estimado(a), {{ $credito->cuentaUser->user->apellidos_nombres }}.
    </p>
    <p>
        Esperamos que se encuentre bien. En referencia a su solicitud de préstamo realizada a {{ config('app.name','CREDIMUNDO') }}, nos complace informarle que su solicitud ha sido aprobada y que hemos desembolsado el monto de su préstamo de $ {{ $credito->monto }} a su cuenta {{ $credito->cuentaUser->tipoCuenta->nombre }}, N° {{ $credito->cuentaUser->numero_cuenta }}
    </p>
    <p>
        Dentro de los términos y condiciones de su préstamo, hemos aplicado un seguro de crédito para proteger tanto su inversión como la de {{ config('app.name','CREDIMUNDO') }} en caso de situaciones imprevistas, como incapacidad, enfermedad, muerte u otras circunstancias específicas que puedan afectar su capacidad de pago.
    </p>
    <p>
        En cumplimiento con los términos del seguro de crédito y de acuerdo con los detalles establecidos en el contrato de préstamo, hemos debitado un porcentaje del valor financiado para cubrir el costo del seguro. El porcentaje específico aplicado en su caso es del {{ $credito->seguro_credito }}% sobre el monto total del préstamo de ${{ $credito->monto }}. Por lo tanto, el monto total del seguro de crédito debitado es de ${{ $credito->total_seguro_credito }}.
    </p>
    <p>
        El saldo restante del préstamo, después de la deducción del seguro y/o otros, es de ${{ $credito->neto_recibir }}. Su plan de pago mensual se basará en este saldo ajustado.
    </p>
    <p>
        Le recordamos que esta medida es parte de nuestro compromiso de proteger tanto su inversión como la de {{ config('app.name','CREDIMUNDO') }} y asegurar que pueda enfrentar situaciones imprevistas de manera más segura.
    </p>
    <p>
        Por favor, no dude en ponerse en contacto con nosotros si tiene alguna pregunta o necesita más información sobre su préstamo, los términos del seguro de crédito o cualquier otro aspecto relacionado con sus servicios financieros con la {{ config('app.name','CREDIMUNDO') }}.
    </p>
    <p>
        {{ $credito->creadoPor->canton??'SALCEDO' }}, {{ $credito->created_at->toDateString() }}
    </p>
    
    <table style="border: none;">
        <tr style="border: none;">
            <td style="border: none;">
                <br><br><br>
                .......................................................................................... <br>
                {{ $credito->cuentaUser->user->apellidos_nombres }} <br>
                {{ $credito->cuentaUser->user->identificacion }} <br>
                <strong>Socio</strong>
            </td>
            @if ($credito->cuentaUser->user->nombre_conyuge)
            <td style="border: none;">
                <br><br><br>
                .......................................................................................... <br>
                {{ $credito->cuentaUser->user->nombre_conyuge }} <br>
                {{ $credito->cuentaUser->user->identificacion_conyuge }} <br>
                <strong>CONYUGE</strong>
            </td>    
            @endif
            
        </tr>
    </table>

    <div style="text-align: center;">
        
        
        
        <div class="col">
            <br><br><br>
            .......................................................................................... <br>
            {{ $credito->creadoPor->apellidos_nombres }} <br>
            {{ $credito->creadoPor->identificacion }} <br>
            <strong>Asistente de negocio</strong>
        </div>
    </div>
    
</body>
</html>