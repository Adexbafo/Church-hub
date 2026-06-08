<x-app-layout>

    <div class="py-10">

        <div class="max-w-6xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-6">

                <div class="flex justify-between items-center mb-6">

                    <h1 class="text-3xl font-bold">
                        Announcements
                    </h1>

                    <a href="{{ route('admin.announcements.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                        Create Announcement

                    </a>

                </div>

                <div class="space-y-4">

                    @forelse($announcements as $announcement)

                        <div class="border rounded-2xl p-5 shadow-sm hover:shadow-md hover:-translate-y-1 transition bg-white">

                            <h2 class="text-xl font-semibold mb-2">
                                {{ $announcement->title }}
                            </h2>

                            <p class="text-gray-600 mb-3 leading-relaxed">
                                {{ $announcement->content }}
                            </p>

                            <div class="text-sm text-gray-400">

                                Posted
                                {{ $announcement->created_at->diffForHumans() }}

                            </div>

                            <div class="flex gap-2 mt-4">

    <a href="{{ route('admin.announcements.edit', $announcement) }}"
       class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm">
        Edit
    </a>

    <form method="POST"
          action="{{ route('admin.announcements.destroy', $announcement) }}">

        @csrf
        @method('DELETE')

        <button type="submit"
                onclick="return confirm('Delete announcement?')"
                class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm">

            Delete

        </button>

    </form>

</div>

                        </div>

                    @empty

                        <div class="text-gray-500">
                            No announcements yet.
                        </div>   

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</x-app-layout>