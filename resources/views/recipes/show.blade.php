<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recipe Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800">{{ $recipe->name }}</h2>

                <p class="text-gray-600 mt-2">
                    By: <span class="font-semibold">{{ $recipe->user->name ?? $recipe->user->email ?? 'Unknown' }}</span>
                </p>

                <p class="text-gray-600 mt-1">
                    Category: <span class="font-semibold">{{ $recipe->category->name ?? 'Uncategorized' }}</span>
                </p>

                <img src="{{ $recipe->image_path ? Storage::url($recipe->image_path) : asset('images/default-recipe.jpg') }}" 
                     class="w-full h-64 object-cover rounded-md mt-4">

                <p class="text-gray-700 mt-4">{{ $recipe->description }}</p>

                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800">Ingredients</h3>
                    <ul class="list-disc list-inside text-gray-700 mt-2">
                        @foreach(explode("\n", $recipe->ingredients) as $ingredient)
                            <li>{{ $ingredient }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800">Steps</h3>
                    <ol class="list-decimal list-inside text-gray-700 mt-2 space-y-2">
                        @foreach(explode("\n", $recipe->steps) as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ol>
                </div>

                <div class="mt-6 flex space-x-4">
                    @if(auth()->user()->usertype === 'admin' || $recipe->user_id === auth()->user()->id)
                        <a href="{{ route('edit', $recipe->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded">Edit</a>

                        <form action="{{ route('delete', $recipe->id) }}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
                        </form>
                    @endif

                    <a href="{{ route('index') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
