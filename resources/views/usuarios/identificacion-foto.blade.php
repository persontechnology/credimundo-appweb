@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('usuarios.identificacion-foto',$user) }}
@endsection


@section('content')

<div class="card">
        
    <div class="card-body row">
        <div class="col-md-6 mb-1">
            <p>Foto personal</p>
            <div class="file-loading"> 
                <input type="file" name="foto" id="foto" class="file-input form-control @error('foto') is-invalid @enderror" accept="image/png, image/jpg, image/jpeg">
                @error('foto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
           
        </div>
        <div class="col-md-6 mb-1">
            <p>Foto de identificación</p>
            <div class="file-loading"> 
                <input type="file" name="foto_identificacion" id="foto_identificacion" class="file-input form-control @error('foto_identificacion') is-invalid @enderror" accept="image/png, image/jpg, image/jpeg">
                @error('foto_identificacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>

@push('scriptsHeader')
{{-- fileinput --}}
<link href="{{ asset('assets/js/vendor/uploaders/fileinput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/js/plugins/buffer.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/js/plugins/filetype.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/js/plugins/piexif.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/js/plugins/sortable.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/js/locale/es.js') }}"></script>
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/themes/fa6/theme.min.js') }}"></script>
@endpush

@push('scripts')
    <script>


    var url_foto_ver = "{{ route('usuarios.ver-archivo',['id'=>$user->id,'tipo'=>'foto']) }}";
    var url_foto_descarga = "{{ route('usuarios.descargar-archivo',['id'=>$user->id,'tipo'=>'foto']) }}";
    
    var url_foto_identificacion_ver = "{{ route('usuarios.ver-archivo',['id'=>$user->id,'tipo'=>'foto_identificacion']) }}";
    var url_foto_identificacion_descarga = "{{ route('usuarios.descargar-archivo',['id'=>$user->id,'tipo'=>'foto_identificacion']) }}";

    $("#foto").fileinput({
        initialPreview: [url_foto_ver],
        initialPreviewAsData: true,
        initialPreviewShowDelete:false,
        initialPreviewConfig: [
            {downloadUrl: url_foto_descarga},
        ],
        uploadUrl: "{{ route('usuarios.actualizar-identificacion-foto') }}",
        allowedFileTypes: ["image"],
        maxImageWidth: 520,
        maxImageHeight: 340,
        resizePreference: 'height',
        maxFileCount: 1,
        resizeImage: true,
        // resizeIfSizeMoreThan: 1000,
        language: "es",
        theme: "fa6",
        browseLabel: 'Foto personal',
        showRemove: false,
        showClose: false,
        uploadExtraData: {
            'id': '{{ $user->id }}',
            'tipo':'foto'
        }
    });

    $("#foto_identificacion").fileinput({
        initialPreview: [url_foto_identificacion_ver],
        initialPreviewAsData: true,
        initialPreviewShowDelete:false,
        initialPreviewConfig: [
            {downloadUrl: url_foto_identificacion_descarga},
        ],
        uploadUrl: "{{ route('usuarios.actualizar-identificacion-foto') }}",
        allowedFileTypes: ["image"],
        maxImageWidth: 520,
        maxImageHeight: 340,
        resizePreference: 'height',
        maxFileCount: 1,
        resizeImage: true,
        // resizeIfSizeMoreThan: 1000,
        language: "es",
        theme: "fa6",
        browseLabel: 'Foto identificación',
        showRemove: false,
        showClose: false,
        uploadExtraData: {
            'id': '{{ $user->id }}',
            'tipo':'identificacion'
        }
    });

    </script>
@endpush
@endsection
