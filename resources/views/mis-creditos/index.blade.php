@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('home') }}
@endsection

@section('content')



@if ($misCreditos->count()>0)
<div class="mb-3 mt-2">
    <h6 class="mb-0">Creditos entregados {{ $misCreditos->count() }}</h6>
</div>
<div class="row">
    @foreach ($misCreditos as $mc)
    <div class="col-lg-12">
        <div class="card border border-dark shadow-sm">
            <div class="card-header bg-dark text-white border-bottom-0">
                <h6 class="mb-0">{{ $mc->tipoCredito->nombre }}</h6>
                <h6 class="mb-0">$ {{ $mc->monto }}</h6>
            </div>

            <div class="card-body">
                <p>DÍA DE PAGO: <strong>{{ Carbon\Carbon::parse($mc->dia_pago)->format('d') }}</strong></p>
                <p>FECHA DE VENCIMIENTO: <strong>{{ $mc->fecha_vencimiento }}</strong></p>
                <p>NÚMERO DE CUOTAS: <strong>{{ $mc->numero_cuotas }}</strong></p>
                <p>PAGO MENSUAL: <strong>${{ $mc->pago_mensual }}</strong></p>
            </div>

            <div class="card-footer text-muted">
                @if ($mc->tablaCreditos->count()>0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">FECHA DE PAGO</th>
                                    <th scope="col">PAGO MENSUAL</th>
                                    <th scope="col">INTERES</th>
                                    <th scope="col">SALDO CAPITAL</th>
                                    <th scope="col">TOTAL</th>
                                    <th scope="col">ESTADO</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mc->tablaCreditos as $tc)
                                <tr class="">
                                    <td scope="row">{{ $tc->numero_pago }}</td>
                                    <td>{{ $tc->fecha_pago }}</td>
                                    <td>{{ $tc->pago_mensual }}</td>
                                    <td>{{ $tc->interes }}</td>
                                    <td>{{ $tc->saldo_capital }}</td>
                                    <td>{{ $tc->total }}</td>
                                    <td>{{ $tc->estado }}</td>
                                </tr>    
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="alert alert-primary" role="alert">
    <strong>NO DISPONE DE CRÉDITOS</strong>
</div>

@endif


@endsection


@push('scripts')
    
    
  

@endpush
