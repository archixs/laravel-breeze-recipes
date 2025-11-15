<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Recipe;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ChatController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $apiKey = env('GEMINI_API_KEY');
            $userMessage = $request->post('content');

            // Load recipes
            $recipes = Recipe::select('id', 'title', 'ingredients')->get();

            // Build prompt
            $prompt = "You are a recipe assistant.\n";
            $prompt .= "Here is the list of recipes with IDs:\n\n";

            foreach ($recipes as $rec) {
                $prompt .= "{$rec->id}: {$rec->title}\nIngredients: {$rec->ingredients}\n\n";
            }

            $prompt .= "User asked: \"{$userMessage}\"\n";
            $prompt .= "Choose the SINGLE best recipe and respond ONLY with the ID number. NOTHING else. No explanation, no text.";

            // Send to Gemini
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post("https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                    "contents" => [
                        ["parts" => [["text" => $prompt]]]
                    ]
                ]);

            $data = $response->json();
            $aiText = trim($data['candidates'][0]['content']['parts'][0]['text'] ?? "");

            // Convert response to integer ID
            $recipeId = intval($aiText);
            $recipe = Recipe::find($recipeId);

            return response()->json([
                'response' => "Here is the best match!",
                'recipe' => $recipe ? [
                    'id' => $recipe->id,
                    'name' => $recipe->name,
                    'description' => $recipe->description,
                    'image' => $recipe->image_path ? Storage::url($recipe->image_path) : null
                ] : null,
            ]);

        } catch (Throwable $e) {
            return response()->json(['response' => "Gemini API error."]);
        }
    }
}
