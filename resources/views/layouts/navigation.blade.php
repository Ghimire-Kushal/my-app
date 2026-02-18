<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Left -->
            <div class="flex items-center space-x-8">

                <a href="{{ route('admin.dashboard') }}" 
                   class="text-xl font-bold text-indigo-600">
                    Kushal.dev
                </a>

                <div class="hidden sm:flex space-x-6">

                    <a href="{{ route('admin.dashboard') }}"
                       class="{{ request()->routeIs('admin.dashboard') ? 'text-indigo-600 font-semibold' : 'text-gray-600' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('admin.projects.index') }}"
                       class="{{ request()->routeIs('admin.projects.*') ? 'text-indigo-600 font-semibold' : 'text-gray-600' }}">
                        Projects
                    </a>

                </div>
            </div>

            <!-- Right -->
            @auth
            <div class="flex items-center space-x-4">

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

        </div>
    </div>
</nav>
          

            <!-- HAMBURGER -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition">

                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke="currentColor"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke="currentColor"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>

        </div>
    </div>

    <!-- RESPONSIVE MENU -->
    @auth
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <div class="pt-4 pb-1 border-t border-gray-200">

            <div class="px-4">
                <div class="font-medium text-base text-gray-800">
                    {{ Auth::user()->name }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

            </div>

        </div>

    </div>
    @endauth

</nav>