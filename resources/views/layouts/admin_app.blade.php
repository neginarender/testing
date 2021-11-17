<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{config('app.name')}}">
    <meta name="author" content="{{config('app.name')}}">
    <title>{{config('app.name')}}</title>
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
    @include('layouts.header')
    <main class="container mt-5">
        @yield('content')
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    @section("scripts")
    @show
  </body>
</html>