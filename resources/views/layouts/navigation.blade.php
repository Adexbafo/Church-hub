<nav class="bg-white border-b border-gray-200 shadow-sm">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between h-16">

            <div class="flex items-center gap-10">

                <a href="{{ route('dashboard') }}"
                   class="text-2xl font-bold text-blue-700">
                    ChurchHub
                </a>

                <div class="hidden md:flex items-center gap-6">

                    <a href="{{ route('dashboard') }}"
                       class="text-gray-700 hover:text-blue-600">
                        Dashboard
                    </a>

                    <a href="{{ route('member.profile') }}"
                       class="text-gray-700 hover:text-blue-600">
                        My Profile
                    </a>

                    @if(auth()->user()->role === 'admin')

                        <a href="{{ route('admin.dashboard') }}"
                           class="text-gray-700 hover:text-blue-600">
                            Admin
                        </a>

                    @endif

                </div>

            </div>

            <div class="flex items-center gap-4">

                <div class="flex items-center gap-3">

    @if(auth()->user()->member?->profile_picture)

        <img src="{{ asset('storage/' . auth()->user()->member->profile_picture) }}"
             class="w-10 h-10 rounded-full object-cover border">

    @else

        <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

    @endif

    <div class="text-sm text-gray-700">
        {{ auth()->user()->name }}
    </div>

</div>

                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf

                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </div>

</nav>