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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib.css') }}" rel="stylesheet">
</head>
<body class="c-app" >
    <div id="app">

            <div class="c-wrapper">
                {{-- @include('header.header') --}}
                <header class="c-header c-header-light c-header-fixed c-header-with">
                    {{-- <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button><a class="c-header-brand d-sm-none" href="#"><img class="c-header-brand" src="coreui/assets/brand/coreui-base.svg" width="97" height="46" alt="CoreUI Logo"></a>
                    <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button> --}}
                    {{-- <ul class="c-header-nav d-md-down-none">
                      <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Dashboard</a></li>
                      <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Users</a></li>
                      <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Settings</a></li>
                    </ul> --}}
                    <ul class="c-header-nav ml-auto mr-4">
                        <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="{{ route('login') }}">
                            <svg class="c-icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                            </svg> Iniciar Session</a></li>
                    </ul>
                    {{-- <div class="c-subheader px-3">
                        <ol class="breadcrumb border-0 m-0">
                          <li class="breadcrumb-item">Home</li>
                          <li class="breadcrumb-item"><a href="#">Admin</a></li>
                          <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                      </div> --}}
                    </header>
               
            

            
     
            
                <template>
                    <principal-component></principal-component>
                </template>
            

        </div>
            @include('footer.footer')

    </div>
</body>
</html>
