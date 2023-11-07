@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('home') }}
@endsection

@section('content')



@if ($misCuentas->count()>0)
<div class="mb-3 mt-2">
    <h6 class="mb-0">Cuentas activas {{ $misCuentas->count() }}</h6>
</div>
<div class="row">
    @foreach ($misCuentas as $mc)
    <div class="col-lg-6">
        <div class="card border border-dark shadow-sm">
            <div class="card-header bg-dark text-white border-bottom-0">
                <h6 class="mb-0">{{ $mc->tipoCuenta->nombre }}</h6>
                <h6 class="mb-0">{{ $mc->numero_cuenta }}</h6>
            </div>

            <div class="card-body">
                <p>Valor disponible:</p>
                <h1>
                    <strong>${{ $mc->valor_disponible }}</strong>
                </h1>
                @if ($mc->transacciones)
                <div class="table-responsive text-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Fecha</th>
                                <th scope="col">Transacción</th>
                                <th scope="col">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mc->transaccionesSocio as $transacion)
                                

                                <tr class="">
                                    <td scope="row">{{ $transacion->created_at }}</td>
                                    <td>{{ $transacion->tipoTransaccion->nombre }}</td>
                                    <td>
                                        <strong class="{{ $transacion->tipoTransaccion->tipo_signo=='+'?'text-success':'text-danger' }}">
                                            {{ $transacion->tipoTransaccion->tipo_signo }}{{ $transacion->valor }}
                                        </strong>
                                    </td>
                                </tr>
                            @endforeach

                            
                        </tbody>
                    </table>
                </div>
                
                    <div class="list-group">
                        
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="alert alert-primary" role="alert">
    <strong>NO DISPONE DE CUENTAS ACTIVAS</strong>
</div>

@endif




@endsection
