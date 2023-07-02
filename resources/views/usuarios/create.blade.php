@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('usuarios.create') }}
@endsection



@section('content')
<form action="{{ route('usuarios.store') }}" method="POST" id="formUser" autocomplete="off">
    @csrf
    <div class="card">
       
        <div class="card-body row">
            <div class="fw-bold border-bottom pb-2 mb-3">DATOS PERSONALES</div>
            <div class="col-md-4 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-user"></i>
                    </div>
                    <input name="apellidos" value="{{ old('apellidos') }}" type="text" class="form-control @error('apellidos') is-invalid @enderror" autofocus required>
                    <label>Apellidos<i class="text-danger">*</i></label>
                    @error('apellidos')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>
            </div>

            <div class="col-md-4 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-user"></i>
                    </div>
                    <input name="nombres" value="{{ old('nombres') }}" type="text" class="form-control @error('nombres') is-invalid @enderror" required>
                    <label>Nombres<i class="text-danger">*</i></label>
                    @error('nombres')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            
            
            <div class="col-md-4 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-identification-card"></i>
                    </div>
                    <input id="identificacion" name="identificacion" value="{{ old('identificacion') }}" type="number" min="0" class="form-control @error('identificacion') is-invalid @enderror" required>
                    <label>Identificación<i class="text-danger">*</i></label>
                    @error('identificacion')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-user"></i>
                    </div>
                    <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror"  >
                    <label>Nombre de usuario</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-envelope-simple"></i>
                    </div>
                    <input name="email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" >
                    <label>Email</label>
                    @error('email')
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
                    <input name="password" value="{{ old('password') }}" type="password" class="form-control @error('password') is-invalid @enderror" >
                    <label>Contraseña</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-4 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-map-pin"></i>
                    </div>
                    <input name="provincia" value="{{ old('provincia') }}" type="text" class="form-control @error('provincia') is-invalid @enderror" required>
                    <label>Provincia<i class="text-danger">*</i></label>
                    @error('provincia')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-map-pin-line"></i>
                    </div>
                    <input name="canton" value="{{ old('canton') }}" type="text" class="form-control @error('canton') is-invalid @enderror" required>
                    <label>Cantón<i class="text-danger">*</i></label>
                    @error('canton')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-map-trifold"></i>
                    </div>
                    <input name="parroquia" value="{{ old('parroquia') }}" type="text" class="form-control @error('parroquia') is-invalid @enderror" required>
                    <label>Parroquia<i class="text-danger">*</i></label>
                    @error('parroquia')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-compass"></i>
                    </div>
                    <input name="recinto" value="{{ old('recinto') }}" type="text" class="form-control @error('recinto') is-invalid @enderror" required>
                    <label>Recinto<i class="text-danger">*</i></label>
                    @error('recinto')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-airplane"></i>
                    </div>
                    <input name="direccion" value="{{ old('direccion') }}" type="text" class="form-control @error('direccion') is-invalid @enderror" required>
                    <label>Dirección<i class="text-danger">*</i></label>
                    @error('direccion')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-phone-call"></i>
                    </div>
                    <input name="telefono" value="{{ old('telefono') }}" type="tel" class="form-control @error('telefono') is-invalid @enderror" >
                    <label>Teléfono</label>
                    @error('telefono')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-device-mobile"></i>
                    </div>
                    <input name="celular" value="{{ old('celular') }}" type="tel" class="form-control @error('celular') is-invalid @enderror" >
                    <label>Celular</label>
                    @error('celular')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-airplane-in-flight"></i>
                    </div>
                    <input name="lugar_nacimiento" value="{{ old('lugar_nacimiento') }}" type="text" class="form-control @error('lugar_nacimiento') is-invalid @enderror" required>
                    <label>Lugar de nacimiento<i class="text-danger">*</i></label>
                    @error('lugar_nacimiento')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-calendar"></i>
                    </div>
                    <input name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" required>
                    <label>Fecha de nacimiento<i class="text-danger">*</i></label>
                    @error('fecha_nacimiento')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-flag"></i>
                    </div>
                    <input name="nacionalidad" value="{{ old('nacionalidad') }}" type="text" class="form-control @error('nacionalidad') is-invalid @enderror" required>
                    <label>Nacionalidad<i class="text-danger">*</i></label>
                    @error('nacionalidad')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-2 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-user-list"></i>
                    </div>
                    
                    <select name="estado_civil" class="form-select @error('estado_civil') is-invalid @enderror" required>
                        <option value=""></option>
                        <option value="SOLTERO" {{ old('estado_civil')=='SOLTERO'?'selected':'' }}>SOLTERO</option>
                        <option value="CASADO" {{ old('estado_civil')=='CASADO'?'selected':'' }}>CASADO</option>
                        <option value="DIVORCIADO" {{ old('estado_civil')=='DIVORCIADO'?'selected':'' }}>DIVORCIADO</option>
                        <option value="VIUDO" {{ old('estado_civil')=='VIUDO'?'selected':'' }}>VIUDO</option>
                        <option value="UNIÓN LIBRE" {{ old('estado_civil')=='UNIÓN LIBRE'?'selected':'' }}>UNIÓN LIBRE</option>
                    </select>
                    <label>Estado civil<i class="text-danger">*</i></label>
                    @error('estado_civil')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-2 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-toggle-left"></i>
                    </div>
                    <select class="form-select @error('estado') is-invalid @enderror" name="estado" required>
                        <option value=""></option>
                        <option value="ACTIVO" {{ old('estado')=='ACTIVO'?'selected':'' }}>ACTIVO</option>
                        <option value="INACTIVO" {{ old('estado')=='INACTIVO'?'selected':'' }}>INACTIVO</option>
                    </select>

                    <label>Estado<i class="text-danger">*</i></label>
                    @error('estado')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-2 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-user-switch"></i>
                    </div>
                    <select class="form-select @error('sexo') is-invalid @enderror" name="sexo" required>
                        <option value=""></option>
                        <option value="HOMBRE" {{ old('sexo')=='HOMBRE'?'selected':'' }}>HOMBRE</option>
                        <option value="MUJER" {{ old('sexo')=='MUJER'?'selected':'' }}>MUJER</option>
                    </select>
                    <label>Sexo<i class="text-danger">*</i></label>
                    @error('sexo')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <p class="fw-semibold">Roles</p>

                    @if ($roles->count()>0)
                        <div class="border p-3 rounded">
                            @foreach ($roles as $rol)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="rol-{{ $rol->id }}" name="roles[{{ $rol->id }}]" {{ old('roles.'.$rol->id)==$rol->id ?'checked':'' }} value="{{ $rol->id }}" type="checkbox">
                                    <label class="form-check-label" for="rol-{{ $rol->id }}">{{ $rol->name }}</label>
                                </div>    
                            @endforeach
                                
                        </div>
                    @else
                        @include('sections.alert',['type'=>'primary','msg'=>'No existe roles para crear usuario.'])
                    @endif
                </div>
            </div>
          
            <div class="fw-bold border-bottom pb-2 mb-3">DATOS DE CONYUGE</div>

            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-user"></i>
                    </div>
                    <input name="nombre_conyuge" value="{{ old('nombre_conyuge') }}" type="text" class="form-control @error('nombre_conyuge') is-invalid @enderror" >
                    <label>Apellidos y nombres de conyuge</label>
                    @error('nombre_conyuge')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-identification-card"></i>
                    </div>
                    <input name="identificacion_conyuge" id="identificacion_conyuge" value="{{ old('identificacion_conyuge') }}" type="number" min="0" class="form-control @error('identificacion_conyuge') is-invalid @enderror" >
                    <label>Identificación de conyuge</label>
                    @error('identificacion_conyuge')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-device-mobile"></i>
                    </div>
                    <input name="celular_conyuge" value="{{ old('celular_conyuge') }}" type="tel" class="form-control @error('celular_conyuge') is-invalid @enderror" >
                    <label>Celular de conyuge</label>
                    @error('celular_conyuge')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <div class="fw-bold border-bottom pb-2 mb-3">DATOS DE REPRESENTANTE</div>

            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-user"></i>
                    </div>
                    <input name="nombre_representante" value="{{ old('nombre_representante') }}" type="text" class="form-control @error('nombre_representante') is-invalid @enderror" required>
                    <label>Apellidos y Nombres de representante<i class="text-danger">*</i></label>
                    @error('nombre_representante')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-identification-card"></i>
                    </div>
                    <input name="identificacion_representante" id="identificacion_representante" value="{{ old('identificacion_representante') }}" type="number" min="0" class="form-control @error('identificacion_representante') is-invalid @enderror">
                    <label>Identificación de representante</label>
                    @error('identificacion_representante')
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
                    <input name="parentesco_representante" value="{{ old('parentesco_representante') }}" type="text" class="form-control @error('parentesco_representante') is-invalid @enderror">
                    <label>Parentesco de representante</label>
                    @error('parentesco_representante')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-device-mobile"></i>
                    </div>
                    <input name="celular_representante" value="{{ old('celular_representante') }}" type="tel" class="form-control @error('celular_representante') is-invalid @enderror">
                    <label>Celular de representante</label>
                    @error('celular_representante')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>



@push('scripts')
    <script>
   
        $('#formUser').validate({
            rules: {
                identificacion: {
                    remote: {
                        url: "{{ route('validarec') }}",
                        type: "post",
                        data: {
                            identificacion: function() {
                                return $( "#identificacion" ).val();
                            },
                            tipo:function(){
                                return $( "#identificacion" ).val();
                            }
                        }
                    }               
                },
                identificacion_conyuge: {
                    remote: {
                        url: "{{ route('validarec') }}",
                        type: "post",
                        data: {
                            identificacion: function() {
                                return $( "#identificacion_conyuge" ).val();
                            },
                            tipo:function(){
                                return $( "#identificacion_conyuge" ).val();
                            }
                        }
                    }               
                },
                identificacion_representante: {
                    remote: {
                        url: "{{ route('validarec') }}",
                        type: "post",
                        data: {
                            identificacion: function() {
                                return $( "#identificacion_representante" ).val();
                            },
                            tipo:function(){
                                return $( "#identificacion_representante" ).val();
                            }
                        }
                    }               
                }
            },
            messages:{
                identificacion: {
                    remote: "Identificación incorrecta"
                },
                identificacion_conyuge: {
                    remote: "Identificación incorrecta"
                },
                identificacion_representante: {
                    remote: "Identificación  incorrecta"
                }
            }
        });
         
    </script>
@endpush
@endsection
