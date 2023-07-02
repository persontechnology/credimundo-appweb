
@foreach (['INGRESADO','APROBADO','REPROBADO','ENTREGADO','PAGADO','PRECANCELADO','VENCIDO'] as $item_es)
    <span class="badge bg-primary bg-opacity-20 text-primary"> {{ $item_es }}
    @if ($credito->estado===$item_es)
        <i class="ph-check"></i>
    @endif
    </span>
@endforeach
