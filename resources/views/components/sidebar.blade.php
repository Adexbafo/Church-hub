<aside id="sidebar"
       class="fixed md:relative z-40 w-64 bg-white shadow-lg min-h-screen transform -translate-x-full md:translate-x-0 transition-transform duration-300">

    <div class="p-6 border-b">

        <h1 class="text-2xl font-bold text-blue-700">
            ChurchHub
        </h1>

    </div>

    <nav class="p-4 space-y-2">

        <a href="{{ route('dashboard') }}"
           class="block px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">

            Dashboard

        </a>

        <a href="{{ route('member.profile') }}"
           class="block px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">

            My Profile

        </a>

        @if(auth()->user()->role === 'admin')

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">

                Admin Dashboard

            </a>

            <a href="{{ route('admin.members.index') }}"
               class="block px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">

                Members

            </a>

        @endif

        <div class="pt-6 border-t mt-6">

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg">

                    Logout

                </button>

            </form>

        </div>

    </nav>

</aside>