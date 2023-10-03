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
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">WhatsApp</th>
                            <th scope="col">N° crédito</th>
                            <th scope="col">Cuenta usuario</th>
                            <th scope="col">Identificación</th>
                            <th scope="col">Apellidos & Nombres</th>
                            <th scope="col">Día de pago</th>
                            <th scope="col">Pago mensual</th>
                            <th scope="col">Pendiente</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tablas_creditos as $tc)
                        <tr class="">
                            <td scope="row">
                                <button type="button" class="btn btn-success" data-bs-popup="popover" title="Enviar este mensaje por whatsapp" data-bs-content="Estimado(a) Socio(a). {{ $tc->credito->cuentaUser->user->apellidos_nombres }}, le recordamos que su cuota de crédito de ${{ $tc->montoCobrarTablaCredito() }} vence el {{ $tc->fecha_pago }}. Evite recargos adicionales realizando el pago a tiempo. Gracias, de parte de CREDIMUNDO.">WhatsApp <i class="ph ph-whatsapp-logo ms-2"></i></button>
                            </td>
                            <td scope="row">{{ $tc->credito->numero }}</td>

                            <td>{{ $tc->credito->cuentaUser->numero_cuenta }}</td>
                            <td>{{ $tc->credito->cuentaUser->user->identificacion }}</td>
                            <td>{{ $tc->credito->cuentaUser->user->apellidos_nombres }}</td>
                            <td>{{ $tc->fecha_pago }}</td>
                            <td>{{ $tc->pago_mensual }}</td>
                            <td class="{{ $tc->montoCobrarTablaCredito()>0?'bg-danger':'' }}">{{ $tc->montoCobrarTablaCredito() }}</td>
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
