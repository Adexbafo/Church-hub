<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Sermon
            </h2>

            <a
                href="{{ route('admin.sermons.index') }}"
                class="text-indigo-600 hover:underline">
                ← Back to Sermons
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form
                    action="{{ route('admin.sermons.update', $sermon) }}"
                    method="POST">
                    @method('PUT')

                    @include('admin.sermons._form', [
                    'submitLabel' => 'Update Sermon'
                    ])
                </form>

            </div>

        </div>
    </div>

</x-app-layout>