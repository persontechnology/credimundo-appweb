@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('cuentas-usuario.edit',$cuentaUser) }}
@endsection
@section('content')

<form action="{{ route('cuentas-usuario.update',$cuentaUser) }}" method="POST" autocomplete="off" id="formCuentaUser">
    @csrf
    @method("PUT")
    <div class="card">
        <div class="card-body row">
            <input type="hidden" name="userid" id="userid" value="{{ old('userid',$cuentaUser->user->id) }}" required>

            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-user"></i>
                    </div>
                    <input name="apellidos_nombres" id="txt_apellidos_nombres" value="{{ old('apellidos_nombres',$cuentaUser->user->apellidos_nombres) }}" type="text" class="form-control @error('apellidos_nombres') is-invalid @enderror" data-bs-toggle="modal" data-bs-target="#modal_full" required >
                    <label>Seleccionar usuario<i class="text-danger">*</i></label>
                    @error('apellidos_nombres')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-user-switch"></i>
                    </div>
                    <select class="form-select @error('tipoCuenta') is-invalid @enderror" name="tipoCuenta" required>
                        <option value=""></option>
                        @foreach ($tipoCuentas as $tc)
                        <option value="{{ $tc->id }}" {{ old('tipoCuenta',$cuentaUser->tipoCuenta->id)==$tc->id?'selected':'' }}>{{ $tc->nombre }}</option>    
                        @endforeach
                        
                    </select>
                    <label>Tipo de Cuenta<i class="text-danger">*</i></label>
                    @error('tipoCuenta')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-toggle-left"></i>
                    </div>
                    <select class="form-select @error('estado') is-invalid @enderror" name="estado" required>
                        <option value=""></option>
                        <option value="CREADO" {{ old('estado',$cuentaUser->estado)=='CREADO'?'selected':'' }}>CREADO</option>
                        <option value="ACTIVO" {{ old('estado',$cuentaUser->estado)=='ACTIVO'?'selected':'' }}>ACTIVO</option>
                        <option value="INACTIVO" {{ old('estado',$cuentaUser->estado)=='INACTIVO'?'selected':'' }}>INACTIVO</option>
                    </select>

                    <label>Estado<i class="text-danger">*</i></label>
                    @error('estado')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-article"></i>
                    </div>
                    <input name="descripcion" value="{{ old('descripcion',$cuentaUser->descripcion) }}" type="text" class="form-control @error('descripcion') is-invalid @enderror">
                    <label>Descripción</label>
                    @error('descripcion')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
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
					<h5 class="modal-title">Lista de usuarios activos</h5>
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
    {{$dataTable->scripts()}}
    <script>
        function selecionarUsuario(arg){
            $('#modal_full').modal('hide');
            $('#txt_apellidos_nombres').val($(arg).data('userapellidosnombres'));
            $('#userid').val($(arg).data('userid'));
        }
        $('#formCuentaUser').validate();
    </script>
    
@endpush