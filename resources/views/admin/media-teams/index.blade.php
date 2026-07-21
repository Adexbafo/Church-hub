<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Media Team
            </h2>

            <a
                href="{{ route('admin.media-teams.create') }}"
                class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                + Add Team Member
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl">

            @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
            @endif

            <div class="overflow-hidden rounded-lg bg-white shadow">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left">User</th>
                            <th class="px-6 py-3 text-left">Role</th>
                            <th class="px-6 py-3 text-left">Joined</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Notes</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">

                        @forelse($mediaTeams as $mediaTeam)

                        <tr>

                            <td class="px-6 py-4">
                                {{ $mediaTeam->user->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $mediaTeam->role }}
                            </td>

                            <td class="px-6 py-4">
                                {{ optional($mediaTeam->joined_at)->format('M d, Y') ?? '—' }}
                            </td>

                            <td class="px-6 py-4">

                                @if($mediaTeam->is_active)

                                <span class="rounded bg-green-100 px-2 py-1 text-xs text-green-700">
                                    Active
                                </span>

                                @else

                                <span class="rounded bg-red-100 px-2 py-1 text-xs text-red-700">
                                    Inactive
                                </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">
                                {{ Str::limit($mediaTeam->notes, 40) ?: '—' }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.media-teams.edit', $mediaTeam) }}"
                                        class="text-blue-600 hover:underline">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.media-teams.destroy', $mediaTeam) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this media team member?');">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="text-red-600 hover:underline">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td
                                colspan="6"
                                class="px-6 py-8 text-center text-gray-500">

                                No media team members found.

                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-6">
                {{ $mediaTeams->links() }}
            </div>

        </div>
    </div>

</x-app-layout>