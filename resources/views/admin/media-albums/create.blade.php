<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Create Media Album
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">

            <form
                action="{{ route('admin.media-albums.store') }}"
                method="POST">

                @include('admin.media-albums.partials.form')

                <div class="mt-6 flex justify-end gap-3">

                    <a
                        href="{{ route('admin.media-albums.index') }}"
                        class="px-4 py-2 border rounded-lg">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Save Album
                    </button>

                </div>

            </form>

        </div>
    </div>

</x-app-layout>