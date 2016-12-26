@extends('layouts.master_layout')

@section('title')
    Upload Images
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
        <a href="{{ route('image.index') }}">Display the images</a>
        <br>
        <a href="{{ route('show-all') }}">Editing on my images</a>
    </div>
@endsection

@section('script')
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
                    if(input.length > 2){
                        myDropzone.processQueue();
                    } else {
                        alert('you should upload at least 3 images');
                    }
                    // autoProcessQueue: true// Tell Dropzone to process all queued files.
                });

                // You might want to show the submit button only when
                // files are dropped here:
                var input = [];
                this.on("addedfile", function (file) {
                    input.push(file);
                    console.log(input.length);

                });
                this.on("removedfile", function (file) {
                    input.pop();
                    console.log(input.length);

                });
                this.on("complete", function (file) {
                    myDropzone.removeFile(file);
                });
            }};
    </script>
@endsection