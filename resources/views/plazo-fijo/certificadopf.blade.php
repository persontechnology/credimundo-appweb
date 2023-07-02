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
            text-align: left;
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
    
    <h2 style="text-align: center;">CERTIFICADO DEPOSITO PLAZO FIJO: N° {{ $plazoFijo->numero }}</h2>
   
    <p><strong>A FAVOR DE: {{ $plazoFijo->cuentaUser->user->apellidos_nombres }}</strong></p>
    
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
            <thead>
                <tr style="text-align: left;">
                    <td scope="col">
                        <strong>N° de Certificado P.F: </strong> {{ $plazoFijo->numero }} <br>
                        <strong>N° de Cuenta: </strong> {{ $plazoFijo->cuentaUser->numero_cuenta }} {{ $plazoFijo->cuentaUser->tipoCuenta->nombre }}<br>
                        <strong>Socio: </strong> {{ $plazoFijo->cuentaUser->user->identificacion }} {{ $plazoFijo->cuentaUser->user->apellidos_nombres }} <br>
                        <strong>Asesor: </strong> {{ $plazoFijo->creadoPor->apellidos_nombres }} <br>
                        <strong>Monto capital: </strong> {{ number_format($plazoFijo->monto,2) }} <br>
                        <strong>Rendimiento: </strong> {{ number_format($plazoFijo->interes_total,2) }} <br>
                        <strong>Total a recibir: </strong> {{ number_format($plazoFijo->pago_total,2) }}
                    </td>
                    <td scope="col">
                        <strong>Día de Pago: </strong>{{ Carbon\Carbon::parse($plazoFijo->dia_pago)->format('d'); }} <br>
                        <strong>Fecha de Vencimiento: </strong>{{ $plazoFijo->fecha_vencimiento}} <br>
                        <strong>Tasa Efectiva Anual: </strong>{{ $plazoFijo->tasa_efectiva_anual }}% <br>
                        <strong>Plazo:</strong> {{ $plazoFijo->plazo }}<br>
                        <strong>Fecha entrega: </strong>{{ $plazoFijo->fecha_entregado }} <br>
                        <strong>Tipo de pago: </strong>{{ $plazoFijo->tipo_pago }} <br>
                        <strong>Estado: </strong>{{ $plazoFijo->estado }}
                    </td>
                </tr>
            </thead>
        </table>
    </div>
    <p>
        El presente Certificado de Depósito a Plazo Fijo se encuentra protegido por la cobertura del Seguro del Depósito hasta el monto determinado por la Corporación del Seguro del Depósito y bajo las condiciones establecidas en la Ley.
    </p>

    <table>
        <tr>
            <td>
                <strong>CERTIFICADO DEL CLIENTE</strong> <br>
                Declaro expresamente y bajo juramento que la información detallada en este documento es verídica y que el origen y procedencia de recursos que poseo, los que depósito directa o indirectamente en {{ config('app.name','........................') }}, controlada por la Superintendencia de Bancos, son lícitos, no provienen ni serán destinados a ninguna actividad ílicita tipificada en la ley Orgánica de Prevención, Detección y Erradicación del Delito de lavados de Activos y Financiamiento de Delitos, autorizo a que se pueda confirmar toda esta información por el medio que la institución considere pertinente, e informar a la autoridad competente cuando sea necesario.
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <strong>TÉRMINOS</strong> <br>
                1. El presente certificado está sujeto a las normas del Código Orgánico Monetarió Y Financiero, Resoluciones de la junta de Política y Regulación Monetaria y Financiera y demás normativa pertinente. <br>
                2. El valor del capital de l ainversión, será pagado al vencimiento del plazo establecido. <br>
                3. El socio podrá cobrar los intereses generados en la inversión al vencimiento o de acuerdo al período de pago de interés establecido. <br>
                4. Este certificado de Depósito a Plazo Fijo es nominativo y su Cesión de Derechos surtirá efecto, desde la aceptación y registros en {{ config('app.name','.............') }}. <br>
                5. El Depósito a Plazo Fijo se sujeta al porcentaje de retención tributaria vigente para rendimientos financieros establecidos en la Ley. <br>
                <strong>CONDICIONES</strong> <br>
                1. Una vez cumplido el plazo del certificado de depósito, éste no generara intereses. Si el cliente no comunica a {{ config('app.name','.....................') }}, las instrucciones de renovación o cancelación de este certificado, se procederá a renovarlo dos días después de su vencimiento bajo las mismas condiciones establecidads al momento de la emisión de la inversión; excepto la tasa de interés, en este caso se aplicará la tasa que se encuentra vigente al momento de la renovación. <br>
                2. El presente certificaco del depósito a plazo fijo no podrá ser cancelado ni total ni parcialmente en forma ancticipada a su vencimiento, salvo definiciones particulares establecidads por parte de {{ config('app.name','............................') }} en su normativa interna. <br>
                3. En cas de robo, pérdida o destrucción de este certificado, el cliente deberá notificar inmediatamente sobre el particular a {{ config('app.name','..............................') }} y realizar el trámite respectivo. <br>
                4. {{ config('app.name','.............') }}, se exime de responsabilidad por cualquier inconveniente o reclamo que se pueda surgir por la pérdida, destrucción o robo de este certificado de depósito. <br>
                <strong>
                    Autoriza(amos) a {{ config('app.name','......................') }} a disponer de los recursos provenientes de esta inversión o cualquier reinversión, para abonar o cancelar las obligaciones impagas que por cualquier motivo mantengan(mos) con {{ config('app.name','.................') }}. <br>
                    Declaro(mos) que acepto(amos) los términos y condiciones del presente documento (anverso y reverso), de los cuales he(mos) sido informado(s).
                </strong>

            </td>
        </tr>
    </table>
    <table style="border: none;">
        <tr style="border: none;">
            <td style="border: none;">
                <br><br><br>
                .......................................................................................... <br>
                FIRMA AUTORIZADA <br> 
                {{ config('app.name','............') }}
                <br>
                <strong>RUC:0503652349001</strong> <br>
                .
            </td>  
            <td style="border: none;">
                <br><br><br>
                .......................................................................................... <br>
                FIRMA DEL SOCIO <br>
                {{ $plazoFijo->cuentaUser->user->apellidos_nombres }} <br>
                {{ $plazoFijo->cuentaUser->user->identificacion }} <br>
                <strong>Socio</strong>
            </td>
            
              
            
            
        </tr>
    </table>
    
   

</body>
</html>