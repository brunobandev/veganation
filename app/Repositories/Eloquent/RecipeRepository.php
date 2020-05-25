<?php

namespace App\Repositories\Eloquent;

use App\Recipe;
use App\Repositories\RecipeRepositoryInterface;

class RecipeRepository extends BaseRepository implements RecipeRepositoryInterface
{
    public function __construct(Recipe $model)
    {
        parent::__construct($model);
    }
}
