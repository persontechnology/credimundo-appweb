<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-end">
            
                <a href="{{ route('caja.edit',$caja) }}" class="dropdown-item">
                    <i class="ph-pen me-2"></i>
                    Editar
                </a>    
            
                <a href="{{ route('caja.destroy',$caja) }}" data-msg="{{ $caja->fecha }}" onclick="event.preventDefault();eliminar(this);" class="dropdown-item">
                    <i class="ph-trash me-2"></i>
                    Eliminar
                </a>
                
        </div>
    </div>
</div>

