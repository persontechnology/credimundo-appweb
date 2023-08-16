@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('home') }}
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        CRÉDITOS PENDIENTE, ATRASADO, <small>(Vencidos o que venceran en dos días)</small>
    </div>
    <div class="card-body">
        @if ($tablas_creditos->count()>0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Mensaje</th>
                            <th scope="col">N° crédito</th>
                            <th scope="col">Cuenta usuario</th>
                            <th scope="col">Identificación</th>
                            <th scope="col">Apellidos & Nombres</th>
                            <th scope="col">Día de pago</th>
                            <th scope="col">Pago mensual</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tablas_creditos as $tc)
                        <tr class="">
                            <td scope="row" >
                                
                                <a href="">
                                    <a href="https://api.whatsapp.com/send?phone={{ $tc->credito->cuentaUser->user->telefono }}&text=Estimado(a) Socio(a). {{ $tc->credito->cuentaUser->user->apellidos_nombres }}, le recordamos que su cuota de crédito de ${{ $tc->pago_mensual }} vence el {{ $tc->fecha_pago }}. Evite cargos adicionales realizando el pago a tiempo. Gracias, de parte de CREDIMUNDO.">Enviar mensaje por WhatsApp</a>
                                </a>
                            </td>
                            <td scope="row">{{ $tc->credito->numero }}</td>

                            <td>{{ $tc->credito->cuentaUser->numero_cuenta }}</td>
                            <td>{{ $tc->credito->cuentaUser->user->identificacion }}</td>
                            <td>{{ $tc->credito->cuentaUser->user->apellidos_nombres }}</td>
                            <td>{{ $tc->fecha_pago }}</td>
                            <td>{{ $tc->pago_mensual }}</td>
                            <td>{{ $tc->estado }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        @endif
    </div>

</div>

@endsection
