@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('transacciones.create') }}
@endsection
@section('content')

<form action="{{ route('transacciones.store') }}" method="POST" autocomplete="off" id="formCreateTransaccion">
    @csrf
    <div class="card">
        <div class="card-body row">
            <input type="hidden" name="cuentaUser" id="cuentaUser" value="{{ old('cuentaUser') }}" required>
            <input type="hidden" name="numero_cuenta" id="txt_numero_cuenta" value="{{ old('numero_cuenta') }}">
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-credit-card"></i>
                    </div>
                    <input name="apellidos_nombres" id="txt_apellidos_nombres" value="{{ old('apellidos_nombres') }}" type="text" class="form-control @error('apellidos_nombres') is-invalid @enderror" data-bs-toggle="modal" data-bs-target="#modal_full" required readonly>
                    <label id="numeroCuenta" >N° cuenta:{{ old("numero_cuenta") }}<i class="text-danger">*</i></label>
                    @error('apellidos_nombres')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <a class="" data-bs-toggle="modal" href="#modalFotoIdentificacion" role="button">Verificar foto de identificación</a>
            </div>

            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-arrows-left-right"></i>
                    </div>
                    <select class="form-select @error('tipoTransaccion') is-invalid @enderror" name="tipoTransaccion" id="tipoTransaccion" required>
                        <option value=""></option>
                        @foreach ($tipoTransacciones as $tt)
                        <option value="{{ $tt->id }}" {{ old('tipoTransaccion')==$tt->id?'selected':'' }}>{{ $tt->tipo==='SUMAR'?'+':'-' }} {{ $tt->nombre }}</option>    
                        @endforeach
                        
                    </select>
                    <label>Tipo de Transacción<i class="text-danger">*</i></label>
                    @error('tipoTransaccion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-currency-dollar"></i>
                    </div>
                    <input name="valor" id="txt_valor" value="{{ old('valor') }}" type="number" min="0" step="0.01" class="form-control @error('valor') is-invalid @enderror" required>
                    <label>Valor<i class="text-danger">*</i></label>
                    @error('valor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
         
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-article"></i>
                    </div>
                    <input name="detalle" value="{{ old('detalle') }}" type="text" class="form-control @error('detalle') is-invalid @enderror">
                    <label>Detalle</label>
                    @error('detalle')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="border p-1 rounded">
                    <p class="fw-semibold">¿Quien realiza esta transacción?</p>
                    <div class="d-flex align-items-center">
                        <input type="radio" class="" onchange="fnQuienRealizaTransaccion(this)" value="titular" name="quienRealizaTransaccion" id="titular_radio" {{ old('quienRealizaTransaccion')==='titular'?'checked':'' }} checked>
                        <label class="ms-2" for="titular_radio">Titular de la cuenta</label>
                    </div>

                    <div class="d-flex align-items-center mb-2">
                        <input type="radio" onchange="fnQuienRealizaTransaccion(this)" value="otro" name="quienRealizaTransaccion" id="otro_radio" {{ old('quienRealizaTransaccion')==='otro'?'checked':'' }}>
                        <label class="ms-2" for="otro_radio">Otra persona</label>
                    </div>

                    @error('quienRealizaTransaccion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>                
            </div>
            <div id="otroUsuario" class="row mt-1" style="{{ old('quienRealizaTransaccion')==='otro'?'':'display:none;' }};">
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-identification-card"></i>
                        </div>
                        <input name="identificacion_otra_persona" id="identificacion_otra_persona" value="{{ old('identificacion_otra_persona') }}" type="number" min="0" class="form-control @error('identificacion_otra_persona') is-invalid @enderror" >
                        <label>Identificación de otra persona</label>
                        @error('identificacion_otra_persona')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-user"></i>
                        </div>
                        <input name="nombre_otra_persona" id="nombre_otra_persona" value="{{ old('nombre_otra_persona') }}" type="text" class="form-control @error('nombre_otra_persona') is-invalid @enderror" >
                        <label>Apellidos y nombres de otra persona</label>
                        @error('nombre_otra_persona')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>

<!--  modal cuentas-->
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
<!-- /modal ceuntas -->


  

  
  <!-- Modal foto identificacion -->
  <div class="modal fade" id="modalFotoIdentificacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Foto de identificación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-img-actions">
                    <img class="card-img-top img-fluid" src="" id="imgidentificacion" alt="NO SE PUEDE VISUALIZAR LA FOTO, DEBIDO A QUE NO SELECCIONA UNA CUENTA, O LA CUENTA DEL USUARIO NO TIENE FOTO DE IDENTIFICACIÓN">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /Modal foto identificacion -->



@endsection



@push('scripts')
    {{$dataTable->scripts()}}
    <script>

        function selecionarUsuario(arg){
            $('#modal_full').modal('hide');
            $('#cuentaUser').val($(arg).data('cuid'));
            $('#txt_apellidos_nombres').val($(arg).data('userapellidosnombres'));
            $('#numeroCuenta').html("N° cuenta:"+$(arg).data('cunumero'));
            $('#txt_numero_cuenta').val($(arg).data('cunumero'));
            $('#imgidentificacion').attr('src',$(arg).data('verarchivo'))
        }

        function fnQuienRealizaTransaccion(arg){
            if($(arg).val()==='otro'){
                $('#otroUsuario').show();
            }else{
                $('#identificacion_otra_persona').val('').removeClass('is-invalid');
                $('#nombre_otra_persona').val('').removeClass('is-invalid');
                $('#otroUsuario').hide();
            }
        }

        $('#formCreateTransaccion').validate({
            rules: {
                identificacion_otra_persona: {
                    required:function(){
                        return $('input[name="quienRealizaTransaccion"]:checked').val()==='otro';
                    },
                    remote: {
                        url: "{{ route('validarec') }}",
                        type: "post",
                        data: {
                            identificacion: function() {
                                return $( "#identificacion_otra_persona" ).val();
                            },
                            tipo:function(){
                                return $( "#identificacion_otra_persona" ).val();
                            }
                        }
                    }               
                },
                nombre_otra_persona:{
                    required:function(){
                        return $('input[name="quienRealizaTransaccion"]:checked').val()==='otro';
                    }
                },
                quienRealizaTransaccion:{
                    required:true
                }

            },
            messages:{
                identificacion_otra_persona: {
                    remote: "Identificación incorrecta"
                }
            },
            submitHandler: function(form) {
                var n_cuenta=$("#numeroCuenta").html();
                var socio='Usuario: '+$('#txt_apellidos_nombres').val();
                var tipo_transaccion= $('#tipoTransaccion').find('option:selected').text();
                var v_efectivo= $('#txt_valor').val();

                $.confirm({
                    title: 'CONFIRMAR TRANSACCIÓN',
                    content: ""+n_cuenta+"<br>"+socio+"<br>"+tipo_transaccion+"<br>Efectivo:"+v_efectivo,
                    type: 'blue',
                    theme: 'modern',
                    icon: 'fa fa-triangle-exclamation',
                    typeAnimated: true,
                    buttons: {
                        SI: {
                            btnClass: 'btn btn-primary',
                            keys: ['enter'],
                            action: function(){
                                block.open()
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