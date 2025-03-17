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
                
                <img src="{{ Storage::url($recipe->image_path) }}" class="w-full h-64 object-cover rounded-md mt-4">
                
                <p class="text-gray-700 mt-4">{{ $recipe->description }}</p>
                
                <div class="mt-6 flex space-x-4">
                    @if(auth()->user()->usertype === 'admin')
                        <a href="{{ route('edit', $recipe->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded">Edit</a>

                        <form action="{{ route('delete', $recipe->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
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