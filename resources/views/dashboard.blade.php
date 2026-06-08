<x-app-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">

            <div class="bg-white rounded-xl shadow p-8">

                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    Welcome to Church Hub
                </h1>

                <p class="text-gray-600 mb-8">
                    Church member management system.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <a href="{{ route('member.profile') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white p-6 rounded-xl transition">

                        <h2 class="text-xl font-semibold mb-2">
                            My Profile
                        </h2>

                        <p>
                            Manage your church member profile.
                        </p>
                    </a>

                    <div class="bg-gray-100 p-6 rounded-xl">
                        <h2 class="text-xl font-semibold mb-2">
                            Announcements
                        </h2>

                        <p class="text-gray-600">
                            Coming soon.
                        </p>
                    </div>

                    <div class="bg-gray-100 p-6 rounded-xl">
                        <h2 class="text-xl font-semibold mb-2">
                            Departments
                        </h2>

                        <p class="text-gray-600">
                            Coming soon.
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>