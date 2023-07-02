@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('plazo-fijo.create') }}
@endsection
@section('content')

<form action="{{ route('plazo-fijo.store') }}" method="POST" autocomplete="off" id="formCredito">
    @csrf
    <div class="card">
        <div class="card-body row">
            <div class="calculator-amortization">
				<div class="thirty form row">

                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph ph-currency-dollar"></i>
                            </div>
                            <input name="monto" id="monto" value="{{ old('monto','1000') }}" step="0.01" min="0" type="number" class="accrue-amount form-control @error('monto') is-invalid @enderror" required autofocus>
                            <label id="monto" >Monto:<i class="text-danger">*</i></label>
                            @error('monto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph ph-calendar"></i>
                            </div>
                            <input name="plazo" id="plazo" value="{{ old('plazo','1y') }}" type="plazo" class="accrue-term form-control @error('plazo') is-invalid @enderror" required>
                            <label>Plazo<i class="text-danger">*</i></label>
                            @error('plazo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph-cardholder"></i>
                            </div>
                            <select class="accrue-rate form-select @error('tipo_credito') is-invalid @enderror" name="tipo_credito" id="tipo_credito" required>
                                @foreach ($tipo_creditos as $tt)
                                <option value="{{ $tt->tasa_efectiva_anual }}" {{ old('tipo_credito')==$tt->tasa_efectiva_anual?'selected':'' }}>{{ $tt->tasa_efectiva_anual }}% {{ $tt->nombre }}</option>    
                                @endforeach
                                
                            </select>
                            <label id="tipo_credito">Tipo de crédito-TEA<i class="text-danger">*</i></label>
                            @error('tipo_credito')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    

                    
                    <div class="col-md-8 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph-credit-card"></i>
                            </div>
                            <input type="hidden" name="cuenta_user" id="cuenta_user" value="{{ old('cuenta_user') }}" required>
                            <input name="apellidos_nombres" id="txt_apellidos_nombres" value="{{ old('apellidos_nombres') }}" type="text" class="form-control @error('apellidos_nombres') is-invalid @enderror" data-bs-toggle="modal" data-bs-target="#modal_full" required >
                            <input type="hidden" id="numero_cuenta" name="numero_cuenta" value="{{ old('numero_cuenta') }}">
                            <label id="numeroCuenta" >N° cuenta:{{ old("numero_cuenta") }}<i class="text-danger">*</i></label>
                            @error('apellidos_nombres')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph ph-number-circle-one"></i>
                            </div>
                            <input name="numero_credito" value="{{ old('numero_credito') }}" type="text" class="form-control @error('numero_credito') is-invalid @enderror">
                            <label>Número de crédito</label>
                            @error('numero_credito')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph-calendar"></i>
                            </div>
                            <input name="dia_pago" id="dia_pago" value="{{ old('dia_pago',Carbon\Carbon::today()->format('Y-m-d')) }}" type="date" class="form-control @error('dia_pago') is-invalid @enderror" required>
                            <label>Día de pago<i class="text-danger">*</i></label>
                            @error('dia_pago')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph ph-money"></i>
                            </div>
                            <select class="accrue-rate_compare form-select @error('tipo_pago') is-invalid @enderror" name="tipo_pago" id="tipo_pago" required>
                                <option value="Unico" {{ old('tipo_pago')=='Unico'?'selected':'' }}>Unico</option>
                                <option value="Mensual" {{ old('tipo_pago')=='Mensual'?'selected':'' }}>Mensual</option>
                                
                            </select>
                            <label for="tipo_pago">Tipo de pago<i class="text-danger">*</i></label>
                            @error('tipo_pago')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph-article"></i>
                            </div>
                            <input name="detalle" value="{{ old('detalle') }}" type="text" class="form-control @error('detalle') is-invalid @enderror">
                            <label>Detalle</label>
                            @error('detalle')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    

				</div>

				<div class="seventy">
					<p><label>Tabla de amortización:</label></p>
                    <div class="table-responsive mb-1">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Neto a recibir:</th>
                                    <th scope="col">Pago Mensual:</th>
                                    <th scope="col">Número de cuotas:</th>
                                    <th scope="col">Pago Total:</th>
                                    <th scope="col">Interés Total:</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td> <input type="hidden" name="neto_recibir" value="{{ old("neto_recibir") }}" id="neto_recibir" required> <div id="neto_recibir_Text"></div></td>
                                    <td> <input type="hidden" name="pago_mensual" value="{{ old("pago_mensual") }}" id="pago_mensual" required> <div id="pago_mensual_Text"></div></td>
                                    <td> <input type="hidden" name="numero_cuotas" value="{{ old("numero_cuotas") }}" id="numero_cuotas" required> <div id="numero_cuotas_Text"></div></td>
                                    <td> <input type="hidden" name="pago_total" value="{{ old("pago_total") }}" id="pago_total" required> <div id="pago_total_Text"></div></td>
                                    <td> <input type="hidden" name="interes_total" value="{{ old("interes_total") }}" id="interes_total" required> <div id="interes_total_Text"></div></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    
					<div class="results table-responsive"></div>
				</div>

				<div class="clear"></div>
			</div>

           

        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>

    <!-- Full width modal -->
	<div id="modal_full" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-full">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Lista de cuentas AHORRO PROGRAMADO</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<div class="table-responsive">
                        {{$dataTable->table()}}
                    </div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /full width modal -->

@endsection
@push('scripts')
    
    
    <script>



        $(".calculator-amortization").accrue({
            mode: "amortization",
            callback: function ( elem, data ){
                
                console.log(data)
                
                
                $('#neto_recibir').val(parseFloat(data.original_amount).toFixed(2));
                $('#pago_mensual').val(parseFloat(data.payment_amount_formatted).toFixed(2));
                $('#numero_cuotas').val(data.num_payments);
                $('#pago_total').val(data.total_payments_formatted);
                $('#interes_total').val(data.total_interest_formatted);
                
                
                $('#neto_recibir_Text').html(parseFloat(data.original_amount).toFixed(2));
                $('#pago_mensual_Text').html(parseFloat(data.payment_amount_formatted).toFixed(2));
                $('#numero_cuotas_Text').html(data.num_payments);
                $('#pago_total_Text').html(data.total_payments_formatted);
                $('#interes_total_Text').html(data.total_interest_formatted);
                
            }
        });
        


        function selecionarUsuario(arg){
            $('#modal_full').modal('hide');
            $('#cuenta_user').val($(arg).data('cuid'));
            $('#txt_apellidos_nombres').val($(arg).data('userapellidosnombres'));
            $('#numeroCuenta').html("N° cuenta:"+$(arg).data('cunumero'));
            $('#numero_cuenta').val($(arg).data('cunumero'))
        }


        $('#formCredito').validate({
            submitHandler: function(form) {
                var n_cuenta=$("#numeroCuenta").html();
                var socio='Usuario: '+$('#txt_apellidos_nombres').val();
                var tipo_transaccion= $('#tipo_credito').find('option:selected').text();
                var v_monto= $('#monto').val();
                var v_plazo= $('#numero_cuotas').val();
                var v_pago_mensual=$('#pago_mensual').val();
                var v_fecha_pago=moment($('#dia_pago').val());
                var v_diaPago=v_fecha_pago.date();

                $.confirm({
                    title: 'CONFIRMAR CRÉDITO',
                    content: ""+n_cuenta+"<br>"+socio+"<br>"+tipo_transaccion+"<br>Monto del crédito: "+v_monto+"<br>N° pagos: "+v_plazo+"<br>Pago mensual: "+v_pago_mensual+"<br>Día de pago: "+v_diaPago,
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

    {{$dataTable->scripts()}}
@endpush

@prepend('scriptsHeader')
    <script src="{{ asset('assets/js/jquery.accrue.js') }}"></script>
    <script src="{{ asset('assets/js/moment-with-locales.js') }}"></script>
    <script>moment.locale('es');</script>
@endprepend