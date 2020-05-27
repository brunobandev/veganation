<?php

namespace App\Repositories\Eloquent;

use App\Ingredient;
use App\Repositories\IngredientRepositoryInterface;


class IngredientRepository extends BaseRepository implements IngredientRepositoryInterface
{
    public function __construct(Ingredient $model)
    {
        parent::__construct($model);
    }

    public function deleteByRecipeId(int $recipeId): void
    {
        $this->model->whereRecipeId($recipeId)->delete();
    }
}
