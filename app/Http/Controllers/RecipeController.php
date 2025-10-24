<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request){
        $query = Recipe::query();
        
        // Filter by search
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }
    
        $recipes = $query->paginate(9);

        return view('recipes.index', ['recipes' => $recipes]);
    }

    public function create() {
        $categories = RecipeCategory::all();
        return view('recipes.create', ['categories' => $categories]);
    }

    public function show($id) {
        $recipe = Recipe::findOrFail($id);
        $recipe->user_rating = $recipe->ratings()->where('user_id', auth()->id())->value('rating') ?? 0;
        $recipe->average_rating = $recipe->ratings()->avg('rating') ?? 0;
        return view('recipes.show', ['recipe' => $recipe]);
    }

    public function edit($id) {
        $recipe = Recipe::findOrFail($id);
        $categories = RecipeCategory::all();
        return view('recipes.edit', ['recipe' => $recipe, 'categories' => $categories]);
    }

    public function myrecipes() {
        $recipes = auth()->user()->recipes()->paginate(9);
        return view('recipes.myrecipes', ['recipes' => $recipes]);
    }

    public function save(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|integer',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            try {
                $path = $request->file('image')->store('images', 'public');
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Failed to upload image. Please try again.']);
            }
        } else {
            $path = null;
        }

        $request->user()->recipes()->create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category,
            'image_path' => $path,
            'ingredients' => $request->ingredients,
            'steps' => $request->steps
        ]);

        return redirect()->route('index')->with('success', 'Recipe created successfully!');
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|integer',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $recipe = Recipe::findOrFail($id);

        if ($request->hasFile('image')) {
            try {
                if ($recipe->image_path) {
                    Storage::disk('public')->delete($recipe->image_path);
                }
                $path = $request->file('image')->store('images', 'public');
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Failed to upload image. Please try again.']);
            }
        } else {
            $path = $recipe->image_path;
        }
        
        
        $recipe->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category,
            'ingredients' => $request->ingredients,
            'steps' => $request->steps,
            'image_path' => $path
        ]);

        return redirect()->route('show', $recipe->id)->with('success', 'Recipe updated successfully!');
    }

    public function destroy($id) {
        $recipe = Recipe::findOrFail($id);
        
        try {
            if ($recipe->image_path) {
                Storage::disk('public')->delete($recipe->image_path);
            }
            $recipe->delete();
            return redirect()->route('index')->with('success', 'Recipe deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('index')->withErrors(['error' => 'Failed to delete recipe. Please try again.']);
        }
    }

    public function rate(Request $request, Recipe $recipe)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Save or update the rating
        $recipe->ratings()->updateOrCreate(
            ['user_id' => auth()->id()], 
            ['rating' => $request->rating]
        );

        // Recalculate the average rating
        $average = $recipe->ratings()->avg('rating');

        return response()->json(['average_rating' => round($average, 1)]);
    }
}
