<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface StepRepositoryInterface
{
    public function create(array $attributes): Model;
    public function deleteByRecipeId(int $recipeId): void;
}
