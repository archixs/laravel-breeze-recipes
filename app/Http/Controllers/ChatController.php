<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ChatController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            if (! $request->user()) {
                return response()->json([
                    'response' => 'You must be logged in to use the AI assistant.',
                    'recipe' => null,
                ], 401);
            }

            $request->validate([
                'content' => 'required|string|max:2000',
            ]);

            $apiKey = env('GEMINI_API_KEY');
            $userMessage = $request->post('content');

            $recipes = Recipe::query()
                ->select('id', 'name', 'ingredients')
                ->visibleTo($request->user())
                ->get();

            if ($recipes->isEmpty()) {
                return response()->json([
                    'response' => "No recipes available for your query yet.",
                    'recipe' => null,
                ]);
            }

            $prompt = $this->buildPrompt($recipes, $userMessage);

            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post("https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                    "contents" => [
                        ["parts" => [["text" => $prompt]]]
                    ]
                ]);

            $data = $response->json();
            $aiText = trim($data['candidates'][0]['content']['parts'][0]['text'] ?? "");

            $recipeId = ctype_digit($aiText) ? (int) $aiText : 0;

            // ✅ Same business rule reused, not duplicated
            $recipe = Recipe::query()
                ->visibleTo($request->user())
                ->find($recipeId);

            return response()->json([
                'response' => $recipe ? "Here is the best match!" : "No matching recipe found.",
                'recipe' => $recipe ? [
                    'id' => $recipe->id,
                    'name' => $recipe->name,
                    'description' => $recipe->description,
                    'image' => $recipe->image_path ? Storage::url($recipe->image_path) : null,
                ] : null,
            ]);
        } catch (Throwable $e) {
            return response()->json(['response' => "Gemini API error."], 500);
        }
    }

    private function buildPrompt($recipes, string $userMessage): string
    {
        $prompt = "You are a recipe assistant.\n";
        $prompt .= "Here is the list of recipes with IDs:\n\n";

        foreach ($recipes as $rec) {
            $prompt .= "{$rec->id}: {$rec->name}\nIngredients: {$rec->ingredients}\n\n";
        }

        $prompt .= "User asked: \"{$userMessage}\"\n";
        $prompt .= "Choose the SINGLE best recipe and respond ONLY with the ID number. NOTHING else.";

        return $prompt;
    }
}
