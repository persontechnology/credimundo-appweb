<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-end">
            <a href="{{ route('cuentas-usuario.imprimirRecibo',$trans->id) }}" class="dropdown-item" target="_blank">
                <i class="ph ph-printer me-2"></i>
                Impimir Recibo
            </a>
            <a href="{{ route('cuentas-usuario.imprimirComprobante',$trans->id) }}" class="dropdown-item" target="_blank">
                <i class="ph ph-printer me-2"></i>
                Impimir Comprobante
            </a>
            
            <a href="{{ route('cuentas-usuario.anularTransaccion',$trans) }}" class="dropdown-item">
                <i class="ph ph-prohibit me-2"></i>
                Anular
            </a> 
        </div>
    </div>
</div>