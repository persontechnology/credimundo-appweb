@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('tipo-cuentas.edit',$tc) }}
@endsection
@section('content')
    
    <form action="{{ route('tipo-cuentas.update',$tc) }}" method="POST" autocomplete="off">
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
                        <input name="codigo" value="{{ old('codigo',$tc->codigo) }}" type="text" class="form-control @error('codigo') is-invalid @enderror" autofocus required>
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
                        <input name="nombre" value="{{ old('nombre',$tc->nombre) }}" type="text" class="form-control @error('nombre') is-invalid @enderror" required>
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
                            <i class="ph-currency-dollar"></i>
                        </div>
                        <input name="valor_apertura" value="{{ old('valor_apertura',$tc->valor_apertura) }}" type="number" min="0" step="0.01" class="form-control @error('valor_apertura') is-invalid @enderror" required>
                        <label>Valor de apertura<i class="text-danger">*</i></label>
                        @error('valor_apertura')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-currency-dollar"></i>
                        </div>
                        <input name="valor_debito" value="{{ old('valor_debito',$tc->valor_debito) }}" type="number" min="0" step="0.01" class="form-control @error('valor_debito') is-invalid @enderror" required>
                        <label>Valor de débito<i class="text-danger">*</i></label>
                        @error('valor_debito')
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
