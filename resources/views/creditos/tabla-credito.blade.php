<div class="table-responsive">
    <table class="table table-sm table-bordered">
        <thead>
            <tr style="text-align: left;">
                <td scope="col">
                    <strong>N° de Crédito: </strong> {{ $credito->numero }} <br>
                    <strong>N° de Cuenta: </strong> {{ $credito->cuentaUser->numero_cuenta }} {{ $credito->cuentaUser->tipoCuenta->nombre }}<br>
                    <strong>Socio: </strong> {{ $credito->cuentaUser->user->identificacion }} {{ $credito->cuentaUser->user->apellidos_nombres }} <br>
                    <strong>Tipo de Crédito: </strong> {{ $credito->tipoCredito->nombre }} <br>
                    <strong>Asesor: </strong> {{ $credito->creadoPor->apellidos_nombres }} <br>
                    <strong>Monto Financiado: </strong> {{ number_format($credito->monto,2) }} <br>
                    <strong>Actividad: </strong> <small>{{ $credito->actividad }}</small> <br>
                </td>
                <td scope="col">
                    <strong>Día de Pago: </strong>{{ Carbon\Carbon::parse($credito->dia_pago)->format('d'); }} <br>
                    <strong>Fecha de Vencimiento: </strong>{{ $credito->fecha_vencimiento }} <br>
                    <strong>Tasa Efectiva Anual: </strong>{{ $credito->tasa_efectiva_anual }}% <br>
                    <strong>Plazo:</strong> {{ $credito->plazo }}<br>
                    <strong>Adjudicación: </strong>{{ $credito->created_at->format('Y-m-d') }} <br>
                    <strong>Tasa nominal: </strong>{{ $credito->tasa_nominal }}% <br>
                    <strong>Estado: </strong>{{ $credito->estado }}
                </td>
            </tr>
        </thead>
    </table>
</div>

<div class="table-responsive" style="margin-top: 5px;">
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th scope="col">Neto a recibir:</th>
                <th scope="col">Pago Mensual:</th>
                <th scope="col">Número de cuotas:</th>
                <th scope="col">Pago Total:</th>
                <th scope="col">Interés Total:</th>
                <th scope="col">Total Certificado plazo fijo</th>
            </tr>
        </thead>
        <tbody>
            <tr class="">
                <td>{{ $credito->neto_recibir }}</td>
                <td>{{ $credito->pago_mensual }}</td>
                <td>{{ $credito->numero_cuotas }}</td>
                <td>{{ $credito->pago_total }}</td>
                <td>{{ $credito->interes_total }}</td>
                <td>{{ $credito->total_certificado_plazo_fijo }}</td>
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
            @foreach ($credito->tablaCreditos as $tc)
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
                {{ $credito->cuentaUser->user->apellidos_nombres }} <br>
                {{ $credito->cuentaUser->user->identificacion }} <br>
                <strong>SOCIO</strong>
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
        
        @if ($credito->garantes->count()>0)
        
            @foreach ($credito->garantes as $ga)
                <div class="col">
                    <br><br><br>
                    .......................................................................................... <br>
                    {{ $ga->apellidos_nombres }} <br>
                    {{ $ga->identificacion }} <br>
                    <strong>Garante</strong>
                </div>
            @endforeach
        @endif
        
        <div class="col">
            <br><br><br>
            .......................................................................................... <br>
            {{ $credito->creadoPor->apellidos_nombres }} <br>
            {{ $credito->creadoPor->identificacion }} <br>
            <strong>Asistente de negocio</strong>
        </div>
    </div>
</div>