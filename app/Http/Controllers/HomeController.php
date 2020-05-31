<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\RecipeRepositoryInterface;

class HomeController extends Controller
{
    protected $recipeRepository;
    protected $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        RecipeRepositoryInterface $recipeRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();
        $latest = $this->recipeRepository->latest(2);
        $recipes = $this->recipeRepository->beforeLatest(12, 2);

        return view('welcome', compact('recipes', 'latest', 'categories'));
    }
}
