<div class="d-inline-flex">
    
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-end">
            <a href="{{ route('cuentas-usuario.solicitud-apertura-cuenta',$cu->id) }}" target="_blank" class="dropdown-item">
                <i class="ph-file-pdf me-2"></i>
                Solicitud Apertura de cuenta
            </a>
            
            <a href="{{ route('cuentas-usuario-transaciones',$cu->id) }}" class="dropdown-item">
                <i class="ph ph-repeat me-2"></i>
                Transacciones del socio
            </a>
            
            <div class="dropdown-header">Opciones</div>
            <a href="{{ route('cuentas-usuario.edit',$cu) }}" class="dropdown-item">
                <i class="ph-pen me-2"></i>
                Editar
            </a>
            <a href="{{ route('cuentas-usuario.destroy',$cu) }}" data-msg="{{ $cu->numero_cuenta }}" onclick="event.preventDefault();eliminar(this);" class="dropdown-item">
                <i class="ph-trash me-2"></i>
                Eliminar
            </a>
            
        </div>
    </div>
    <a href="{{ route('cuentas-usuario.show',$cu->id) }}" class="text-body" data-bs-popup="tooltip" title="Detalle">
        <i class="ph ph-arrow-fat-right"></i>
    </a>
</div>
