@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container"></div>
    </div>

    <section class="container mb-4">
        <h2 class="font-semibold with-line text-shadow my-5"><span>Últimas receitas</span></h2>
        <div class="row">
        @forelse($recipes as $recipe)
            <div class="col-md-6">
                <div class="card recipe-card border mt-2 shadow-sm">
                    <div class="card-header border-0 recipe-card-header">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <span class="mr-2">{{ $recipe->user->name }}</span>
                                <img height="30px" class="rounded" src="{{ $recipe->user->avatar }}" alt="{{ $recipe->user->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-body recipe-card-body d-flex">
                        <div>
                            <img height="150px" class="rounded" src="{{ asset("storage/recipe/$recipe->id/thumb_$recipe->picture") }}" alt="">
                        </div>
                        <div class="pl-3">
                            <a class="h4" href="{{ route('recipes.show', $recipe->slug) }}">{{ Str::limit($recipe->name, 28) }}</a>
                            <p class="recipe-card-description m-0 pt-1">
                                {{ Str::limit($recipe->description, 155) }}
                            </p>
                        </div>
                    </div>
                    <div class="card-footer border-0">
                        <div class="mt-auto d-flex justify-content-center">
                            <div class="d-flex align-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                                    <g fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M2.5.625h16.25v18.75H2.5zM1.25 4.375h2.5M1.25 8.125h2.5M1.25 11.875h2.5M1.25 15.625h2.5" stroke-width="1.249995"/>
                                        <path d="M6.875 7.188a1.875 2.188 0 103.75 0 1.875 2.188 0 10-3.75 0zM8.75 9.375v5M13.75 9.375v5M12.5 5v3.125a1.25 1.25 0 001.25 1.25h0A1.25 1.25 0 0015 8.125V5" stroke-width="1.249995"/>
                                    </g>
                                </svg>
                                <span class="pl-2">{{ $recipe->category->name }}</span>
                            </div>
                            <div class="pl-3 d-inline-flex align-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                        <path d="M2.5 10.625a7.5 7.5 0 1015 0 7.5 7.5 0 10-15 0zM5 19.375l1.155-2.31M10 10.625H7.174M10 6.25v4.375M1.25 3.125l3.125-2.5M15 19.375l-1.155-2.31M18.75 3.125l-3.125-2.5" stroke-width="1.249995"/>
                                    </g>
                                </svg>
                                <span class="pl-2">{{ $recipe->preparation_time }} mins</span>
                            </div>
                            <div class="pl-3 d-inline-flex align-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                        <path d="M16.875 6.826c1.552.667 2.5 1.565 2.5 2.549 0 2.07-4.197 3.75-9.375 3.75S.625 11.445.625 9.375 4.822 5.625 10 5.625" stroke-width="1.249995"/><path d="M.625 9.375v1.25c0 4.833 4.197 8.75 9.375 8.75s9.375-3.917 9.375-8.75v-1.25" stroke-width="1.249995"/><path d="M16.25 10.625c0 1.38-2.798 2.5-6.25 2.5s-6.25-1.12-6.25-2.5c0-1.12 1.84-2.067 4.375-2.386M6.875 10.625h1.25M13.625 7.25L18.75.625" stroke-width="1.249995"/><path d="M13.868 10a2.124 2.124 0 00-.243-2.75c-.828-.622-2.172-.23-3 .875A2.917 2.917 0 0010.008 10" stroke-width="1.249995"/>
                                    </g>
                                </svg>
                                <span class="pl-2">{{ $recipe->portions }} porções</span>
                            </div>
                            <div class="pl-3 d-inline-flex align-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M.625 3.125h18.75v16.25H.625zM.625 8.125h18.75M5.625 5V.625M14.375 5V.625M4.688 11.25h0" stroke-width="1.249995"/>
                                        <path d="M4.688 11.25a.313.313 0 10.312.313.313.313 0 00-.313-.313M4.688 15.625h0M4.688 15.625a.313.313 0 10.312.313.313.313 0 00-.313-.313M10 11.25h0M10 11.25a.313.313 0 10.313.313.313.313 0 00-.313-.313M10 15.625h0M10 15.625a.313.313 0 10.313.313.313.313 0 00-.313-.313M15.313 11.25h0M15.313 11.25a.313.313 0 10.312.313.313.313 0 00-.313-.313M15.313 15.625h0M15.313 15.625a.313.313 0 10.312.313.313.313 0 00-.313-.313" stroke-width="1.249995"/>
                                    </g>
                                </svg>
                                <span class="pl-2">{{ $recipe->created_at->locale('pt_BR')->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12 font-weight-bolder">
                <p class="h4">Aguardando receitas.</p>
            </div>
        @endforelse
        </div>
    </section>

    <section class="container mb-4">
        <h3 class="font-semibold with-line text-shadow my-5"><span>Categorias</span></h3>
        <div class="row">
            @foreach($categories as $category)
            <div class="category-item col-md-3 mb-4">
                <a href="{{ route('recipes.categories.show', $category) }}">
                    <figure>
                        <img src="{{ asset("storage/category/$category->id/thumb_$category->picture") }}" class="img-fluid rounded" alt="{{ $category->name }}">
                        <span class="py-1 px-2 font-semibold rounded h5">{{ $category->name }}</span>
                    </figure>
                </a>
            </div>
            @endforeach
        </div>
    </section>

    <section class="container">
        <h3 class="font-semibold with-line text-shadow my-5"><span>Mais delícias</span></h3>
        <div class="row">
            @forelse($recipes as $recipe)
            <div class="col-md-4">
                <div class="card mb-3 shadow-sm recipe-card">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset("storage/recipe/$recipe->id/thumb_$recipe->picture") }}" class="card-img" alt="{{ $recipe->name }}">
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
