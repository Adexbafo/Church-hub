<x-app-layout>

    <div class="py-20">
        <div class="max-w-2xl mx-auto text-center">

            <h1 class="text-6xl font-bold text-red-600">
                403
            </h1>

            <h2 class="text-3xl font-semibold mt-4">
                Access Denied
            </h2>

            <p class="text-gray-600 mt-4">
                You do not have permission to access this page.
            </p>

            <a href="{{ route('dashboard') }}"
               class="inline-block mt-6 px-6 py-3 bg-blue-600 text-white rounded-lg">

                Return Dashboard

            </a>

        </div>
    </div>

</x-app-layout>