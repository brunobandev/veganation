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
                <h3 class="font-semibold with-line text-shadow my-5"><span>Editando receita</span></h3>
            </div>
            <div class="col-md-8">
                <form method="POST" action="{{ route('settings.recipes.update', $recipe) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="text-muted text-uppercase">Nome da receita</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $recipe->name }}" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category" class="text-muted text-uppercase">Categoria</label>
                                <select class="form-control custom-select" name="category_id" id="category">
                                    @foreach($categories as $caterory)
                                        <option value="{{ $caterory->id }}" {{ ($recipe->category_id == $caterory->id) ? 'selected' : '' }}>{{ $caterory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description" class="text-muted text-uppercase">Descrição</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ $recipe->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="preparation_time" class="text-muted text-uppercase">Tempo de preparo</label>
                                <input type="text" class="form-control" name="preparation_time" id="preparation_time" value="{{ $recipe->preparation_time }}" placeholder="">
                                <small class="text-danger">Colocar somente números, tempo em minutos!</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="portions" class="text-muted text-uppercase">Porções</label>
                                <input type="text" class="form-control" name="portions" id="portions" value="{{ $recipe->portions }}" placeholder="">
                                <small class="text-danger">Colocar somente números, quantidade de porções!</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="portions" class="text-muted text-uppercase">Imagem</label>
                                <input type="file" class="" name="picture" id="picture" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="font-semibold with-line text-shadow my-5"><span>Adicionando ingredientes</span></h4>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <p class="m-0 text-muted text-uppercase">Quantidade</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="m-0 text-muted text-uppercase">Unidade de medida</p>
                                </div>
                                <div class="col-md-7">
                                    <p class="m-0 text-muted text-uppercase">Ingrediente</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="ingredientList">
                            @foreach($recipe->ingredients as $ingredient)
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="ingredients_quantity[]" id="ingredients_quantity" value="{{ $ingredient->quantity }}" placeholder="">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control custom-select" name="ingredients_measures_id[]" id="measures">
                                        @foreach($measures as $measure)
                                            <option value="{{ $measure->id }}" {{ ($ingredient->measure_id == $measure->id) ? 'selected' : '' }}>{{ $measure->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="ingredients[]" id="ingredients" value="{{ $ingredient->name }}">
                                </div>
                                <input type="hidden" name="ingredients_order[]" value="{{ $ingredient->order }}">
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-12 d-inline-flex justify-content-between">
                            <a href="javascript:void(0);" class="text-muted text-uppercase" onclick="remove('ingredientList')">Remover último ingrediente</a>
                            <a href="javascript:void(0);" class="text-muted text-uppercase" onclick="duplicate('ingredientList')">+ Adicionar ingrediente</a>
                        </div>

                        <div class="col-md-12">
                            <h4 class="font-semibold with-line text-shadow my-5"><span>Adicionando o passo-a-passo</span></h4>
                        </div>
                        <div class="col-md-12" id="stepList">
                            @foreach($recipe->steps as $step)
                            <div class="form-group">
                                <input type="text" class="form-control" name="steps[]" id="steps" placeholder="Descreva o próximo passo" value="{{ $step->description }}">
                                <input type="hidden" name="steps_order[]" value="{{ $step->order }}">
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-12 d-inline-flex justify-content-between">
                            <a href="javascript:void(0);" class="text-muted text-uppercase" onclick="remove('stepList')">Remover último passo</a>
                            <a href="javascript:void(0);" class="text-muted text-uppercase" onclick="duplicate('stepList')">+ Adicionar novo passo</a>
                        </div>
                        <div class="col-md-12 text-right">
                            <hr>
                            <button type="submit" class="btn btn-success text-uppercase font-weight-bold">Alterar receita</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 text-center">
                <img class="img-thumbnail rounded" src="{{ asset("storage/recipe/$recipe->id/thumb_$recipe->picture") }}" alt="">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        function duplicate(target)
        {
            let node = document.getElementById(target);
            let element = node.lastChild;
            let duplicated = element.cloneNode(true);

            let inputs = duplicated.getElementsByTagName('input');
            for (let i = 0 ; i < inputs.length ; i++) {
                // Clear text fields.
                if (inputs[i].type === "text") {
                    inputs[i].value = "";
                }

                // Create order.
                if (inputs[i].type === "hidden") {
                    inputs[i].value = parseInt(inputs[i].value) + 1;
                }
            }
            node.appendChild(duplicated);
        }

        function remove(target)
        {
            let node = document.getElementById(target);
            if (node.childElementCount === 1) {
                return;
            }
            node.lastChild.remove();
        }
    </script>
@stop
