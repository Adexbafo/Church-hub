<x-app-layout>

    <div class="py-10">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white rounded-2xl shadow p-8">

                <div class="mb-6">

                <a href="{{ route('announcements.index') }}"
                    class="text-blue-600 hover:text-blue-700 font-medium">

                    ← Back to Announcements

                </a>

            </div>

                <h1 class="text-3xl font-bold mb-4">
                    {{ $announcement->title }}
                </h1>

                <div class="text-sm text-gray-500 mb-6">
                    Posted {{ $announcement->created_at->diffForHumans() }}
                </div>

                <div class="prose max-w-none">
                    {{ $announcement->content }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>