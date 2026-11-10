
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-64 shrink-0 text-white min-h-screen"
       style="background-color: #111827;">
            <div class="px-6 py-6 border-b border-gray-700">
                <h1 class="text-xl font-bold">Portfolio Admin</h1>
                <p class="text-sm text-gray-400 mt-1">Management Panel</p>
            </div>

            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('post.dashboard') }}"
                   class="block px-4 py-3 rounded-lg transition
                   {{ request()->routeIs('post.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-[#1f2937]'}}">
                    Dashboard
                </a>

                <a href="{{ route('projects.index') }}"
                   class="block px-4 py-3 rounded-lg transition
                   {{ request()->routeIs('projects.*') && !request()->routeIs('projects.trash') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    Projects
                </a>

                <a href="{{ route('projects.trash') }}"
                   class="block px-4 py-3 rounded-lg transition
                   {{ request()->routeIs('projects.trash') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    Trash Projects
                </a>

                <a href="{{ route('profile.saya') }}"
                   class="block px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800 transition">
                    Profil Saya
                </a>
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 min-w-0">

            {{-- Navbar --}}
            <header class="h-16 bg-white shadow-sm px-8 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">
                    @yield('title', 'Dashboard Admin')
                </h2>

                <div class="flex items-center gap-5">
                    <span class="text-sm text-gray-600">
                        {{ Auth::user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-sm font-medium text-red-600 hover:text-red-800">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="p-6 lg:p-8">
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>
