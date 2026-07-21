<div class="space-y-6">

    <!-- User -->
    <div>
        <label for="user_id" class="block text-sm font-medium text-gray-700">
            User
        </label>

        <select
            name="user_id"
            id="user_id"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            required>
            <option value="">Select User</option>

            @foreach ($users as $user)
            <option
                value="{{ $user->id }}"
                @selected(old('user_id', $mediaTeam->user_id ?? '') == $user->id)
                >
                {{ $user->name }}
            </option>
            @endforeach
        </select>

        @error('user_id')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Role -->
    <div>
        <label for="role" class="block text-sm font-medium text-gray-700">
            Role
        </label>

        <input
            type="text"
            name="role"
            id="role"
            value="{{ old('role', $mediaTeam->role ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            required>

        @error('role')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Joined Date -->
    <div>
        <label for="joined_at" class="block text-sm font-medium text-gray-700">
            Joined Date
        </label>

        <input
            type="date"
            name="joined_at"
            id="joined_at"
            value="{{ old('joined_at', optional($mediaTeam->joined_at ?? null)?->format('Y-m-d')) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

        @error('joined_at')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Active -->
    <div class="flex items-center">
        <input
            id="is_active"
            name="is_active"
            type="checkbox"
            value="1"
            @checked(old('is_active', $mediaTeam->is_active ?? true))
        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
        >

        <label for="is_active" class="ml-2 block text-sm text-gray-700">
            Active
        </label>
    </div>

    <!-- Notes -->
    <div>
        <label for="notes" class="block text-sm font-medium text-gray-700">
            Notes
        </label>

        <textarea
            name="notes"
            id="notes"
            rows="4"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $mediaTeam->notes ?? '') }}</textarea>

        @error('notes')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

</div>