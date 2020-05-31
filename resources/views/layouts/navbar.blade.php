<nav class="navbar navbar-expand-md fixed-top-sm nav-main">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/veganation.png') }}" alt="Veganation">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"><g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M2.813 22.504h24.375M2.813 15.004h24.375M2.813 7.504h24.375" stroke-width="1.875"/></g></svg>
            </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recipes.index') }}">Receitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recipes.categories') }}">Categorias</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/auth/redirect/google') }}"><i class="fab fa-google"></i> Google</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/auth/redirect/facebook') }}"><i class="fab fa-facebook-f"></i> Facebook</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('settings.recipes.index') }}">
                            <img width="30" height="30" src="{{ Auth::user()->avatar }}" class="rounded mr-2" alt="{{ Auth::user()->name }}">
                        </a>
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
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{ route('settings.recipes.favorites') }}">Receitas favoritas</a>--}}
{{--            </li>--}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Desconectar') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
@endif
