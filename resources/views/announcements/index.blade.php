@php
use Illuminate\Support\Str;
@endphp
<x-app-layout>

    <div class="py-10">
        <div class="max-w-5xl mx-auto px-6">

            <h1 class="text-3xl font-bold mb-8">
                Church Announcements
            </h1>

            <div class="space-y-6">

                @forelse ($announcements as $announcement)

                <div class="bg-white shadow rounded-xl p-6">

                    <h2 class="text-xl font-semibold mb-3">
                        {{ $announcement->title }}
                    </h2>

                    <p class="text-gray-700 whitespace-pre-line">
                        {{ Str::limit($announcement->content, 220) }}
                    </p>

                    <div class="mt-4 text-sm text-gray-500">
                        {{ $announcement->published_at->format('F d, Y') }}
                    </div>

                    <div class="mt-4">

                        <a
                            href="{{ route('announcements.show', $announcement) }}"
                            class="text-blue-600 hover:text-blue-700 font-medium">

                            Read More →

                        </a>

                    </div>

                </div>

                @empty

                <div class="bg-white shadow rounded-xl p-8 text-center">

                    <h2 class="text-lg font-semibold">
                        No announcements available
                    </h2>

                    <p class="mt-2 text-gray-500">
                        Please check back later for church updates and upcoming events.
                    </p>
                </div>
                @endforelse
            </div>

            @if ($announcements->hasPages())

            <div class="mt-8">

                {{ $announcements->links() }}

            </div>

            @endif
        </div>
    </div>

</x-app-layout>