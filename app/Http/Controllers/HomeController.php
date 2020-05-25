<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\RecipeRepositoryInterface;
use Illuminate\Http\Request;

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
        RecipeRepositoryInterface $recipeRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->recipeRepository = $recipeRepository;
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();
        $recipes = $this->recipeRepository->all();

        return view('welcome', compact('recipes', 'categories'));
    }
}
