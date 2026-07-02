<x-app-layout>

    <div class="py-10">

        <div class="max-w-5xl mx-auto px-6">

            <div class="bg-white rounded-xl shadow p-8">

                <div class="flex justify-between items-center mb-8">

                    <h1 class="text-3xl font-bold">
                        Notification Details
                    </h1>

                    <a
                        href="{{ route('admin.notifications.index') }}"
                        class="text-blue-600 hover:underline">

                        ← Back

                    </a>

                </div>

                <div class="space-y-6">

                    <div>

                        <h2 class="text-sm text-gray-500">
                            Title
                        </h2>

                        <p class="text-xl font-semibold">

                            {{ $notification->title }}

                        </p>

                    </div>

                    <div>

                        <h2 class="text-sm text-gray-500">
                            Message
                        </h2>

                        <p class="whitespace-pre-line">

                            {{ $notification->message }}

                        </p>

                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">

                        <div>

                            <span class="text-gray-500">
                                Category
                            </span>

                            <p>

                                {{ ucfirst($notification->category) }}

                            </p>

                        </div>

                        <div>

                            <span class="text-gray-500">
                                Audience
                            </span>

                            <p>

                                {{ ucfirst($notification->audience) }}

                            </p>

                        </div>

                        <div>

                            <span class="text-gray-500">
                                Priority
                            </span>

                            <p>

                                {{ ucfirst($notification->priority) }}

                            </p>

                        </div>

                        <div>

                            <span class="text-gray-500">
                                Status
                            </span>

                            <p>

                                {{ $notification->is_active ? 'Active' : 'Inactive' }}

                            </p>

                        </div>

                        <div>

                            <span class="text-gray-500">
                                Published
                            </span>

                            <p>

                                {{ optional($notification->published_at)->format('M d, Y H:i') ?? 'Draft' }}

                            </p>

                        </div>

                        <div>

                            <span class="text-gray-500">
                                Expires
                            </span>

                            <p>

                                {{ optional($notification->expires_at)->format('M d, Y H:i') ?? 'Never' }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>