@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('home') }}
@endsection

@section('content')
<!-- Content area -->
<div class="d-flex justify-content-center align-items-center">
    <div class="login-form" action="index.html">
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img class="rounded-circle" src="{{ asset('img/logo-light.svg') }}" width="260" height="260" alt="">
                        
                    </div>
                </div>

                <div class="text-center mb-3">
                    <h6 class="mb-0">MG.ING DAVID CRIOLLO</h6>
                    <span class="text-muted">PRESIDENTE</span>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- /content area -->
@endsection
