<?php


namespace App\Repositories;


interface StepRepositoryInterface
{
    public function createByRecipeId(int $recipeId, array $attributes): void;
}
