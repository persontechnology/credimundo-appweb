<button type="button" class="btn btn-primary" 
    data-cuid="{{ $cu->id }}" 
    data-cunumero="{{ $cu->numero_cuenta }}" 
    data-userapellidosnombres="{{ $cu->user->apellidos_nombres }}" 
    onclick="selecionarUsuario(this);"
    data-bs-popup="tooltip" title="Selecionar" data-bs-placement="right"
    data-verarchivo="{{ route('usuarios.ver-archivo',['id'=>$cu->user->id,'tipo'=>'foto_identificacion']) }}"
    >

    <i class="ph-hand-pointing"></i>
</button>
