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
                    Categories: 
                    @if($recipe->categories && $recipe->categories->count())
                        <span class="font-semibold">
                            {{ $recipe->categories->pluck('name')->join(', ') }}
                        </span>
                    @else
                        <span class="font-semibold">Uncategorized</span>
                    @endif
                </p>

                <!-- Rating System -->
                <div class="mt-4 flex items-center space-x-2">
                    <span class="text-gray-700 font-semibold">Rating:</span>
                    <div id="rating-stars" class="flex space-x-1 text-yellow-500 cursor-pointer">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg data-value="{{ $i }}" xmlns="http://www.w3.org/2000/svg" 
                                class="w-6 h-6 fill-current {{ $i <= $recipe->user_rating ? 'text-yellow-500' : 'text-gray-300' }}" 
                                viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.963a1 1 0 00.95.69h4.172c.97 0 1.371 1.24.588 1.81l-3.367 2.448a1 1 0 00-.364 1.118l1.286 3.963c.3.92-.755 1.688-1.54 1.118L10 14.347l-3.367 2.448c-.785.57-1.84-.198-1.54-1.118l1.286-3.963a1 1 0 00-.364-1.118L2.648 8.39c-.783-.57-.382-1.81.588-1.81h4.172a1 1 0 00.95-.69l1.286-3.963z"/>
                            </svg>
                        @endfor
                    </div>
                    <span id="average-rating" class="text-gray-600">({{ round($recipe->average_rating, 1) }})</span>
                </div>


                <!-- Recipe Image -->
                <img src="{{ $recipe->image_path ? Storage::url($recipe->image_path) : asset('images/default-recipe.jpg') }}" 
                     class="w-full h-64 object-cover rounded-md mt-4">

                <p class="text-gray-700 mt-4">{{ $recipe->description }}</p>

                <!-- Ingredients -->
                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800">Ingredients</h3>
                    <ul class="list-disc list-inside text-gray-700 mt-2">
                        @foreach(explode("\n", $recipe->ingredients) as $ingredient)
                            <li>{{ $ingredient }}</li>
                        @endforeach
                    </ul>
                </div>

                <!-- Steps -->
                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800">Steps</h3>
                    <ol class="list-decimal list-inside text-gray-700 mt-2 space-y-2">
                        @foreach(explode("\n", $recipe->steps) as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ol>
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex space-x-4">
                    @if(auth()->user()->usertype === 'admin' || $recipe->user_id === auth()->user()->id)
                        <a href="{{ route('edit', $recipe->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded">Edit</a>

                        <form action="{{ route('delete', $recipe->id) }}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
                        </form>
                    @endif

                    <a href="{{ url()->previous() }}" class="px-4 py-2 bg-blue-500 text-white rounded">Back</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Rating -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('#rating-stars svg');
            let currentRating = "{{ $recipe->user_rating }}";

            // Highlight previously selected rating on page load
            stars.forEach((star, index) => {
                star.classList.toggle('text-yellow-500', index < currentRating);
                star.classList.toggle('text-gray-300', index >= currentRating);
            });

            // Handle click event
            stars.forEach(star => {
                star.addEventListener('click', function () {
                    let rating = this.getAttribute('data-value');

                    fetch("{{ route('rate', $recipe->id) }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ rating: rating })
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('average-rating').textContent = `(${data.average_rating})`;

                        stars.forEach((s, index) => {
                            s.classList.toggle('text-yellow-500', index < rating);
                            s.classList.toggle('text-gray-300', index >= rating);
                        });
                    });
                });
            });
        });
    </script>   

</x-app-layout>
