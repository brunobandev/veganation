<?php

namespace App\Repositories\Eloquent;

use App\Category;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function findBySlug(string $slug): ?Model
    {
        return $this->model->whereSlug($slug)->first();
    }
}
