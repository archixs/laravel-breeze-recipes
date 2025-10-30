<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo & Navigation Links -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 8px;">
                    <x-application-logo style="height: 80px; width: auto;" />
                </a>


                <x-nav-link :href="route('index')" :active="request()->routeIs('index')" class="text-gray-600 hover:text-gray-900">
                    {{ __('Recipes') }}
                </x-nav-link>

                <x-nav-link :href="route('myrecipes')" :active="request()->routeIs('myrecipes')" class="text-gray-600 hover:text-gray-900">
                    {{ __('My recipes') }}
                </x-nav-link>

                <x-nav-link :href="route('ai-page')" :active="request()->routeIs('ai-page')" class="text-gray-600 hover:text-gray-900">
                    {{ __('My AI') }}
                </x-nav-link>
            </div>

            <!-- Category Dropdown & Search Bar -->
            <div class="flex items-center space-x-4">
                <!-- Category Dropdown -->
                <form action="{{ route('index') }}" method="GET" id="category-form" class="flex items-center">
                    <select name="category" class="border border-gray-300 p-2 rounded-lg text-gray-700 focus:ring focus:ring-blue-200" onchange="document.getElementById('category-form').submit();">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <!-- Search -->
                <form action="{{ route('index') }}" method="GET" class="flex items-center space-x-2">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search recipes..."
                        value="{{ request('search') }}"
                        class="border border-gray-300 p-2 rounded-lg w-48 sm:w-64 focus:ring focus:ring-blue-200"
                    >
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                        Search
                    </button>
                </form>
            </div>

            <!-- Right Section (User Authentication) -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:text-gray-900 focus:ring focus:ring-blue-200">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
