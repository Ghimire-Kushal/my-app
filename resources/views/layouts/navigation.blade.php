<nav class="bg-white border-b border-gray-200 shadow-sm" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- LEFT -->
            <div class="flex items-center space-x-8">

                <!-- Logo -->
                <a href="{{ route('home') }}" 
                   class="text-xl font-bold text-indigo-600">
                    Kushal.dev
                </a>

                <!-- Admin Menu (ONLY when logged in) -->
                @auth
                <div class="hidden sm:flex space-x-6">

                    <a href="{{ route('admin.dashboard') }}"
                       class="{{ request()->routeIs('admin.dashboard') ? 'text-indigo-600 font-semibold' : 'text-gray-600 hover:text-indigo-600' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('admin.projects.index') }}"
                       class="{{ request()->routeIs('admin.projects.*') ? 'text-indigo-600 font-semibold' : 'text-gray-600 hover:text-indigo-600' }}">
                        Projects
                    </a>

                </div>
                @endauth

            </div>

            <!-- RIGHT -->
            @auth
            <div class="hidden sm:flex items-center space-x-4">

                <span class="text-gray-600 text-sm">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="text-red-500 hover:text-red-700 text-sm">
                        Logout
                    </button>
                </form>

            </div>
            @endauth

            <!-- HAMBURGER -->
            @auth
            <div class="sm:hidden flex items-center">
                <button @click="open = !open"
                        class="p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100">

                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }"
                              stroke="currentColor" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': !open, 'inline-flex': open }"
                              stroke="currentColor" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>
            @endauth

        </div>
    </div>

    <!-- MOBILE MENU -->
    @auth
    <div x-show="open" class="sm:hidden border-t border-gray-200">

        <div class="px-4 py-3">
            <div class="text-base font-medium text-gray-800">
                {{ Auth::user()->name }}
            </div>
            <div class="text-sm text-gray-500">
                {{ Auth::user()->email }}
            </div>
        </div>

        <div class="space-y-1 pb-3">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                Dashboard
            </a>

            <a href="{{ route('admin.projects.index') }}"
               class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                Projects
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100">
                    Logout
                </button>
            </form>

        </div>

    </div>
    @endauth
</nav>