<x-app-layout>

    <div class="py-10">

        <div class="max-w-5xl mx-auto px-6">

            <div class="mb-8">

                <h1 class="text-3xl font-bold">
                    Edit Notification
                </h1>

                <p class="text-gray-500 mt-2">
                    Update an existing church notification.
                </p>

            </div>

            <div class="bg-white rounded-2xl shadow p-8">

                <form method="POST"
                    action="{{ route('admin.notifications.update', $notification) }}"
                    enctype="multipart/form-data">
                    @if ($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                        <ul class="list-disc list-inside text-red-600">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @csrf
                    @method('PUT')
                    <!-- Title -->

                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Notification Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $notification->title) }}"
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
                            required>{{ old('message', $notification->message) }}</textarea>

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

                                <option value="general"
                                    @selected(old('category', $notification->category) == 'general')>
                                    General
                                </option>

                                <option value="announcement"
                                    @selected(old('category', $notification->category) == 'announcement')>
                                    Announcement
                                </option>

                                <option value="event"
                                    @selected(old('category', $notification->category) == 'event')>
                                    Event
                                </option>

                                <option value="prayer"
                                    @selected(old('category', $notification->category) == 'prayer')>
                                    Prayer
                                </option>

                                <option value="birthday"
                                    @selected(old('category', $notification->category) == 'birthday')>
                                    Birthday
                                </option>

                            </select>

                        </div>

                        <div>

                            <label class="block font-medium mb-2">
                                Audience
                            </label>

                            <select
                                name="audience"
                                class="w-full rounded-lg border-gray-300">

                                <option value="all"
                                    @selected(old('audience', $notification->audience) == 'all')>
                                    All Members
                                </option>

                                <option value="member"
                                    @selected(old('audience', $notification->audience) == 'member')>
                                    Members
                                </option>

                                <option value="admin"
                                    @selected(old('audience', $notification->audience) == 'admin')>
                                    Administrators
                                </option>

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

                                <option value="low"
                                    @selected(old('priority', $notification->priority) == 'low')>
                                    Low
                                </option>

                                <option value="normal"
                                    @selected(old('priority', $notification->priority) == 'normal')>
                                    Normal
                                </option>

                                <option value="high"
                                    @selected(old('priority', $notification->priority) == 'high')>
                                    High
                                </option>

                                <option value="urgent"
                                    @selected(old('priority', $notification->priority) == 'urgent')>
                                    Urgent
                                </option>

                            </select>

                        </div>

                        <div>

                            <label class="block font-medium mb-2">
                                Expiry Date
                            </label>

                            <input
                                type="datetime-local"
                                value="{{ old('expires_at', optional($notification->expires_at)->format('Y-m-d\TH:i')) }}"
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
                            value="{{ old('link', $notification->link) }}"
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
                                @checked(old('is_active', $notification->is_active))>

                            Publish immediately

                        </label>

                        <label class="flex items-center gap-3">

                            <input
                                type="checkbox"
                                name="is_pinned"
                                value="1"
                                @checked(old('is_pinned', $notification->is_pinned))>

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

                            Update Notification

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>