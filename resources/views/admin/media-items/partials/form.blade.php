<div class="space-y-6">

    {{-- Category --}}
    <div>
        <label for="media_category_id" class="block text-sm font-medium text-gray-700">
            Category <span class="text-red-600">*</span>
        </label>

        <select
            id="media_category_id"
            name="media_category_id"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

            <option value="">Select Category</option>

            @foreach($categories as $category)

            <option
                value="{{ $category->id }}"
                @selected(old('media_category_id', $mediaItem->media_category_id ?? '') == $category->id)>

                {{ $category->name }}

            </option>

            @endforeach

        </select>

        @error('media_category_id')
        <p class="mt-1 text-sm text-red-600">
            {{ $message }}
        </p>
        @enderror
    </div>

    {{-- Album --}}
    <div>
        <label for="media_album_id" class="block text-sm font-medium text-gray-700">
            Album
        </label>

        <select
            id="media_album_id"
            name="media_album_id"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

            <option value="">No Album</option>

            @foreach($albums as $album)

            <option
                value="{{ $album->id }}"
                @selected(old('media_album_id', $mediaItem->media_album_id ?? '') == $album->id)>

                {{ $album->title }}

            </option>

            @endforeach

        </select>

        @error('media_album_id')
        <p class="mt-1 text-sm text-red-600">
            {{ $message }}
        </p>
        @enderror
    </div>

    {{-- Title --}}
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">
            Title <span class="text-red-600">*</span>
        </label>

        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $mediaItem->title ?? '') }}"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

        @error('title')
        <p class="mt-1 text-sm text-red-600">
            {{ $message }}
        </p>
        @enderror
    </div>

    {{-- Description --}}
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">
            Description
        </label>

        <textarea
            id="description"
            name="description"
            rows="5"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $mediaItem->description ?? '') }}</textarea>
    </div>

    {{-- File --}}
    <div>
        <label for="file" class="block text-sm font-medium text-gray-700">
            Media File
            @if(!isset($mediaItem))
            <span class="text-red-600">*</span>
            @endif
        </label>

        <input
            type="file"
            id="file"
            name="file"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

        @error('file')
        <p class="mt-1 text-sm text-red-600">
            {{ $message }}
        </p>
        @enderror

        @isset($mediaItem)
        <p class="mt-2 text-sm text-gray-500">
            Leave this blank to keep the current media file.
            Upload a new file only if you want to replace it.
        </p>
        @endisset
    </div>

    {{-- Checkboxes --}}
    <div class="space-y-3">

        <label class="flex items-center">

            <input
                type="checkbox"
                name="is_featured"
                value="1"
                @checked(old('is_featured', $mediaItem->is_featured ?? false))
            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">

            <span class="ml-2 text-sm text-gray-700">

                Featured

            </span>

        </label>

        <label class="flex items-center">

            <input
                type="checkbox"
                name="is_published"
                value="1"
                @checked(old('is_published', $mediaItem->is_published ?? true))
            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">

            <span class="ml-2 text-sm text-gray-700">

                Published

            </span>

        </label>

    </div>
    {{-- Form Actions --}}
    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">

        <a
            href="{{ route('admin.media-items.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">

            Cancel

        </a>

        <button
            type="submit"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">

            {{ isset($mediaItem) ? 'Update Media' : 'Upload Media' }}

        </button>

    </div>

</div>