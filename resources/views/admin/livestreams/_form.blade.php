@csrf

<div class="space-y-6">

    <div>
        <label class="block text-sm font-medium text-gray-700">
            Title
        </label>

        <input
            type="text"
            name="title"
            value="{{ old('title', $livestream->title ?? '') }}"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm"
            required>

        @error('title')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">
            Platform
        </label>

        <select
            name="platform"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
            @foreach (['YouTube', 'Facebook', 'Zoom', 'Other'] as $platform)
            <option
                value="{{ $platform }}"
                @selected(old('platform', $livestream->platform ?? '') === $platform)
                >
                {{ $platform }}
            </option>
            @endforeach
        </select>

        @error('platform')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">
            Stream URL
        </label>

        <input
            type="url"
            name="stream_url"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">

        @error('stream_url')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">
            Scheduled Date & Time
        </label>

        <input
            type="datetime-local"
            name="scheduled_at"
            value="{{ old('scheduled_at', isset($livestream) ? $livestream->scheduled_at?->format('Y-m-d\TH:i') : '') }}"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm"
            required>

        @error('scheduled_at')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">
            Status
        </label>

        <select
            name="status"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
            @foreach (['scheduled', 'live', 'ended'] as $status)
            <option
                value="{{ $status }}"
                @selected(old('status', $livestream->status ?? 'scheduled') === $status)
                >
                {{ ucfirst($status) }}
            </option>
            @endforeach
        </select>

        @error('status')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">
            Recording
        </label>

        <select
            name="recording_media_item_id"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
            <option value="">None</option>

            @foreach($recordings as $recording)
            <option
                value="{{ $recording->id }}"
                @selected(old( 'recording_media_item_id' ,
                $livestream->recording_media_item_id ?? ''
                ) == $recording->id)
                >
                {{ $recording->title }}
            </option>
            @endforeach
        </select>

        @error('recording_media_item_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">
            Description
        </label>

        <textarea
            name="description"
            rows="5"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">{{ old('description', $livestream->description ?? '') }}</textarea>

        @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center">
        <input
            type="checkbox"
            name="is_published"
            value="1"
            @checked(old('is_published', $livestream->is_published ?? true))
        class="rounded border-gray-300"
        >

        <span class="ml-2">
            Published
        </span>
    </div>

    <div class="flex gap-3 pt-4">

        <button
            type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Save Livestream
        </button>

        <a
            href="{{ route('admin.livestreams.index') }}"
            class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
            Cancel
        </a>

    </div>

</div>