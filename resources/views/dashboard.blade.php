@php
    $member = auth()->user()->member;

    $fields = [
        $member?->phone,
        $member?->gender,
        $member?->date_of_birth,
        $member?->address,
        $member?->occupation,
        $member?->marital_status,
    ];

    $completedFields = collect($fields)
        ->filter()
        ->count();

    $totalFields = count($fields);
@endphp

<x-app-layout>

    <div class="py-10">

        <div class="max-w-7xl mx-auto px-4 space-y-8">

        <div class="bg-white rounded-2xl shadow p-6">

    <h1 class="text-3xl font-bold text-gray-800">
        Welcome, {{ auth()->user()->name }}
    </h1>

    <p class="text-gray-500 mt-2">
        Stay connected with church activities and announcements.
    </p>

    </div>

            <!-- Stats Cards -->

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white rounded-2xl shadow p-6">

        <div class="text-gray-500 text-sm mb-2">
            Profile Completion
        </div>

        <div class="text-5xl font-bold text-blue-600 mb-4">
            {{ $completedFields }}/{{ $totalFields }}
        </div>

        <div class="w-full bg-gray-200 rounded-full h-3">
            <div
                class="bg-green-500 h-3 rounded-full"
                style="width: {{ ($completedFields / $totalFields) * 100 }}%">
            </div>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <div class="text-gray-500 text-sm mb-2">
            Membership Status
        </div>

        <div class="text-2xl font-bold text-green-600">
            {{ ucfirst($member->membership_status) }}
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <div class="text-gray-500 text-sm mb-2">
            Baptized
        </div>

        <div class="text-2xl font-bold text-purple-600">
            {{ $member->is_baptized ? 'Yes' : 'No' }}
        </div>

    </div>

</div>

    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6">

    <h2 class="text-xl font-bold text-blue-800 mb-2">
        Complete Your Profile
    </h2>

    <p class="text-blue-700 mb-4">
        Your profile completion is currently
        {{ $completedFields }}/{{ $totalFields }}.
    </p>

    <a href="{{ route('member.profile') }}"
       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg">

        Update Profile

    </a>

</div>

</div>

            <!-- Quick Actions -->

            <div class="bg-white rounded-2xl shadow p-8">

                <h2 class="text-3xl font-bold mb-8">
                    Quick Actions
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <a href="{{ route('member.profile') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white p-6 rounded-2xl text-lg font-semibold transition">

        My Profile

    </a>

    <a href="{{ route('announcements.index') }}"
       class="bg-purple-600 hover:bg-purple-700 text-white p-6 rounded-2xl text-lg font-semibold transition">

        Announcements

    </a>

</div>

            </div>

            <!-- Latest Announcements -->

            <div class="bg-white border rounded-2xl p-6">

                <div class="flex items-center justify-between mb-4">

                    <h3 class="text-xl font-bold text-gray-800">
                        Latest Announcements
                    </h3>

                    <a href="{{ route('announcements.index') }}"
                       class="text-sm text-blue-600 hover:text-blue-700 font-medium">

                        View All

                    </a>

                </div>

                <div class="space-y-4">

                    @forelse(
                        \App\Models\Announcement::where('is_active', true)
                  
                        ->latest()
                            ->take(3)
                            ->get()
                        as $announcement
                        )

                        <div class="border rounded-xl p-4">

                            <h4 class="font-semibold text-gray-800 mb-2">
                                {{ $announcement->title }}
                            </h4>

                            <p class="text-sm text-gray-600 mb-3">

                                {{ Str::limit($announcement->content, 120) }}

                            </p>

                            <div class="text-xs text-gray-400">

                                Posted
                                {{ $announcement->created_at->diffForHumans() }}

                            </div>

                        </div>

                    @empty

                        <div class="text-sm text-gray-500">

                            No announcements available.

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</x-app-layout>