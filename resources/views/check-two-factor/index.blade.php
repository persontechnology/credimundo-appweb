@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('login') }}
@endsection



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Código de acceso</div>

                <div class="card-body">

                    <p class="text-center">Enviamos el código al correo electrónico: {{ Str::mask(Auth::user()->email, '*', -15, Str::length(Auth::user()->email)/2 ); }}</p>
                    
                    <form method="POST" action="{{ route('check2fa.crear') }}" id="formCheck2fa">
                        @csrf


                        <div class="form-floating form-control-feedback form-control-feedback-start mb-3">
                            <div class="form-control-feedback-icon">
                                <i class="ph ph-password"></i>
                            </div>
                            <input id="codigo" type="number" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}" required autocomplete="codigo" autofocus>
                            <label>Código</label>
                            @error('codigo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                Ingresar
                            </button>
                        </div>

                        <div class="text-center">
                            <a class="btn btn-link" href="{{ route('check2fa.reenviar') }}">
                                Reenviar código
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $( "#formCheck2fa" ).validate();
    </script>
@endpush
@endsection
