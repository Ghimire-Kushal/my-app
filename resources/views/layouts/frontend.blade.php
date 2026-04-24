<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kushal Portfolio</title>

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Devicons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

    <!-- AlpineJS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-950 text-gray-800 dark:text-gray-100 transition-colors duration-300 antialiased">

{{-- ================= NAVBAR ================= --}}
<nav x-data="{ open: false }"
     class="fixed top-0 left-0 w-full z-50
            backdrop-blur-lg
            bg-white/70 dark:bg-gray-900/70
            border-b border-gray-200/50 dark:border-gray-700/50
            shadow-sm">

    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- LOGO -->
        <a href="{{ url('/') }}"
           class="text-xl font-bold text-indigo-600">
            Kushal.dev
        </a>

        <!-- DESKTOP MENU -->
        <div class="hidden md:flex items-center space-x-8 text-sm font-medium">

            <!-- Home -->
            <a href="{{ url('/') }}"
               class="{{ request()->is('/') 
                   ? 'text-indigo-600' 
                   : 'text-black hover:text-indigo-600' }}">
                Home
            </a>

            <!-- Projects -->
            <a href="{{ url('/#projects') }}"
               class="text-black hover:text-indigo-600">
                Projects
            </a>

            <!-- Contact -->
            <a href="{{ url('/contact') }}"
               class="{{ request()->is('contact') 
                   ? 'text-indigo-600' 
                   : 'text-black hover:text-indigo-600' }}">
                Contact
            </a>

            <!-- ADMIN ONLY -->
            @auth
                <a href="{{ url('/admin') }}"
                   class="{{ request()->is('admin*') 
                       ? 'text-indigo-600 font-semibold' 
                       : 'text-black hover:text-indigo-600' }}">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 hover:text-red-700 transition">
                        Logout
                    </button>
                </form>
            @endauth

        </div>

        <!-- MOBILE BUTTON -->
        <button @click="open = !open"
                class="md:hidden text-gray-700 dark:text-gray-300 focus:outline-none">

            <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>

            <svg x-show="open" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>

        </button>
    </div>

    <!-- MOBILE MENU -->
    <div x-show="open"
         x-transition
         class="md:hidden bg-white dark:bg-gray-900
                border-t border-gray-200 dark:border-gray-700 shadow-sm">

        <div class="px-6 py-6 space-y-4 text-gray-700 dark:text-gray-300 font-medium">

            <a href="{{ url('/') }}" @click="open=false"
               class="block hover:text-indigo-600">
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

            <!-- ADMIN ONLY -->
            @auth
                <a href="{{ url('/admin') }}" @click="open=false"
                   class="block text-indigo-600 font-semibold">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="block text-red-500 hover:text-red-600">
                        Logout
                    </button>
                </form>
            @endauth

        </div>
    </div>

</nav>

{{-- ================= CONTENT ================= --}}
<main class="pt-24">
    @yield('content')
</main>

{{-- ================= AOS JS ================= --}}
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        once: true,
        duration: 800,
        offset: 100,
    });
</script>

{{-- ================= FLASH AUTO FADE ================= --}}
<script>
    setTimeout(() => {
        document.querySelectorAll('[data-alert]').forEach(el => {
            el.style.transition = "opacity 0.5s";
            el.style.opacity = 0;
        });
    }, 3000);
</script>

</body>
</html>