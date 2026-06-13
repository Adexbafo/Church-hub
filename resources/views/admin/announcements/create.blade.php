<x-app-layout>

    <div class="py-10">

        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-4 md:p-8">

                <h1 class="text-2xl md:text-3xl font-bold mb-6">
                    Create Announcement
                </h1>

                <form method="POST"
                      action="{{ route('admin.announcements.store') }}">

                    @csrf

                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Title
                        </label>

                        <input type="text"
                               name="title"
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
                                  required></textarea>

                    </div>

                    <button type="submit"
                            class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                        Publish Announcement

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>