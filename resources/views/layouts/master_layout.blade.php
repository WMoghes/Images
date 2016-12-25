<!DOCTYPE Html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    {!! Html::style(URL::to('assets/css/bootstrap.min.css')) !!}


    @yield('header')

</head>
<body>

<div class="container">
    @yield('content')
</div>


{!! Html::script(URL::to('assets/css/jquery-1.11.1.min.js')) !!}
{!! Html::script(URL::to('assets/css/bootstrap.min.js')) !!}
@yield('footer')

</body>
</html>
