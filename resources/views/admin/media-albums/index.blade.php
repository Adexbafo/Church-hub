<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Media Albums
            </h2>

            <a
                href="{{ route('admin.media-albums.create') }}"
                class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                + New Album
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
                            <th class="px-6 py-3 text-left">Event Date</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">

                        @forelse($albums as $album)

                        <tr>

                            <td class="px-6 py-4">
                                {{ $album->title }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $album->event_date?->format('M d, Y') ?? '—' }}
                            </td>

                            <td class="px-6 py-4">

                                @if($album->is_published)

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

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.media-albums.edit', $album) }}"
                                        class="text-blue-600 hover:underline">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.media-albums.destroy', $album) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this album?');">
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
                                colspan="4"
                                class="px-6 py-8 text-center text-gray-500">
                                No media albums found.
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-6">
                {{ $albums->links() }}
            </div>

        </div>
    </div>

</x-app-layout>