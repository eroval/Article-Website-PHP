@include('mysections')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>what</title>

        @yield('mystyles')
    </head>
    <body class="antialiased" style="height: 100%; width: 80%; margin: auto;">
        @yield('header')
        @yield('article-page')
        @yield('myfooter')

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>