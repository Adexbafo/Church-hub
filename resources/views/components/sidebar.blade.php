@php
use App\Enums\Role as RoleEnum;
use App\Enums\Permission;

$user = auth()->user();

$memberOpen = request()->routeIs('admin.members.*');

$communicationOpen =
request()->routeIs('admin.announcements.*')
|| request()->routeIs('admin.notifications.*');

$mediaOpen =
request()->routeIs('admin.media-items.*')
|| request()->routeIs('admin.media-categories.*')
|| request()->routeIs('admin.media-albums.*')
|| request()->routeIs('admin.sermons.*')
|| request()->routeIs('admin.livestreams.*')
|| request()->routeIs('admin.media-teams.*');

$financialOpen =
request()->routeIs('admin.financial.*')
|| request()->routeIs('admin.donations.*')
|| request()->routeIs('admin.expenses.*')
|| request()->routeIs('admin.fund-categories.*')
|| request()->routeIs('admin.financial-reports.*');

$administrationOpen =
request()->routeIs('admin.audit-logs.*');
@endphp


<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-50
           w-72 max-w-[85vw] bg-white shadow-lg min-h-screen
           transform transition-transform duration-300 ease-in-out
           -translate-x-full md:translate-x-0 md:relative">
    <div class="p-6 border-b">

        <h1 class="text-2xl font-bold text-blue-700">
            ChurchHub
        </h1>

    </div>

    <nav class="p-4 space-y-2">

        @php
        $user = auth()->user();
        @endphp

        @if($user->hasRole(RoleEnum::SUPER_ADMIN->value))

        <a href="{{ route('admin.dashboard') }}"
            class="block px-4 py-3 rounded-lg
       {{ request()->routeIs('admin.dashboard')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">🏠</span>
            Dashboard
        </a>

        <div
            x-data="{
        open: {{ $memberOpen ? 'true' : 'false' }}
    }">
            <button
                @click="open = !open"
                type="button"
                class="w-full flex items-center justify-between px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-blue-600 hover:bg-gray-50 rounded-md transition-colors duration-200">
                <span>Member Management</span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 transition-transform duration-200"
                    :class="{ 'rotate-90': open }"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div
                x-show="open"
                x-transition:enter.duration.200ms
                x-transition:leave.duration.150ms>
                <a href="{{ route('admin.members.index') }}"
                    class="block px-4 py-3 rounded-lg
       {{ request()->routeIs('admin.members.*')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
                    <span class="mr-3">👥</span>
                    Members
                </a>
            </div>
        </div>

        <div
            x-data="{
        open: {{ $communicationOpen ? 'true' : 'false' }}
    }">
            <button
                @click="open = !open"
                type="button"
                class="w-full flex items-center justify-between px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-blue-600 hover:bg-gray-50 rounded-md transition-colors duration-200">
                <span>Communication</span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 transition-transform duration-200"
                    :class="{ 'rotate-90': open }"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div
                x-show="open"
                x-transition:enter.duration.200ms
                x-transition:leave.duration.150ms>

                <!-- Announcements Link -->
                <a href="{{ route('admin.announcements.index') }}"
                    class="block px-4 py-3 rounded-lg
       {{ request()->routeIs('admin.announcements.*')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
                    <span class="mr-3">📢</span>
                    Announcements
                </a>

                <a href="{{ route('admin.events.index') }}"
                    class="block px-4 py-3 rounded-lg
    {{ request()->routeIs('admin.events.*')
        ? 'bg-blue-100 text-blue-700'
        : 'text-gray-700 hover:bg-blue-50' }}">

                    <span class="mr-3">📅</span>
                    Events

                </a>



                <!-- Notifications Link -->
                <a href="{{ route('admin.notifications.index') }}"
                    class="block px-4 py-3 rounded-lg
    {{ request()->routeIs('admin.notifications.*')
        ? 'bg-blue-100 text-blue-700'
        : 'text-gray-700 hover:bg-blue-50' }}">

                    <span class="mr-3">🔔</span>
                    Notifications

                </a>
            </div>
        </div>

        <div
            x-data="{
        open: {{ $mediaOpen ? 'true' : 'false' }}
    }">
            <button
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-blue-600 hover:bg-gray-50 rounded-md transition-colors duration-200"
                type="button">
                <span>Media Management</span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 transition-transform duration-200"
                    :class="{ 'rotate-90': open }"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5l7 7-7 7" />
                </svg>
            </button>
            <div
                x-show="open"
                x-transition:enter.duration.200ms
                x-transition:leave.duration.150ms>

                <a href="{{ route('admin.media-items.index') }}"
                    class="block px-4 py-3 rounded-lg
        {{ request()->routeIs('admin.media-items.*')
            ? 'bg-blue-100 text-blue-700'
            : 'text-gray-700 hover:bg-blue-50' }}">
                    <span class="mr-3">🎬</span>
                    Media Library
                </a>

                <a href="{{ route('admin.media-categories.index') }}"
                    class="block px-4 py-3 rounded-lg
        {{ request()->routeIs('admin.media-categories.*')
            ? 'bg-blue-100 text-blue-700'
            : 'text-gray-700 hover:bg-blue-50' }}">

                    <span class="mr-3">📂</span>
                    Media Categories
                </a>

                <a href="{{ route('admin.media-albums.index') }}"
                    class="block px-4 py-3 rounded-lg
        {{ request()->routeIs('admin.media-albums.*')
            ? 'bg-blue-100 text-blue-700'
            : 'text-gray-700 hover:bg-blue-50' }}">

                    <span class="mr-3">🎞️</span>
                    Media Albums
                </a>

                <a href="{{ route('admin.sermons.index') }}"
                    class="block px-4 py-3 rounded-lg
    {{ request()->routeIs('admin.sermons.*')
        ? 'bg-blue-100 text-blue-700'
        : 'text-gray-700 hover:bg-blue-50' }}">
                    <span class="mr-3">🎤</span>
                    Sermons
                </a>

                <a href="{{ route('admin.livestreams.index') }}"
                    class="block px-4 py-3 rounded-lg
   {{ request()->routeIs('admin.livestreams.*')
        ? 'bg-blue-100 text-blue-700'
        : 'text-gray-700 hover:bg-blue-50' }}">

                    <span class="mr-3">📺</span>

                    Livestreams
                </a>

                <a href="{{ route('admin.media-teams.index') }}"
                    class="block px-4 py-3 rounded-lg
    {{ request()->routeIs('admin.media-teams.*')
        ? 'bg-blue-100 text-blue-700'
        : 'text-gray-700 hover:bg-blue-50' }}">

                    <span class="mr-3">👥</span>

                    Media Team
                </a>
            </div>
        </div>
        <div
            x-data="{
        open: {{ $financialOpen ? 'true' : 'false' }}
    }"
            class="pt-4 mt-4 border-t">
            <button
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-blue-600 hover:bg-gray-50 rounded-md transition-colors duration-200"
                type="button">
                <span>Financial Management</span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 transition-transform duration-200"
                    :class="{ 'rotate-90': open }"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5l7 7-7 7" />
                </svg>
            </button>
            <div
                x-show="open"
                x-transition:enter.duration.200ms
                x-transition:leave.duration.150ms>
                <a href="{{ route('admin.financial.dashboard') }}"
                    class="block px-4 py-3 rounded-lg
    {{ request()->routeIs('admin.financial.*')
        ? 'bg-blue-100 text-blue-700'
        : 'text-gray-700 hover:bg-blue-50' }}">

                    <span class="mr-3">💰</span>
                    Financial Dashboard

                </a>
                <a href="{{ route('admin.donations.index') }}"
                    class="block px-4 py-3 rounded-lg
    {{ request()->routeIs('admin.donations.*')
        ? 'bg-blue-100 text-blue-700'
        : 'text-gray-700 hover:bg-blue-50' }}">

                    <span class="mr-3">💵</span>
                    Donations

                </a>
                <a href="{{ route('admin.expenses.index') }}"
                    class="block px-4 py-3 rounded-lg
    {{ request()->routeIs('admin.expenses.*')
        ? 'bg-blue-100 text-blue-700'
        : 'text-gray-700 hover:bg-blue-50' }}">

                    <span class="mr-3">💸</span>
                    Expenses
                </a>

                <a href="{{ route('admin.fund-categories.index') }}"
                    class="block px-4 py-3 rounded-lg
    {{ request()->routeIs('admin.fund-categories.*')
        ? 'bg-blue-100 text-blue-700'
        : 'text-gray-700 hover:bg-blue-50' }}">

                    <span class="mr-3">🗂️</span>
                    Fund Categories
                </a>

                <a href="{{ route('admin.financial-reports.index') }}"
                    class="block px-4 py-3 rounded-lg
    {{ request()->routeIs('admin.financial-reports.*')
        ? 'bg-blue-100 text-blue-700'
        : 'text-gray-700 hover:bg-blue-50' }}">

                    <span class="mr-3">📊</span>
                    Financial Reports
                </a>
            </div>
        </div>

        <div
            x-data="{
        open: {{ $administrationOpen ? 'true' : 'false' }}
    }"
            class="pt-4 mt-4 border-t">
            <button
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-blue-600 hover:bg-gray-50 rounded-md transition-colors duration-200"
                type="button">
                <span>Administration</span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 transition-transform duration-200"
                    :class="{ 'rotate-90': open }"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div
                x-show="open"
                x-transition:enter.duration.200ms
                x-transition:leave.duration.150ms>

                <!-- Audit Logs Link -->
                <a href="{{ route('admin.audit-logs.index') }}"
                    class="block px-4 py-3 rounded-lg
    {{ request()->routeIs('admin.audit-logs.*')
        ? 'bg-blue-100 text-blue-700'
        : 'text-gray-700 hover:bg-blue-50' }}">

                    <span class="mr-3">📋</span>
                    Audit Logs
                </a>
            </div>
        </div>

        @else

        <a href="{{ route('dashboard') }}"
            class="block px-4 py-3 rounded-lg
        {{ request()->routeIs('dashboard')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">🏠</span>
            Dashboard
        </a>


        @if($user->can(Permission::FINANCIAL_DASHBOARD_VIEW->value))
        <a href="{{ route('admin.financial.dashboard') }}"
            class="block px-4 py-3 rounded-lg
   {{ request()->routeIs('admin.financial.*')
       ? 'bg-blue-100 text-blue-700'
       : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">💰</span>
            Financial Dashboard
        </a>
        @endif

        @if($user->can(Permission::DONATIONS_VIEW->value))
        <a href="{{ route('admin.donations.index') }}"
            class="block px-4 py-3 rounded-lg
   {{ request()->routeIs('admin.donations.*')
       ? 'bg-blue-100 text-blue-700'
       : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">💵</span>
            Donations
        </a>
        @endif

        @if($user->can(Permission::EXPENSES_VIEW->value))
        <a href="{{ route('admin.expenses.index') }}"
            class="block px-4 py-3 rounded-lg
   {{ request()->routeIs('admin.expenses.*')
       ? 'bg-blue-100 text-blue-700'
       : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">💸</span>
            Expenses
        </a>
        @endif

        @if($user->can(Permission::FINANCIAL_REPORTS_VIEW->value))
        <a href="{{ route('admin.financial-reports.index') }}"
            class="block px-4 py-3 rounded-lg
   {{ request()->routeIs('admin.financial-reports.*')
       ? 'bg-blue-100 text-blue-700'
       : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">📊</span>
            Financial Reports
        </a>
        @endif

        @if($user->can(Permission::AUDIT_LOGS_VIEW->value))
        <a href="{{ route('admin.audit-logs.index') }}"
            class="block px-4 py-3 rounded-lg
   {{ request()->routeIs('admin.audit-logs.*')
       ? 'bg-blue-100 text-blue-700'
       : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">📋</span>
            Audit Logs
        </a>
        @endif
        @if($user->can(Permission::FUND_CATEGORIES_VIEW->value))
        <a href="{{ route('admin.fund-categories.index') }}"
            class="block px-4 py-3 rounded-lg
   {{ request()->routeIs('admin.fund-categories.*')
       ? 'bg-blue-100 text-blue-700'
       : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">🗂</span>
            Fund Categories
        </a>
        @endif
        <a href="{{ route('member.profile') }}"
            class="block px-4 py-3 rounded-lg
       {{ request()->routeIs('member.profile*')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">👤</span>
            My Profile
        </a>

        <a href="{{ route('announcements.index') }}"
            class="block px-4 py-3 rounded-lg
       {{ request()->routeIs('announcements.*')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">📢</span>
            Announcements
        </a>
        <a href="{{ route('notifications.index') }}"
            class="flex items-center justify-between px-4 py-3 rounded-lg hover:bg-blue-100">

            <div class="flex items-center">

                <span>🔔</span>

                <span class="ml-3">

                    Notifications

                </span>

            </div>

            @if(($unreadNotifications ?? 0) > 0)

            <span
                class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full">

                {{ $unreadNotifications }}

            </span>

            @endif

        </a>
        @endif

        <div class="pt-6 border-t mt-6">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg">
                    Logout
                </button>

            </form>

        </div>

    </nav>

</aside>