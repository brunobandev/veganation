@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container"></div>
    </div>

    <section class="container mb-4">
        <h3 class="font-semibold with-line text-shadow my-5"><span>Categorias</span></h3>
        <div class="row">
            @foreach($categories as $category)
                <div class="category-item col-md-3 mb-4">
                    <a href="{{ route('recipes.categories.show', $category->slug) }}">
                        <figure>
                            @if ($category->picture)
                            <img src="{{ asset("storage/category/$category->id/$category->picture") }}" class="img-fluid rounded" alt="{{ $category->name }}">
                            @else
                            <img src="{{ asset("images/placeholder.png") }}" class="img-fluid rounded" alt="{{ $category->name }}">
                            @endif
                            <span class="py-1 px-2 font-semibold rounded h5">{{ $category->name }}</span>
                        </figure>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection
