<!DOCTYPE Html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    {!! Html::style(URL::to('assets/css/bootstrap.min.css')) !!}
    {!! Html::style(URL::to('assets/css/dropzone.css')) !!}

    @yield('header')

</head>
<body>

<div class="container">
    @yield('content')
</div>

{!! Html::script(URL::to('assets/js/jquery-1.11.1.min.js')) !!}
{!! Html::script(URL::to('assets/js/bootstrap.min.js')) !!}
{!! Html::script(URL::to('assets/js/dropzone.js')) !!}

@yield('script')
@yield('footer')

</body>
</html>
