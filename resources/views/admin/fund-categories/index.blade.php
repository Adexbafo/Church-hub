<x-app-layout>

    <div class="py-10">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center mb-8">

                <div>

                    <h1 class="text-3xl font-bold">
                        Fund Categories
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Manage church financial categories.
                    </p>

                </div>

                <a
                    href="{{ route('admin.fund-categories.create') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">

                    + New Category

                </a>

            </div>

            <div class="bg-white rounded-2xl shadow overflow-hidden">

                <table class="min-w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-4 text-left">
                                Name
                            </th>

                            <th class="px-6 py-4 text-left">
                                Description
                            </th>

                            <th class="px-6 py-4 text-left">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($categories as $category)

                        <tr class="border-t">

                            <td class="px-6 py-4 font-medium">

                                {{ $category->name }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $category->description }}

                            </td>

                            <td class="px-6 py-4">

                                @if($category->is_active)

                                <span class="text-green-600">
                                    Active
                                </span>

                                @else

                                <span class="text-red-600">
                                    Inactive
                                </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-right">

                                <a
                                    href="{{ route('admin.fund-categories.edit', $category) }}"
                                    class="text-blue-600 mr-3">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('admin.fund-categories.destroy', $category) }}"
                                    method="POST"
                                    class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Delete this category?')"
                                        class="text-red-600">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="4"
                                class="text-center py-10 text-gray-500">

                                No fund categories found.

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