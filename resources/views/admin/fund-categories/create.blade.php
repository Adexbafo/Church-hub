<x-app-layout>

    <div class="py-10">

        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white rounded-2xl shadow p-8">

                <h1 class="text-3xl font-bold mb-8">
                    Create Fund Category
                </h1>

                <form method="POST"
                    action="{{ route('admin.fund-categories.store') }}">

                    @csrf

                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full rounded-lg border-gray-300"
                            required>

                    </div>

                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            class="w-full rounded-lg border-gray-300">{{ old('description') }}</textarea>

                    </div>

                    <div class="mb-8">

                        <label class="flex items-center gap-3">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                checked>

                            Active Category

                        </label>

                    </div>

                    <div class="flex justify-end gap-4">

                        <a
                            href="{{ route('admin.fund-categories.index') }}"
                            class="px-6 py-2 border rounded-lg">

                            Cancel

                        </a>

                        <button
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">

                            Save Category

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>