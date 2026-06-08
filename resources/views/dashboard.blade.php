<x-app-layout>

    <div class="p-8">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded-2xl shadow p-6">

                <h3 class="text-gray-500 mb-2">
                    Total Members
                </h3>

                <div class="text-4xl font-bold text-blue-700">
                    {{ \App\Models\Member::count() }}
                </div>

            </div>

            <div class="bg-white rounded-2xl shadow p-6">

                <h3 class="text-gray-500 mb-2">
                    Active Members
                </h3>

                <div class="text-4xl font-bold text-green-600">
                    {{ \App\Models\Member::where('membership_status', 'active')->count() }}
                </div>

            </div>

            <div class="bg-white rounded-2xl shadow p-6">

                <h3 class="text-gray-500 mb-2">
                    Inactive Members
                </h3>

                <div class="text-4xl font-bold text-red-500">
                    {{ \App\Models\Member::where('membership_status', 'inactive')->count() }}
                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl shadow p-8">

            <h2 class="text-2xl font-bold mb-6">
                Quick Actions
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <a href="{{ route('member.profile') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl p-6 transition">

                    My Profile

                </a>

                @if(auth()->user()->role === 'admin')

                    <a href="{{ route('admin.members.index') }}"
                       class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl p-6 transition">

                        Manage Members

                    </a>

                @endif

                <div class="bg-gray-100 rounded-xl p-6">

                    Announcements Coming Soon

                </div>

            </div>

        </div>

    </div>

</x-app-layout>