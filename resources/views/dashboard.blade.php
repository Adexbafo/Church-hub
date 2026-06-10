@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>

    <div class="py-10">

        <div class="max-w-7xl mx-auto px-4 space-y-8">

            <!-- Stats Cards -->

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500 text-sm mb-2">
                        Total Members
                    </div>

                    <div class="text-5xl font-bold text-blue-600">

                        {{ \App\Models\Member::count() }}

                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500 text-sm mb-2">
                        Active Members
                    </div>

                    <div class="text-5xl font-bold text-green-600">

                        {{ \App\Models\Member::where('status', 'active')->count() }}

                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500 text-sm mb-2">
                        Inactive Members
                    </div>

                    <div class="text-5xl font-bold text-red-500">

                        {{ \App\Models\Member::where('status', 'inactive')->count() }}

                    </div>

                </div>

            </div>

            <!-- Quick Actions -->

            <div class="bg-white rounded-2xl shadow p-8">

                <h2 class="text-3xl font-bold mb-8">
                    Quick Actions
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <a href="{{ route('member.profile') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white p-6 rounded-2xl text-lg font-semibold transition">

                        My Profile

                    </a>

                    @if(auth()->user()->role === 'admin')

                        <a href="{{ route('admin.members.index') }}"
                           class="bg-indigo-600 hover:bg-indigo-700 text-white p-6 rounded-2xl text-lg font-semibold transition">

                            Manage Members

                        </a>

                        <a href="{{ route('admin.announcements.index') }}"
                           class="bg-purple-600 hover:bg-purple-700 text-white p-6 rounded-2xl text-lg font-semibold transition">

                            Manage Announcements

                        </a>

                    @endif

                </div>

            </div>

            <!-- Latest Announcements -->

            <div class="bg-white border rounded-2xl p-6">

                <div class="flex items-center justify-between mb-4">

                    <h3 class="text-xl font-bold text-gray-800">
                        Latest Announcements
                    </h3>

                    <a href="{{ route('admin.announcements.index') }}"
                       class="text-sm text-blue-600 hover:text-blue-700 font-medium">

                        View All

                    </a>

                </div>

                <div class="space-y-4">

                    @forelse(\App\Models\Announcement::latest()->take(3)->get() as $announcement)

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