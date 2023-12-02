@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('mis-cuentas') }}
@endsection

@section('content')



@if ($misCuentas->count()>0)
<div class="mb-3 mt-2">
    <h6 class="mb-0">Cuentas activas {{ $misCuentas->count() }}</h6>
</div>
<div class="row">
    @foreach ($misCuentas as $mc)
    <div class="col-lg-6">
        <div class="card border  shadow-sm">
            <div class="card-header bg-primary text-white border-bottom-0">
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
                    <table class="table table-sm table-bordered">
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
                @endif
            </div>

            <div class="card-footer text-muted">
                <form action="{{ route('enviar-mas-movimietos-correo') }}" method="POST" autocomplete="off" id="formMasMovimientos">
                    @csrf
                    <strong>Ver más movimientos</strong>
                    <input type="hidden" name="cuentaUser" id="" value="{{ $mc->id }}">
                    <div class="form-floating form-control-feedback form-control-feedback-start m-1">
                        <div class="form-control-feedback-icon">
                            <i class="ph-calendar"></i>
                        </div>
                        <input name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio',Carbon\Carbon::today()->format('Y-m-d')) }}" type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" required>
                        <label>Fecha Inicio<i class="text-danger">*</i></label>
                        @error('fecha_inicio')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating form-control-feedback form-control-feedback-start m-1">
                        <div class="form-control-feedback-icon">
                            <i class="ph-calendar"></i>
                        </div>
                        <input name="fecha_final" id="fecha_final" value="{{ old('fecha_final',Carbon\Carbon::today()->format('Y-m-d')) }}" type="date" class="form-control @error('fecha_final') is-invalid @enderror" required>
                        <label>Fecha Final<i class="text-danger">*</i></label>
                        @error('fecha_final')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar a mi correo</button>
                </form>
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


@push('scripts')
    
    
    <script>

        $('#formMasMovimientos').validate({
            submitHandler: function(form) {
                
                var fecha_inicio= $('#fecha_inicio').val();
                var fecha_final=$('#fecha_final').val();

                $.confirm({
                    title: 'CONFIRMAR',
                    content: "ENVIAR MOVIMIENTOS: <br>DESDE:"+fecha_inicio+"<br>HASTA:"+fecha_final,
                    type: 'blue',
                    theme: 'modern',
                    icon: 'fa fa-triangle-exclamation',
                    typeAnimated: true,
                    buttons: {
                        SI: {
                            btnClass: 'btn btn-primary',
                            keys: ['enter'],
                            action: function(){
                                block.open();
				                form.submit();
                            }
                        },
                        NO: function () {
                        }
                    }
                });
				
			}
        });
        
        
        
    </script>

@endpush
