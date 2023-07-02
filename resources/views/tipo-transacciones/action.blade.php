<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-end">
            @can('update', $tt)
                <a href="{{ route('tipo-transacciones.edit',$tt) }}" class="dropdown-item">
                    <i class="ph-pen me-2"></i>
                    Editar
                </a>
            @endcan
            @can('delete', $tt)
                <a href="{{ route('tipo-transacciones.destroy',$tt) }}" data-msg="{{ $tt->nombre }}" onclick="event.preventDefault();eliminar(this);" class="dropdown-item">
                    <i class="ph-trash me-2"></i>
                    Eliminar
                </a>
            @endcan
            
        </div>
    </div>
</div>


