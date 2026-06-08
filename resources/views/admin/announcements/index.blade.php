<x-app-layout>

    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-6">

                <div class="flex justify-between items-center mb-6">

                    <h1 class="text-3xl font-bold">
                        Announcements
                    </h1>

                    <a href="{{ route('admin.announcements.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg">

                        Create Announcement

                    </a>

                </div>

                <div class="space-y-4">

                    <div class="border rounded-xl p-5">

                        <h2 class="text-xl font-semibold mb-2">
                            Sunday Service Update
                        </h2>

                        <p class="text-gray-600 mb-3">
                            There will be a special thanksgiving service this Sunday by 8AM.
                        </p>

                        <div class="text-sm text-gray-400">
                            Posted 2 hours ago
                        </div>

                    </div>

                    <div class="border rounded-xl p-5">

                        <h2 class="text-xl font-semibold mb-2">
                            Workers Meeting
                        </h2>

                        <p class="text-gray-600 mb-3">
                            All department leaders should attend the leadership meeting on Friday.
                        </p>

                        <div class="text-sm text-gray-400">
                            Posted yesterday
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>