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

    public function createByRecipeId(int $recipeId, array $attributes): void
    {
        foreach ($attributes as $attribute) {
            $attribute['recipe_id'] = $recipeId;
            $this->create($attribute);
        }
    }
}
