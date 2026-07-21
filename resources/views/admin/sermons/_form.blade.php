@csrf

<div class="space-y-6">

    {{-- Title --}}
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">
            Title
        </label>

        <input
            type="text"
            name="title"
            id="title"
            value="{{ old('title', $sermon->title ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
            required>

        @error('title')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Speaker --}}
    <div>
        <label for="speaker" class="block text-sm font-medium text-gray-700">
            Speaker
        </label>

        <input
            type="text"
            name="speaker"
            id="speaker"
            value="{{ old('speaker', $sermon->speaker ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
            required>

        @error('speaker')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Scripture --}}
    <div>
        <label for="scripture" class="block text-sm font-medium text-gray-700">
            Scripture
        </label>

        <input
            type="text"
            name="scripture"
            id="scripture"
            value="{{ old('scripture', $sermon->scripture ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    </div>

    {{-- Sermon Date --}}
    <div>
        <label for="sermon_date" class="block text-sm font-medium text-gray-700">
            Sermon Date
        </label>

        <input
            type="date"
            name="sermon_date"
            id="sermon_date"
            value="{{ old('sermon_date', isset($sermon) ? $sermon->sermon_date->format('Y-m-d') : '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
            required>
    </div>

    {{-- Description --}}
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">
            Description
        </label>

        <textarea
            name="description"
            id="description"
            rows="5"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $sermon->description ?? '') }}</textarea>
    </div>

</div>

<h2 class="text-lg font-semibold mt-8 mb-4">
    Media Resources
</h2>

@if (
$errors->has('audio_media_item_id') ||
$errors->has('video_media_item_id') ||
$errors->has('notes_media_item_id')
)
<div class="mb-4 rounded-md bg-red-50 border border-red-200 p-3">
    <p class="text-sm text-red-700">
        {{ $errors->first('audio_media_item_id')
                ?? $errors->first('video_media_item_id')
                ?? $errors->first('notes_media_item_id') }}
    </p>
</div>
@endif

{{-- Audio --}}
<div class="mb-4">

    <label class="block text-sm font-medium text-gray-700">
        Audio
    </label>

    <select
        name="audio_media_item_id"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

        <option value="">-- None --</option>

        @foreach($audioItems as $item)

        <option
            value="{{ $item->id }}"
            @selected(old('audio_media_item_id', $sermon->audio_media_item_id ?? '') == $item->id)>

            {{ $item->title }}

        </option>

        @endforeach

    </select>


</div>

{{-- Video --}}
<div class="mb-4">

    <label class="block text-sm font-medium text-gray-700">
        Video
    </label>

    <select
        name="video_media_item_id"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

        <option value="">-- None --</option>

        @foreach($videoItems as $item)

        <option
            value="{{ $item->id }}"
            @selected(old('video_media_item_id', $sermon->video_media_item_id ?? '') == $item->id)>

            {{ $item->title }}

        </option>

        @endforeach

    </select>


</div>

{{-- Notes --}}
<div class="mb-6">

    <label class="block text-sm font-medium text-gray-700">
        Notes
    </label>

    <select
        name="notes_media_item_id"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

        <option value="">-- None --</option>

        @foreach($noteItems as $item)

        <option
            value="{{ $item->id }}"
            @selected(old('notes_media_item_id', $sermon->notes_media_item_id ?? '') == $item->id)>

            {{ $item->title }}

        </option>

        @endforeach

    </select>


</div>
<h2 class="text-lg font-semibold mt-8 mb-4">
    Publication
</h2>
<label class="flex items-center">

    <input
        type="checkbox"
        name="is_featured"
        value="1"
        @checked(old('is_featured', $sermon->is_featured ?? false))
    >

    <span class="ml-2">
        Featured Sermon
    </span>

</label>
<label class="flex items-center mt-3">

    <input
        type="checkbox"
        name="is_published"
        value="1"
        @checked(old('is_published', $sermon->is_published ?? true))
    >

    <span class="ml-2">
        Published
    </span>

</label>
<div class="mt-8 flex gap-3">

    <button
        type="submit"
        class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
        {{ $submitLabel }}
    </button>

    <a
        href="{{ route('admin.sermons.index') }}"
        class="rounded-md border px-4 py-2">
        Cancel
    </a>

</div>