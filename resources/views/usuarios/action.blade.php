<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-end">

            @can('autenticar', $user)
                <a href="{{ route('usuarios.autenticar',$user->id) }}" class="dropdown-item">
                    <i class="ph ph-sign-in me-2"></i>
                    Ingresar
                </a>        
            @endcan

            
            <a href="{{ route('usuarios.identificacion-foto',$user->id) }}" class="dropdown-item">
                <i class="ph ph-user-focus me-2"></i>
                Identificación y Foto
            </a>

           

            @can('update', $user)
                <a href="{{ route('usuarios.edit',$user->id) }}" class="dropdown-item">
                    <i class="ph ph-pencil-simple me-2"></i>
                    Editar
                </a>    
            @endcan
            

            @can('delete', $user)
                <a href="{{ route('usuarios.destroy',$user->id) }}" data-msg="{{ $user->apellidos_nombres }}" onclick="event.preventDefault(); eliminar(this)" class="dropdown-item">
                    <i class="ph ph-trash me-2"></i>
                    Eliminar
                </a>
            @endcan
            
        </div>
    </div>
</div>