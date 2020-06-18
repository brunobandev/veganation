@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container"></div>
    </div>

    <section class="container">
        <h3 class="font-semibold with-line text-shadow my-5"><span>Todas as receitas</span></h3>
        <div class="row">
            @forelse($recipes as $recipe)
                <div class="col-md-4">
                    <div class="card mb-3 shadow-sm recipe-card">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                @if ($recipe->picture)
                                <img src="{{ asset("storage/recipe/$recipe->id/thumb_$recipe->picture") }}" class="card-img" alt="{{ $recipe->name }}">
                                @else
                                <img src="{{ asset("images/placeholder.png") }}" class="card-img" alt="{{ $recipe->name }}">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body recipe-card-body">
                                    <a class="h5" href="{{ route('recipes.show', $recipe->slug) }}">
                                        {{ Str::limit($recipe->name, 55) }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12 font-weight-bolder">
                    <p class="h4">Aguardando novas delícias.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
