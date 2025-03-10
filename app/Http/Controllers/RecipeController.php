<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Laravel\Pail\ValueObjects\Origin\Console;

class RecipeController extends Controller
{
    public function index(){
        $recipes = Recipe::all();
        return view('recipes.index', ['recipes' => $recipes]);
    }

    public function create() {
        return view('recipes.create');
    }

    public function edit($id) {
        $recipe = Recipe::find($id);
        return view('recipes.edit', ['recipe' => $recipe]);
    }

    public function save(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        } else {
            $path = null;
        }

    Recipe::create([
        'name' => $request->name,
        'description' => $request->description,
        'category' => $request->category,
        'image_path' => $path,
    ]);

    return redirect('/recipe');

    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $rec = Recipe::find($id);

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        } else {
            $path = $rec->image_path;
        }
        
        $rec->update([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'image_path' => $path
        ]);


        return redirect('/recipe');
    }

    public function destroy($id) {
        $recipe = Recipe::find($id);
        $recipe->delete();

        return redirect('/recipe');
    }
}
