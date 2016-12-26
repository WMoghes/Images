@extends('layouts.master_layout')

@section('title')
    Our Images
@endsection

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        ul { list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px; }
        li { margin: 5px; padding: 5px; width: 150px; }
    </style>
@endsection

@section('content')
    <div class="row">
        <h1>Our Images</h1>
        <hr>
    </div>
    <div class="row">
        <ul id="sortable">
            @if(count($images) > 0)
                @foreach($images as $image)
                    <li id="item-{{ $image->id }}" class="ui-state-default">
                        <div>
                            <img src="{{ URL::to('images'). '/' . $image->image_name }}" width="100" height="100">
                        </div>
                    </li>
                @endforeach
            @else
                <h1>There's no images</h1>
            @endif
        </ul>
        <a href="{{ route('homepage') }}" class="btn btn-primary">Back to upload images</a>
    </div>
@endsection

@section('script')
    {!! Html::script(URL::to('assets/js/jquery-ui.js')) !!}

    <script>
        $( function() {
            $( "#sortable" ).sortable({
                revert: true
            });
            $( "#draggable" ).draggable({
                connectToSortable: "#sortable",
                helper: "clone",
                revert: "invalid"
            });
            $( "ul, li" ).disableSelection();
        } );
    </script>
    <script>
        $(document).ready(function () {
            $('ul').sortable({
                axis: 'y',
                stop: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    console.log(data);
                    var URLBase = '{{ route('set.position') }}';
                    console.log(data);
                    $.ajax({
                         headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },
                         data: data,
                         type: 'GET',
                         url: URLBase
                     });
                }
            });
        });
    </script>
@endsection
