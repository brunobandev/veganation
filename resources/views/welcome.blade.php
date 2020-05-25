@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="font-semibold">Últimas receitas</h3>
            </div>

            @foreach($recipes as $recipe)
                <div class="col-md-6">
                    <div class="card border-0 mt-2">
                        <div class="card-body d-flex">
                            <div>
                                <img height="150px" class="rounded" src="{{ asset("storage/recipe/$recipe->id/thumb_$recipe->picture") }}" alt="">
                            </div>
                            <div class="w-100 pl-3 d-flex flex-column">
                                <h3>{{ Str::limit($recipe->name, 24) }}</h3>
                                <p>{{ $recipe->description }}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="mt-auto d-inline-flex">
                                <div class="d-inline-flex align-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            <path d="M2.5 10.625a7.5 7.5 0 1015 0 7.5 7.5 0 10-15 0zM5 19.375l1.155-2.31M10 10.625H7.174M10 6.25v4.375M1.25 3.125l3.125-2.5M15 19.375l-1.155-2.31M18.75 3.125l-3.125-2.5" stroke-width="1.249995"/>
                                        </g>
                                    </svg>
                                    <span class="pl-2">{{ $recipe->preparation_time }}</span>
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
            @endforeach

            <div class="col-md-12">
                <h3 class="font-semibold">Categorias</h3>
            </div>
            @foreach($categories as $category)
            <figure class="figure col-md-3">
                <img src="..." class="figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption">{{ $category->name }}</figcaption>
            </figure>
            @endforeach


            <div class="col-md-12">
                <h3 class="font-semibold">Mais delícias</h3>
            </div>
            <div class="col-md-4">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="..." class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="..." class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="..." class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
