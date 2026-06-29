<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('church.name') }}</title>

    <link rel="manifest" href="/build/manifest.webmanifest">
    <link rel="apple-touch-icon" href="/pwa-192x192.png">

    <meta name="theme-color" content="#2563eb">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title"
        content="{{ config('church.short_name') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="flex min-h-screen">
        <div id="sidebarOverlay"
            class="fixed inset-0 bg-black/50 z-40 hidden md:hidden">
        </div>

        <x-sidebar />

        <div class="flex-1">

            <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center">

                <button id="menuButton"
                    class="md:hidden bg-gray-100 p-2 rounded-lg">

                    ☰

                </button>

                <div>
                    <h2 class="hidden md:block text-2xl font-bold text-gray-800">
                        {{ config('church.short_name') }} Dashboard
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

            @if(session('success'))

            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                x-transition.opacity.duration.500ms
                class="fixed top-5 right-5 z-50">

                <div class="bg-green-500 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3">

                    <span class="text-lg">✅</span>

                    <span class="font-medium">
                        {{ session('success') }}
                    </span>

                </div>

            </div>

            @endif

            <main>
                {{ $slot }}
            </main>

        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const menuButton = document.getElementById('menuButton')
            const sidebar = document.getElementById('sidebar')
            const overlay = document.getElementById('sidebarOverlay')

            menuButton?.addEventListener('click', () => {

                sidebar.classList.toggle('-translate-x-full')

                overlay.classList.toggle('hidden')

            })

            overlay?.addEventListener('click', () => {

                sidebar.classList.add('-translate-x-full')

                overlay.classList.add('hidden')

            })

        })
    </script>

</body>

</html>