<x-app-layout>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-white shadow rounded-xl p-8">

                <h1 class="text-3xl font-bold text-gray-800 mb-8">
                    Member Profile
                </h1>

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
                            Profile Picture
                        </label>

                        <input type="file"
                               name="profile_picture"
                               class="block w-full text-sm text-gray-700">
                    </div>

                    @if ($member->profile_picture)
                        <div>
                            <img src="{{ asset('storage/' . $member->profile_picture) }}"
                                 class="w-32 h-32 rounded-full object-cover border">
                        </div>
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