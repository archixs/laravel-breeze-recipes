<nav x-data="{ open: false }" class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- LEFT: Logo + Hamburger -->
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <x-application-logo class="h-12 w-auto opacity-90 hover:opacity-100 transition" />
                </a>

                <!-- Desktop Links -->
                <div class="hidden md:flex items-center gap-6 text-[15px]">
                    <a href="{{ route('index') }}"
                       class="font-medium text-gray-700 hover:text-black transition {{ request()->routeIs('index') ? 'text-blue-600 font-semibold' : '' }}">
                        Recipes
                    </a>
                    <a href="{{ route('myrecipes') }}"
                       class="font-medium text-gray-700 hover:text-black transition {{ request()->routeIs('myrecipes') ? 'text-blue-600 font-semibold' : '' }}">
                        My Recipes
                    </a>
                    <a href="{{ route('ai-page') }}"
                       class="font-medium text-gray-700 hover:text-black transition {{ request()->routeIs('ai-page') ? 'text-blue-600 font-semibold' : '' }}">
                        AI
                    </a>
                </div>

                <!-- Mobile Hamburger -->
                <button @click="open = !open" class="md:hidden p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- CENTER: Search & Category -->
            <div class="hidden lg:flex items-center gap-4">
                <form action="{{ route('index') }}" method="GET">
                    <select name="category" onchange="this.form.submit()"
                            class="w-52 h-[42px] px-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-700 text-md focus:ring-2 focus:ring-blue-300">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <form action="{{ route('index') }}" method="GET" class="flex items-center">
                    <input name="search" value="{{ request('search') }}" type="text" placeholder="Search…"
                           class="w-52 h-[42px] px-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-700 text-md focus:ring-2 focus:ring-blue-300">
                </form>
            </div>

            <!-- RIGHT: User -->
            <div class="flex items-center gap-2">
                @auth
                    <div class="relative" x-data="{ menu: false }">
                        <button @click="menu = !menu"
                                class="flex items-center h-[42px] gap-2 px-3 rounded-xl border border-gray-300 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold text-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-gray-700 font-medium hidden sm:block truncate">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-500 hidden sm:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="menu" x-cloak @click.away="menu = false" x-transition
                             class="absolute right-0 mt-2 w-44 bg-white shadow-xl rounded-xl overflow-hidden z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-50 text-gray-700 text-sm">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Log Out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}"
                           class="h-[42px] flex items-center px-4 rounded-xl border border-gray-300 text-gray-700 text-sm hover:bg-gray-100 transition">Login</a>
                        <a href="{{ route('register') }}"
                           class="h-[42px] flex items-center px-4 rounded-xl bg-blue-500 text-white text-sm hover:bg-blue-600 transition">Register</a>
                    </div>
                @endauth
            </div>
        </div>

        <!-- MOBILE MENU -->
        <div x-show="open" class="md:hidden mt-2 space-y-2 pb-2">
            <a href="{{ route('index') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Recipes</a>
            <a href="{{ route('myrecipes') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">My Recipes</a>
            <a href="{{ route('ai-page') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">AI</a>

            <!-- Mobile Search & Category -->
            <form action="{{ route('index') }}" method="GET" class="flex flex-col gap-2 mt-2">
                <select name="category" onchange="this.form.submit()" class="h-[42px] px-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-700">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search…" class="h-[42px] px-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-700">
            </form>
        </div>
    </div>
</nav>
