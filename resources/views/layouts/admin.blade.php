<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-white shadow-md p-6">

            <h2 class="text-xl font-bold text-indigo-600 mb-8">
                Admin Panel
            </h2>

            <nav class="space-y-4 text-sm">

                <a href="/admin"
                   class="block hover:text-indigo-600">
                    Dashboard
                </a>

                <a href="/admin/projects"
                   class="block hover:text-indigo-600">
                    Projects
                </a>

                <a href="/"
                   class="block hover:text-indigo-600">
                    View Website
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 hover:text-red-700">
                        Logout
                    </button>
                </form>

            </nav>
        </aside>


        {{-- Main Content --}}
        <main class="flex-1 p-10">
            @yield('content')
        </main>

    </div>

</body>
</html>