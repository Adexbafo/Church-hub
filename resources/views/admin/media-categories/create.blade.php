<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Media Category
            </h2>

            <a href="{{ route('admin.media-categories.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition">
                ← Back to Categories
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
            <div class="mb-6 rounded-md border border-red-300 bg-red-50 p-4">
                <h3 class="font-semibold text-red-700 mb-2">
                    Please fix the following errors:
                </h3>

                <ul class="list-disc list-inside text-red-600">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('admin.media-categories.store') }}"
                    method="POST">

                    @csrf

                    @include('admin.media-categories.partials.form')

                </form>

            </div>

        </div>
    </div>
</x-app-layout>