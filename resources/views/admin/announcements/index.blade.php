<x-app-layout>

    <div class="py-10">

        <div class="max-w-6xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-6">

                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">

                    <div>
                        <h1 class="text-3xl font-bold">
                            Announcement Management
                        </h1>

                        <p class="text-gray-500 mt-2">
                            Create and manage church announcements.
                        </p>
                    </div>

                    <a href="{{ route('admin.announcements.create') }}"
                        class="w-full md:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Create Announcement

                    </a>

                </div>

                <div class="grid grid-cols-1 gap-6 mb-6">

                    <div class="bg-white rounded-2xl shadow p-6">

                        <p class="text-sm font-medium text-gray-500">
                            Total Announcements
                        </p>

                        <p class="mt-2 text-3xl font-bold text-blue-600">
                            {{ $totalAnnouncements }}
                        </p>

                    </div>

                </div>

                <form method="GET" action="{{ route('admin.announcements.index') }}"
                    class="flex flex-col md:flex-row gap-3 mb-6">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search announcements..."
                        class="flex-1 rounded-lg border-gray-300">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                        Search

                    </button>

                    <a
                        href="{{ route('admin.announcements.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 px-5 py-2 rounded-lg text-center">

                        Reset

                    </a>

                </form>

                <div class="space-y-4">

                    @forelse($announcements as $announcement)

                    <div class="border rounded-xl p-5">

                        <h2 class="text-xl font-semibold mb-2">
                            {{ $announcement->title }}
                        </h2>

                        <p class="text-gray-600 mb-3 break-words">
                            {{ $announcement->content }}
                        </p>

                        <div class="flex items-center justify-between mb-4">

                            <div class="text-sm text-gray-400">

                                Posted {{ $announcement->created_at->diffForHumans() }}

                            </div>

                            @if ($announcement->published_at)

                            <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-700">

                                Published

                            </span>

                            @else

                            <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-sm font-medium text-yellow-700">

                                Draft

                            </span>

                            @endif

                        </div>

                        <div class="flex flex-col sm:flex-row gap-2">

                            <a href="{{ route('admin.announcements.edit', $announcement) }}"
                                class="w-full sm:w-auto text-center bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm">

                                Edit

                            </a>

                            <form method="POST"
                                action="{{ route('admin.announcements.destroy', $announcement) }}">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    onclick="return confirm('Delete announcement?')"
                                    class="w-full sm:w-auto bg-red-600 text-white px-4 py-2 rounded-lg text-sm">

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

                    @if ($announcements->hasPages())

                    <div class="mt-8">

                        {{ $announcements->links() }}

                    </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>