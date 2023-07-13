@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('tipo-creditos.create') }}
@endsection
@section('content')
    
    <form action="{{ route('tipo-creditos.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="card">
           
            <div class="card-body row">
                <div class="fw-bold border-bottom pb-2 mb-3">COMPLETE DATOS</div>
          

                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-text-aa"></i>
                        </div>
                        <input name="nombre" value="{{ old('nombre') }}" type="text" class="form-control @error('nombre') is-invalid @enderror" required autofocus>
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
                        <input name="tasa_efectiva_anual" value="{{ old('tasa_efectiva_anual') }}" type="number" min="0" step="0.01" class="form-control @error('tasa_efectiva_anual') is-invalid @enderror" required>
                        <label>Tasa efectiva anual-PARA CRÉDITOS o PLAZO FIJO<i class="text-danger">*</i></label>
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
                        <input name="tasa_nominal" value="{{ old('tasa_nominal') }}" type="number" min="0" step="0.01" class="form-control @error('tasa_nominal') is-invalid @enderror" required>
                        <label>Tasa nominal<i class="text-danger">*</i></label>
                        @error('tasa_nominal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-3 mb-1">
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
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>


                <div class="col-md-3 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-toggle-left"></i>
                        </div>
                        <select class="form-select @error('tipo') is-invalid @enderror" name="tipo" required>
                            <option value=""></option>
                            <option value="CREDITO" {{ old('tipo')=='CREDITO'?'selected':'' }}>CREDITO</option>
                            <option value="PLAZO FIJO" {{ old('tipo')=='PLAZO FIJO'?'selected':'' }}>PLAZO FIJO</option>
                        </select>

                        <label>Tipo para<i class="text-danger">*</i></label>
                        @error('tipo')
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
                        <input name="descripcion" value="{{ old('descripcion') }}" type="text" class="form-control @error('descripcion') is-invalid @enderror">
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
