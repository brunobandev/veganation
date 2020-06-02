<?php

namespace App\Http\Controllers\Settings;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\IngredientRepositoryInterface;
use App\Repositories\MeasureRepositoryInterface;
use App\Repositories\RecipeRepositoryInterface;
use App\Repositories\StepRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Image;
use App\Notifications\NewRecipePublished;

class RecipesController extends Controller
{
    use Image;

    protected $categoryRepository;
    protected $ingredientRepository;
    protected $measureRepository;
    protected $recipeRepository;
    protected $stepRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        IngredientRepositoryInterface $ingredientRepository,
        MeasureRepositoryInterface $measureRepository,
        RecipeRepositoryInterface $recipeRepository,
        StepRepositoryInterface $stepRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->ingredientRepository = $ingredientRepository;
        $this->measureRepository = $measureRepository;
        $this->recipeRepository = $recipeRepository;
        $this->stepRepository = $stepRepository;
    }

    public function index()
    {
        $recipes = $this->recipeRepository->findByUserId(auth()->id());

        return view('settings.recipes.index', compact('recipes'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->all();
        $measures = $this->measureRepository->all()->sortBy('name');

        return view('settings.recipes.create', compact('categories', 'measures'));
    }

    public function store(Request $request)
    {
        $this->validateData($request);

        $recipe = $this->recipeRepository->create($request->all());

        if ($request->hasFile('picture')) {
            $folder = "recipe/$recipe->id";
            $path = storage_path("app/public/$folder");
            $filename = $this->uploadOne($request->file('picture'), $path);
            $this->recipeRepository->update($recipe->id, ['picture' => $filename]);
        }

        $this->addSteps($recipe, $request);
        $this->addIngredients($recipe, $request);

        if (env('APP_ENV') == 'production') {
            $recipe->notify(new NewRecipePublished());
        }

        info($recipe);

        return redirect()->route('settings.recipes.index')
            ->with('message', 'Receita cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $recipe = $this->recipeRepository->find($id);
        $this->authorize('edit-recipe', $recipe);

        $categories = $this->categoryRepository->all();
        $measures = $this->measureRepository->all()->sortBy('name');

        return view('settings.recipes.edit', compact('recipe', 'categories', 'measures'));
    }

    public function update(Request $request, $id)
    {
        $recipe = $this->recipeRepository->find($id);
        $this->authorize('update-recipe', $recipe);

        $this->validateData($request);

        $recipe = $this->recipeRepository->update($id, $request->all());
        $this->ingredientRepository->deleteByRecipeId($recipe->id);
        $this->stepRepository->deleteByRecipeId($recipe->id);

        if ($request->hasFile('picture')) {
            $folder = "recipe/$recipe->id";
            $path = storage_path("app/public/$folder");
            $this->cleanDirectory($path);
            $filename = $this->uploadOne($request->file('picture'), $path);
            $this->recipeRepository->update($recipe->id, ['picture' => $filename]);
        }

        $this->addSteps($recipe, $request);
        $this->addIngredients($recipe, $request);

        return redirect()->route('settings.recipes.edit', $recipe)
            ->with('success', 'Receita alterada com sucesso!');
    }

    public function destroy($id)
    {
        $recipe = $this->recipeRepository->find($id);
        $this->authorize('update-recipe', $recipe);

        $this->ingredientRepository->deleteByRecipeId($recipe->id);
        $this->stepRepository->deleteByRecipeId($recipe->id);

        $deleted = $this->recipeRepository->delete($recipe->id);

        if (!$deleted) {
            throw new \Exception('Fail to delete');
        }

        $path = storage_path("app/public/recipe/$id");

        if (!$this->deleteDir($path)) {
            throw new \Exception('Fail to remove directory');
        }

        return redirect()->route('settings.recipes.index')
            ->with('success', 'Receita removida com sucesso!');
    }

    private function addSteps($recipe, $request)
    {
        foreach ($request->steps as $key => $value) {
            $step = [
                'recipe_id' => $recipe->id,
                'description' => $value,
                'order' => $request->steps_order[$key]
            ];

            $this->stepRepository->create($step);
        }
    }

    private function addIngredients($recipe, $request)
    {
        foreach ($request->ingredients as $key => $value) {
            $ingredient = [
                'recipe_id' => $recipe->id,
                'name' => $value,
                'quantity' => $request->ingredients_quantity[$key],
                'measure_id' => $request->ingredients_measures_id[$key],
                'order' => $request->ingredients_order[$key]
            ];

            $this->ingredientRepository->create($ingredient);
        }
    }

    private function validateData(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|min:6',
            'preparation_time' => 'required|integer',
            'portions' => 'required|integer',
            'ingredients.*' => 'min:3',
            'steps.*' => 'min:3'
        ]);
    }
}
