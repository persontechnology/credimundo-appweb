@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('creditos.show',$credito) }}
@endsection

@section('breadcrumb_elements')

<div class="d-lg-flex mb-2 mb-lg-0">
    <a href="{{ route('creditos.garantes',$credito) }}" class="d-flex align-items-center text-body py-2">
        <i class="ph-users-three me-2"></i>
        Garantes
    </a>

    <div class="dropdown ms-lg-3">
        <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
            <i class="ph-file-pdf me-2"></i>
            <span class="flex-1">Documentos</span>
        </a>

        <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">
           
            <a href="{{ route('creditos.tabla-amortizacion',$credito) }}" target="_blank" class="dropdown-item">
                <i class="ph-file-pdf me-2"></i>
                Tabla de amortización
            </a>
            
            <a href="{{ route('creditos.pagare',$credito) }}" target="_blank" class="dropdown-item">
                <i class="ph-file-pdf me-2"></i>
                Pagare a la orden
            </a>
        </div>
    </div>

</div>


@endsection



@section('content')
    <div class="card">
        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
            <div class="py-sm-3 mb-sm-0">
                @include('creditos.estado',['credito'=>$credito])
            </div>
            <div class="ms-sm-auto my-sm-auto">
                
            </div>
        </div>
        <div class="card-body">
            @include('creditos.tabla-credito',['credito'=>$credito])
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('creditos.actualizar-estado') }}" method="post" id="formEstadoCredito">
                @csrf
                <input type="hidden" name="id" value="{{ $credito->id }}">
                <label for="estadoSelect"> Actualizar estado</label>
                <div class="input-group">
                    <select class="form-select" name="estado" id="estadoSelect" required>
                        <option value=""></option>
                        <option value="INGRESADO" {{ $credito->estado=='INGRESADO'?'selected':'' }}>INGRESADO</option>
                        <option value="APROBADO" {{ $credito->estado=='APROBADO'?'selected':'' }}>APROBADO</option>
                        <option value="REPROBADO" {{ $credito->estado=='REPROBADO'?'selected':'' }}>REPROBADO</option>
                        <option value="ENTREGADO" {{ $credito->estado=='ENTREGADO'?'selected':'' }}>ENTREGADO</option>
                        <option value="PAGADO" {{ $credito->estado=='PAGADO'?'selected':'' }}>PAGADO</option>
                        <option value="PRECANCELADO" {{ $credito->estado=='PRECANCELADO'?'selected':'' }}>PRECANCELADO</option>
                        <option value="VENCIDO" {{ $credito->estado=='VENCIDO'?'selected':'' }}>VENCIDO</option>
                    </select>
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                    
                </div>
            </form>
        </div>
        
        <div class="card-footer">
            <p>Fechas</p>
            <ul>
                <li><strong>INGRESADO:</strong> {{ $credito->fecha_ingresado }}</li>
                <li><strong>APROBADO:</strong> {{ $credito->fecha_aprobado }}</li>
                <li><strong>REPROBADO:</strong> {{ $credito->fecha_reprobado }}</li>
                <li><strong>ENTREGADO:</strong> {{ $credito->fecha_entregado }}</li>
                <li><strong>PAGADO:</strong> {{ $credito->fecha_pagado }}</li>
                <li><strong>PRECANCELADO:</strong> {{ $credito->fecha_precancelado }}</li>
                <li><strong>VENCIDO:</strong> {{ $credito->fecha_vencido }}</li>
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