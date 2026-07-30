<x-app-layout>

    <div class="py-10">

        <div class="max-w-6xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-6">

                <h1 class="text-3xl font-bold">
                    Create Event
                </h1>

                <p class="text-gray-500 mt-2 mb-6">
                    Add a new church event.
                </p>

                <form action="{{ route('admin.events.store') }}" method="POST">

                    @csrf

                    <div class="space-y-6">

                        <div>

                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Event Title <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                name="title"
                                id="title"
                                value="{{ old('title') }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            @error('title')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                        <div>

                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>

                            <textarea
                                name="description"
                                id="description"
                                rows="5"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>

                            @error('description')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                        <div>

                            <label for="category" class="block text-sm font-medium text-gray-700">
                                Category <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="category"
                                id="category"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                                <option value="general" @selected(old('category')=='general' )>General</option>
                                <option value="worship" @selected(old('category')=='worship' )>Worship</option>
                                <option value="prayer" @selected(old('category')=='prayer' )>Prayer</option>
                                <option value="youth" @selected(old('category')=='youth' )>Youth</option>
                                <option value="conference" @selected(old('category')=='conference' )>Conference</option>
                                <option value="training" @selected(old('category')=='training' )>Training</option>
                                <option value="children" @selected(old('category')=='children' )>Children</option>
                                <option value="outreach" @selected(old('category')=='outreach' )>Outreach</option>

                            </select>

                            @error('category')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            <div>

                                <label for="event_date" class="block text-sm font-medium text-gray-700">
                                    Event Date <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="date"
                                    name="event_date"
                                    id="event_date"
                                    value="{{ old('event_date') }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                                @error('event_date')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>

                            <div>

                                <label for="start_time" class="block text-sm font-medium text-gray-700">
                                    Start Time <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="time"
                                    name="start_time"
                                    id="start_time"
                                    value="{{ old('start_time') }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                                @error('start_time')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>

                            <div>

                                <label for="end_time" class="block text-sm font-medium text-gray-700">
                                    End Time
                                </label>

                                <input
                                    type="time"
                                    name="end_time"
                                    id="end_time"
                                    value="{{ old('end_time') }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                                @error('end_time')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>
                        </div>

                        <div>

                            <label for="venue" class="block text-sm font-medium text-gray-700">
                                Venue <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                name="venue"
                                id="venue"
                                value="{{ old('venue') }}"
                                placeholder="Main Auditorium"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            @error('venue')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                        <div class="border-t pt-6">

                            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                Event Settings
                            </h2>

                            <div class="space-y-4">

                                <label class="flex items-center">

                                    <input
                                        type="checkbox"
                                        name="is_featured"
                                        value="1"
                                        @checked(old('is_featured'))
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">

                                    <span class="ml-3">
                                        Featured Event
                                    </span>

                                </label>

                                <label class="flex items-center">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        @checked(old('is_active', true))
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">

                                    <span class="ml-3">
                                        Active Event
                                    </span>

                                </label>

                            </div>

                            <div class="flex justify-end gap-4 border-t pt-6">

                                <a
                                    href="{{ route('admin.events.index') }}"
                                    class="px-5 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">

                                    Cancel

                                </a>

                                <button
                                    type="submit"
                                    class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">

                                    Create Event

                                </button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>



        </div>

    </div>

</x-app-layout>