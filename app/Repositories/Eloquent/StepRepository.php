<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use App\Step;

class StepRepository extends BaseRepository implements EloquentRepositoryInterface
{
    public function __construct(Step $model)
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
