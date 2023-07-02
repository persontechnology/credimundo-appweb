@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('plazo-fijo.show',$plazoFijo) }}
@endsection

@section('breadcrumb_elements')

<div class="d-lg-flex mb-2 mb-lg-0">
   

    <div class="dropdown ms-lg-3">
        <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
            <i class="ph-file-pdf me-2"></i>
            <span class="flex-1">Documentos</span>
        </a>

        <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">
           
            <a href="{{ route('plazo-fijo.tabla-amortizacion',$plazoFijo) }}" target="_blank" class="dropdown-item">
                <i class="ph-file-pdf me-2"></i>
                Tabla de amortización
            </a>
            
            <a href="{{ route('plazo-fijo.certificadopf',$plazoFijo) }}" target="_blank" class="dropdown-item">
                <i class="ph-file-pdf me-2"></i>
                Certificado deposito PF
            </a>

        </div>
    </div>

</div>


@endsection



@section('content')
    <div class="card">
        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
            <div class="py-sm-3 mb-sm-0">
                @include('plazo-fijo.estado',['plazoFijo'=>$plazoFijo])
            </div>
            <div class="ms-sm-auto my-sm-auto">
                
            </div>
        </div>
        <div class="card-body">
            @include('plazo-fijo.tabla-plazo-fijo',['plazoFijo'=>$plazoFijo])
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('plazo-fijo.actualizar-estado') }}" method="post" id="formEstadoCredito">
                @csrf
                <input type="hidden" name="id" value="{{ $plazoFijo->id }}">
                <label for="estadoSelect"> Actualizar estadox</label>
                <div class="input-group">
                    <select class="form-select" name="estado" id="estadoSelect" required>
                        <option value=""></option>
                        <option value="INGRESADO" {{ $plazoFijo->estado=='INGRESADO'?'selected':'' }}>INGRESADO</option>
                        <option value="APROBADO" {{ $plazoFijo->estado=='APROBADO'?'selected':'' }}>APROBADO</option>
                        <option value="REPROBADO" {{ $plazoFijo->estado=='REPROBADO'?'selected':'' }}>REPROBADO</option>
                        <option value="ENTREGADO" {{ $plazoFijo->estado=='ENTREGADO'?'selected':'' }}>ENTREGADO</option>
                        <option value="PAGADO" {{ $plazoFijo->estado=='PAGADO'?'selected':'' }}>PAGADO</option>
                        <option value="PRECANCELADO" {{ $plazoFijo->estado=='PRECANCELADO'?'selected':'' }}>PRECANCELADO</option>
                        <option value="VENCIDO" {{ $plazoFijo->estado=='VENCIDO'?'selected':'' }}>VENCIDO</option>
                    </select>
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                    
                </div>
            </form>
        </div>
        
        <div class="card-footer">
            <p>Fechas</p>
            <ul>
                <li><strong>INGRESADO:</strong> {{ $plazoFijo->fecha_ingresado }}</li>
                <li><strong>APROBADO:</strong> {{ $plazoFijo->fecha_aprobado }}</li>
                <li><strong>REPROBADO:</strong> {{ $plazoFijo->fecha_reprobado }}</li>
                <li><strong>ENTREGADO:</strong> {{ $plazoFijo->fecha_entregado }}</li>
                <li><strong>PAGADO:</strong> {{ $plazoFijo->fecha_pagado }}</li>
                <li><strong>PRECANCELADO:</strong> {{ $plazoFijo->fecha_precancelado }}</li>
                <li><strong>VENCIDO:</strong> {{ $plazoFijo->fecha_vencido }}</li>
            </ul>
        </div>
    </div>

    @push('scripts')
        <script>
            $('#formEstadoCredito').validate({
                submitHandler: function(form) {

                    $.confirm({
                        title: 'CONFIRMAR.!',
                        content: "Esta seguro de cambiar el estado a: "+$( "#estadoSelect option:selected" ).text(),
                        type: 'blue',
                        theme: 'modern',
                        icon: 'fa fa-triangle-exclamation',
                        typeAnimated: true,
                        buttons: {
                            SI: {
                                btnClass: 'btn btn-primary',
                                keys: ['enter'],
                                action: function(){
                                    block.open();
                                    form.submit();
                                }
                            },
                            NO: function () {
                            }
                        }
                    });
                    
                }
            });
        </script>
    @endpush
@endsection