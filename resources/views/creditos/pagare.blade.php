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
    
    <h2 style="text-align: center;">PAGARE A LA ORDEN</h2>
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
         
            <tbody>
                <tr class="">
                    <td scope="row"><strong>Por $: </strong>{{ number_format($credito->monto,2) }}</td>
                    <td><strong>N° cuenta: </strong> {{ $credito->cuentaUser->numero_cuenta }}</td>
                    <td><strong>N° RFR-CREDITO: </strong>{{ $credito->numero }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p>
        Debo(emos) y pagaré(mos), solidariamente a <strong>{{ $credito->numero_cuotas }} </strong> cuotas fijas; en la cuidad de <strong>{{ $credito->creadoPor->canton??'SALCEDO' }}</strong> o en el lugar donde se me(nos) solicite, a la orden de <strong>{{ config('app.name','CREDIMUNDO') }}</strong>, la cantidad de
        <strong>${{ number_format($credito->monto,2) }}</strong> Dólares de los Estados Unidos de América, por igual valor recibido de dicha institución Financiera, en moneda de curso legal que la he(mos) recibido para invirtirla en actividad <strong>{{ $credito->actividad }}</strong>.
    </p>
    <p>
        El pago se realizara cada <strong>{{ Carbon\Carbon::parse($credito->dia_pago)->format('d'); }}</strong> días, mediante <strong>{{ $credito->numero_cuotas }}</strong> cuotas fijas de <strong>${{ $credito->pago_mensual }}</strong> Dólares de los Estados Unidos de América, que incluye el capital y el interes del <strong>%{{ $credito->tasa_efectiva_anual }}</strong> por ciento anual.
    </p>
    <p>
        En caso de mora reconoceré(mos) el interés de 1.1 veces de la tasa activa hasta la cancelación total.
    </p>
    <p>
        En caso de variación de las tasas de interés me(nos) allano(nanos) expresamente a dichos cambios.
    </p>
    <p>
        El deudor tiene el derecho de pagar anticipadamente la totalidad de lo adeudado o realizar prepagos parciales en cantidades mayores a una cuota; en este caso serán cuotas completas.
    </p>
    <p>
        {{ config('app.name','CREDIMUNDO') }} podrá declarar vencidos los plazos de esta obligación y proceder al cobro inmediato en caso de incumplimiento en el pago de una o más cuotas, o haverse comprobado que el destino del dinero no ha sido el que se encuentra estipulado en este Contrato.
    </p>
    <p>
        Autorizo(amos) a la {{ config('app.name','CREDIMUNDO') }} debitar de los certificados de aportación y de nuestra(s) cuenta(s) de ahorros, los valores correspondientes a intereses y cuotas vencidas para acreditar a la presente obligación, así como tasas y gastos judiciales y extrajudiciales que ocasionaren, bastando para determinar el monto de tales gastos la sola aseveración del Acreedor.
    </p>
    <p>
        En caso de jucio me(nos) someto(temos) a los jueces del lugar que elija el acreedor, asi como el trámite ejecutivo o verbal sumario, para cuyo efecto renuncio(amos) fuero y domicilio.
    </p>
    <p>
        SIN PROTESTO. Exímise la presentación para el pago, asi como avisos por falta de este hecho.
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
    
    <p>
        En esta misma fecha GARANTIZO(AMOS) el cumplimiento de las obligaciones contantes en el pagaré que antecede, en iguales términos y condiciones, contituyéndome(nos) en aval(es) solidario(s) del deudor.
    </p>
    <p>
        Eximo(imos) al acreedor de la obligación de formalizar el protesto y estipulo(amos) expresamente que al tenedor no podrá ser obligado a recibir el pago por partes, ni aún por mis(nuestros) herederos.
    </p>

    @foreach ($credito->garantes as $ga)
        <div class="col" style="text-align: center;">
            <br><br><br>
            .......................................................................................... <br>
            {{ $ga->apellidos_nombres }} <br>
            {{ $ga->identificacion }} <br>
            <strong>Garante</strong>
        </div>
    @endforeach
</body>
</html>