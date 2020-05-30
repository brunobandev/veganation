@extends('layouts.app')

@section('facebook')
<meta property="og:url" content="{{ url('recipes') }}/{{ $recipe->id }}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{ $recipe->name }}" />
<meta property="og:description" content="{{ $recipe->description }}" />
<meta property="og:image" content="{{ asset("storage/recipe/$recipe->id/$recipe->picture") }}" />
@endsection

@section('content')
<div class="container mt-4 pb-4">
    <div class="row">
        <div class="col-md-12 text-right d-flex justify-content-between">
            <div class="d-flex">
                <img height="30px" width="30px" class="rounded" src="{{ $recipe->user->avatar }}" alt="{{ $recipe->user->name }}">
                <span class="pl-2 align-self-center font-semibold text-left" style="line-height: 14px;">
                    <small>receita de</small><br> {{ $recipe->user->name }}
                </span>
            </div>
{{--                <button class="btn btn-outline-danger btn-sm text-uppercase">Esta receita não é vegana!</button>--}}

            <div>
                <button class="btn btn-outline-success btn-sm text-uppercase">Compartilhar</button>
{{--                <button class="btn btn-outline-success btn-sm text-uppercase">Favoritar</button>--}}
            </div>
        </div>

        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-6 d-flex align-items-end flex-column recipe-card">
            <div class="w-100 d-flex justify-content-center">
                <div class="d-inline-flex align-content-center">
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

            <div class="recipe-card-body w-100">
                <hr>
                <h1 class="h2 text-shadow">{{ $recipe->name }}</h1>
                <p class="recipe-card-description">
                    {!! nl2br(e($recipe->description)) !!}
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <img class="img-fluid rounded img-thumbnail" src="{{ asset("storage/recipe/$recipe->id/$recipe->picture") }}" alt="{{ $recipe->name }}">
        </div>
    </div>
    <div class="row">
        <div class="col-4 ingredients">
            <h4 class="font-semibold with-line text-shadow my-5"><span>Ingredientes</span></h4>
            <ul class="list-group list-group-flush">
                @forelse($recipe->ingredients as $ingredient)
                    <li class="list-group-item"><strong>{{ $ingredient->quantity }} {{ $ingredient->measure->name }}</strong> {{ $ingredient->name }}</li>
                @empty
                    <li class="list-group-item">Nenhum ingrediente cadastrado!</li>
                @endforelse
            </ul>
        </div>
        <div class="col-8 steps">
            <h4 class="font-semibold with-line text-shadow my-5"><span>Modo de preparo</span></h4>
            <ul class="list-group list-group-flush">
                @forelse($recipe->steps as $step)
                    <li class="list-group-item"><strong>{{ $loop->iteration }}.</strong> {{ $step->description }}</li>
                @empty
                    <li class="list-group-item">Nenhum passo cadastrado!</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection

