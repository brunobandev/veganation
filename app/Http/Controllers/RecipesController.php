<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\MeasureRepositoryInterface;
use App\Repositories\RecipeRepositoryInterface;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    protected $categoryRepository;
    protected $measureRepository;
    protected $recipeRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        MeasureRepositoryInterface $measureRepository,
        RecipeRepositoryInterface $recipeRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->measureRepository = $measureRepository;
        $this->recipeRepository = $recipeRepository;
    }

    public function index()
    {
        $recipes = $this->recipeRepository->all();

        return view('recipes.index', compact('recipes'));
    }

    public function show(int $id)
    {
        $recipe = $this->recipeRepository->find($id);

        return view('recipes.show', compact('recipe'));
    }
}
