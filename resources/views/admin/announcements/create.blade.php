<x-app-layout>

    <div class="py-10">

        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-4 md:p-8">

                <h1 class="text-2xl md:text-3xl font-bold mb-6">
                    Create Announcement
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
                    action="{{ route('admin.announcements.store') }}">

                    @csrf

                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="w-full border rounded-lg px-4 py-3"
                            required>

                    </div>

                    <div class="mb-6">

                        <label class="block text-sm font-medium mb-2">
                            Content
                        </label>

                        <textarea
                            name="content"
                            rows="6"
                            class="w-full border rounded-lg px-4 py-3"
                            required>{{ old('content') }}</textarea>

                    </div>

                    <div class="mb-6">

                        <label class="flex items-center gap-3">

                            <input
                                type="checkbox"
                                name="send_notification"
                                value="1"
                                @checked(old('send_notification'))>

                            Notify members immediately

                        </label>

                        <p class="text-sm text-gray-500 ml-7 mt-1">
                            Automatically create a notification when this announcement is published.
                        </p>

                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">

                        <button
                            type="submit"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                            Publish Announcement

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