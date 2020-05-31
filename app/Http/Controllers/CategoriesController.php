<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\RecipeRepositoryInterface;

class CategoriesController extends Controller
{
    private $categoryRepository;
    private $recipeRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        RecipeRepositoryInterface $recipeRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->recipeRepository = $recipeRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();

        return view('categories.index', compact('categories'));
    }

    public function show($slug)
    {
        $category = $this->categoryRepository->findBySlug($slug);
        $recipes = $this->recipeRepository->findByCategoryId($category->id);

        return view('categories.show', compact('category', 'recipes'));
    }
}
