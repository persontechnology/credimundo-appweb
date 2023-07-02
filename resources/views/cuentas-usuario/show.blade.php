@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('cuentas-usuario.show',$cuentaUser) }}
@endsection
@section('content')

    <div class="row">
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
                <div class="card-body">
                    CUENTA N°: {{ $cuentaUser->numero_cuenta }} <br>
                    NOMBRE: {{ $cuentaUser->user->apellidos_nombres }} <br>
                    CÉDULA/RUC: {{ $cuentaUser->user->identificacion }}
                </div>
                @if ($transacciones->count()>0)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
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
                                    <td scope="row">{{ $trans->numero_libreta }}</td>
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
            <div class="card">
                <div class="card-header">
                    SOLICITUD APERTURA DE CUENTA
                </div>
                <div class="card-body">
                    <a href="{{ route('cuentas-usuario.solicitud-apertura-cuenta',$cuentaUser->id) }}" target="_blank" class="btn btn-link"><i class="ph ph-file-pdf me-2"></i> VER DOCUMENTO</a>
                </div>
            </div>

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
        
    </div>



    

    @push('scripts')
     <script>
        $('#formCuentaUserEstado').validate();
     </script>
    @endpush
@endsection