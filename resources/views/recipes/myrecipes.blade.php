<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6 px-6 pt-2">
            @if ($recipes->isEmpty())
                <p class="text-gray-500">You haven't added any recipes yet.</p>
            @else
                <div class="grid grid-cols-3 gap-2 md:gap-4 auto-rows-[200px] md:auto-rows-[250px] mt-4">
                    @foreach ($recipes as $recipe)
                        <div class="relative overflow-hidden rounded-lg shadow-lg 
                            {{ $loop->index % 6 == 0 ? 'col-span-2 row-span-2' : 'col-span-1 row-span-1' }}">
                            <a href="{{ route('show', $recipe->id) }}">
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

                <form action="/" method="get" class="mt-6 mb-6">
                    <button class="text-white px-4 py-2 rounded bg-blue-500">Back</button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
