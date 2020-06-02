@extends('layouts.app')

@section('content')
<div class="container pb-4">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.alerts')
            @if ($errors->any())
                <div class="alert alert-danger mt-4" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('settings.categories.update', $category) }}" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h3 class="font-semibold with-line text-shadow my-5"><span>Criar categoria</span></h3>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="text-muted text-uppercase">Nome da categoria</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="picture" class="text-muted text-uppercase">Imagem</label>
                            <input type="file" class="w-100" name="picture" id="picture" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description" class="text-muted text-uppercase">Descrição</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $category->description }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <hr>
                        <button type="submit" class="btn btn-success text-uppercase font-weight-bold">Atualizar categoria</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
