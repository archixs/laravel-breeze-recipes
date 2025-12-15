<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6 px-6 pt-2 min-h-[70vh] flex flex-col">
            
            @if ($recipes->isEmpty())
                <p class="text-gray-500 mt-4">You haven't added any recipes yet.</p>

                <!-- Buttons pinned to bottom -->
                <div class="mt-auto mb-6 flex gap-4">
                    <a href="{{ route('create', ['redirect' => 'myrecipes']) }}"
                       class="text-white px-4 py-2 rounded bg-blue-500">
                        Create a Recipe
                    </a>

                    <a href="{{ route('index') }}"
                       class="text-white px-4 py-2 rounded bg-gray-500">
                        Back
                    </a>
                </div>
            @else
                <div class="grid grid-cols-3 gap-2 md:gap-4 auto-rows-[200px] md:auto-rows-[250px] mt-4">
                    @foreach ($recipes as $recipe)
                        <div class="relative overflow-hidden rounded-lg shadow-lg 
                            {{ $loop->index % 6 == 0 ? 'col-span-2 row-span-2' : 'col-span-1 row-span-1' }}">
                            <a href="{{ route('show', ['id' => $recipe->id, 'redirect' => 'myrecipes']) }}">
                                <img src="{{ Storage::url($recipe->image_path) }}" class="w-full h-full object-cover">
                            </a>
                            <div class="absolute bottom-0 bg-black bg-opacity-50 text-white p-2 w-full text-center">
                                <h3 class="text-lg font-bold">{{ $recipe->name }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $recipes->links() }}
                </div>

                <!-- Buttons pinned to bottom -->
                <div class="mt-auto mb-6 flex gap-4">
                    <a href="{{ route('create', ['redirect' => 'myrecipes']) }}"
                       class="text-white px-4 py-2 rounded bg-blue-500">
                        Create a Recipe
                    </a>

                    <a href="{{ route('index') }}"
                       class="text-white px-4 py-2 rounded bg-gray-500">
                        Back
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
