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

        @if($user->isAdmin())

        <a href="{{ route('admin.dashboard') }}"
            class="block px-4 py-3 rounded-lg
       {{ request()->routeIs('admin.dashboard')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">🏠</span>
            Dashboard
        </a>

        <a href="{{ route('admin.members.index') }}"
            class="block px-4 py-3 rounded-lg
       {{ request()->routeIs('admin.members.*')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">👥</span>
            Members
        </a>

        <a href="{{ route('admin.announcements.index') }}"
            class="block px-4 py-3 rounded-lg
       {{ request()->routeIs('admin.announcements.*')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">📢</span>
            Announcements
        </a>
        <a href="{{ route('admin.notifications.index') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-100">

            <span class="mr-3">🔔</span>
            Notifications

        </a>
        <a href="{{ route('admin.financial.dashboard') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-100">

            <span class="mr-3">💰</span>
            Financial Dashboard


        </a>
        <a
            href="{{ route('admin.fund-categories.index') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-100">

            <span class="mr-3">🗂️</span>
            Fund Categories

        </a>
        <a
            href="{{ route('admin.donations.index') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-100">

            <span class="mr-3">💵</span>
            Donations

        </a>
        <a href="{{ route('admin.expenses.index') }}"
            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 rounded-lg">

            <span>💸</span>
            <span>Expenses</span>

        </a>


        <a href="{{ route('admin.financial-reports.index') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-100">

            <span class="mr-3">📊</span>
            Financial Reports
        </a>

        <a href="{{ route('admin.audit-logs.index') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-100">

            <span class="mr-3">📋</span>
            Audit Logs
        </a>


        @else

        <a href="{{ route('dashboard') }}"
            class="block px-4 py-3 rounded-lg
        {{ request()->routeIs('dashboard')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">🏠</span>
            Dashboard
        </a>

        @if($user->hasFinancialAccess())
        <a href="{{ route('admin.financial.dashboard') }}"
            class="block px-4 py-3 rounded-lg
   {{ request()->routeIs('admin.financial.*')
       ? 'bg-blue-100 text-blue-700'
       : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">💰</span>
            Financial Dashboard
        </a>
        @endif

        @if($user->canManageDonations())
        <a href="{{ route('admin.donations.index') }}"
            class="block px-4 py-3 rounded-lg
   {{ request()->routeIs('admin.donations.*')
       ? 'bg-blue-100 text-blue-700'
       : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">💵</span>
            Donations
        </a>
        @endif

        @if($user->canManageExpenses())
        <a href="{{ route('admin.expenses.index') }}"
            class="block px-4 py-3 rounded-lg
   {{ request()->routeIs('admin.expenses.*')
       ? 'bg-blue-100 text-blue-700'
       : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">💸</span>
            Expenses
        </a>
        @endif

        @if($user->hasFinancialAccess())
        <a href="{{ route('admin.financial-reports.index') }}"
            class="block px-4 py-3 rounded-lg
   {{ request()->routeIs('admin.financial-reports.*')
       ? 'bg-blue-100 text-blue-700'
       : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">📊</span>
            Financial Reports
        </a>
        @endif

        @if($user->canViewAuditLogs())
        <a href="{{ route('admin.audit-logs.index') }}"
            class="block px-4 py-3 rounded-lg
   {{ request()->routeIs('admin.audit-logs.*')
       ? 'bg-blue-100 text-blue-700'
       : 'text-gray-700 hover:bg-blue-50' }}">
            <span class="mr-3">📋</span>
            Audit Logs
        </a>
        @endif

        @if($user->hasFinancialAccess())
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