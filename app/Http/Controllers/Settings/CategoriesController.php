<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepositoryInterface;
use App\Category;
use App\Traits\Image;

class CategoriesController extends Controller
{
    use Image;

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();

        return view('settings.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('settings.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:6'
        ]);

        $category = $this->categoryRepository->create($request->all());

        if ($request->hasFile('picture')) {
            $folder = "category/$category->id";
            $path = storage_path("app/public/$folder");
            $filename = $this->uploadOne($request->file('picture'), $path);
            $this->categoryRepository->update($category->id, ['picture' => $filename]);
        }

        return redirect()->route('settings.categories.index');
    }

    public function edit(int $id)
    {
        $category = $this->categoryRepository->find($id);

        return view('settings.categories.edit', compact('category'));
    }

    public function update(Request $request, int $id)
    {
        $category = $this->categoryRepository->find($id);

        $this->validate($request, [
            'name' => 'required|min:6'
        ]);

        $this->categoryRepository->update($id, $request->all());

        if ($request->hasFile('picture')) {
            $folder = "category/$category->id";
            $path = storage_path("app/public/$folder");
            $this->cleanDirectory($path);
            $filename = $this->uploadOne($request->file('picture'), $path);
            $this->categoryRepository->update($category->id, ['picture' => $filename]);
        }

        return redirect()->route('settings.categories.index');
    }

    public function destroy(int $id)
    {
        $deleted = $this->categoryRepository->delete($id);

        if (! $deleted) {
            throw new \Exception('Fail to delete');
        }

        $path = storage_path("app/public/category/$id");

        if (! $this->deleteDir($path)) {
            throw new \Exception('Fail to remove directory');
        }

        return redirect()->route('settings.categories.index')
            ->with('success', 'Categoria removida com sucesso!');
    }
}
