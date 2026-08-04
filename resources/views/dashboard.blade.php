@php
$member = auth()->user()->member;

$fields = [
$member?->phone,
$member?->gender,
$member?->date_of_birth,
$member?->address,
$member?->occupation,
$member?->marital_status,
$member?->band_one,
$member?->band_two,
$member?->band_three,
$member?->next_of_kin_name,
$member?->next_of_kin_phone,
];

$completedFields = collect($fields)
->filter()
->count();

$totalFields = count($fields);

$completionPercentage = $totalFields > 0
? (int) round(($completedFields / $totalFields) * 100)
: 0;

$completionColor = match (true) {
$completionPercentage === 100 => 'text-green-600',
$completionPercentage >= 75 => 'text-blue-600',
default => 'text-orange-500',
};

use Illuminate\Support\Str;
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

            <!-- Quick Actions -->

            <div class="bg-white rounded-2xl shadow p-8">

                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Quick Actions
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

                    <!-- My Profile -->

                    <a href="{{ route('member.profile') }}"
                        class="group bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-300 rounded-2xl p-6 transition duration-300">

                        <div class="text-4xl mb-4">
                            👤
                        </div>

                        <h3 class="text-lg font-bold text-gray-800">
                            My Profile
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            View and update your personal information.
                        </p>

                    </a>

                    <!-- Announcements -->

                    <a href="{{ route('announcements.index') }}"
                        class="group bg-slate-50 hover:bg-purple-50 border border-slate-200 hover:border-purple-300 rounded-2xl p-6 transition duration-300">

                        <div class="text-4xl mb-4">
                            📢
                        </div>

                        <h3 class="text-lg font-bold text-gray-800">
                            Announcements
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            Read the latest church news and announcements.
                        </p>

                    </a>

                    <!-- Events -->

                    <a
                        href="{{ route('member.events.index') }}"
                        class="block bg-white border border-slate-200 rounded-2xl p-6 transition duration-200 hover:shadow-lg hover:-translate-y-1 hover:border-blue-300">

                        <div class="text-4xl">
                            📅
                        </div>

                        <h3 class="text-lg font-bold text-gray-800 mt-4">
                            Events
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            View upcoming church programs and activities.
                        </p>

                    </a>

                    <!-- Gallery -->

                    <a
                        href="{{ route('member.gallery.index') }}"
                        class="block bg-white border border-slate-200 rounded-2xl p-6 transition duration-200 hover:shadow-lg hover:-translate-y-1 hover:border-blue-300">

                        <div class="text-4xl">
                            🖼️
                        </div>

                        <h3 class="text-lg font-bold text-gray-800 mt-4">
                            Gallery
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            Browse church photos, videos and media albums.
                        </p>

                    </a>

                </div>

            </div>

            <!-- Stats Cards -->

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500 text-sm mb-2">
                        Membership ID
                    </div>

                    <div class="text-2xl font-bold text-blue-600">
                        {{ $member?->membership_id ?? 'N/A' }}
                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500 text-sm mb-2">
                        Profile Completion
                    </div>

                    <div class="text-5xl font-bold {{ $completionColor }}">
                        {{ $completedFields }}/{{ $totalFields }}
                    </div>

                    <div class="mt-2 text-sm font-semibold {{ $completionColor }}">
                        {{ $completionPercentage }}% Complete
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 mt-4">

                        <div
                            class="h-3 rounded-full transition-all duration-700
            {{ $completionPercentage === 100
                ? 'bg-green-500'
                : ($completionPercentage >= 75
                    ? 'bg-blue-500'
                    : 'bg-orange-500') }}"
                            @style([ 'width: ' . $completionPercentage . '%'
                            ])>

                        </div>

                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500 text-sm mb-2">
                        Membership Status
                    </div>

                    <div class="text-2xl font-bold text-green-600">
                        {{ ucfirst($member?->membership_status ?? 'N/A') }}
                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500 text-sm mb-2">
                        Baptized
                    </div>

                    <div class="text-2xl font-bold text-purple-600">
                        {{ $member?->is_baptized ? 'Yes' : 'No' }}
                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500 text-sm mb-3">
                        Ministry Bands
                    </div>

                    @php
                    $bands = array_filter([
                    $member?->band_one,
                    $member?->band_two,
                    $member?->band_three,
                    ]);
                    @endphp

                    @if(count($bands))

                    <div class="flex flex-wrap gap-2">

                        @foreach($bands as $band)

                        <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-sm">
                            {{ $band }}
                        </span>

                        @endforeach

                    </div>

                    @else

                    <span class="text-gray-500">
                        No ministry assigned
                    </span>

                    @endif

                </div>

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500 text-sm mb-2">
                        Next of Kin
                    </div>

                    <div class="text-lg font-semibold text-gray-800">
                        {{ $member->next_of_kin_name ?? 'Not Provided' }}
                    </div>

                    @if($member?->next_of_kin_relationship)
                    <div class="text-sm text-gray-500 mt-1">
                        {{ $member->next_of_kin_relationship }}
                    </div>
                    @endif

                    @if($member?->next_of_kin_phone)
                    <div class="text-sm text-blue-600 mt-1">
                        {{ $member->next_of_kin_phone }}
                    </div>
                    @endif

                </div>

            </div>

            @if ($completedFields >= $totalFields)

            <div class="bg-green-50 border border-green-200 rounded-2xl p-8">

                <div class="flex items-start justify-between">

                    <div class="flex-1">

                        <h2 class="text-2xl font-bold text-green-800 mb-3">

                            ✅ Profile Complete

                        </h2>

                        <p class="text-green-700">

                            Your membership information is fully up to date.

                        </p>

                        <p class="text-green-600 mt-2">

                            Thank you for keeping your profile current.
                            You're ready to participate in church activities.

                        </p>

                        <div class="mt-6">

                            <a href="{{ route('member.profile') }}"
                                class="inline-flex items-center rounded-lg bg-green-600 px-5 py-2.5 text-white font-medium hover:bg-green-700 transition">

                                View Profile

                            </a>

                        </div>

                    </div>

                    <div
                        class="ml-8 flex h-20 w-20 items-center justify-center rounded-full bg-green-100">

                        <span class="text-5xl">

                            ✅

                        </span>

                    </div>

                </div>

            </div>

            @else

            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">

                <h2 class="text-xl font-bold text-blue-800 mb-2">
                    Complete Your Profile
                </h2>

                <p class="text-blue-700">
                    You have completed
                    <strong>{{ $completedFields }}</strong>
                    of
                    <strong>{{ $totalFields }}</strong>
                    required profile fields.
                </p>

                <p class="text-blue-600 mt-2 text-sm">
                    Keeping your profile updated helps the church communicate with you and serve you better.
                </p>

                <div class="mt-6">

                    <a href="{{ route('member.profile') }}"
                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">

                        Complete Profile

                    </a>

                </div>

            </div>

            @endif

        </div>


        <!-- Latest Announcements -->

        <div class="bg-white rounded-2xl shadow p-8">

            <div class="flex items-start justify-between">

                <div>

                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                        📢
                        Latest Announcements
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Stay informed with the latest church news and updates.
                    </p>

                </div>

                <a href="{{ route('announcements.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition">

                    View All →

                </a>

            </div>

            <div class="border-t border-gray-100 my-6"></div>

            <div class="space-y-6">

                @forelse($latestAnnouncements as $announcement)

                <div
                    class="group bg-slate-50 border border-gray-200 rounded-2xl p-6 hover:border-blue-400 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                    <div class="flex gap-4">

                        <!-- Icon -->

                        <div class="flex-shrink-0">

                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-xl">

                                📢

                            </div>

                        </div>

                        <!-- Content -->

                        <div class="flex-1">

                            <!-- Title Row -->

                            <div class="flex items-start justify-between gap-4">

                                <h3 class="text-lg font-bold text-gray-800 group-hover:text-blue-700 transition">

                                    {{ $announcement->title }}

                                </h3>

                                @if ($announcement->published_at->gt(now()->subDays(2)))

                                <span
                                    class="shrink-0 rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">

                                    NEW

                                </span>

                                @endif

                            </div>

                            <!-- Published -->

                            <div class="mt-2 flex items-center gap-2 text-sm text-gray-400">

                                <span>🕒</span>

                                <span>

                                    Published {{ $announcement->published_at->diffForHumans() }}

                                </span>

                            </div>

                            <!-- Summary -->

                            <p class="mt-4 text-gray-600 leading-relaxed">

                                {{ Str::limit($announcement->content, 140) }}

                            </p>

                            <!-- Footer -->

                            <div class="mt-5 flex justify-end">

                                <span
                                    class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 transition-transform duration-300 group-hover:translate-x-1">

                                    View Details

                                    →

                                </span>

                            </div>

                        </div>

                    </div>

                </div>
                @empty

                <div class="rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 p-10 text-center">

                    <div class="text-5xl mb-4">
                        📭
                    </div>

                    <h3 class="text-lg font-semibold text-gray-700">
                        No announcements yet
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Church announcements will appear here as soon as they are published.
                    </p>

                </div>

                @endforelse

            </div>

        </div>

        <!-- Upcoming Events -->
        <div class="bg-white rounded-2xl shadow p-8">

            <!-- Header -->

            <div class="flex items-start justify-between">

                <div>

                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">

                        📅

                        Upcoming Events

                    </h2>

                    <p class="text-gray-500 mt-2">

                        See what's happening in church over the coming weeks.

                    </p>

                </div>

                <button
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-50 px-4 py-2 text-blue-700 transition hover:bg-blue-100">

                    View Calendar →

                </button>

            </div>

            <div class="border-t border-gray-100 my-6"></div>

            <div class="space-y-5">

                <!-- Event cards go here -->
                <div
                    class="group flex items-center gap-6 rounded-2xl border border-gray-200 bg-slate-50 p-6 transition-all duration-300 hover:-translate-y-1 hover:border-blue-400 hover:shadow-lg">

                    <!-- Date -->

                    <div
                        class="flex h-20 w-20 flex-shrink-0 flex-col items-center justify-center rounded-2xl bg-blue-600 text-white">

                        <span class="text-xs font-semibold uppercase">

                            Aug

                        </span>

                        <span class="text-3xl font-bold">

                            17

                        </span>

                    </div>

                    <!-- Event Details -->

                    <div class="flex-1">

                        <h3
                            class="text-lg font-bold text-gray-800 transition group-hover:text-blue-700">

                            Sunday Worship Service

                        </h3>

                        <p class="mt-2 text-sm text-gray-500">

                            ⏰ 9:00 AM

                            •

                            📍 Main Auditorium

                        </p>

                        <p class="mt-4 text-gray-600">

                            Weekly worship service with praise, worship and biblical teaching.

                        </p>

                    </div>

                    <!-- Action -->

                    <div>

                        <span
                            class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 transition-transform duration-300 group-hover:translate-x-1">

                            View Event →

                        </span>

                    </div>

                </div>

            </div>
            <div
                class="group flex items-center gap-6 rounded-2xl border border-gray-200 bg-slate-50 p-6 transition-all duration-300 hover:-translate-y-1 hover:border-blue-400 hover:shadow-lg">

                <!-- Date -->

                <div
                    class="flex h-20 w-20 flex-shrink-0 flex-col items-center justify-center rounded-2xl bg-blue-600 text-white">

                    <span class="text-xs font-semibold uppercase">

                        Aug

                    </span>

                    <span class="text-3xl font-bold">

                        17

                    </span>

                </div>

                <!-- Event Details -->

                <div class="flex-1">

                    <h3
                        class="text-lg font-bold text-gray-800 transition group-hover:text-blue-700">

                        Youth Fellowship

                    </h3>

                    <p class="mt-2 text-sm text-gray-500">

                        ⏰ 9:00 AM

                        •

                        📍 Youth Hall

                    </p>

                    <p class="mt-4 text-gray-600">

                        Weekly worship service with praise, worship and biblical teaching.

                    </p>

                </div>

                <!-- Action -->

                <div>

                    <span
                        class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 transition-transform duration-300 group-hover:translate-x-1">

                        View Event →

                    </span>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>