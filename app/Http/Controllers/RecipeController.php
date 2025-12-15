<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $recipes = Recipe::query()
            ->search($request->input('search'))
            ->inCategories((array) $request->input('category', []))
            ->visibleTo($request->user())
            ->paginate(9);

        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        $categories = RecipeCategory::all();
        return view('recipes.create', compact('categories'));
    }

    public function show($id)
    {
        $recipe = Recipe::with(['user', 'categories'])->findOrFail($id);

        if (! $recipe->canBeViewedBy(auth()->user())) {
            abort(403);
        }

        $recipe->user_rating = $recipe->userRating(auth()->user());
        $recipe->average_rating = $recipe->averageRating();

        return view('recipes.show', compact('recipe'));
    }

    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        $categories = RecipeCategory::all();

        return view('recipes.edit', compact('recipe', 'categories'));
    }

    public function myrecipes()
    {
        $recipes = auth()->user()->recipes()->paginate(9);
        return view('recipes.myrecipes', compact('recipes'));
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
            'categories' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_public' => 'nullable|boolean',
        ]);

        Recipe::createFromRequest(
            $request->user(),
            $validated,
            $request->file('image')
        );

        $redirect = $request->input('redirect', 'index');

        return redirect()->route($redirect)
            ->with('success', 'Recipe created successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
            'categories' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_public' => 'nullable|boolean',
        ]);

        $recipe = Recipe::findOrFail($id);

        $recipe->updateFromRequest(
            $validated,
            $request->file('image')
        );

        $redirect = $request->input('redirect', 'index');

        return redirect()->route('show', ['id' => $recipe->id, 'redirect' => $redirect])->with('success', 'Recipe updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);

        $redirect = $request->input('redirect', 'index');

        try {
            $recipe->deleteWithImage();

            return redirect()
                ->route($redirect)
                ->with('success', 'Recipe deleted successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route($redirect)
                ->withErrors([
                    'error' => 'Failed to delete recipe. Please try again.'
                ]);
        }
    }


    public function rate(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:' . Rating::MIN . '|max:' . Rating::MAX,
        ]);

        $average = $recipe->rateBy(
            $request->user(),
            (int) $validated['rating']
        );

        return response()->json([
            'average_rating' => round($average, 1),
        ]);
    }

    public function toAI()
    {
        return view('recipes.ai-page');
    }
}
