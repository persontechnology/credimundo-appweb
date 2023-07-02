@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('tipo-cuentas.index') }}
@endsection

@section('breadcrumb_elements')
<div class="d-lg-flex mb-2 mb-lg-0">
    <a href="{{ route('tipo-cuentas.create') }}" class="d-flex align-items-center text-body py-2">
        <i class="ph ph-file-plus"></i>Nuevo
    </a>
</div>
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                {{$dataTable->table()}}
            </div>
            
        </div>
    </div>
@endsection
@push('scripts')
    {{$dataTable->scripts()}}
@endpush