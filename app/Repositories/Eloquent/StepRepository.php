<?php

namespace App\Repositories\Eloquent;

use App\Repositories\StepRepositoryInterface;
use App\Step;

class StepRepository extends BaseRepository implements StepRepositoryInterface
{
    public function __construct(Step $model)
    {
        parent::__construct($model);
    }

    public function deleteByRecipeId(int $recipeId): void
    {
        $this->model->whereRecipeId($recipeId)->delete();
    }
}
