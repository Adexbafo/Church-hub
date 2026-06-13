<x-app-layout>

    <div class="py-10">

        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-4 md:p-8">

                <h1 class="text-2xl md:text-3xl font-bold mb-6">
                    Edit Announcement
                </h1>

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
                               value="{{ $announcement->title }}"
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
                                  required>{{ $announcement->content }}</textarea>

                    </div>

                    <button type="submit"
                        class="w-full md:w-auto bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg">

                        Update Announcement

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>