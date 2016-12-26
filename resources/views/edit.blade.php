@extends('layouts.master_layout')

@section('title')
    Editing
@endsection

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! Html::style(URL::to('assets/css/cropper.min.css')) !!}
@endsection

@section('content')
    <h1 class="page-header">Customize preview for Cropper</h1>
    <div class="row">
        <div class="col-sm-6">
            <h3 class="page-header">Cropper</h3>
            <div>
                <img class="img-responsive" id="image" src="{{ URL::to('images'). '/' . $image->image_name }}" alt="Picture">
                <br>
                <a id="submit" href="#" class="btn btn-primary">Crop</a>
            </div>
        </div>
        <div class="col-sm-6">
            <h3 class="page-header">Preview</h3>
            <div class="row">
                <div class="col-sm-6">
                    <div id="preview-1" class="preview"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    {!! Html::script(URL::to('assets/js/cropper.min.js')) !!}
    <script>
        $(function () {
            var $previews = $('.preview');

            $('#image').cropper({
                build: function (e) {
                    var $clone = $(this).clone();

                    $clone.css({
                        display: 'block',
                        width: '100%',
                        minWidth: 0,
                        minHeight: 0,
                        maxWidth: 'none',
                        maxHeight: 'none'
                    });

                    $previews.css({
                        width: '100%',
                        overflow: 'hidden'
                    }).html($clone);
                },

                crop: function (e) {
                    var imageData = $(this).cropper('getImageData');
                    var previewAspectRatio = e.width / e.height;

                    $previews.each(function () {
                        var $preview = $(this);
                        var previewWidth = $preview.width();
                        var previewHeight = previewWidth / previewAspectRatio;
                        var imageScaledRatio = e.width / previewWidth;

                        $preview.height(previewHeight).find('img').css({
                            width: imageData.naturalWidth / imageScaledRatio,
                            height: imageData.naturalHeight / imageScaledRatio,
                            marginLeft: -e.x / imageScaledRatio,
                            marginTop: -e.y / imageScaledRatio
                        });
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var $image = $('#image');
            var arr = [];
            $image.on({
                'crop.cropper': function (e) {
//                    console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
                    arr['x'] = e.x;
                    arr['y'] = e.y;
                    arr['width'] = e.width;
                    arr['height'] = e.height;
                    arr['scaleX'] = e.scaleX;
                    arr['scaleY'] = e.scaleY;
                }
            });

            $('#submit').click(function(event) {
                event.preventDefault();
                console.log(arr);
                var URLBase = '{{ route('crop', $image->id) }}';
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        width: arr['width'],
                        height: arr['height'],
                        x: arr['x'],
                        y: arr['y'],
                        scaleX: arr['scaleX'],
                        scaleY: arr['scaleY'],
                    },
                    type: 'GET',
                    url: URLBase
                });
            });
        });
    </script>
@endsection
