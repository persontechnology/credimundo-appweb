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

<div class="table-responsive" style="margin-top: 5px;">
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th scope="col">Neto:</th>
                <th scope="col">Pago Mensual:</th>
                <th scope="col">Número de cuotas:</th>
                <th scope="col">Interés Total:</th>
                <th scope="col">Pago Total:</th>
                <th scope="col">Tipo pago:</th>
            </tr>
        </thead>
        <tbody>
            <tr class="">
                <td>{{ $plazoFijo->neto_recibir }}</td>
                <td>{{ $plazoFijo->pago_mensual }}</td>
                <td>{{ $plazoFijo->numero_cuotas }}</td>
                <td>{{ $plazoFijo->interes_total }}</td>
                <td>{{ $plazoFijo->pago_total }}</td>
                <td>{{ $plazoFijo->tipo_pago }}</td>
            </tr>
            
        </tbody>
    </table>
</div>

<div class="table-responsive mt-2" style="margin-top: 5px;">
    <table class="table table-sm table-bordered">
        
        <tbody>
            <tr>
                <th>#</th>
                <th>Fecha de pago</th>
                <th>Pago mensual</th>
                <th>Interés</th>
                <th>Total de pago</th>
                <th>Saldo capital</th>
                <th>Total</th>
                <th>Estado</th>
            </tr>
            @foreach ($plazoFijo->tablaPlazoFijo as $tc)
            <tr class="">
                <td>{{ $tc->numero_pago }}</td>
                <td>{{ $tc->fecha_pago }}</td>
                <td>{{ $tc->pago_mensual }}</td>
                <td>{{ $tc->interes }}</td>
                <td>{{ $tc->total_de_pago }}</td>
                <td>{{ $tc->saldo_capital }}</td>
                <td>{{ $tc->total }}</td>
                <td>{{ $tc->estado }}</td>
            </tr>    
            @endforeach
            
        </tbody>
    </table>
</div>

<div class="notas-aclaratorias">
    <p>Firman:</p>

    <table style="border: none; text-align: center;" class="table">
        <tr style="border: none;">
            <td style="border: none;">
                <br><br><br>
                .......................................................................................... <br>
                {{ $plazoFijo->cuentaUser->user->apellidos_nombres }} <br>
                {{ $plazoFijo->cuentaUser->user->identificacion }} <br>
                <strong>SOCIO</strong>
            </td>
            @if ($plazoFijo->cuentaUser->user->nombre_conyuge)
                <td style="border: none;">
                    <br><br><br>
                    .......................................................................................... <br>
                    {{ $plazoFijo->cuentaUser->user->nombre_conyuge }} <br>
                    {{ $plazoFijo->cuentaUser->user->identificacion_conyuge }} <br>
                    <strong>CONYUGE</strong>
                </td>  
            @endif
            
        </tr>
    </table>
    <div style="text-align: center;">
                
        <div class="col">
            <br><br><br>
            .......................................................................................... <br>
            {{ $plazoFijo->creadoPor->apellidos_nombres }} <br>
            {{ $plazoFijo->creadoPor->identificacion }} <br>
            <strong>Asistente de negocio</strong>
        </div>
    </div>
</div>