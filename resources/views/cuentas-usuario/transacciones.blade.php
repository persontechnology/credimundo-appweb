@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('cuentas-usuario-transaciones',$cuentaUser) }}
@endsection
@section('breadcrumb_elements')

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