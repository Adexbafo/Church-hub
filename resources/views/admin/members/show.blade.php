<x-app-layout>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-white rounded-2xl shadow p-8">

                <h1 class="text-3xl font-bold mb-8">
                    Member Details
                </h1>

                <div class="space-y-4">

                    @if($member->profile_picture)

                        <img src="{{ asset('storage/' . $member->profile_picture) }}"
                             class="w-32 h-32 rounded-full object-cover">

                    @endif

                    <div>
                        <strong>Name:</strong>
                        {{ $member->full_name }}
                    </div>

                    <div>
                        <strong>Phone:</strong>
                        {{ $member->phone }}
                    </div>

                    <div>
                        <strong>Occupation:</strong>
                        {{ $member->occupation }}
                    </div>

                    <div>
                        <strong>Status:</strong>
                        {{ $member->membership_status }}
                    </div>

                    <div>
                        <strong>Address:</strong>
                        {{ $member->address }}
                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>