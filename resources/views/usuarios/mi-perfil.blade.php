@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>{{ $user->apellidos_nombres }}</h1>
            <p><strong>Email:</strong> {{ Str::mask($user->email, '*', 5, 8) }}</p>
            <p><strong>Identificación:</strong> {{ Str::mask($user->identificacion, 'x', -3, 8) }}</p>
        </div>
    </div>
    <form action="{{ route('actualizar-contrasena') }}" method="POST" autocomplete="off" id="formActualizarContrasena">
        @csrf
        <div class="card">
            <div class="card-header">
                ACTUALIZAR CONTRASEÑA
            </div>
            <div class="card-body row">
                
                <div class="col-md-4 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-lock-simple"></i>
                        </div>
                        <input name="contrasena_actual"  type="password" class="form-control @error('contrasena_actual') is-invalid @enderror" autofocus required>
                        <label>Contraseña actual</label>
                        @error('contrasena_actual')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-lock-simple"></i>
                        </div>
                        <input name="nueva_contrasena"  type="password" class="form-control @error('nueva_contrasena') is-invalid @enderror" required>
                        <label>Nueva contraseña</label>
                        @error('nueva_contrasena')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-lock-simple"></i>
                        </div>
                        <input name="nueva_contrasena_confirmation"  type="password" class="form-control @error('nueva_contrasena_confirmation') is-invalid @enderror" required>
                        <label>Repita contraseña</label>
                        @error('nueva_contrasena_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    
    
    <script>

        $('#formActualizarContrasena').validate({
            submitHandler: function(form) {
                $.confirm({
                    title: 'CONFIRMAR',
                    content: "ESTA SEGURO DE ACTUALIZAR LA CONTRASEÑA",
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