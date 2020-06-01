<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Site de receitas da comunidade vegana">
    <meta name="keywords" content="Receitas, Vegano, Comunidade">
    <meta name="author" content="Bruno Bandeira & Luise Flores">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Facebook Metas -->
    @yield('facebook')

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href=" {{ asset('images/favicon.png') }}"/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&autoLogAppEvents=1&version=v7.0&appId=718800412225760"></script>

    <div id="app">

        @include('layouts.navbar')

        <main>
            @yield('content')
        </main>

        <footer>
            <div class="container text-center">
                <div class="d-flex justify-content-between">
                    <div class=" text-left">
                        2020 Copyright © Veganation. Todos os direitos reservados - Feito com <i class="fa fa-heart text-danger"></i> e respeito aos animais
                    </div>
                    <div class="text-right">
                        <a href="mailto:veganation.app@gmail.com"><i class="fa fa-envelope"></i> veganation.app@gmail.com</a>
                        <a class="ml-2" href="https://facebook.com/veganationapp" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @yield('scripts')
</body>
</html>
