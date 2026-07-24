<x-app-layout>

    <div class="py-10">

        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-4 md:p-8">

                <h1 class="text-2xl md:text-3xl font-bold mb-6">
                    Edit Announcement
                </h1>

                @if ($errors->any())

                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

                    <div class="font-semibold text-red-700">
                        Please correct the following errors:
                    </div>

                    <ul class="mt-2 list-disc list-inside text-sm text-red-600">

                        @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

                @endif

                <form method="POST"
                    action="{{ route('admin.announcements.update', $announcement) }}">

                    @csrf
                    @method('PUT')

                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Title
                        </label>

                        <input type="text"
                            name="title"
                            value="{{ old('title', $announcement->title) }}"
                            class="w-full border rounded-lg px-4 py-3"
                            required>

                    </div>

                    <div class="mb-6">

                        <label class="block text-sm font-medium mb-2">
                            Content
                        </label>

                        <textarea name="content"
                            rows="6"
                            class="w-full border rounded-lg px-4 py-3"
                            required>{{ old('content', $announcement->content) }}</textarea>

                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">

                        <button
                            type="submit"
                            class="w-full sm:w-auto bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg">

                            Update Announcement

                        </button>

                        <a
                            href="{{ route('admin.announcements.index') }}"
                            class="w-full sm:w-auto bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-lg text-center">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>