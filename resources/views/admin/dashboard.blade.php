<x-app-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">

            <div class="bg-white rounded-xl shadow p-8">

                <h1 class="text-3xl font-bold mb-8">
                    Admin Dashboard
                </h1>

                <div class="mb-6">
                    <a href="{{ route('admin.members.index') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                        Manage Members

                    </a>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-gray-500 text-sm">Total Members</div>
        <div class="text-3xl font-bold text-blue-600">
            {{ $totalMembers }}
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-gray-500 text-sm">Active Members</div>
        <div class="text-3xl font-bold text-green-600">
            {{ $activeMembers }}
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-gray-500 text-sm">Inactive Members</div>
        <div class="text-3xl font-bold text-red-600">
            {{ $inactiveMembers }}
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-gray-500 text-sm">Announcements</div>
        <div class="text-3xl font-bold text-purple-600">
            {{ $announcementCount }}
        </div>
    </div>

</div>

                <div class="overflow-x-auto">

                    <table class="w-full border-collapse">

                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-3 text-left">Name</th>
                                <th class="p-3 text-left">Phone</th>
                                <th class="p-3 text-left">Occupation</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($members as $member)

                                <tr class="border-b">

                                    <td class="p-3">
                                        {{ $member->full_name }}
                                    </td>

                                    <td class="p-3">
                                        {{ $member->phone }}
                                    </td>

                                    <td class="p-3">
                                        {{ $member->occupation }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>