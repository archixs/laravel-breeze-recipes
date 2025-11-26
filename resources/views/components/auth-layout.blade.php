<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 flex">

    <div class="hidden md:flex w-1/2 items-center justify-center bg-gray-100">
        <x-application-logo class="w-40 h-auto text-indigo-600" />
    </div>

    <!-- Right side (content / form) -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>

</body>
</html>
