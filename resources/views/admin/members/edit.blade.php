<x-app-layout>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-white rounded-2xl shadow p-8">

                <h1 class="text-3xl font-bold mb-8">
                    Edit Member
                </h1>

                <form method="POST"
                        action="{{ route('admin.members.update', $member) }}"
                        enctype="multipart/form-data"
                        class="space-y-6">

                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block mb-2">Full Name</label>

                        <input type="text"
                               name="full_name"
                               value="{{ old('full_name', $member->full_name) }}"
                               class="w-full rounded-lg border-gray-300">
                    </div>

                    <div>
                        <label class="block mb-2">Phone</label>

                        <input type="text"
                               name="phone"
                               value="{{ old('phone', $member->phone) }}"
                               class="w-full rounded-lg border-gray-300">
                    </div>

                    <div>
                        <label class="block mb-2">Occupation</label>

                        <input type="text"
                               name="occupation"
                               value="{{ old('occupation', $member->occupation) }}"
                               class="w-full rounded-lg border-gray-300">
                    </div>

                    <div>
                        <label class="block mb-2">
                            Profile Picture
                        </label>

                        <input type="file"
                               name="profile_picture"
                               class="w-full rounded-lg border-gray-300">
                    </div>

                        @if ($member->profile_picture)

                            <img src="{{ asset('storage/' . $member->profile_picture) }}"
                                class="w-24 h-24 rounded-full object-cover border">

                        @endif

                    <div>
                        <label class="block mb-2">Address</label>

                        <textarea name="address"
                                  class="w-full rounded-lg border-gray-300">{{ old('address', $member->address) }}</textarea>
                    </div>

                    <div>
                        <label class="block mb-2">
                            Membership Status
                        </label>

                        <select name="membership_status"
                                class="w-full rounded-lg border-gray-300">

                            <option value="active"
                                @selected($member->membership_status === 'active')>
                                Active
                            </option>

                            <option value="inactive"
                                @selected($member->membership_status === 'inactive')>
                                Inactive
                            </option>

                        </select>

                    </div>

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                        Update Member

                    </button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>