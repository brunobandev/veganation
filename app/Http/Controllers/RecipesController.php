<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\MeasureRepositoryInterface;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    protected $categoryRepository;
    protected $measureRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        MeasureRepositoryInterface $measureRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->measureRepository = $measureRepository;
    }

    public function show(int $id)
    {
        return view('recipes.show');
    }
}
