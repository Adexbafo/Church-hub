<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">

        <h2 class="text-2xl font-bold mb-6">
            Member Profile
        </h2>

        @if (session('success'))
            <div class="mb-4 rounded bg-green-500 text-white px-4 py-3">
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
                <label class="block mb-1">Full Name</label>

                <input type="text"
                       name="full_name"
                       value="{{ old('full_name', $member->full_name) }}"
                       class="w-full rounded border-gray-300">
            </div>

            <div>
                <label class="block mb-1">Phone</label>

                <input type="text"
                       name="phone"
                       value="{{ old('phone', $member->phone) }}"
                       class="w-full rounded border-gray-300">
            </div>

            <div>
                <label class="block mb-1">Occupation</label>

                <input type="text"
                       name="occupation"
                       value="{{ old('occupation', $member->occupation) }}"
                       class="w-full rounded border-gray-300">
            </div>

            <div>
                <label class="block mb-1">Profile Picture</label>

                <input type="file"
                       name="profile_picture"
                       class="w-full">
            </div>

            @if ($member->profile_picture)
                <img src="{{ asset('storage/' . $member->profile_picture) }}"
                     class="w-32 h-32 rounded-full object-cover">
            @endif

            <div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                    Save Profile
                </button>
            </div>
        </form>
    </div>
</x-app-layout>