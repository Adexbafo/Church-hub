<x-app-layout>

    <div class="py-10">

        <div class="max-w-7xl mx-auto px-6 space-y-8">

            <div>

                <h1 class="text-3xl font-bold">

                    Notification Management

                </h1>

                <p class="text-gray-500 mt-2">

                    Create and manage church notifications.

                </p>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500">
                        Total Notifications
                    </div>

                    <div class="text-4xl font-bold text-blue-600 mt-3">

                        {{ $totalNotifications }}

                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500">
                        Active
                    </div>

                    <div class="text-4xl font-bold text-green-600 mt-3">

                        {{ $activeNotifications }}

                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500">
                        Pinned
                    </div>

                    <div class="text-4xl font-bold text-yellow-500 mt-3">

                        {{ $pinnedNotifications }}

                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500">
                        Unread
                    </div>

                    <div class="text-4xl font-bold text-red-600 mt-3">

                        {{ $unreadNotifications }}

                    </div>

                </div>

            </div>

            <div class="mt-8 bg-white rounded-xl shadow-sm p-6">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

                    <div class="flex flex-wrap items-center gap-3">

                        <form method="GET" class="flex flex-wrap items-center gap-3">

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search notifications..."
                                class="rounded-lg border-gray-300">

                            <select
                                name="category"
                                class="rounded-lg border-gray-300">
                                <option value="">All Categories</option>
                                <option value="general">General</option>
                                <option value="announcement">Announcement</option>
                                <option value="event">Event</option>
                                <option value="prayer">Prayer</option>
                                <option value="birthday">Birthday</option>
                            </select>

                            <button
                                class="bg-blue-600 text-white px-5 rounded-lg">
                                Filter
                            </button>

                        </form>
                    </div>
                    <a
                        href="{{ route('admin.notifications.create') }}"
                        class="inline-flex items-center justify-center bg-green-600 text-white px-5 py-2 rounded-lg whitespace-nowrap">
                        + New Notification
                    </a>
                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-[900px] w-full text-sm">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="p-3 text-left">Title</th>

                                <th class="p-3 text-left">Category</th>

                                <th class="p-3 text-left">Audience</th>

                                <th class="p-3 text-left">Priority</th>

                                <th class="p-3 text-left">Status</th>

                                <th class="p-3 text-left">Published</th>

                                <th class="p-3 text-right">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($notifications as $notification)

                            <tr class="border-b">

                                <td class="p-3">

                                    {{ $notification->title }}

                                </td>

                                <td class="p-3">

                                    {{ ucfirst($notification->category) }}

                                </td>

                                <td class="p-3">

                                    {{ ucfirst($notification->audience) }}

                                </td>

                                <td class="p-3">

                                    {{ ucfirst($notification->priority) }}

                                </td>

                                <td class="p-3">

                                    @if($notification->is_active)

                                    <span class="text-green-600 font-semibold">
                                        Active
                                    </span>

                                    @else

                                    <span class="text-red-600 font-semibold">
                                        Inactive
                                    </span>

                                    @endif

                                </td>

                                <td class="p-3">

                                    {{ optional($notification->published_at)->format('M d, Y') ?? 'Draft' }}

                                </td>

                                <td class="p-3 text-right space-x-2">

                                    <a
                                        href="{{ route('admin.notifications.show', $notification) }}"
                                        class="text-blue-600 hover:underline">
                                        View
                                    </a>

                                    <a
                                        href="{{ route('admin.notifications.edit', $notification) }}"
                                        class="text-green-600 hover:underline">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.notifications.destroy', $notification) }}"
                                        method="POST"
                                        class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            onclick="return confirm('Delete this notification?')"
                                            class="text-red-600 hover:underline">

                                            Delete

                                        </button>

                                    </form>

                                </td>
                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="7" class="text-center py-8 text-gray-500">

                                    No notifications have been created yet.

                                    Click "New Notification" to publish your first church announcement.

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>
                <div class="mt-6">

                    {{ $notifications->links() }}

                </div>


            </div>

        </div>


    </div>

</x-app-layout>