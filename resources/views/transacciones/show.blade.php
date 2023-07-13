@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('transacciones.show',$trans) }}
@endsection

@section('breadcrumb_elements')
<div class="d-lg-flex mb-2 mb-lg-0">
    <a href="{{ route('transacciones.imprimirRecibo',$trans->id) }}" target="_blank" class="d-flex align-items-center text-body py-2">
        <i class="fa-solid fa-print me-1"></i>Recibo
    </a>
    <a href="{{ route('transacciones.imprimirComprobante',$trans->id) }}" target="_blank" class="d-flex align-items-center text-body py-2 ms-lg-3">
        <i class="fa-solid fa-print me-1"></i>Comprobante
    </a>
</div>
@endsection

@section('content')
   <div class="card">
    <div class="card-header">
        <h6 class="mb-0">Detalle de transacción</h6>
    </div>
    <div class="card-body">
        <p id="contenido">
            <strong>Número de cuenta:</strong> {{ $trans->cuentaUser->numero_cuenta }} <br>
            <strong>Apellidos & Nombres:</strong> {{ $trans->cuentaUser->user->apellidos_nombres }} <br>
            <strong>Identificación:</strong> {{ $trans->cuentaUser->user->identificacion }} <br>
            <a class="" data-bs-toggle="modal" href="#modalFotoIdentificacion" role="button">Verificar foto de identificación</a> <br>
            <strong>Tipo de transacción: </strong> {{ $trans->tipoTransaccion->tipo_signo }}{{ $trans->tipoTransaccion->nombre }} <br>
            <strong>Valor:</strong> {{ $trans->valor }} <br>
            <strong>Realizado por:</strong> {{ $trans->quien_realiza_transaccion }} <br>
            @if ($trans->quien_realiza_transaccion==='otro')
                <strong>Identificación de quien realizo:</strong> {{ $trans->identificacion_otra_persona }} <br>
                <strong>Apellidos & Nombres de quien realizo:</strong> {{ $trans->nombre_otra_persona}} <br>
            @endif
            <strong>Fecha creado:</strong> {{ $trans->created_at }} <br>
            <strong>Creado por:</strong> {{ $trans->creadoPor->apellidos_nombres }} <br>
            <strong>Fecha actualizado:</strong> {{ $trans->updated_at }} <br>
            <strong>Actualizado por:</strong> {{ $trans->actualizadoPor->apellidos_nombres }} <br>
            <strong>Detalle:</strong> {{ $trans->detalle }} <br>
            <strong>Detalle de anulación:</strong> {{ $trans->descripcion_estado }} <br>
            <strong>ESTADO:</strong> {{ $trans->estado }} <br>

        </p>

        @if ($ultimos_trans->count()>0)
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>FECHA</th>
                            <th>TRANSACCIÓN</th>
                            <th>VALOR</th>
                            <th>DISPONIBLE</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($ultimos_trans as $ultr)
                            <tr>
                                <td>{{ $ultr->created_at->toDateString() }}</td>
                                <td>{{ $ultr->tipoTransaccion->tipo==='SUMAR'?'+':'-' }}{{ $ultr->tipoTransaccion->nombre }}</td>
                                <td>{{ $ultr->valor }}</td>
                                <td>{{ $ultr->valor_disponible }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        
    </div>
   </div>

   <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Imprimir recibo
            </div>
            <div class="card-body">
                <div class="ratio ratio-16x9">
                    <iframe src="{{ route('transacciones.imprimirRecibo',$trans->id) }}" title="Recibo" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Imprimir comprobante
            </div>
            <div class="card-body">
                <div class="ratio ratio-16x9">
                    <iframe src="{{ route('transacciones.imprimirComprobante',$trans->id) }}" title="Comprobante" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
   </div>

   <!-- Modal foto identificacion -->
  <div class="modal fade" id="modalFotoIdentificacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Foto de identificación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-img-actions">
                    <img class="card-img-top img-fluid" src="{{ route('usuarios.ver-archivo',['id'=>$trans->cuentaUser->user->id,'tipo'=>'foto_identificacion']) }}" id="imgidentificacion" alt="NO SE PUEDE VISUALIZAR LA FOTO, DEBIDO A QUE NO SELECCIONA UNA CUENTA, O LA CUENTA DEL USUARIO NO TIENE FOTO DE IDENTIFICACIÓN">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /Modal foto identificacion -->
@endsection