<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-end">
            @can('update', $tc)
                <a href="{{ route('tipo-creditos.edit',$tc) }}" class="dropdown-item">
                    <i class="ph-pen me-2"></i>
                    Editar
                </a>    
            @endcan
            
            @can('delete', $tc)
                <a href="{{ route('tipo-creditos.destroy',$tc) }}" data-msg="{{ $tc->nombre }}" onclick="event.preventDefault();eliminar(this);" class="dropdown-item">
                    <i class="ph-trash me-2"></i>
                    Eliminar
                </a>    
            @endcan
            
            
        </div>
    </div>
</div>

