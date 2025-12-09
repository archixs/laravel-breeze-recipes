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

                    <div id="category-wrapper" class="mb-4">
                        <label class="block text-gray-700 mb-1">Categories</label>

                        <!-- Hidden input where selected category IDs will be stored -->
                        <input type="hidden" name="categories" id="categoriesInput">

                        <!-- The dropdown -->
                        <select id="categorySelect" class="w-full border border-gray-300 rounded-lg p-2">
                            <option value="">Select category…</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <!-- Tags appear here -->
                        <div id="categoryTags" class="flex flex-wrap gap-2 mt-3"></div>
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

                    {{-- Visibility toggle --}}
                    <div class="mb-4">
                        <span class="block text-gray-700">Visibility</span>
                        <div class="mt-2 flex items-center space-x-6">
                            <label class="inline-flex items-center">
                                <input type="radio"
                                       name="is_public"
                                       value="1"
                                       class="text-blue-500 focus:ring-blue-500"
                                       {{ old('is_public', $recipe->is_public) ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700">Public</span>
                            </label>

                            <label class="inline-flex items-center">
                                <input type="radio"
                                       name="is_public"
                                       value="0"
                                       class="text-blue-500 focus:ring-blue-500"
                                       {{ old('is_public', $recipe->is_public) ? '' : 'checked' }}>
                                <span class="ml-2 text-gray-700">Private</span>
                            </label>
                        </div>
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

<script>
    let selected = @json($recipe->categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name]));

    const select = document.getElementById('categorySelect');
    const tagsDiv = document.getElementById('categoryTags');
    const input = document.getElementById('categoriesInput');

    function updateTags() {
        input.value = JSON.stringify(selected.map(c => c.id));
        tagsDiv.innerHTML = "";

        selected.forEach(cat => {
            const tag = document.createElement('span');
            tag.className = "bg-blue-200 text-blue-800 px-3 py-1 rounded-full flex items-center";
            tag.innerHTML = `
                ${cat.name}
                <button type="button" class="ml-2 text-red-600 font-bold"
                    onclick="removeCategory('${cat.id}')">×</button>
            `;
            tagsDiv.appendChild(tag);
        });
    }

    function removeCategory(id) {
        selected = selected.filter(cat => cat.id != id);
        updateTags();
    }

    select.addEventListener('change', function() {
        const id = this.value;
        if (!id) return;

        const name = this.options[this.selectedIndex].text;
        if (selected.some(cat => cat.id == id)) {
            this.value = "";
            return;
        }

        selected.push({ id, name });
        updateTags();
        this.value = "";
    });

    // Initialize tags on page load
    updateTags();
</script>