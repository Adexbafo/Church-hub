<x-app-layout>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-6">

                <h1 class="text-3xl font-bold mb-6">
                    Create Announcement
                </h1>

                <form method="POST"
                      action="{{ route('admin.announcements.store') }}"
                      class="space-y-6">

                    @csrf

                    <div>

                        <label class="block mb-2 font-medium">
                            Title
                        </label>

                        <input type="text"
                               name="title"
                               class="w-full rounded-lg border-gray-300">

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Content
                        </label>

                        <textarea name="content"
                                  rows="6"
                                  class="w-full rounded-lg border-gray-300"></textarea>

                    </div>

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                        Publish Announcement

                    </button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>