@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('usuarios.edit',$user) }}
@endsection


@section('content')
<form action="{{ route('usuarios.update',$user->id) }}" method="POST" id="formUser" autocomplete="off">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $user->id }}">
    <div class="card">
        
        <div class="card-body row">
            <div class="fw-bold border-bottom pb-2 mb-3">DATOS PERSONALES</div>
            <div class="col-md-4 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-user"></i>
                    </div>
                    <input name="apellidos" id="apellidos" value="{{ old('apellidos',$user->apellidos) }}" type="text" class="form-control @error('apellidos') is-invalid @enderror" autofocus required>
                    <label for="apellidos">Apellidos<i class="text-danger">*</i></label>
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
                    <input name="nombres" id="nombres" value="{{ old('nombres',$user->nombres) }}" type="text" class="form-control @error('nombres') is-invalid @enderror" required>
                    <label for="nombres">Nombres<i class="text-danger">*</i></label>
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
                    <input name="identificacion" id="identificacion" value="{{ old('identificacion',$user->identificacion) }}" type="number" min="0" class="form-control @error('identificacion') is-invalid @enderror" required>
                    <label for="identificacion">Identificación<i class="text-danger">*</i></label>
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
                    <input name="name" id="name" value="{{ old('name',$user->name) }}" type="text" class="form-control @error('name') is-invalid @enderror"  >
                    <label for="name">Nombre de usuario</label>
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
                    <input name="email" id="email" value="{{ old('email',$user->email) }}" type="email" class="form-control @error('email') is-invalid @enderror" >
                    <label for="email">Email</label>
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
                    <input name="password" id="password" value="{{ old('password') }}" type="password" class="form-control @error('password') is-invalid @enderror" >
                    <label for="password">Contraseña</label>
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
                    <input name="provincia" id="provincia" value="{{ old('provincia',$user->provincia) }}" type="text" class="form-control @error('provincia') is-invalid @enderror" required>
                    <label for="provincia">Provincia<i class="text-danger">*</i></label>
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
                    <input name="canton" id="canton" value="{{ old('canton',$user->canton) }}" type="text" class="form-control @error('canton') is-invalid @enderror" required>
                    <label for="canton">Cantón<i class="text-danger">*</i></label>
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
                    <input name="parroquia" id="parroquia" value="{{ old('parroquia',$user->parroquia) }}" type="text" class="form-control @error('parroquia') is-invalid @enderror" required>
                    <label for="parroquia">Parroquia<i class="text-danger">*</i></label>
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
                    <input name="recinto" id="recinto" value="{{ old('recinto',$user->recinto) }}" type="text" class="form-control @error('recinto') is-invalid @enderror" required>
                    <label for="recinto">Recinto<i class="text-danger">*</i></label>
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
                    <input name="direccion" id="direccion" value="{{ old('direccion',$user->direccion) }}" type="text" class="form-control @error('direccion') is-invalid @enderror" required>
                    <label for="direccion">Dirección<i class="text-danger">*</i></label>
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
                    <input name="telefono" id="telefono" value="{{ old('telefono',$user->telefono) }}" type="tel" class="form-control @error('telefono') is-invalid @enderror" >
                    <label for="telefono">Teléfono</label>
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
                    <input name="celular" id="celular" value="{{ old('celular',$user->celular) }}" type="tel" class="form-control @error('celular') is-invalid @enderror" >
                    <label for="celular">Celular</label>
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
                    <input name="lugar_nacimiento" id="lugar_nacimiento" value="{{ old('lugar_nacimiento',$user->lugar_nacimiento) }}" type="text" class="form-control @error('lugar_nacimiento') is-invalid @enderror" required>
                    <label for="lugar_nacimiento">Lugar de nacimiento<i class="text-danger">*</i></label>
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
                    <input name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento',$user->fecha_nacimiento) }}" type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" required>
                    <label for="fecha_nacimiento">Fecha de nacimiento<i class="text-danger">*</i></label>
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
                    <input name="nacionalidad" id="nacionalidad" value="{{ old('nacionalidad',$user->nacionalidad) }}" type="text" class="form-control @error('nacionalidad') is-invalid @enderror" required>
                    <label for="nacionalidad">Nacionalidad<i class="text-danger">*</i></label>
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
                    
                    <select name="estado_civil" id="estado_civil" class="form-select @error('estado_civil') is-invalid @enderror" required>
                        <option value=""></option>
                        <option value="SOLTERO" {{ old('estado_civil',$user->estado_civil)=='SOLTERO'?'selected':'' }}>SOLTERO</option>
                        <option value="CASADO" {{ old('estado_civil',$user->estado_civil)=='CASADO'?'selected':'' }}>CASADO</option>
                        <option value="DIVORCIADO" {{ old('estado_civil',$user->estado_civil)=='DIVORCIADO'?'selected':'' }}>DIVORCIADO</option>
                        <option value="VIUDO" {{ old('estado_civil',$user->estado_civil)=='VIUDO'?'selected':'' }}>VIUDO</option>
                        <option value="UNIÓN LIBRE" {{ old('estado_civil',$user->estado_civil)=='UNIÓN LIBRE'?'selected':'' }}>UNIÓN LIBRE</option>
                    </select>
                    <label for="estado_civil">Estado civil<i class="text-danger">*</i></label>
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
                    <select class="form-select @error('estado') is-invalid @enderror" name="estado" id="estado" required>
                        <option value=""></option>
                        <option value="ACTIVO" {{ old('estado',$user->estado)=='ACTIVO'?'selected':'' }}>ACTIVO</option>
                        <option value="INACTIVO" {{ old('estado',$user->estado)=='INACTIVO'?'selected':'' }}>INACTIVO</option>
                    </select>

                    <label for="estado">Estado<i class="text-danger">*</i></label>
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
                    <select class="form-select @error('sexo') is-invalid @enderror" name="sexo" id="sexo" required>
                        <option value=""></option>
                        <option value="HOMBRE" {{ old('sexo',$user->sexo)=='HOMBRE'?'selected':'' }}>HOMBRE</option>
                        <option value="MUJER" {{ old('sexo',$user->sexo)=='MUJER'?'selected':'' }}>MUJER</option>
                    </select>
                    <label for="sexo">Sexo<i class="text-danger">*</i></label>
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
                                    <input class="form-check-input" id="rol-{{ $rol->id }}" name="roles[{{ $rol->id }}]" {{ $user->hasRole($rol)?'checked':'' }} {{ old('roles.'.$rol->id)==$rol->id ?'checked':'' }} value="{{ $rol->id }}" type="checkbox">
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
                    <input name="nombre_conyuge" id="nombre_conyuge" value="{{ old('nombre_conyuge',$user->nombre_conyuge) }}" type="text" class="form-control @error('nombre_conyuge') is-invalid @enderror" >
                    <label for="nombre_conyuge">Apellidos y nombres de conyuge</label>
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
                    <input name="identificacion_conyuge" id="identificacion_conyuge" value="{{ old('identificacion_conyuge',$user->identificacion_conyuge) }}" type="number" min="0" class="form-control @error('identificacion_conyuge') is-invalid @enderror" >
                    <label for="identificacion_conyuge">Identificación de conyuge</label>
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
                    <input name="celular_conyuge" id="celular_conyuge" value="{{ old('celular_conyuge',$user->celular_conyuge) }}" type="tel" class="form-control @error('celular_conyuge') is-invalid @enderror" >
                    <label for="celular_conyuge">Celular de conyuge</label>
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
                    <input name="nombre_representante" id="nombre_representante" value="{{ old('nombre_representante',$user->nombre_representante) }}" type="text" class="form-control @error('nombre_representante') is-invalid @enderror" required>
                    <label for="nombre_representante">Apellidos y Nombres de representante<i class="text-danger">*</i></label>
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
                    <input name="identificacion_representante" id="identificacion_representante" value="{{ old('identificacion_representante',$user->identificacion_representante) }}" type="number" min="0" class="form-control @error('identificacion_representante') is-invalid @enderror">
                    <label for="identificacion_representante">Identificación de representante</label>
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
                    <input name="parentesco_representante" id="parentesco_representante" value="{{ old('parentesco_representante',$user->parentesco_representante) }}" type="text" class="form-control @error('parentesco_representante') is-invalid @enderror">
                    <label for="parentesco_representante">Parentesco de representante</label>
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
                    <input name="celular_representante" id="celular_representante" value="{{ old('celular_representante',$user->celular_representante) }}" type="tel" class="form-control @error('celular_representante') is-invalid @enderror">
                    <label for="celular_representante">Celular de representante</label>
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
