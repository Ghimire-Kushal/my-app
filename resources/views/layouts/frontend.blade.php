<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kushal Portfolio</title>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Devicons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

    <!-- AlpineJS (REQUIRED FOR MOBILE MENU) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-900 antialiased">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ once: true, duration: 800 });
</script>

{{-- NAVBAR --}}
<nav x-data="{ open: false }"
     class="fixed top-0 left-0 w-full backdrop-blur-md bg-white/90 border-b border-gray-200 z-50">

    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        {{-- LOGO --}}
        <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600">
            Kushal.dev
        </a>

        {{-- DESKTOP MENU --}}
        <div class="hidden md:flex items-center space-x-8 text-sm font-medium">

            {{-- Home --}}
            <a href="{{ url('/') }}"
               class="relative group transition duration-300
               {{ request()->is('/') ? 'text-indigo-600' : 'text-gray-700 hover:text-indigo-600' }}">
                Home
                <span class="absolute left-0 -bottom-1 h-0.5 bg-indigo-600 transition-all duration-300
                {{ request()->is('/') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>

            {{-- Projects (FIXED LINK) --}}
            <a href="{{ url('/#projects') }}"
               class="relative group transition duration-300 text-gray-700 hover:text-indigo-600">
                Projects
                <span class="absolute left-0 -bottom-1 h-0.5 bg-indigo-600 w-0 group-hover:w-full transition-all duration-300"></span>
            </a>

            {{-- Contact --}}
            <a href="{{ url('/contact') }}"
               class="relative group transition duration-300
               {{ request()->is('contact') ? 'text-indigo-600' : 'text-gray-700 hover:text-indigo-600' }}">
                Contact
                <span class="absolute left-0 -bottom-1 h-0.5 bg-indigo-600 transition-all duration-300
                {{ request()->is('contact') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>

            @auth
                <a href="{{ url('/admin') }}"
                   class="text-indigo-600 font-semibold hover:opacity-80 transition">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 hover:text-red-700 transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ url('/login') }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow-sm">
                    Login
                </a>
            @endauth
        </div>

        {{-- MOBILE BUTTON --}}
        <button @click="open = !open"
                class="md:hidden text-gray-700 focus:outline-none">

            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>

            <svg x-show="open" xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>

        </button>
    </div>

    {{-- MOBILE MENU --}}
    <div x-show="open"
         x-transition
         class="md:hidden bg-white border-t border-gray-200 shadow-sm">

        <div class="px-6 py-6 space-y-4 text-gray-700 font-medium">

            <a href="{{ url('/') }}" @click="open=false" class="block hover:text-indigo-600">
                Home
            </a>

            <a href="{{ url('/#projects') }}" @click="open=false"
               class="block hover:text-indigo-600">
                Projects
            </a>

            <a href="{{ url('/contact') }}" @click="open=false"
               class="block hover:text-indigo-600">
                Contact
            </a>

            @auth
                <a href="{{ url('/admin') }}" @click="open=false"
                   class="block text-indigo-600 font-semibold">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="block text-red-500 hover:text-red-700">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ url('/login') }}"
                   class="block bg-indigo-600 text-white px-4 py-2 rounded-lg text-center hover:bg-indigo-700 transition">
                    Login
                </a>
            @endauth

        </div>
    </div>

</nav>

{{-- CONTENT --}}
<main class="pt-24">
    @yield('content')
</main>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    once: true,
    duration: 800,
    offset: 100,
  });
</script>

</body>
</html>