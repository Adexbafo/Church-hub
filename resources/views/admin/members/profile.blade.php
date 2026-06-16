<x-app-layout>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-white shadow rounded-xl p-8">

                <h1 class="text-3xl font-bold text-gray-800 mb-8">
                    Member Profile
                </h1>

                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">

                    <div class="text-sm text-blue-600">
                        Membership ID
                    </div>

                    <div class="text-2xl font-bold text-blue-800">
                        {{ $member->membership_id ?? 'Not Assigned' }}
                    </div>

                </div>

                @if (session('success'))
                    <div class="mb-6 bg-green-500 text-white px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('member.profile.update') }}"
                      enctype="multipart/form-data"
                      class="space-y-6">

                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Full Name
                        </label>

                        <input type="text"
                               name="full_name"
                               value="{{ old('full_name', $member->full_name) }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Phone
                        </label>

                        <input type="text"
                               name="phone"
                               value="{{ old('phone', $member->phone) }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Occupation
                        </label>

                        <input type="text"
                               name="occupation"
                               value="{{ old('occupation', $member->occupation) }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                     <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Gender
                        </label>

                        <select name="gender"
                                class="w-full rounded-lg border-gray-300">

                            <option value="">Select Gender</option>

                            <option value="male"
                                @selected($member->gender === 'male')>
                                Male
                            </option>

                            <option value="female"
                                @selected($member->gender === 'female')>
                                Female
                            </option>

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Date of Birth
                        </label>

                        <input type="date"
                               name="date_of_birth"
                               value="{{ old('date_of_birth', optional($member->date_of_birth)->format('Y-m-d')) }}"
                               class="w-full rounded-lg border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Joined Date
                        </label>

                        <input type="date"
                               name="joined_at"
                               value="{{ old('joined_at', optional($member->joined_at)->format('Y-m-d')) }}"
                               class="w-full rounded-lg border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Address
                        </label>

                        <textarea name="address"
                                class="w-full rounded-lg border-gray-300">{{ old('address', $member->address) }}</textarea>
                    </div>

                    <h2 class="text-xl font-semibold text-gray-800">
                        Next of Kin Information
                    </h2>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Next of Kin Name
                        </label>

                        <input type="text"
                            name="next_of_kin_name"
                            value="{{ old('next_of_kin_name', $member->next_of_kin_name) }}"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Relationship
                        </label>

                        <input type="text"
                            name="next_of_kin_relationship"
                            value="{{ old('next_of_kin_relationship', $member->next_of_kin_relationship) }}"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Next of Kin Phone
                        </label>

                        <input type="text"
                            name="next_of_kin_phone"
                            value="{{ old('next_of_kin_phone', $member->next_of_kin_phone) }}"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Next of Kin Address
                        </label>

                        <textarea name="next_of_kin_address"
                            class="w-full rounded-lg border-gray-300">{{ old('next_of_kin_address', $member->next_of_kin_address) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Band
                        </label>

                        <select name="band_name"
                            class="w-full rounded-lg border-gray-300">

                            <option value="">Select Band</option>

                            @foreach([
                                'Ruth',
                                'Hope',
                                'Rhoda',
                                'Queen Sheba',
                                'Deborah',
                                'Elizabeth',
                                'Rebecca',
                                'Martha',
                                'Dorcas',
                                'Abigail',
                                'Lydia',
                                'Mary',
                                'Queen Esther',
                                'Samuel',
                                'Joseph',
                                'Early Morning Star',
                                'Love Divine',
                                'Show the Glory of God',
                                'Soldiers of Christ',
                                'King David'
                            ] as $band)

                            <option value="{{ $band }}"
                                @selected($member->band_name === $band)>
                                {{ $band }}
                            </option>

                        @endforeach

                    </select>
                </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Marital Status
                        </label>

                        <select name="marital_status"
                                class="w-full rounded-lg border-gray-300">

                            <option value="">Select Status</option>

                            <option value="single"
                                @selected($member->marital_status === 'single')>
                                Single
                            </option>

                            <option value="married"
                                @selected($member->marital_status === 'married')>
                                Married
                            </option>

                        </select>
                    </div>

                     <div class="flex items-center gap-3">

                        <input type="checkbox"
                               name="is_baptized"
                               value="1"
                               @checked($member->is_baptized)>

                        <label>
                            Baptized
                        </label>

                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Profile Picture
                        </label>

                        <input type="file"
                               name="profile_picture"
                               class="block w-full text-sm text-gray-700">
                    </div>

                    @if ($member->profile_picture)

                        <img src="{{ asset('storage/' . $member->profile_picture) }}"
                        class="w-32 h-32 rounded-full object-cover border">

                    @endif

                    <div>
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition">
                            Save Profile
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>