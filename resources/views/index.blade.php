<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <link rel="stylesheet" type="text/css" href="/css/normalize.css">
        @stack('styles')
    </head>
    <body>
        <div id="app">
            @yield('content')
        </div>
        <script type="text/javascript" src="/js/app.js"></script>
        @stack('scripts')
    </body>
</html>
