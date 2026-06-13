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
                            {{ $announcement->content }}
                        </p>

                        <div class="mt-4 text-sm text-gray-500">
                            {{ $announcement->created_at->format('F d, Y') }}
                        </div>

                    </div>

                @empty

                    <div class="bg-white shadow rounded-xl p-6">
                        No announcements available.
                    </div>

                @endforelse

            </div>
            <div class="mt-4">

    <a href="{{ route('announcements.show', $announcement) }}"
       class="text-blue-600 hover:text-blue-700 font-medium">

        Read More →

    </a>

    </div>

        </div>
    </div>

</x-app-layout>