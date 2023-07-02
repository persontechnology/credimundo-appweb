@extends('layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('transacciones.edit',$trans) }}
@endsection
@section('content')

<form action="{{ route('transacciones.update',$trans) }}" method="POST" autocomplete="off" id="formCreateTransaccion">
    @csrf
    @method("PUT")
    <input type="hidden" name="id" value="{{ $trans->id }}">
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">Detalle de transacción</h6>
        </div>
        <div class="card-body row">

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
                <strong>Creado por:</strong> {{ $trans->actualizadoPor->apellidos_nombres }} <br>
                <strong>Detalle:</strong> {{ $trans->detalle }} <br>
                <strong>Detalle de anulación:</strong> {{ $trans->descripcion_estado }} <br>
                <strong>ESTADO:</strong> {{ $trans->estado }} <br>
            </p>

        </div>
        <div class="card-footer">
            @if ($trans->estado==='OK')
            <div class="my-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-article"></i>
                    </div>
                    <input name="detalle" value="{{ old('detalle') }}" type="text" class="form-control @error('detalle') is-invalid @enderror" required autofocus>
                    <label>¿PORQUE QUIERE ANULAR ESTA TRANSACCIÓN?</label>
                    @error('detalle')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="my-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="confirmacion" id="flexCheckDefault" required>
                    <label class="form-check-label" for="flexCheckDefault">
                      ESTA SEGURO DE ANULAR ESTA TRANSACCIÓN N° {{ $trans->numero }}
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Continuar</button>
            @else
            @include('sections.alert',['type'=>'primary','msg'=>' TRANSACCIÓ YA ESTA ANULADA..!'])
            @endif
        </div>
    </div>
</form>




  

  
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



@push('scripts')
    
    <script>
        $('#formCreateTransaccion').validate({
            submitHandler: function(form) {
                $.confirm({
                    title: 'CONFIRMAR ANULACIÓN DE TRANSACCIÓN',
                    content: "{{ $trans->tipoTransaccion->tipo_signo }}{{ $trans->tipoTransaccion->nombre }}",
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