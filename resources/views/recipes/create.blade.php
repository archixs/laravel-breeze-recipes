<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a recipe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6 p-6">
                <h2 class="font-semibold text-lg text-gray-800">Create a Recipe</h2>
                <form action="/recipe" method="post" enctype="multipart/form-data" class="mt-4 space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-lg p-2">
                    </div>
                    
                    <div>
                        <label for="description" class="block text-gray-700">Description</label>
                        <input type="text" name="description" id="description" class="w-full border-gray-300 rounded-lg p-2">
                    </div>
                    
                    <div>
                        <label for="category" class="block text-gray-700">Category</label>
                        <select name="category" id="category" class="w-full border-gray-300 rounded-lg p-2">
                            <option value="latvian">Latvian</option>
                            <option value="china">Chinese</option>
                            <option value="america">American</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="image" class="block text-gray-700">Image</label>
                        <input type="file" name="image" id="image" class="w-full border-gray-300 rounded-lg p-2">
                    </div>
                    
                    <button class="text-white px-4 py-2 rounded-lg bg-blue-500">Save Recipe</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
