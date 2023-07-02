@extends('layouts.app')
@section('breadcrumb')
<div class="d-flex">
    <div class="breadcrumb py-2">
        {{ Breadcrumbs::render('tipo-creditos.edit',$tc) }}
    </div>
</div>

@endsection
@section('content')
    
    <form action="{{ route('tipo-creditos.update',$tc) }}" method="POST" autocomplete="off">
        @csrf
        @method("PUT")
        <div class="card">
           
            <div class="card-body row">
                <div class="fw-bold border-bottom pb-2 mb-3">COMPLETE DATOS</div>
                
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-text-aa"></i>
                        </div>
                        <input name="nombre" value="{{ old('nombre',$tc->nombre) }}" type="text" class="form-control @error('nombre') is-invalid @enderror" required autofocus>
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
                            <i class="ph-percent"></i>
                        </div>
                        <input name="tasa_efectiva_anual" value="{{ old('tasa_efectiva_anual',$tc->tasa_efectiva_anual) }}" type="number" min="0" step="0.01" class="form-control @error('tasa_efectiva_anual') is-invalid @enderror" required>
                        <label>Tasa efectiva anual-PARA CRÉDITOS<i class="text-danger">*</i></label>
                        @error('tasa_efectiva_anual')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-percent"></i>
                        </div>
                        <input name="tasa_nominal" value="{{ old('tasa_nominal',$tc->tasa_nominal) }}" type="number" min="0" step="0.01" class="form-control @error('tasa_nominal') is-invalid @enderror" required>
                        <label>Tasa nominal<i class="text-danger">*</i></label>
                        @error('tasa_nominal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
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
                            <option value="ACTIVO" {{ old('estado',$tc->estado)=='ACTIVO'?'selected':'' }}>ACTIVO</option>
                            <option value="INACTIVO" {{ old('estado',$tc->estado)=='INACTIVO'?'selected':'' }}>INACTIVO</option>
                        </select>

                        <label>Estado<i class="text-danger">*</i></label>
                        @error('estado')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                

                <div class="col-md-10 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-article"></i>
                        </div>
                        <input name="descripcion" value="{{ old('descripcion',$tc->descripcion) }}" type="text" class="form-control @error('descripcion') is-invalid @enderror">
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
