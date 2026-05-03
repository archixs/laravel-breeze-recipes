<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 flex">

    <div class="hidden md:flex w-1/2 bg-cover bg-center relative" 
        style="background-image: url('{{ asset('storage/demo/login-bg.jpg') }}' );">
        
        <div class="absolute inset-0 bg-black/70"></div>

        <div class="relative z-10 flex items-center justify-center w-full">
            <div class="bg-white/90 p-8 rounded-full shadow-2xl">
                <img src="{{ asset('storage/demo/recipes-icon2.jpg') }}" alt="Logo" class="w-40 h-auto">
            </div>
        </div>
    </div>

    <!-- Right side (content / form) -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>

</body>
</html>
