<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <h2 class="text-2xl font-bold text-gray-800">
                Edit Media Category
            </h2>

            <a href="{{ route('admin.media-categories.index') }}"
                class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">

                ← Back to Categories

            </a>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-4xl mx-auto">

            @if ($errors->any())

            <div class="mb-6 rounded-md border border-red-300 bg-red-50 p-4">

                <ul class="list-disc list-inside text-red-700">

                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <form
                    action="{{ route('admin.media-categories.update', $category) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    @include('admin.media-categories.partials.form')

                </form>

            </div>

        </div>

    </div>

</x-app-layout>