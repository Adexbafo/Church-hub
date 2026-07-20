<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">

                Media Library

            </h2>

            <a
                href="{{ route('admin.media-items.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">

                + Upload Media

            </a>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Title
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Size
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Uploaded By
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Published
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @forelse($mediaItems as $mediaItem)

                        <tr>

                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $mediaItem->title }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $mediaItem->category->name }}
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if ($mediaItem->media_type === 'image')
                                <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                                    🖼️ Image
                                </span>
                                @elseif ($mediaItem->media_type === 'video')
                                <span class="px-2 py-1 rounded-full bg-blue-100 text-blue-700 text-xs">
                                    🎥 Video
                                </span>
                                @elseif ($mediaItem->media_type === 'audio')
                                <span class="px-2 py-1 rounded-full bg-purple-100 text-purple-700 text-xs">
                                    🎵 Audio
                                </span>
                                @else
                                <span class="px-2 py-1 rounded-full bg-gray-100 text-gray-700 text-xs">
                                    📄 Document
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                {{ $mediaItem->formatted_file_size }}
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                {{ $mediaItem->uploader?->name ?? 'Unknown' }}
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">

                                @if ($mediaItem->is_published)
                                <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                                    Published
                                </span>
                                @else
                                <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs">
                                    Draft
                                </span>
                                @endif

                            </td>

                            <td class="px-6 py-4 text-right">

                                <div class="flex justify-end items-center space-x-4">

                                    <a
                                        href="{{ route('admin.media-items.edit', $mediaItem) }}"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium">

                                        ✏️ Edit

                                    </a>

                                    <a
                                        href="{{ route('admin.media-items.download', $mediaItem) }}"
                                        class="text-green-600 hover:text-green-800 text-sm font-medium">
                                        ⬇️ Download
                                    </a>
                                    <form
                                        action="{{ route('admin.media-items.destroy', $mediaItem) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this media file?');">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-red-600 hover:text-red-800 font-medium">

                                            🗑️ Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7"
                                class="px-6 py-10 text-center text-gray-500">

                                No media has been uploaded yet.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-6">

                {{ $mediaItems->links() }}

            </div>

        </div>

    </div>

</x-app-layout>