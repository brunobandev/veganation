<?php

namespace App\Providers;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\IngredientRepository;
use App\Repositories\Eloquent\MeasureRepository;
use App\Repositories\Eloquent\RecipeRepository;
use App\Repositories\Eloquent\StepRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\IngredientRepositoryInterface;
use App\Repositories\MeasureRepositoryInterface;
use App\Repositories\RecipeRepositoryInterface;
use App\Repositories\StepRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(IngredientRepositoryInterface::class, IngredientRepository::class);
        $this->app->bind(MeasureRepositoryInterface::class, MeasureRepository::class);
        $this->app->bind(RecipeRepositoryInterface::class, RecipeRepository::class);
        $this->app->bind(StepRepositoryInterface::class, StepRepository::class);
    }
}
