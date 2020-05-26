<nav class="navbar navbar-expand-md navbar-light bg-white fixed-top-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Veganation') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="">Receitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Categorias</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('settings.recipes.index') }}">
                            <img width="30" height="30" src="{{ Auth::user()->avatar }}" class="rounded-circle mr-2" alt="{{ Auth::user()->name }}">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Sair') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@if (auth()->check())
<nav class="navbar navbar-expand-md bg-light navbar-light">
    <div class="container navbar-collapse collapse d-flex">

        <ul class="navbar-nav mx-auto justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('settings.recipes.index') }}">Minhas receitas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('settings.recipes.create') }}">Criar receita</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('settings.recipes.favorites') }}">Receitas favoritas</a>
            </li>
        </ul>
    </div>
</nav>
@endif
