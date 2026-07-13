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

        @if(auth()->user()->role === 'admin')

        <a href="{{ route('admin.dashboard') }}"
            class="block px-4 py-3 rounded-lg
       {{ request()->routeIs('admin.dashboard')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
            Dashboard
        </a>

        <a href="{{ route('admin.members.index') }}"
            class="block px-4 py-3 rounded-lg
       {{ request()->routeIs('admin.members.*')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
            Members
        </a>

        <a href="{{ route('admin.announcements.index') }}"
            class="block px-4 py-3 rounded-lg
       {{ request()->routeIs('admin.announcements.*')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
            Announcements
        </a>
        <a href="{{ route('admin.notifications.index') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-100">

            🔔

            <span class="ml-3">
                Notifications
            </span>

        </a>
        <a href="{{ route('admin.financial.dashboard') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-100">

            💰

            <span class="ml-3">
                Financial Dashboard
            </span>

        </a>
        <a
            href="{{ route('admin.fund-categories.index') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-100">

            🗂️

            <span class="ml-3">
                Fund Categories
            </span>

        </a>
        <a
            href="{{ route('admin.donations.index') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-100">

            💵

            <span class="ml-3">
                Donations
            </span>

        </a>
        <a href="{{ route('expenses.index') }}"
            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 rounded-lg">

            <span>💸</span>
            <span>Expenses</span>

        </a>


        @else

        <a href="{{ route('dashboard') }}"
            class="block px-4 py-3 rounded-lg
        {{ request()->routeIs('dashboard')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
            Dashboard
        </a>

        <a href="{{ route('member.profile') }}"
            class="block px-4 py-3 rounded-lg
       {{ request()->routeIs('member.profile')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
            My Profile
        </a>

        <a href="{{ route('announcements.index') }}"
            class="block px-4 py-3 rounded-lg
       {{ request()->routeIs('announcements.index')
           ? 'bg-blue-100 text-blue-700'
           : 'text-gray-700 hover:bg-blue-50' }}">
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