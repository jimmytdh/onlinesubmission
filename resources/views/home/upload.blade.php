@extends('guest')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ url('plugins/dropzone/dropzone.css') }}">

@endsection

@section('body')
    <h2 class="text-success title-header">Upload Files</h2>

    <div class="col-md-12">
        <form action="{{ url('dropzone/upload') }}" class="dropzone">
            {{ csrf_field() }}
            <div class="fallback">
                <input name="file" type="file"  />
            </div>
        </form>
    </div>
@endsection

@section('modal')

@endsection

@section('js')
    <script src="{{ url('plugins/dropzone/dropzone.js') }}"></script>
    <script>
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone(".dropzone",{
            maxFilesize: 30,  // 3 mb
            acceptedFiles: ".jpeg,.jpg,.png,.pdf,.zip,.rar",
            addRemoveLinks: true,
            removedfile: function(file) {
                // var name = file.name;
                // $.ajax({
                //     type: 'POST',
                //     url: 'delete.php',
                //     data: "id="+name,
                //     dataType: 'html'
                // });
                // var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                console.log(file.name);
            }
        });
        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", CSRF_TOKEN);
        });
    </script>
@endsection
