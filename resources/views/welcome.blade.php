@extends('layouts.master_layout')

@section('title')
    Upload Image
@endsection

@section('header')
    <style>
        #upload-files {
            display: none;
        }
        .upload-images {
            height: 500px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <h1>Upload Images</h1>
        <hr>
        {{ Form::open(['url' => route('image.store'), 'class' => 'dropzone', 'files' => true, 'method' => 'post', 'id' => 'dropzoneFileUpload']) }}
            {{ Form::submit('Upload', ['class' => 'btn btn-primary', 'id' => 'btn-submit']) }}
        {{ Form::close() }}

    </div>
@endsection

@section('script')
    <script>
        {{--var baseUrl = "{{ route('image.store') }}";--}}
        {{--var token = "{{ Session::getToken() }}";--}}
        {{--Dropzone.autoDiscover = false;--}}
        {{--var myDropzone = new Dropzone("#dropzoneFileUpload", {--}}
            {{--url: baseUrl,--}}
            {{--params: {--}}
                {{--_token: token--}}
            {{--}--}}
        {{--});--}}
        {{--Dropzone.options.myAwesomeDropzone = {--}}
            {{--paramName: "file", // The name that will be used to transfer the file--}}
            {{--maxFilesize: 2, // MB--}}
            {{--addRemoveLinks: true,--}}
            {{--accept: function(file, done) {--}}

            {{--},--}}
        {{--};--}}
    </script>
    <script>
        Dropzone.options.dropzoneFileUpload = {
            // Prevents Dropzone from uploading dropped files immediately
            autoProcessQueue: false,
            uploadMultiple: true,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            maxFilesize: 1,
            parallelUploads: 10,
            addRemoveLinks: true,
            init: function() {
                var submitButton = document.querySelector("#btn-submit")
                myDropzone = this; // closure

                submitButton.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                    // autoProcessQueue: true// Tell Dropzone to process all queued files.
                });

                // You might want to show the submit button only when
                // files are dropped here:
                this.on("addedfile", function () {
                    // Show submit button here and/or inform user to click it.
                });
                this.on("complete", function (file) {
                    myDropzone.removeFile(file);
                });
            }};
    </script>
@endsection