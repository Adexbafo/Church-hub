@php
$bands = config('church.bands');
@endphp
<x-app-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">

            <div class="bg-white rounded-2xl shadow p-8">

                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">

                    <h1 class="text-3xl font-bold">
                        Church Members
                    </h1>

                    <form method="GET"
                        class="flex flex-wrap gap-3 items-center">

                        <input
                            type="text"
                            name="search"
                            placeholder="Search name, ID, band..."
                            value="{{ request('search') }}"
                            class="rounded-lg border-gray-300 w-full md:w-64">

                        <select
                            name="status"
                            class="rounded-lg border-gray-300">

                            <option value="">All Status</option>

                            <option value="active"
                                @selected(request('status')=='active' )>
                                Active
                            </option>

                            <option value="inactive"
                                @selected(request('status')=='inactive' )>
                                Inactive
                            </option>

                        </select>

                        <select
                            name="gender"
                            class="rounded-lg border-gray-300">

                            <option value="">All Gender</option>

                            <option value="male"
                                @selected(request('gender')=='male' )>
                                Male
                            </option>

                            <option value="female"
                                @selected(request('gender')=='female' )>
                                Female
                            </option>

                        </select>

                        <select
                            name="baptized"
                            class="rounded-lg border-gray-300">

                            <option value="">Baptized?</option>

                            <option value="1"
                                @selected(request('baptized')=='1' )>
                                Yes
                            </option>

                            <option value="0"
                                @selected(request('baptized')=='0' )>
                                No
                            </option>

                        </select>

                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                            Filter

                        </button>

                        <a href="{{ route('admin.members.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 px-5 py-2 rounded-lg">

                            Reset

                        </a>

                    </form>

                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 my-6">

                        <div class="bg-blue-50 rounded-xl p-5">
                            <div class="text-sm text-gray-500">
                                Total Members
                            </div>

                            <div class="text-3xl font-bold text-blue-700">
                                {{ $totalMembers }}
                            </div>
                        </div>

                        <div class="bg-green-50 rounded-xl p-5">
                            <div class="text-sm text-gray-500">
                                Active Members
                            </div>

                            <div class="text-3xl font-bold text-green-700">
                                {{ $activeMembers }}
                            </div>
                        </div>

                        <div class="bg-red-50 rounded-xl p-5">
                            <div class="text-sm text-gray-500">
                                Inactive Members
                            </div>

                            <div class="text-3xl font-bold text-red-700">
                                {{ $inactiveMembers }}
                            </div>
                        </div>

                        <div class="bg-purple-50 rounded-xl p-5">
                            <div class="text-sm text-gray-500">
                                Male Members
                            </div>

                            <div class="text-3xl font-bold text-purple-700">
                                {{ $maleMembers }}
                            </div>
                        </div>

                        <div class="bg-pink-50 rounded-xl p-5">
                            <div class="text-sm text-gray-500">
                                Female Members
                            </div>

                            <div class="text-3xl font-bold text-pink-700">
                                {{ $femaleMembers }}
                            </div>
                        </div>

                        <div class="bg-amber-50 rounded-xl p-5">
                            <div class="text-sm text-gray-500">
                                Baptized Members
                            </div>

                            <div class="text-3xl font-bold text-amber-700">
                                {{ $baptizedMembers }}
                            </div>
                        </div>

                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                    <div class="bg-white border rounded-xl p-5">
                        <div class="text-sm text-gray-500">
                            Newest Member
                        </div>

                        <div class="font-semibold text-lg mt-2">
                            {{ $newestMember?->full_name ?? '—' }}
                        </div>
                    </div>

                    <div class="bg-white border rounded-xl p-5">
                        <div class="text-sm text-gray-500">
                            Latest Membership ID
                        </div>

                        <div class="font-mono font-semibold text-blue-700 mt-2">
                            {{ $latestMemberId ?? '—' }}
                        </div>
                    </div>

                    <div class="bg-white border rounded-xl p-5">
                        <div class="text-sm text-gray-500">
                            Members Displayed
                        </div>

                        <div class="text-3xl font-bold text-indigo-700 mt-2">
                            {{ $displayedMembers }}
                        </div>
                    </div>

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

                <form method="POST" action="{{ route('admin.members.bulk') }}">
                    @csrf

                    <div class="hidden md:block overflow-x-auto rounded-xl border">

                        <div class="flex flex-wrap gap-3 mb-4">

                            <button
                                type="submit"
                                name="action"
                                value="activate"
                                class="bg-green-600 text-white px-4 py-2 rounded-lg">

                                Activate Selected

                            </button>

                            <button
                                type="submit"
                                name="action"
                                value="deactivate"
                                class="bg-yellow-500 text-white px-4 py-2 rounded-lg">

                                Deactivate Selected

                            </button>

                            <button
                                type="submit"
                                name="action"
                                value="delete"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg">

                                Delete Selected

                            </button>

                        </div>

                        <table class="min-w-[700px] w-full">

                            <thead class="sticky top-0 bg-white z-10">

                                <tr class="bg-gray-100 border-b">

                                    <th class="p-4 text-center">
                                        <input
                                            type="checkbox"
                                            id="select-all"
                                            class="rounded border-gray-300">
                                    </th>

                                    <th class="p-4 text-left">
                                        Photo
                                    </th>

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

                                    <td class="p-4 text-center">

                                        <input
                                            type="checkbox"
                                            name="members[]"
                                            class="member-checkbox rounded border-gray-300"
                                            value="{{ $member->id }}">

                                    </td>

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

                                        @php
                                        $bands = array_filter([
                                        $member->band_one,
                                        $member->band_two,
                                        $member->band_three,
                                        ]);
                                        @endphp

                                        @if(count($bands))

                                        <div class="flex flex-wrap gap-2">

                                            @foreach($bands as $band)

                                            <span class="px-3 py-1 rounded-full text-sm bg-indigo-100 text-indigo-700">
                                                {{ $band }}
                                            </span>

                                            @endforeach

                                        </div>

                                        @else

                                        <span class="text-gray-400">—</span>

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

                </form>
            </div>

        </div>
    </div>
    <script>
        document.getElementById('select-all')
            ?.addEventListener('change', function() {

                document
                    .querySelectorAll('.member-checkbox')
                    .forEach(box => {

                        box.checked = this.checked;

                    });

            });
    </script>

</x-app-layout>