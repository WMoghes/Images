@extends('layouts.master_layout')

@section('title')
    Display Crops
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
            @if(count($crops) > 0)
                @foreach($crops as $crop)
                    <img src="{{ URL::to('images/imagesAfterCroped'). '/' . $crop->crop_image_name }}" width="100" height="100">
                @endforeach
            @else
                <h1>There's no crops</h1>
            @endif
        </ul>
        <a href="{{ route('homepage') }}" class="btn btn-primary">Back to upload images</a>
    </div>
@endsection

@section('script')

@endsection
