@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('tipo-cuentas.create') }}
@endsection
@section('content')
    
    <form action="{{ route('caja.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="card">
           
            <div class="card-body row">
                <div class="fw-bold border-bottom pb-2 mb-3">COMPLETE DATOS</div>
                <div class="col-md-12 mb-1">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-exam"></i>
                        </div>
                        <input name="valor_apertura" value="{{ old('valor_apertura') }}" type="number" step="0.01" class="form-control @error('valor_apertura') is-invalid @enderror" autofocus required>
                        <label>Valor de apertura<i class="text-danger">*</i></label>
                        @error('valor_apertura')
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
                        <input name="detalle_apertura" value="{{ old('detalle_apertura') }}" type="text" class="form-control @error('detalle_apertura') is-invalid @enderror" required>
                        <label>Detalle de apertura<i class="text-danger">*</i></label>
                        @error('detalle_apertura')
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

