<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Livestreams') }}
            </h2>

            <a href="{{ route('admin.livestreams.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                + New Livestream
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Title
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Platform
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Scheduled
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Status
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Published
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Created By
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                Actions
                            </th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @forelse($livestreams as $livestream)

                        <tr>

                            <td class="px-6 py-4">
                                {{ $livestream->title }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $livestream->platform }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $livestream->scheduled_at->format('M d, Y g:i A') }}
                            </td>

                            <td class="px-6 py-4">

                                @php
                                $statusColors = [
                                'scheduled' => 'bg-yellow-100 text-yellow-800',
                                'live' => 'bg-green-100 text-green-800',
                                'ended' => 'bg-gray-100 text-gray-800',
                                ];
                                @endphp

                                <span class="px-2 py-1 rounded-full text-xs {{ $statusColors[$livestream->status] }}">
                                    {{ ucfirst($livestream->status) }}
                                </span>

                            </td>

                            <td class="px-6 py-4">
                                {{ $livestream->is_published ? 'Yes' : 'No' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $livestream->creator->name }}
                            </td>

                            <td class="px-6 py-4 text-right">

                                <a href="{{ route('admin.livestreams.edit', $livestream) }}"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    Edit
                                </a>

                                <form action="{{ route('admin.livestreams.destroy', $livestream) }}"
                                    method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Delete this livestream?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="ml-3 text-red-600 hover:text-red-900">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="px-6 py-6 text-center text-gray-500">
                                No livestreams found.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-6">
                {{ $livestreams->links() }}
            </div>

        </div>
    </div>
</x-app-layout>