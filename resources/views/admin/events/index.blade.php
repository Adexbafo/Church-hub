<x-app-layout>

    <div class="py-10">

        <div class="max-w-6xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-6">

                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">

                    <div>

                        <h1 class="text-3xl font-bold">
                            Event Management
                        </h1>

                        <p class="text-gray-500 mt-2">
                            Create and manage church events.
                        </p>

                    </div>

                    <a href="{{ route('admin.events.create') }}"
                        class="w-full md:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                        Create Event

                    </a>

                </div>

                @if(session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
                @endif

                <div class="grid grid-cols-1 gap-6 mb-6">

                    <div class="bg-white rounded-2xl shadow p-6">

                        <p class="text-sm font-medium text-gray-500">
                            Total Events
                        </p>

                        <p class="mt-2 text-3xl font-bold text-blue-600">
                            {{ $totalEvents }}
                        </p>

                    </div>

                </div>

                @forelse($events as $event)

                <div class="border rounded-xl p-5 mb-4">

                    <div class="border rounded-xl p-5 mb-4">

                        <h2 class="text-xl font-semibold mb-4">
                            {{ $event->title }}
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

                            <div>
                                <span class="font-medium">📅 Date:</span>
                                {{ $event->event_date->format('M d, Y') }}
                            </div>

                            <div>
                                <span class="font-medium">🕒 Time:</span>
                                {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
                                @if($event->end_time)
                                - {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}
                                @endif
                            </div>

                            <div>
                                <span class="font-medium">📍 Venue:</span>
                                {{ $event->venue }}
                            </div>

                            <div>
                                <span class="font-medium">Category:</span>
                                <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                                    {{ ucfirst($event->category) }}
                                </span>
                            </div>

                            <div>
                                <span class="font-medium">Status:</span>

                                @if($event->is_active)
                                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                                    Active
                                </span>
                                @else
                                <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                                    Inactive
                                </span>
                                @endif
                            </div>

                            <div>
                                <span class="font-medium">Featured:</span>

                                @if($event->is_featured)
                                <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700">
                                    ⭐ Featured
                                </span>
                                @else
                                <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                                    Not Featured
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="mt-6 flex justify-end gap-3 border-t pt-4">

                        <a href="{{ route('admin.events.edit', $event) }}"
                            class="rounded-lg bg-yellow-500 px-6 py-3 text-sm font-medium text-white hover:bg-yellow-600">
                            Edit
                        </a>

                        <form
                            action="{{ route('admin.events.destroy', $event) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Delete this event?')"
                                class="rounded-lg bg-red-600 px-6 py-3 text-sm font-medium text-white hover:bg-red-700">
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

                @empty

                <div class="text-center py-12">

                    <div class="text-6xl mb-4">
                        📅
                    </div>

                    <h2 class="text-2xl font-bold mb-2">
                        No events yet
                    </h2>

                    <p class="text-gray-500 mb-6">
                        Create your first church event.
                    </p>

                    <a href="{{ route('admin.events.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg">

                        Create Event

                    </a>

                </div>

                @endforelse

                @if($events->hasPages())

                <div class="mt-8">

                    {{ $events->links() }}

                </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>