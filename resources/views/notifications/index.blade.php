<x-app-layout>

    <div class="max-w-6xl mx-auto py-10 px-6">

        <h1 class="text-3xl font-bold mb-2">
            Church Notifications
        </h1>

        <p class="text-gray-500 mb-8">
            Stay informed about church activities.
        </p>

        @forelse($notifications as $notification)

        <div class="bg-white rounded-xl shadow p-6 mb-5">

            <div class="flex justify-between">

                <h2 class="font-bold text-xl">
                    {{ $notification->title }}
                </h2>

                <span class="text-sm text-gray-500">
                    {{ optional($notification->published_at)->format('M d, Y') }}
                </span>

            </div>

            <p class="text-gray-600 mt-3">

                {{ Str::limit($notification->message, 180) }}

            </p>

            <a
                href="{{ route('notifications.show', $notification) }}"
                class="text-blue-600 font-semibold mt-4 inline-block">

                Read More →

            </a>

        </div>

        @empty

        <div class="bg-white rounded-xl shadow p-8 text-center">

            No notifications available.

        </div>

        @endforelse

        <div class="mt-6">

            {{ $notifications->links() }}

        </div>

    </div>

</x-app-layout>