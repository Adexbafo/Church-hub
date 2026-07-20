<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Media Categories
            </h2>

            <a href="{{ route('admin.media-categories.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                + New Category
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Slug</th>
                            <th class="px-6 py-3 text-left">Description</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Media Items</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @forelse($categories as $category)

                        <tr>

                            <td class="px-6 py-4 font-medium">
                                {{ $category->name }}
                            </td>
                            <td class="px-6 py-4">
                                <code class="font-mono text-sm text-gray-600 whitespace-nowrap">
                                    {{ $category->slug }}
                                </code>
                            </td>

                            <td class="px-6 py-4">
                                {{ $category->description ?: '—' }}
                            </td>

                            <td class="px-6 py-4 text-center">

                                @if($category->is_active)

                                <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                                    Active
                                </span>

                                @else

                                <span class="px-2 py-1 rounded-full bg-red-100 text-red-700 text-xs">
                                    Inactive
                                </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ $category->media_items_count }}

                            </td>

                            <td class="px-6 py-4 text-right">

                                <div class="flex justify-end gap-3">

                                    <a
                                        href="{{ route('admin.media-categories.edit', $category) }}"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('admin.media-categories.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this media category?');">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-red-600 hover:text-red-800 font-medium">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6"
                                class="px-6 py-10 text-center text-gray-500">

                                No media categories have been created yet.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-6">

                {{ $categories->links() }}

            </div>

        </div>
    </div>
</x-app-layout>