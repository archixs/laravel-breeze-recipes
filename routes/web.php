<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/recipe', [RecipeController::class, 'index']);
Route::get('/recipe/create', [RecipeController::class, 'create']);
Route::post('/recipe/{id}/edit', [RecipeController::class, 'edit']);
Route::post('/recipe', [RecipeController::class, 'save']);
Route::put('/recipe/{id}', [RecipeController::class, 'update']);
Route::delete('/recipe/{id}', [RecipeController::class, 'destroy']);
