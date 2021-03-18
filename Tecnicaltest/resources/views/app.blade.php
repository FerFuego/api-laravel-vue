<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.laravel = { csrfToken: '{{ csrf_token() }}' }</script>
        <title>Laravel + VUE</title>
        <!-- Fonts -->
        <link src="{{ asset('css/app.css') }}">
    </head>
    <body>
       <div id="app">
           <example-component></example-component>
       </div>
       {{-- Vue --}}
       <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>