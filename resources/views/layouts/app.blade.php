<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">

    <div class="flex min-h-screen">

        <x-sidebar />

        <div class="flex-1">

            <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center">

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        ChurchHub Dashboard
                    </h2>
                </div>

                <div class="flex items-center gap-4">

                    @if(auth()->user()->member?->profile_picture)

                        <img src="{{ asset('storage/' . auth()->user()->member->profile_picture) }}"
                             class="w-10 h-10 rounded-full object-cover">

                    @else

                        <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                    @endif

                    <div class="text-gray-700">
                        {{ auth()->user()->name }}
                    </div>

                </div>

            </header>

            <main>
                {{ $slot }}
            </main>

        </div>

    </div>

</body>
</html>
