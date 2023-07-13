@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('cuentas-usuario.show',$cuentaUser) }}
@endsection
@section('content')

    {{-- infromacion de socio --}}
    <div class="alert alert-dark" role="alert">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-md-4">
                <strong>Cuenta: </strong> {{ $cuentaUser->tipoCuenta->codigo }}, {{ $cuentaUser->numero_cuenta }}
            </div>
            <div class="col-md-4">
                <strong>Socio: </strong>{{ $cuentaUser->user->apellidos_nombres }}
            </div>
            <div class="col-md-3">
                <strong>Cédula/Ruc: </strong>{{ $cuentaUser->user->identificacion }}
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalIdentificacion"><i class="ph ph-user-rectangle"></i></button>
                <div class="modal fade" id="modalIdentificacion" tabindex="-1" aria-labelledby="modalIdentificacionlabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalIdentificacionlabel">Identificación de socio</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card text-start">
                              <img class="card-img-top" src="{{ route('usuarios.ver-archivo',['id'=>$cuentaUser->user->id,'tipo'=>'foto_identificacion']) }}" alt="NO TIENE FOTO">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">

            {{-- realizar transacion --}}
            @if ($cuentaUser->estado==='ACTIVO')
                <form action="{{ route('cuentas-usuario.guardar-transacion') }}" method="POST" autocomplete="off" id="formCreateTransaccion">
                    @csrf
                    <input type='hidden' name="cuentaUser" value="{{ $cuentaUser->id }}" />
                    <div class="card">
                        <div class="card-header">
                            Realizar Transación
                        </div>
                        <div class="card-body">
                            <div class="mb-1">
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
                            <div class="mb-1">
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
                        
                            <div class="mb-1">
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
                
                            <div class="mb-1">
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
                            <div id="otroUsuario" class="mt-1" style="{{ old('quienRealizaTransaccion')==='otro'?'':'display:none;' }};">
                                <div class="mb-1">
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
                                <div class="mb-1">
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
            @else
                <div class="alert alert-danger" role="alert">
                    <strong>No puede realizar ninguna transacción mientras la cuenta está INACTIVA.</strong>
                </div>
            @endif
            

            {{-- solicitud e apertura de cuenta --}}
            <div class="card">
                <div class="card-header">
                    SOLICITUD APERTURA DE CUENTA
                </div>
                <div class="card-body">
                    <a href="{{ route('cuentas-usuario.solicitud-apertura-cuenta',$cuentaUser->id) }}" target="_blank" class="btn btn-link"><i class="ph ph-printer me-2"></i> IMPRIMIR APERTURA DE CUENTA</a>
                </div>
            </div>
            {{-- activar desactiva el estado de cuenta --}}
            <form action="{{ route('cuentas-usuario.actualizar-estado') }}" method="POST" id="formCuentaUserEstado">
                @csrf
                <input type="hidden" name="id" value="{{ $cuentaUser->id }}">
                <div class="card">
                    <div class="card-header">
                        ACTUALIZAR ESTADO DE CUENTA
                    </div>
                    <div class="card-body">
                        
                        <div class="form-floating form-control-feedback form-control-feedback-start">
                            <div class="form-control-feedback-icon">
                                <i class="ph-toggle-left"></i>
                            </div>
                            <select class="form-select @error('estado') is-invalid @enderror" name="estado" required>
                                <option value=""></option>
                                <option value="ACTIVO" {{ old('estado',$cuentaUser->estado)=='ACTIVO'?'selected':'' }}>ACTIVO</option>
                                <option value="INACTIVO" {{ old('estado',$cuentaUser->estado)=='INACTIVO'?'selected':'' }}>INACTIVO</option>
                            </select>
        
                            <label>Actualizar estado de cuenta<i class="text-danger">*</i></label>
                            @error('estado')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('cuentas-usuario.imprimir-libreta-pdf') }}" method="get" target="_blank" autocomplete="off">
                        <input type="hidden" name="id" value="{{ $cuentaUser->id }}">
                        <div class="input-group">
                            <input type="number" name="numero" class="form-control" placeholder="Ingrese línea de libreta" aria-label="Recipient's username" aria-describedby="button-addon2" required>
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i class="ph ph-printer"></i>IMPIMIR LIBRETA</button>
                        </div>
                        <div id="emailHelp" class="form-text">Ingrese 0, para imprimir datos de la cuenta.</div>
                        
                    </form>
                </div>
               
                @if ($transacciones->count()>0)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">N°</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Trans.</th>
                                    <th scope="col">Valor.</th>
                                    <th scope="col">Saldo.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transacciones as $trans)
                                <tr>
                                    <td>
                                        <div class="d-inline-flex">
                                            <div class="dropdown">
                                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                    <i class="ph-list"></i>
                                                </a>
                                        
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="{{ route('cuentas-usuario.imprimirRecibo',$trans->id) }}" class="dropdown-item" target="_blank">
                                                        <i class="ph ph-printer me-2"></i>
                                                        Impimir Recibo
                                                    </a>
                                                    <a href="{{ route('cuentas-usuario.imprimirComprobante',$trans->id) }}" class="dropdown-item" target="_blank">
                                                        <i class="ph ph-printer me-2"></i>
                                                        Impimir Comprobante
                                                    </a>
                                                    
                                                    <a href="{{ route('cuentas-usuario.anularTransaccion',$trans) }}" class="dropdown-item">
                                                        <i class="ph ph-prohibit me-2"></i>
                                                        Anular
                                                    </a> 
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $trans->numero_libreta }}</td>
                                    <td>{{ $trans->created_at }}</td>
                                    <td>{{ $trans->tipoTransaccion->tipo_signo }} {{ $trans->tipoTransaccion->nombre }}</td>
                                    <td>{{ $trans->valor }}</td>
                                    <td>{{ $trans->valor_disponible }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>  
                @else
                <div class="card-footer">
                    @include('sections.alert',['type'=>'primary','msg'=>'No tiene transacciones'])  
                </div>
                @endif
                
            </div>

        </div>
        <div class="col-md-6">
            
        </div>
        
    </div>



    

    @push('scripts')
     <script>
        $('#formCuentaUserEstado').validate();
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
                var n_cuenta="{{ $cuentaUser->tipoCuenta->codigo }}, {{ $cuentaUser->numero_cuenta }}";
                var socio="Socio: {{ $cuentaUser->user->apellidos_nombres }}";
                var tipo_transaccion= $('#tipoTransaccion').find('option:selected').text();
                var v_efectivo= $('#txt_valor').val();

                $.confirm({
                    title: 'CONFIRMAR TRANSACCIÓN',
                    content: ""+n_cuenta+"<br>"+socio+"<br>"+tipo_transaccion+"<br>Valor:"+v_efectivo,
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
@endsection