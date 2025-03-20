<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Recipe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800">Edit Recipe</h2>

                <form action="{{ route('update', $recipe->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ $recipe->name }}" 
                               class="w-full p-2 border border-gray-300 rounded mt-1" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea name="description" id="description" 
                                  class="w-full p-2 border border-gray-300 rounded mt-1" required>{{ $recipe->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="category" class="block text-gray-700">Category</label>
                        <select name="category" id="category" class="w-full p-2 border border-gray-300 rounded mt-1">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    @if($recipe->category_id == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach 
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="ingredients" class="block text-gray-700">Ingredients</label>
                        <textarea name="ingredients" id="ingredients" 
                                  class="w-full p-2 border border-gray-300 rounded mt-1" required>{{ $recipe->ingredients }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="steps" class="block text-gray-700">Steps</label>
                        <textarea name="steps" id="steps" 
                                  class="w-full p-2 border border-gray-300 rounded mt-1" required>{{ $recipe->steps }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-gray-700">Image</label>
                        <input type="file" name="image" id="image" class="w-full p-2 border border-gray-300 rounded mt-1">
                    </div>

                    <div class="mb-4">
                        <img src="{{ $recipe->image_path ? Storage::url($recipe->image_path) : asset('images/default-recipe.jpg') }}" 
                             class="w-full h-64 object-cover rounded-md">
                    </div>
                    
                    <div class="mt-6 flex space-x-4">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save changes</button>
                        <a href="{{ route('show', $recipe->id) }}" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
