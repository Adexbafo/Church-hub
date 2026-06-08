<x-app-layout>

    <div class="py-10">

        <div class="max-w-7xl mx-auto px-6">

            <div class="bg-gradient-to-r from-blue-700 to-indigo-700 rounded-2xl shadow-lg p-10 text-white mb-8">

                <h1 class="text-4xl font-bold mb-3">
                    Welcome to ChurchHub
                </h1>

                <p class="text-blue-100 text-lg">
                    Church member management and communication platform.
                </p>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <a href="{{ route('member.profile') }}"
                   class="bg-white hover:shadow-xl transition rounded-2xl p-8">

                    <h2 class="text-2xl font-bold text-gray-800 mb-3">
                        My Profile
                    </h2>

                    <p class="text-gray-600">
                        Manage your church member information and profile picture.
                    </p>

                </a>

                @if(auth()->user()->role === 'admin')

                    <a href="{{ route('admin.dashboard') }}"
                       class="bg-white hover:shadow-xl transition rounded-2xl p-8">

                        <h2 class="text-2xl font-bold text-gray-800 mb-3">
                            Admin Dashboard
                        </h2>

                        <p class="text-gray-600">
                            Manage church members and administration.
                        </p>

                    </a>

                @endif

                <div class="bg-white rounded-2xl p-8">

                    <h2 class="text-2xl font-bold text-gray-800 mb-3">
                        Announcements
                    </h2>

                    <p class="text-gray-600">
                        Church updates and ministry information coming soon.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>