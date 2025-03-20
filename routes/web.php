<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [RecipeController::class, 'index'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/recipe', [RecipeController::class, 'index'])->name('index');
    Route::get('/recipe/create', [RecipeController::class, 'create'])->name('create');
    Route::get('/recipe/{id}/edit', [RecipeController::class, 'edit'])->name('edit');
    Route::post('/', [RecipeController::class, 'save']);
    Route::put('/recipe/{id}', [RecipeController::class, 'update'])->name('update');
    Route::delete('/recipe/{id}', [RecipeController::class, 'destroy'])->name('delete');
    Route::get('/recipe/{id}/show', [RecipeController::class, 'show'])->name('show');
});

require __DIR__.'/auth.php';
