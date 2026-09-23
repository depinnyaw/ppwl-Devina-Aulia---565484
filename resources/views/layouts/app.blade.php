<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    @include('partials.navbar')

    <main class="max-w-5xl mx-auto px-6 py-8">
        @yield('content')
    </main>

      @include('partials.footer')

</body>
</html>