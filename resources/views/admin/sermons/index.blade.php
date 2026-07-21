<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Sermons
            </h2>

            <a
                href="{{ route('admin.sermons.create') }}"
                class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                + New Sermon
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl">

            @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
            @endif

            <div class="overflow-hidden rounded-lg bg-white shadow">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left">Title</th>
                            <th class="px-6 py-3 text-left">Speaker</th>
                            <th class="px-6 py-3 text-left">Sermon Date</th>
                            <th class="px-6 py-3 text-left">Media</th>
                            <th class="px-6 py-3 text-left">Featured</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Created By</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">

                        @forelse($sermons as $sermon)

                        <tr>

                            <td class="px-6 py-4">
                                {{ $sermon->title }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $sermon->speaker }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $sermon->sermon_date->format('M d, Y') }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">

                                    @if($sermon->audio)
                                    <span class="rounded bg-blue-100 px-2 py-1 text-xs text-blue-700">
                                        🎵 Audio
                                    </span>
                                    @endif

                                    @if($sermon->video)
                                    <span class="rounded bg-red-100 px-2 py-1 text-xs text-red-700">
                                        🎥 Video
                                    </span>
                                    @endif

                                    @if($sermon->notes)
                                    <span class="rounded bg-gray-100 px-2 py-1 text-xs text-gray-700">
                                        📄 Notes
                                    </span>
                                    @endif

                                </div>
                            </td>

                            <td class="px-6 py-4">

                                @if($sermon->is_featured)

                                <span class="rounded bg-blue-100 px-2 py-1 text-xs text-blue-700">
                                    Featured
                                </span>

                                @else

                                <span class="text-gray-400">
                                    —
                                </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                @if($sermon->is_published)

                                <span class="rounded bg-green-100 px-2 py-1 text-xs text-green-700">
                                    Published
                                </span>

                                @else

                                <span class="rounded bg-yellow-100 px-2 py-1 text-xs text-yellow-700">
                                    Draft
                                </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">
                                {{ $sermon->creator->name }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.sermons.edit', $sermon) }}"
                                        class="text-blue-600 hover:underline">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.sermons.destroy', $sermon) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this sermon?');">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="text-red-600 hover:underline">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td
                                colspan="8"
                                class="px-6 py-8 text-center text-gray-500">

                                No sermons found.

                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-6">
                {{ $sermons->links() }}
            </div>

        </div>
    </div>

</x-app-layout>