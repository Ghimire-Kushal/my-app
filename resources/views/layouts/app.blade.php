<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ config('app.name', 'Kushal.dev') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50">

    <div class="min-h-screen flex flex-col">

        <!-- Navigation -->
        @auth
            {{-- Admin Navbar --}}
            @include('layouts.navigation')
        @else
            {{-- Public Navbar --}}
            @include('layouts.frontend')
        @endauth

        <!-- Main Content -->
        <main class="flex-grow py-10">
            @yield('content')
        </main>

        <!-- Footer (optional) -->
        <footer class="text-center text-sm text-gray-500 py-4">
            © {{ date('Y') }} Kushal.dev. All rights reserved.
        </footer>

    </div>

</body>
</html>