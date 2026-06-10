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
    <strong>Occupation:</strong>
    {{ $member->occupation ?? '—' }}
</div>

<div>
    <strong>Gender:</strong>
    {{ ucfirst($member->gender ?? '—') }}
</div>

<div>
    <strong>Date of Birth:</strong>
    {{ $member->date_of_birth?->format('F d, Y') ?? '—' }}
</div>

<div>
    <strong>Marital Status:</strong>
    {{ ucfirst($member->marital_status ?? '—') }}
</div>

<div>
    <strong>Baptized:</strong>
    {{ $member->is_baptized ? 'Yes' : 'No' }}
</div>

<div>
    <strong>Status:</strong>
    {{ ucfirst($member->membership_status) }}
</div>

<div>
    <strong>Address:</strong>
    {{ $member->address ?? '—' }}
</div>

<div>
    <strong>Joined At:</strong>
    {{ $member->joined_at?->format('F d, Y') ?? '—' }}
</div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>