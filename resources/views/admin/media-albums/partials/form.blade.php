@csrf

<div class="space-y-6">

    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">
            Album Title
        </label>

        <input
            type="text"
            name="title"
            id="title"
            value="{{ old('title', $mediaAlbum->title ?? '') }}"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            required>

        @error('title')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">
            Description
        </label>

        <textarea
            name="description"
            id="description"
            rows="5"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $mediaAlbum->description ?? '') }}</textarea>

        @error('description')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="event_date" class="block text-sm font-medium text-gray-700">
            Event Date
        </label>

        <input
            type="date"
            name="event_date"
            id="event_date"
            value="{{ old('event_date', optional($mediaAlbum ?? null)->event_date?->format('Y-m-d')) }}"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

        @error('event_date')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center">
        <input
            type="checkbox"
            name="is_published"
            id="is_published"
            value="1"
            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
            @checked(old( 'is_published' ,
            $mediaAlbum->is_published ?? true
        ))
        >

        <label
            for="is_published"
            class="ml-2 text-sm text-gray-700">
            Published
        </label>
    </div>

</div>