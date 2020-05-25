<?php


namespace App\Repositories;


interface IngredientRepositoryInterface
{
    public function createByRecipeId(int $recipeId, array $attributes): void;
}
