<x-app-layout>

    <div class="py-10">

        <div class="max-w-5xl mx-auto px-4">

            <a
                href="{{ route('member.events.index') }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-700 mb-6">

                ← Back to Events

            </a>

            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8">

                <h1 class="text-3xl font-bold text-gray-900">
                    {{ $event->title }}
                </h1>

                <p class="mt-4 text-gray-600 leading-relaxed">
                    {{ $event->description }}
                </p>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <p class="text-sm font-medium text-gray-500">
                            📅 Date
                        </p>

                        <p class="mt-1 text-lg">
                            {{ $event->event_date->format('F d, Y') }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm font-medium text-gray-500">
                            🕒 Time
                        </p>

                        <p class="mt-1 text-lg">

                            {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}

                            @if($event->end_time)

                            - {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}

                            @endif

                        </p>

                    </div>

                    <div>

                        <p class="text-sm font-medium text-gray-500">
                            📍 Venue
                        </p>

                        <p class="mt-1 text-lg">
                            {{ $event->venue }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm font-medium text-gray-500">
                            🏷 Category
                        </p>

                        <span class="mt-2 inline-flex rounded-full bg-blue-100 px-4 py-1 text-sm font-medium text-blue-700">

                            {{ ucfirst($event->category) }}

                        </span>

                    </div>

                </div>

                @if($event->is_featured)

                <div class="mt-8">

                    <span class="inline-flex rounded-full bg-yellow-100 px-4 py-2 text-sm font-medium text-yellow-700">

                        ⭐ Featured Event

                    </span>

                </div>

                @endif

                <div class="mt-10 border-t pt-6">

                    <a
                        href="{{ route('member.events.index') }}"
                        class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

                        Back to Events

                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>