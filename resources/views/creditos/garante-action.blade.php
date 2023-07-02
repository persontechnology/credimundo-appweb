<div class="d-flex align-items-center">
    <input type="checkbox" id="dc_ls_c{{ $u->id }}" value="{{ $u->id }}" name="garantes[]" {{ $u->esGarante($u->id,$idCredito)?'checked':'' }}>
    <label class="ms-2" for="dc_ls_c{{ $u->id }}"></label>
</div>