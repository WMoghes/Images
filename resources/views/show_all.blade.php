@extends('layouts.master_layout')

@section('title')
    Editing
@endsection

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="row">
        <h1>Edit on my images</h1>
        <h4>Select the image to start editing</h4>
        <hr>
    </div>
    <div class="row">
        <ul id="sortable">
            @if(count($images) > 0)
                @foreach($images as $image)
                    <a href="{{ route('image.edit', $image->id) }}">
                        <img src="{{ URL::to('images'). '/' . $image->image_name }}" width="100" height="100">
                    </a>

                    {{--<li class="ui-state-default">{{ $image->image_original_name }}</li>--}}
                    {{--<li class="ui-state-default">{{ $image->image_name }}</li>--}}
                    {{--<li class="ui-state-default">{{ $image->image_size }}</li>--}}
                    {{--<li class="ui-state-default">{{ $image->image_type }}</li>--}}
                @endforeach
            @endif
        </ul>
        <a href="{{ route('homepage') }}">Back to upload images</a>
    </div>
@endsection

@section('script')

@endsection
