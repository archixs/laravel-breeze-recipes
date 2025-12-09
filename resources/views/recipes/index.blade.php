<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6  px-6 pt-2">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-4">
                @foreach ($recipes as $recipe)
                    <div class="bg-gray-100 p-4 rounded-lg shadow-lg">
                        <a href="{{ route('show', ['id' => $recipe->id, 'redirect' => 'index']) }}">
                            <img src="{{ Storage::url($recipe->image_path) }}" class="w-full h-48 object-cover rounded-md">
                        </a>
                        <h3 class="text-xl font-bold mt-2">{{ $recipe->name }}</h3>
                        <p class="text-gray-700 mt-1">{{ $recipe->description }}</p>
                        
                        <a href="{{ route('show', ['id' => $recipe->id, 'redirect' => 'index']) }}" class="mt-4 block text-center bg-blue-500 text-white px-4 py-2 rounded">See More</a>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $recipes->links() }}
            </div>
            
            <form action="/recipe/create" method="get" class="mt-6 mb-6">
                <button class="text-white px-4 py-2 rounded bg-blue-500">Make Recipe</button>
            </form>
        </div>
    </div>
</x-app-layout>
