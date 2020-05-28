@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="font-semibold with-line text-shadow my-5"><span>Categorias</span></h3>
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group list-group-flush">
                    @forelse($categories as $category)
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <img width="60" height="60" src="{{ asset("storage/category/$category->id/thumb_$category->picture") }}" class="img-fluid rounded" alt="{{ $category->name }}">
                                <strong class="pl-2">{{ $loop->iteration }}.</strong> {{ $category->name }}
                            </div>
                            <div>
                                <a href="{{ route('settings.categories.edit', $category) }}">Editar</a>
                            </div>

                        </li>
                    @empty
                        <li class="list-group-item">Nenhuma categoria encontrada!</li>
                    @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
