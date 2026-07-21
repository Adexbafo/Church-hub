<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Media Team Member
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form
                    method="POST"
                    action="{{ route('admin.media-teams.store') }}">
                    @csrf

                    @include('admin.media-teams._form')

                    <div class="mt-6 flex justify-end gap-3">

                        <a
                            href="{{ route('admin.media-teams.index') }}"
                            class="px-4 py-2 bg-gray-200 rounded">
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded">
                            Save
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>