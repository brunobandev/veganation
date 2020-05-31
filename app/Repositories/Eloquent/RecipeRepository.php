<?php

namespace App\Repositories\Eloquent;

use App\Recipe;
use App\Repositories\RecipeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class RecipeRepository extends BaseRepository implements RecipeRepositoryInterface
{
    public function __construct(Recipe $model)
    {
        parent::__construct($model);
    }

    public function findByCategoryId(int $categoryId): Collection
    {
        return $this->model->whereCategoryId($categoryId)->get();
    }

    public function findByUserId(int $userId): Collection
    {
        return $this->model->whereUserId($userId)->get();
    }

    public function findBySlug(string $slug): ?Model
    {
        return $this->model->whereSlug($slug)->first();
    }
}
