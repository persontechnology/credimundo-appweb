<button type="button" class="btn btn-primary" 
    data-cuid="{{ $cu->id }}" 
    data-cunumero="{{ $cu->numero_cuenta }}" 
    data-userapellidosnombres="{{ $cu->user->apellidos_nombres }}" 
    onclick="selecionarUsuario(this);"
    data-bs-popup="tooltip" title="Selecionar" data-bs-placement="right" 
    >
    <i class="ph-hand-pointing"></i>
</button>
