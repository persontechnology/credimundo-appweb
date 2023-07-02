<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-end">
            <a href="{{ route('plazo-fijo.show',$c) }}" class="dropdown-item">
                <i class="ph-eye me-2"></i>Ver
            </a>
     
            <a href="{{ route('plazo-fijo.edit',$c) }}" class="dropdown-item">
                <i class="ph-pen me-2"></i>Editar
            </a>
    
            <a href="{{ route('plazo-fijo.destroy',$c) }}" data-msg="Certificado P.F N° {{ $c->numero }}" onclick="event.preventDefault();eliminar(this);" class="dropdown-item">
                <i class="ph-trash me-2"></i>Eliminar
            </a>
            
        </div>
    </div>
</div>

