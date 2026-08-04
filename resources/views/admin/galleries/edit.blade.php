<x-app-layout>

    <div class="py-10">

        <div class="max-w-6xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-6">

                <h1 class="text-3xl font-bold">
                    Edit Media
                </h1>

                <p class="text-gray-500 mt-2 mb-6">
                    Update gallery information or replace the uploaded file.
                </p>

                <form
                    action="{{ route('admin.galleries.update', $gallery) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>

                            <label
                                for="title"
                                class="block text-sm font-medium text-gray-700">

                                Media Title <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="text"
                                name="title"
                                id="title"
                                value="{{ old('title', $gallery->title) }}"
                                placeholder="Youth Convention 2026"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            @error('title')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>
                        <div>

                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700">

                                Description

                            </label>

                            <textarea
                                name="description"
                                id="description"
                                rows="5"
                                placeholder="Brief description of this media..."
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $gallery->description) }}</textarea>

                            @error('description')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>
                        <div>

                            <label
                                for="media_type"
                                class="block text-sm font-medium text-gray-700">

                                Media Type <span class="text-red-500">*</span>

                            </label>

                            <select
                                name="media_type"
                                id="media_type"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                                <option value="">Select Media Type</option>

                                <option
                                    value="image"
                                    @selected(old('media_type', $gallery->media_type) == 'image')>

                                    📷 Image

                                </option>

                                <option
                                    value="video"
                                    @selected(old('media_type', $gallery->media_type) == 'video')>

                                    🎥 Video

                                </option>

                            </select>

                            @error('media_type')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>
                        <div>

                            <label
                                for="album"
                                class="block text-sm font-medium text-gray-700">

                                Album

                            </label>

                            <input
                                type="text"
                                name="album"
                                id="album"
                                value="{{ old('album', $gallery->album) }}"
                                placeholder="Youth Convention 2026"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            @error('album')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                        </div>
                        <div>

                            <label
                                for="media"
                                class="block text-sm font-medium text-gray-700">

                                Replace File (Optional)

                            </label>

                            @if($gallery->media_type === 'image')

                            <img
                                src="{{ asset('storage/'.$gallery->file_path) }}"
                                alt="{{ $gallery->title }}"
                                class="h-40 w-40 object-cover rounded-lg border mb-4">

                            @else

                            <video controls class="h-40 w-40 object-cover rounded-lg border mb-4">

                                <source src="{{ asset('storage/'.$gallery->file_path) }}">

                            </video>

                            @endif

                            <input
                                type="file"
                                name="file"
                                id="file"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">

                            @error('file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                        </div>
                        <div class="rounded-lg bg-blue-50 border border-blue-200 p-4">

                            <h3 class="font-semibold text-blue-700">
                                Upload Guidelines
                            </h3>

                            <ul class="mt-2 text-sm text-blue-600 space-y-1">
                                <li>• Images: JPG, PNG, WEBP</li>
                                <li>• Videos: MP4, MOV, WEBM</li>
                                <li>• Maximum upload size: 50 MB</li>
                            </ul>

                        </div>
                        <div class="space-y-3">

                            <label class="flex items-center gap-3">

                                <input
                                    type="checkbox"
                                    name="is_featured"
                                    value="1"
                                    @checked(old('is_featured', $gallery->is_featured))
                                class="rounded border-gray-300">

                                <span>Featured Media</span>

                            </label>

                            <label class="flex items-center gap-3">

                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    @checked(old('is_active', $gallery->is_active))
                                class="rounded border-gray-300">

                                <span>Visible to Members</span>

                            </label>

                        </div>
                        <div class="flex justify-end gap-3 pt-6 border-t">

                            <a
                                href="{{ route('admin.galleries.index') }}"
                                class="px-5 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">

                                Cancel

                            </a>

                            <button
                                type="submit"
                                class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">

                                Update Media

                            </button>

                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>