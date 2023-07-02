@extends('layouts.app')
@section('breadcrumb')
{{ Breadcrumbs::render('tipo-transacciones.edit',$tt) }}
@endsection
@section('content')
    
    <form action="{{ route('tipo-transacciones.update',$tt) }}" method="POST" autocomplete="off">
        @csrf
        @method("PUT")
        <div class="card">
           
            <div class="card-body row">
                <div class="fw-bold border-bottom pb-2 mb-3">COMPLETE DATOS</div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-exam"></i>
                        </div>
                        <input name="codigo" value="{{ old('codigo',$tt->codigo) }}" type="text" class="form-control @error('codigo') is-invalid @enderror" autofocus required>
                        <label>Código<i class="text-danger">*</i></label>
                        @error('codigo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-text-aa"></i>
                        </div>
                        <input name="nombre" value="{{ old('nombre',$tt->nombre) }}" type="text" class="form-control @error('nombre') is-invalid @enderror" required>
                        <label>Nombre<i class="text-danger">*</i></label>
                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
              
                
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-arrows-left-right"></i>
                        </div>
                        <select class="form-select @error('tipo') is-invalid @enderror" name="tipo" required>
                            <option value=""></option>
                            <option value="SUMAR" {{ old('tipo',$tt->tipo)=='SUMAR'?'selected':'' }}>SUMAR</option>
                            <option value="RESTAR" {{ old('tipo',$tt->tipo)=='RESTAR'?'selected':'' }}>RESTAR</option>
                        </select>

                        <label>Tipo<i class="text-danger">*</i></label>
                        @error('tipo')
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
                            <option value="ACTIVO" {{ old('estado',$tt->estado)=='ACTIVO'?'selected':'' }}>ACTIVO</option>
                            <option value="INACTIVO" {{ old('estado',$tt->estado)=='INACTIVO'?'selected':'' }}>INACTIVO</option>
                        </select>

                        <label>Estado<i class="text-danger">*</i></label>
                        @error('estado')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                

                <div class="col-md-12 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-article"></i>
                        </div>
                        <input name="descripcion" value="{{ old('descripcion',$tt->descripcion) }}" type="text" class="form-control @error('descripcion') is-invalid @enderror">
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
@endsection
