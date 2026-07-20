<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">

                Upload Media

            </h2>

            <a
                href="{{ route('admin.media-items.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition">

                ← Back to Media Library

            </a>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form
                    action="{{ route('admin.media-items.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    @include('admin.media-items.partials.form')
                </form>

            </div>

        </div>

    </div>

</x-app-layout>