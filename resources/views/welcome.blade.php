<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="scroll-smooth">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gray-100 text-gray-800">

    <header class="bg-blue-700 text-white shadow">

        <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">

            <h1 class="text-3xl font-bold">

                ChurchHub

            </h1>

            <nav class="hidden lg:flex gap-8 text-white">

                <a href="#about">About</a>

                <a href="#features">Features</a>

                <a href="#statistics">Statistics</a>

                <a href="#contact">Contact</a>

            </nav>

            <div class="space-x-3">

                @auth

                <a href="{{ route('dashboard') }}"
                    class="bg-white text-blue-700 px-5 py-2 rounded-lg">

                    Dashboard

                </a>

                @else

                <a href="{{ route('login') }}"
                    class="bg-white text-blue-700 px-5 py-2 rounded-lg">

                    Login

                </a>

                <a href="{{ route('register') }}"
                    class="bg-yellow-400 text-black px-5 py-2 rounded-lg">

                    Register

                </a>

                @endauth

            </div>

        </div>

    </header>

    <section id="home" class="bg-blue-600 text-white">

        <div class="max-w-6xl mx-auto px-6 py-24 text-center">

            <h2 class="text-5xl font-bold mb-6">

                Welcome to ChurchHub

            </h2>

            <p class="text-xl mb-10">

                Stay connected with your church community anytime,
                anywhere.

            </p>

            @guest

            <a href="{{ route('login') }}"
                class="bg-white text-blue-700 px-8 py-4 rounded-xl font-bold">

                Member Login

            </a>

            @endguest

        </div>

    </section>
    <section id="about" class="bg-white py-20">

        <div class="max-w-6xl mx-auto px-6 text-center">

            <h2 class="text-4xl font-bold mb-8">

                About ChurchHub

            </h2>

            <p class="text-gray-600 text-lg leading-8 max-w-3xl mx-auto">

                ChurchHub is a secure church management platform designed to
                help churches manage members, ministry groups, announcements,
                profiles, and church communication from anywhere.

                It enables both church leaders and members to stay connected
                through a modern web application.

            </p>

        </div>

    </section>
    <section id="features" class="bg-gray-100 py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center mb-14">

                What ChurchHub Offers

            </h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow p-8 h-full transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                    <h3 class="text-2xl font-bold mb-4">

                        👥 Member Management

                    </h3>

                    <p class="text-gray-600">

                        Register members, manage profiles, ministry bands,
                        and church records.

                    </p>

                </div>
                <div class="bg-white rounded-2xl shadow p-8 h-full transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                    <h3 class="text-2xl font-bold mb-4">

                        📢 Church Announcements

                    </h3>

                    <p class="text-gray-600">

                        Publish church news, upcoming events and important notices that members can access anytime.

                    </p>

                </div>
                <div class="bg-white rounded-2xl shadow p-8 h-full transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                    <h3 class="text-2xl font-bold mb-4">

                        🎵 Ministry Bands

                    </h3>

                    <p class="text-gray-600">

                        Organize choir, ushers, media, protocol and other ministry groups with ease.

                    </p>

                </div>
                <div class="bg-white rounded-2xl shadow p-8 h-full transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                    <h3 class="text-2xl font-bold mb-4">

                        📱 Mobile Friendly

                    </h3>

                    <p class="text-gray-600">

                        Access ChurchHub from phones, tablets and desktops with a responsive experience.

                    </p>

                </div>
                <div class="bg-white rounded-2xl shadow p-8 h-full transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                    <h3 class="text-2xl font-bold mb-4">

                        🔐 Secure Member Portal

                    </h3>

                    <p class="text-gray-600">

                        Members can securely update their profiles and view personalized church information.

                    </p>

                </div>
                <div class="bg-white rounded-2xl shadow p-8 h-full transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                    <h3 class="text-2xl font-bold mb-4">

                        📊 Church Administration

                    </h3>

                    <p class="text-gray-600">

                        Manage membership records, statistics, reports and administrative activities from one dashboard.

                    </p>

                </div>
            </div> {{-- closes grid --}}
        </div> {{-- closes max-w-7xl --}}
    </section> {{-- closes What ChurchHub Offers --}}
    <section id="statistics" class="bg-white py-24">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center mb-14">

                Church At A Glance

            </h2>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="bg-blue-50 rounded-2xl shadow p-8 text-center transition hover:-translate-y-2 hover:shadow-xl">

                    <div class="text-5xl font-bold text-blue-600">

                        {{ $totalMembers }}

                    </div>

                    <div class="mt-3 text-gray-600">

                        Total Members

                    </div>

                </div>

                <div class="bg-green-50 rounded-2xl shadow p-8 text-center transition hover:-translate-y-2 hover:shadow-xl">

                    <div class="text-5xl font-bold text-green-600">

                        {{ $activeMembers }}

                    </div>

                    <div class="mt-3 text-gray-600">

                        Active Members

                    </div>

                </div>

                <div class="bg-purple-50 rounded-2xl shadow p-8 text-center transition hover:-translate-y-2 hover:shadow-xl">

                    <div class="text-5xl font-bold text-purple-600">

                        {{ $totalBands }}

                    </div>

                    <div class="mt-3 text-gray-600">

                        Ministry Bands

                    </div>

                </div>

                <div class="bg-orange-50 rounded-2xl shadow p-8 text-center transition hover:-translate-y-2 hover:shadow-xl">

                    <div class="text-5xl font-bold text-orange-600">

                        {{ $totalAnnouncements }}

                    </div>

                    <div class="mt-3 text-gray-600">

                        Announcements

                    </div>

                </div>

            </div>

        </div>

    </section>
    <section id="contact" class="bg-blue-700 text-white py-20">

        <div class="max-w-4xl mx-auto text-center px-6">

            <h2 class="text-4xl font-bold mb-6">
                Ready to Connect Your Church?
            </h2>

            <p class="text-lg opacity-90 mb-8">
                ChurchHub helps churches manage members, announcements,
                ministry groups and communication from one secure platform.
            </p>

            @guest
            <a href="{{ route('register') }}"
                class="bg-yellow-400 text-black px-8 py-4 rounded-xl font-bold hover:bg-yellow-300">

                Get Started

            </a>
            @else
            <a href="{{ route('dashboard') }}"
                class="bg-white text-blue-700 px-8 py-4 rounded-xl font-bold">

                Go to Dashboard

            </a>
            @endguest

        </div>

    </section>
    <footer class="bg-gray-900 text-white py-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="text-center">

                <h3 class="text-2xl font-bold mb-3">
                    ChurchHub
                </h3>

                <p class="text-gray-300">

                    A modern church management platform built for churches,
                    ministries and Christian organizations.

                </p>

                <div class="mt-6 text-gray-500">

                    © {{ date('Y') }} ChurchHub.
                    All Rights Reserved.

                </div>

            </div>
        </div>
    </footer>

</body>

</html>