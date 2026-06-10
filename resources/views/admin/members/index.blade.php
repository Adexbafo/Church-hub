<x-app-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">

            <div class="bg-white rounded-2xl shadow p-8">

                <div class="flex justify-between items-center mb-6">

                    <h1 class="text-3xl font-bold">
                        Church Members
                    </h1>

                    <form method="GET">

                        <input type="text"
                               name="search"
                               placeholder="Search members..."
                               value="{{ request('search') }}"
                               class="rounded-lg border-gray-300">

                    </form>

                </div>

                @if(session('success'))
                    <div class="mb-4 bg-green-500 text-white px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="bg-gray-100 border-b">

                                <th class="p-4 text-left">Photo</th>
                                <th class="p-4 text-left">Name</th>
                                <th class="p-4 text-left">Gender</th>
                                <th class="p-4 text-left">Phone</th>
                                <th class="p-4 text-left">Occupation</th>
                                <th class="p-4 text-left">Address</th>
                                <th class="p-4 text-left">Baptized</th>
                                <th class="p-4 text-left">Joined</th>
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

    <td class="p-4">
        {{ $member->full_name }}
    </td>

    <td class="p-4">
        {{ $member->gender ?? '—' }}
    </td>

    <td class="p-4">
        {{ $member->phone ?? '—' }}
    </td>

    <td class="p-4">
        {{ $member->occupation ?? '—' }}
    </td>

    <td class="p-4">
        {{ $member->address ?? '—' }}
    </td>

    <td class="p-4">
        {{ $member->is_baptized ? 'Yes' : 'No' }}
    </td>

    <td class="p-4">
        {{ $member->joined_at?->format('M d, Y') ?? '—' }}
    </td>

    <td class="p-4">

        <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
            {{ $member->membership_status }}
        </span>

    </td>

    <td class="p-4 flex gap-2">

        <a href="{{ route('admin.members.show', $member) }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            View
        </a>

        <a href="{{ route('admin.members.edit', $member) }}"
           class="bg-yellow-500 text-white px-4 py-2 rounded">
            Edit
        </a>

        <form action="{{ route('admin.members.destroy', $member) }}"
              method="POST">

            @csrf
            @method('DELETE')

            <button class="bg-red-600 text-white px-4 py-2 rounded">
                Delete
            </button>

        </form>

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