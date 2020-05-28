<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepositoryInterface;
use App\Category;

class CategoriesController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return view('settings.categories.index');
    }

    public function create()
    {
        return view('settings.categories.create');
    }

    public function store(Request $request)
    {
        $category = $this->categoryRepository->create($request->all());

        return redirect()->route('settings.categories.index');
    }

    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'name' => 'required|min:6'
        ]);

        $this->categoryRepository->update($id, $request->all());

        return redirect()->route('settings.categories.index');
    }

    public function destroy(int $id)
    {
        $this->categoryRepository->delete($id);

        return redirect()->route('settings.categories.index');
    }
}
