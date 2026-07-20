<div class="space-y-6">

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">
            Category Name
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $category->name ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
            required>
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">
            Description
        </label>

        <textarea
            id="description"
            name="description"
            rows="4"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $category->description ?? '') }}</textarea>
    </div>

    <div class="flex items-center">

        <input
            type="checkbox"
            id="is_active"
            name="is_active"
            value="1"
            {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}
            class="rounded border-gray-300">

        <label for="is_active" class="ml-2 text-sm text-gray-700">
            Active Category
        </label>

    </div>

    <div class="flex justify-end gap-3">

        <a href="{{ route('admin.media-categories.index') }}"
            class="px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600">
            Cancel
        </a>

        <button
            type="submit"
            class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">

            Save Category

        </button>

    </div>

</div>