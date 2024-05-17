@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('mis-creditos') }}
@endsection

@section('content')




@if ($misCreditos->count()>0)
<div class="mb-3 mt-2">
    <h6 class="mb-0">Creditos entregados {{ $misCreditos->count() }}</h6>
</div>
<div class="row">
    @foreach ($misCreditos as $mc)
    <div class="col-lg-12" >
        <div class="card animate__animated animate__pulse">
            <div class="card-header border-bottom-0">
                <h6 class="mb-0">CRÉDITO {{ $mc->tipoCredito->nombre }}</h6>
                <p class="mb-0"><strong>MONTO:</strong> ${{ $mc->monto }}</p>
                <p class="mb-0"><strong>DÍA DE PAGO:</strong> {{ Carbon\Carbon::parse($mc->dia_pago)->format('d') }}</p>
                <p class="mb-0"><strong>FECHA DE VENCIMIENTO:</strong> {{ $mc->fecha_vencimiento }}</p>
                <p class="mb-0"><strong>NÚMERO DE CUOTAS:</strong> {{ $mc->numero_cuotas }}</p>
                <p class="mb-0"><strong>PAGO MENSUAL:</strong> ${{ $mc->pago_mensual }}</p>
              
            </div>

            <div class="card-body">
                @if ($mc->tablaCreditos->count()>0)
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">N°</th>
                                <th class="text-center" scope="col">FECHA DE PAGO</th>
                                <th class="text-center" scope="col">PAGO MENSUAL</th>
                                <th class="text-center" scope="col">INTERES</th>
                                <th class="text-center" scope="col">SALDO CAPITAL</th>
                                <th class="text-center bg-primary fw-bold" scope="col">PRECANCELAR</th>
                                <th class="text-center" scope="col">ESTADO</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mc->tablaCreditos->where('estado','!=','PAGADO') as $tc)
                            <tr class="">
                                <td class="text-center" scope="row">{{ $tc->numero_pago }}</td>
                                <td class="text-center">{{ $tc->fecha_pago }}</td>
                                <td class="text-center">{{ $tc->pago_mensual }}</td>
                                <td class="text-center">{{ $tc->interes }}</td>
                                <td class="text-center">{{ $tc->saldo_capital }}</td>
                                <td class="text-center bg-primary fw-bold">{{ $tc->total }}</td>
                                <td class="text-center">{{ $tc->estado }}</td>
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
