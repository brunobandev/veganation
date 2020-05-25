<?php

namespace App\Http\Controllers\Settings;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\IngredientRepositoryInterface;
use App\Repositories\MeasureRepositoryInterface;
use App\Repositories\RecipeRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Traits\Image;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    use Image;

    protected $categoryRepository;
    protected $ingredientRepository;
    protected $measureRepository;
    protected $recipeRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        IngredientRepositoryInterface $ingredientRepository,
        MeasureRepositoryInterface $measureRepository,
        RecipeRepositoryInterface $recipeRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->ingredientRepository = $ingredientRepository;
        $this->measureRepository = $measureRepository;
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = $this->recipeRepository->all();

        return view('settings.recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->all();
        $measures = $this->measureRepository->all();

        return view('settings.recipes.create', compact('categories', 'measures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['user_id' => auth()->id()]);

        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'name' => 'required|min:6',
            'preparation_time' => 'required',
            'portions' => 'required|integer'
        ]);

        $recipe = $this->recipeRepository->create($request->all());

        if ($request->hasfile('picture')) {
            $folder = "recipe/$recipe->id";
            $filename = $this->uploadOne($request->file('picture'), $folder);
            $this->recipeRepository->update($recipe->id, ['picture' => $filename]);
        }

        foreach ($request->steps as $key => $value) {
            $recipe->steps()->create([
                'description' => $value,
                'order' => $request->steps_order[$key]
            ]);
        }

        foreach ($request->ingredients as $key => $value) {
            $recipe->ingredients()->create([
                'name' => $value,
                'quantity' => $request->ingredients_quantity[$key],
                'measure_id' => $request->ingredients_measures_id[$key],
                'order' => $request->ingredients_order[$key]
            ]);
        }

        return redirect()->route('settings.recipes.index')
            ->with('message', 'Receita cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = $this->recipeRepository->find($id);
        $categories = $this->categoryRepository->all();
        $measures = $this->measureRepository->all();

        return view('settings.recipes.edit', compact('recipe', 'categories', 'measures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->request->add(['user_id' => auth()->id()]);

        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'name' => 'required|min:6',
            'preparation_time' => 'required',
            'portions' => 'required|integer'
        ]);

        $recipe = $this->recipeRepository->update($id, $request->all());

        $recipe->ingredients()->delete();
        $recipe->steps()->delete();

        if ($request->hasfile('picture')) {

            $folder = "recipe/$recipe->id";
            $path = storage_path("app/public/$folder");

            $this->cleanDirectory($path);

            $filename = $this->uploadOne($request->file('picture'), $path);
            $this->recipeRepository->update($recipe->id, ['picture' => $filename]);
        }

        foreach ($request->steps as $key => $value) {
            $recipe->steps()->create([
                'description' => $value,
                'order' => $request->steps_order[$key]
            ]);
        }

        foreach ($request->ingredients as $key => $value) {
            $recipe->ingredients()->create([
                'name' => $value,
                'quantity' => $request->ingredients_quantity[$key],
                'measure_id' => $request->ingredients_measures_id[$key],
                'order' => $request->ingredients_order[$key]
            ]);
        }

        return redirect()->route('settings.recipes.edit', $recipe)
            ->with('message', 'Receita alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = $this->recipeRepository->find($id);
        $recipe->ingredients()->delete();
        $recipe->steps()->delete();

        $deleted = $this->recipeRepository->delete($recipe->id);

        if (! $deleted) {
            throw new \Exception('Fail to delete');
        }

        $path = storage_path("app/public/recipe/$id");

        if (! $this->deleteDir($path)) {
            throw new \Exception('Fail to remove directory');
        }

        return redirect()->route('settings.recipes.index')
            ->with('success', 'Receita removida com sucesso!');
    }
}
