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

                <form action="/recipe" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" name="name" id="name" required class="w-full border-gray-300 rounded-lg p-2">
                    </div>

                    <div>
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3" required class="w-full border-gray-300 rounded-lg p-2"></textarea>
                    </div>

                    <div>
                        <label for="category" class="block text-gray-700">Category</label>
                        <select name="category" id="category" required class="w-full border-gray-300 rounded-lg p-2">
                            <option value="latvian">Latvian</option>
                            <option value="chinese">Chinese</option>
                            <option value="american">American</option>
                        </select>
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
                        <input type="file" name="image" id="image" required class="w-full border-gray-300 rounded-lg p-2">
                    </div>

                    <button type="submit" class="text-white px-4 py-2 rounded-lg bg-blue-500">Save Recipe</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
