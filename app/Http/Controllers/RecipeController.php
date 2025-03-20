<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(){
        $recipes = Recipe::all();
        return view('recipes.index', ['recipes' => $recipes]);
    }

    public function create() {
        $categories = RecipeCategory::all();
        return view('recipes.create', ['categories' => $categories]);
    }

    public function show($id) {
        $recipe = Recipe::find($id);
        return view('recipes.show', ['recipe' => $recipe]);
    }

    public function edit($id) {
        $recipe = Recipe::find($id);
        $categories = RecipeCategory::all();
        return view('recipes.edit', ['recipe' => $recipe, 'categories' => $categories]);
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
            $path = $request->file('image')->store('images', 'public');
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

        return redirect('/');
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

        $recipe = Recipe::find($id);

        if ($request->hasFile('image')) {
            if ($recipe->image_path) {
                Storage::disk('public')->delete($recipe->image_path);
            }
            $path = $request->file('image')->store('images', 'public');
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


        return redirect('/');
    }

    public function destroy($id) {
        $recipe = Recipe::find($id);
        if ($recipe->image_path) {
            Storage::disk('public')->delete($recipe->image_path);
        }
        $recipe->delete();

        return redirect('/');
    }
}
