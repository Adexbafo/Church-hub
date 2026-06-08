<x-app-layout>

    <div class="py-10">

        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-8">

                <h1 class="text-3xl font-bold mb-6">
                    Edit Announcement
                </h1>

                <form method="POST"
                      action="{{ route('admin.announcements.update', $announcement) }}">

                    @csrf
                    @method('PUT')

                    <div class="mb-5">

                        <label class="block mb-2 font-medium">
                            Title
                        </label>

                        <input type="text"
                               name="title"
                               value="{{ old('title', $announcement->title) }}"
                               class="w-full rounded-lg border-gray-300">

                    </div>

                    <div class="mb-6">

                        <label class="block mb-2 font-medium">
                            Content
                        </label>

                        <textarea name="content"
                                  rows="6"
                                  class="w-full rounded-lg border-gray-300">{{ old('content', $announcement->content) }}</textarea>

                    </div>

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                        Update Announcement

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>