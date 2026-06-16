<x-app-layout>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-white rounded-2xl shadow p-8">

                <h1 class="text-3xl font-bold mb-8">
                    Member Details
                </h1>

                <div class="mb-6">
                    <h2 class="text-2xl font-semibold">
                        {{ $member->full_name }}
                    </h2>
                </div>

                <div class="space-y-4">

                    @if($member->profile_picture)

                        <img src="{{ asset('storage/' . $member->profile_picture) }}"
                            class="w-32 h-32 rounded-full object-cover">

                    @endif

                    <div>
                        <strong>Phone:</strong>
                        {{ $member->phone ?? '—' }}
                    </div>

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

<hr class="my-6">

<h2 class="text-xl font-bold mb-4">
    Membership Information
</h2>

<div>
    <strong>Membership ID:</strong>
    {{ $member->membership_id ?? '—' }}
</div>

<div>
    <strong>Band:</strong>
    {{ $member->band_name ?? '—' }}
</div>
<hr class="my-6">

<h2 class="text-xl font-bold mb-4">
    Next of Kin
</h2>

<div>
    <strong>Name:</strong>
    {{ $member->next_of_kin_name ?? '—' }}
</div>

<div>
    <strong>Relationship:</strong>
    {{ $member->next_of_kin_relationship ?? '—' }}
</div>

<div>
    <strong>Phone:</strong>
    {{ $member->next_of_kin_phone ?? '—' }}
</div>
<div>
    <strong>Address:</strong>
    {{ $member->next_of_kin_address ?? '—' }}
</div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>