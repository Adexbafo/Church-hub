<x-app-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">

            <div class="bg-white rounded-2xl shadow p-8">

                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">

                    <h1 class="text-3xl font-bold">
                        Church Members
                    </h1>

                    <form method="GET">

                        <input type="text"
                            name="search"
                            placeholder="Search members..."
                            value="{{ request('search') }}"
                            class="w-full md:w-72 rounded-lg border-gray-300">


                    </form>

                </div>

                @if(session('success'))
                <div class="mb-4 bg-green-500 text-white px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
                @endif

                <div class="md:hidden space-y-4">

                    @foreach($members as $member)

                    <div class="bg-white border rounded-xl p-4 shadow-sm">

                        <div class="flex items-center gap-4 mb-4">

                            @if ($member->profile_picture)

                            <img src="{{ asset('storage/' . $member->profile_picture) }}"
                                class="w-14 h-14 rounded-full object-cover">

                            @else

                            <div class="w-14 h-14 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">
                                {{ strtoupper(substr($member->full_name, 0, 1)) }}
                            </div>

                            @endif

                            <div>

                                <h3 class="font-semibold text-lg">
                                    {{ $member->full_name }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    {{ $member->membership_status }}
                                </p>

                            </div>

                        </div>

                        <div class="space-y-2 text-sm">

                            <p>
                                <strong>Gender:</strong>
                                {{ $member->gender ?? '—' }}
                            </p>

                            <p>
                                <strong>Phone:</strong>
                                {{ $member->phone ?? '—' }}
                            </p>

                            <p>
                                <strong>Baptized:</strong>
                                {{ $member->is_baptized ? 'Yes' : 'No' }}
                            </p>

                        </div>

                        <div class="flex flex-wrap gap-2 mt-4">

                            <a href="{{ route('admin.members.show', $member) }}"
                                class="bg-blue-600 text-white px-3 py-2 rounded text-sm">
                                View
                            </a>

                            <a href="{{ route('admin.members.edit', $member) }}"
                                class="bg-yellow-500 text-white px-3 py-2 rounded text-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.members.destroy', $member) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="bg-red-600 text-white px-3 py-2 rounded text-sm">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                    @endforeach

                </div>

                <div class="hidden md:block overflow-x-auto rounded-xl border">

                    <table class="min-w-[700px] w-full">

                        <thead class="sticky top-0 bg-white z-10">

                            <tr class="bg-gray-100 border-b">

                                <th class="p-4 text-left">Photo</th>

                                <th class="hidden lg:table-cell p-4 text-left">
                                    Membership ID
                                </th>

                                <th class="p-4 text-left">Name</th>

                                <th class="hidden lg:table-cell p-4 text-left">
                                    Band
                                </th>

                                <th class="hidden lg:table-cell p-4 text-left">Gender</th>
                                <th class="hidden lg:table-cell p-4 text-left">Phone</th>
                                <th class="hidden lg:table-cell p-4 text-left">Occupation</th>

                                <th class="hidden lg:table-cell p-4 text-left">
                                    Address
                                </th>

                                <th class="p-4 text-left">Baptized</th>

                                <th class="hidden md:table-cell p-4 text-left">
                                    Joined
                                </th>

                                <th class="p-4 text-left">Status</th>
                                <th class="p-4 text-left">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($members as $member)

                            <tr class="border-b">

                                <td class="p-4">

                                    @if ($member->profile_picture)

                                    <img src="{{ asset('storage/' . $member->profile_picture) }}"
                                        class="w-12 h-12 rounded-full object-cover">

                                    @else

                                    <div class="w-12 h-12 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                        {{ strtoupper(substr($member->full_name, 0, 1)) }}
                                    </div>

                                    @endif

                                </td>

                                <td class="hidden lg:table-cell p-4 font-mono text-sm whitespace-nowrap">
                                    {{ $member->membership_id ?? '—' }}
                                </td>

                                <td class="p-4">
                                    {{ $member->full_name }}
                                </td>

                                <td class="hidden lg:table-cell p-4">

                                    @if($member->band_name)

                                    <span class="inline-block whitespace-nowrap px-3 py-1 rounded-full text-sm bg-indigo-100 text-indigo-700">
                                        {{ $member->band_name }}
                                    </span>

                                    @else

                                    —

                                    @endif

                                </td>

                                <td class="hidden lg:table-cell p-4">
                                    {{ $member->gender ?? '—' }}
                                </td>

                                <td class="hidden lg:table-cell p-4">
                                    {{ $member->phone ?? '—' }}
                                </td>

                                <td class="hidden lg:table-cell p-4">
                                    {{ $member->occupation ?? '—' }}
                                </td>

                                <td class="hidden lg:table-cell p-4">
                                    {{ $member->address ?? '—' }}
                                </td>

                                <td class="p-4">

                                    @if($member->is_baptized)

                                    <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
                                        Yes
                                    </span>

                                    @else

                                    <span class="px-3 py-1 rounded-full text-sm bg-red-100 text-red-700">
                                        No
                                    </span>

                                    @endif

                                </td>

                                <td class="hidden md:table-cell p-4">
                                    {{ $member->joined_at?->format('M d, Y') ?? '—' }}
                                </td>

                                <td class="p-4">

                                    @if($member->membership_status === 'active')

                                    <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
                                        Active
                                    </span>

                                    @else

                                    <span class="px-3 py-1 rounded-full text-sm bg-red-100 text-red-700">
                                        Inactive
                                    </span>

                                    @endif

                                </td>

                                <td class="p-4">
                                    <div class="flex flex-col gap-2">

                                        <a href="{{ route('admin.members.show', $member) }}"
                                            class="bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                            View
                                        </a>

                                        <a href="{{ route('admin.members.edit', $member) }}"
                                            class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.members.destroy', $member) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">
                                                Delete
                                            </button>

                                        </form>
                                    </div>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-6">
                    {{ $members->links() }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>