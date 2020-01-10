<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <link rel="icon" href="img/ag.png">
    <title>agroman</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/lib.js') }}" defer></script>

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/lib.css') }}" rel="stylesheet">
</head>
<body class="c-app" >
    <div id="app">

            @guest
            
            @else
            {{-- @if (Auth::user()->tipo=='ADMINISTRADOR') --}}
            @include('sidebar.sidebar')
            {{-- @endif --}}
            <div class="c-wrapper">
                @include('header.header')
            
            @endguest
            
     
            @yield('contenido')

            
            @guest
            @else
        </div>
            @include('footer.footer')
                
            @endguest 
    </div>
</body>
</html>
