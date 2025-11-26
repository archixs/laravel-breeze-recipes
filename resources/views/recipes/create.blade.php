<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Recipe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6 p-6">
                <h2 class="font-semibold text-lg text-gray-800">Create a Recipe</h2>

                <form action="/" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" name="name" id="name" required class="w-full border-gray-300 rounded-lg p-2">
                    </div>

                    <div>
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3" required class="w-full border-gray-300 rounded-lg p-2"></textarea>
                    </div>

                    <div id="category-wrapper" class="mb-4">
                        <label class="block text-gray-700 mb-1">Categories</label>

                        <!-- Hidden input where selected category IDs will be stored -->
                        <input type="hidden" name="categories" id="categoriesInput">

                        <!-- The dropdown -->
                        <select id="categorySelect"
                                class="w-full border-gray-300 rounded-lg p-2">
                            <option value="">Select category…</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <!-- Tags appear here -->
                        <div id="categoryTags" class="flex flex-wrap gap-2 mt-3"></div>
                    </div>


                    <div>
                        <label for="ingredients" class="block text-gray-700">Ingredients</label>
                        <textarea name="ingredients" id="ingredients" rows="4" required class="w-full border-gray-300 rounded-lg p-2" placeholder="List ingredients separated by a new line..."></textarea>
                    </div>

                    <div>
                        <label for="steps" class="block text-gray-700">Steps</label>
                        <textarea name="steps" id="steps" rows="4" required class="w-full border-gray-300 rounded-lg p-2" placeholder="Write step-by-step instructions..."></textarea>
                    </div>

                    <div>
                        <label for="image" class="block text-gray-700">Image</label>
                        <input type="file" name="image" id="image" class="w-full border-gray-300 rounded-lg p-2">
                    </div>

                    <button type="submit" class="text-white px-4 py-2 rounded-lg bg-blue-500">Save Recipe</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let selected = [];

    const select = document.getElementById('categorySelect');
    const tagsDiv = document.getElementById('categoryTags');
    const input = document.getElementById('categoriesInput');

    // When user selects a category
    select.addEventListener('change', function() {
        const id = this.value;
        if (!id) return;

        const name = this.options[this.selectedIndex].text;

        // Prevent duplicates
        if (selected.some(cat => cat.id == id)) {
            this.value = "";
            return;
        }

        selected.push({ id, name });
        updateTags();
        this.value = "";
    });

    // Remove category
    function removeCategory(id) {
        selected = selected.filter(cat => cat.id != id);
        updateTags();
    }

    // Refresh displayed tags + hidden input
    function updateTags() {
        // Insert only IDs into hidden input
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
</script>

