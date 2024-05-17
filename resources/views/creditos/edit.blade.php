@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('creditos.edit',$credito) }}
@endsection
@section('content')

<form action="{{ route('creditos.update',$credito) }}" method="POST" autocomplete="off" id="formCredito">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-body row">
            
            
            <div class="calculator-amortization">
				<div class="thirty form row">

                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph ph-currency-dollar"></i>
                            </div>
                            <input name="monto" id="monto" value="{{ old('monto',$credito->monto) }}" step="0.01" min="0" type="number" class="accrue-amount form-control @error('monto') is-invalid @enderror" required autofocus>
                            <label id="monto" >Monto:{{ old("monto") }}<i class="text-danger">*</i></label>
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
                            <input name="plazo" id="plazo" value="{{ old('plazo',$credito->plazo) }}" type="plazo" class="accrue-term form-control @error('plazo') is-invalid @enderror" required>
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
                                <option value="{{ $tt->tasa_efectiva_anual }}" {{ old('tipo_credito',$credito->tipoCredito->tasa_efectiva_anual)==$tt->tasa_efectiva_anual?'selected':'' }}>{{ $tt->tasa_efectiva_anual }}% {{ $tt->nombre }}</option>    
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
                    

                    
                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph-credit-card"></i>
                            </div>
                            <input type="hidden" name="cuenta_user" id="cuenta_user" value="{{ old('cuenta_user',$credito->cuentaUser->id) }}" required>
                            <input name="apellidos_nombres" id="txt_apellidos_nombres" value="{{ old('apellidos_nombres',$credito->cuentaUser->user->apellidos_nombres) }}" type="text" class="form-control @error('apellidos_nombres') is-invalid @enderror" data-bs-toggle="modal" data-bs-target="#modal_full" required >
                            <label id="numeroCuenta" >N° cuenta:{{ old("numero_cuenta",$credito->cuentaUser->numero_cuenta) }}<i class="text-danger">*</i></label>
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
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <select class="accrue-rate_compare form-select @error('seguro_credito') is-invalid @enderror" name="seguro_credito" id="seguro_credito" required>
                                <option value="5" {{ old('seguro_credito',$credito->seguro_credito)=='5'?'selected':'' }}>5%</option>
                                <option value="4" {{ old('seguro_credito',$credito->seguro_credito)=='4'?'selected':'' }}>4%</option>
                                <option value="3" {{ old('seguro_credito',$credito->seguro_credito)=='3'?'selected':'' }}>3%</option>
                                <option value="2" {{ old('seguro_credito',$credito->seguro_credito)=='2'?'selected':'' }}>2%</option>
                                <option value="1" {{ old('seguro_credito',$credito->seguro_credito)=='1'?'selected':'' }}>1%</option>
                                <option value="0" {{ old('seguro_credito',$credito->seguro_credito)=='0'?'selected':'' }}>0%</option>
                            </select>
                            <label for="seguro_credito">Seguro de crédito<i class="text-danger">*</i></label>
                            @error('seguro_credito')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-4 mb-1">
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="fa-solid fa-piggy-bank"></i>
                            </div>
                            <select class="accrue-rate_compare form-select @error('interes_certificado_plazo_fijo') is-invalid @enderror" name="interes_certificado_plazo_fijo" id="interes_certificado_plazo_fijo" required>
                                <option value="5" {{ old('interes_certificado_plazo_fijo',$credito->interes_certificado_plazo_fijo)=='5'?'selected':'' }}>5%</option>    
                                <option value="4" {{ old('interes_certificado_plazo_fijo',$credito->interes_certificado_plazo_fijo)=='4'?'selected':'' }}>4%</option>    
                                <option value="3" {{ old('interes_certificado_plazo_fijo',$credito->interes_certificado_plazo_fijo)=='3'?'selected':'' }}>3%</option>    
                                <option value="2" {{ old('interes_certificado_plazo_fijo',$credito->interes_certificado_plazo_fijo)=='2'?'selected':'' }}>2%</option>    
                                <option value="1" {{ old('interes_certificado_plazo_fijo',$credito->interes_certificado_plazo_fijo)=='1'?'selected':'' }}>1%</option>
                                <option value="0" {{ old('interes_certificado_plazo_fijo',$credito->interes_certificado_plazo_fijo)=='0'?'selected':'' }}>0%</option>
                            </select>
                            <label for="interes_certificado_plazo_fijo">Certificado plazo fijo<i class="text-danger">*</i></label>
                            @error('interes_certificado_plazo_fijo')
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
                            <input name="dia_pago" id="dia_pago" value="{{ old('dia_pago',$credito->dia_pago) }}" type="date" class="form-control @error('dia_pago') is-invalid @enderror" required>
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
                                <i class="ph-article"></i>
                            </div>
                            <input name="actividad" id="actividad" value="{{ old('actividad',$credito->actividad) }}" type="text" class="form-control @error('actividad') is-invalid @enderror" required>
                            <label for="actividad">Actividad del crédito<i class="text-danger">*</i></label>
                            @error('actividad')
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
                            <input name="detalle" value="{{ old('detalle',$credito->detalle) }}" type="text" class="form-control @error('detalle') is-invalid @enderror">
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
                                    <th scope="col">Total Certificado Plazo Fijo</th>
                                    <th scope="col">Total Seguro Crédito</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td> <input type="hidden" name="neto_recibir" value="{{ old("neto_recibir") }}" id="neto_recibir" required> <div id="neto_recibir_Text"></div></td>
                                    <td> <input type="hidden" name="pago_mensual" value="{{ old("pago_mensual") }}" id="pago_mensual" required> <div id="pago_mensual_Text"></div></td>
                                    <td> <input type="hidden" name="numero_cuotas" value="{{ old("numero_cuotas") }}" id="numero_cuotas" required> <div id="numero_cuotas_Text"></div></td>
                                    <td> <input type="hidden" name="pago_total" value="{{ old("pago_total") }}" id="pago_total" required> <div id="pago_total_Text"></div></td>
                                    <td> <input type="hidden" name="interes_total" value="{{ old("interes_total") }}" id="interes_total" required> <div id="interes_total_Text"></div></td>
                                    <td> <input type="hidden" name="total_certificado_plazo_fijo" value="{{ old("total_certificado_plazo_fijo") }}" id="total_certificado_plazo_fijo" required> <div id="total_certificado_plazo_fijo_text"></div></td>
                                    <td> <input type="hidden" name="total_seguro_credito" value="{{ old("total_seguro_credito") }}" id="total_seguro_credito" required> <div id="total_seguro_credito_text"></div></td>
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
					<h5 class="modal-title">Lista de cuentas activos</h5>
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
                
                var ahorro_programado=$( "#interes_certificado_plazo_fijo option:selected" ).val();
                var total_certificado_plazo_fijo=parseFloat((ahorro_programado*data.original_amount)/100).toFixed(2);

                var seguro_credito=$( "#seguro_credito option:selected" ).val();
                var total_seguro_credito=parseFloat((seguro_credito*data.original_amount)/100).toFixed(2);
                
                $('#neto_recibir').val(parseFloat(data.original_amount-total_seguro_credito-total_certificado_plazo_fijo).toFixed(2));
                $('#pago_mensual').val(parseFloat(data.payment_amount_formatted).toFixed(2));
                $('#numero_cuotas').val(data.num_payments);
                $('#pago_total').val(data.total_payments_formatted);
                $('#interes_total').val(data.total_interest_formatted);
                $('#total_certificado_plazo_fijo').val(total_certificado_plazo_fijo);
                $('#total_seguro_credito').val(total_seguro_credito);
                
                $('#neto_recibir_Text').html(parseFloat(data.original_amount-total_seguro_credito-total_certificado_plazo_fijo).toFixed(2));
                $('#pago_mensual_Text').html(parseFloat(data.payment_amount_formatted).toFixed(2));
                $('#numero_cuotas_Text').html(data.num_payments);
                $('#pago_total_Text').html(data.total_payments_formatted);
                $('#interes_total_Text').html(data.total_interest_formatted);
                $('#total_certificado_plazo_fijo_text').html(total_certificado_plazo_fijo);
                $('#total_seguro_credito_text').html(total_seguro_credito);
            }
        });
        


        function selecionarUsuario(arg){
            $('#modal_full').modal('hide');
            $('#cuenta_user').val($(arg).data('cuid'));
            $('#txt_apellidos_nombres').val($(arg).data('userapellidosnombres'));
            $('#numeroCuenta').html("N° cuenta:"+$(arg).data('cunumero'));
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