<x-app-layout>

    <div class="py-10">

        <div class="max-w-5xl mx-auto px-6">

            <div class="mb-8">

                <h1 class="text-3xl font-bold">
                    Create Notification
                </h1>

                <p class="text-gray-500 mt-2">
                    Publish announcements and notifications to church members.
                </p>

            </div>

            <div class="bg-white rounded-2xl shadow p-8">

                <form
                    action="{{ route('admin.notifications.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <!-- Title -->

                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Notification Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="w-full rounded-lg border-gray-300"
                            required>

                    </div>

                    <!-- Message -->

                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Message
                        </label>

                        <textarea
                            name="message"
                            rows="6"
                            class="w-full rounded-lg border-gray-300"
                            required>{{ old('message') }}</textarea>

                    </div>

                    <!-- Category / Audience -->

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                        <div>

                            <label class="block font-medium mb-2">
                                Category
                            </label>

                            <select
                                name="category"
                                class="w-full rounded-lg border-gray-300">

                                <option value="general">General</option>
                                <option value="announcement">Announcement</option>
                                <option value="event">Event</option>
                                <option value="prayer">Prayer</option>
                                <option value="birthday">Birthday</option>

                            </select>

                        </div>

                        <div>

                            <label class="block font-medium mb-2">
                                Audience
                            </label>

                            <select
                                name="audience"
                                class="w-full rounded-lg border-gray-300">

                                <option value="all">All Members</option>
                                <option value="member">Members</option>
                                <option value="admin">Administrators</option>

                            </select>

                        </div>

                    </div>

                    <!-- Priority / Expiry -->

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                        <div>

                            <label class="block font-medium mb-2">
                                Priority
                            </label>

                            <select
                                name="priority"
                                class="w-full rounded-lg border-gray-300">

                                <option value="low">Low</option>
                                <option value="normal" selected>Normal</option>
                                <option value="high">High</option>
                                <option value="urgent">Urgent</option>

                            </select>

                        </div>

                        <div>

                            <label class="block font-medium mb-2">
                                Expiry Date
                            </label>

                            <input
                                type="datetime-local"
                                name="expires_at"
                                class="w-full rounded-lg border-gray-300">

                        </div>

                    </div>

                    <!-- Link -->

                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Link (Optional)
                        </label>

                        <input
                            type="url"
                            name="link"
                            class="w-full rounded-lg border-gray-300">

                    </div>

                    <!-- Attachment -->

                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Attachment
                        </label>

                        <input
                            type="file"
                            name="attachment"
                            class="w-full rounded-lg border-gray-300">

                    </div>

                    <!-- Options -->

                    <div class="space-y-4 mb-8">

                        <label class="flex items-center gap-3">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                checked>

                            Publish immediately

                        </label>

                        <label class="flex items-center gap-3">

                            <input
                                type="checkbox"
                                name="is_pinned"
                                value="1">

                            Pin this notification

                        </label>

                    </div>

                    <!-- Buttons -->

                    <div class="flex justify-end gap-4">

                        <a
                            href="{{ route('admin.notifications.index') }}"
                            class="px-6 py-2 rounded-lg border">

                            Cancel

                        </a>

                        <button
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">

                            Publish Notification

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>