<x-app-layout>

    <div class="py-10">

        <div class="max-w-6xl mx-auto px-4">

            <h1 class="text-3xl font-bold mb-2">
                Church Events
            </h1>

            <p class="text-gray-500 mb-8">
                Stay informed about upcoming and past church activities.
            </p>

            <div class="grid grid-cols-1 gap-6">

                @forelse($events as $event)

                <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">

                    <div class="flex items-start justify-between gap-4">

                        <h2 class="text-2xl font-bold text-gray-900">
                            {{ $event->title }}
                        </h2>

                        @if($event->event_date->isPast())

                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs">
                            Completed
                        </span>

                        @else

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                            Upcoming
                        </span>

                        @endif

                    </div>

                    <div class="prose max-w-none mt-4">
                        {!! nl2br(e($event->description)) !!}
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">

                        <div>
                            📅
                            <span class="font-medium">
                                {{ $event->event_date->format('F d, Y') }}
                            </span>
                        </div>

                        <div>
                            🕒
                            <span class="font-medium">
                                {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}

                                @if($event->end_time)
                                - {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}
                                @endif
                            </span>
                        </div>

                        <div>
                            📍
                            <span class="font-medium">
                                {{ $event->venue }}
                            </span>
                        </div>

                        <div>
                            🏷️
                            <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                                {{ ucfirst($event->category) }}
                            </span>
                        </div>

                    </div>

                    <div class="mt-6 flex justify-end">

                        <a
                            href="{{ route('member.events.show', $event) }}"
                            class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-medium text-white hover:bg-blue-700 transition">

                            View Event

                        </a>

                    </div>

                </div>

                @empty

                <div class="col-span-full">

                    <div class="rounded-2xl bg-white shadow p-10 text-center">

                        <div class="text-5xl mb-4">
                            📅
                        </div>

                        <h2 class="text-2xl font-bold">
                            No Events Available
                        </h2>

                        <p class="mt-2 text-gray-500">
                            Check back later for more church events
                        </p>

                    </div>

                </div>

                @endforelse

            </div>

            @if($events->hasPages())

            <div class="mt-8">

                {{ $events->links() }}

            </div>

            @endif

        </div>

    </div>

</x-app-layout>