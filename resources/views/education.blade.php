
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education | My Portfolio</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-6 py-5 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-gray-900">
                My Portfolio
            </a>

            <div class="flex gap-6 text-sm font-medium">
                <a href="/" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="{{ route('experience') }}" class="text-gray-600 hover:text-blue-600">Experience</a>
                <a href="{{ route('education') }}" class="text-blue-600">Education</a>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-16">
        <div class="mb-12">
            <p class="text-blue-600 font-semibold text-sm uppercase tracking-widest">
                Academic Journey
            </p>

            <h1 class="text-4xl font-bold text-gray-900 mt-3">
                Education
            </h1>

            <p class="text-gray-600 mt-4 max-w-2xl leading-relaxed">
                Riwayat pendidikan dan perjalanan akademik saya.
            </p>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-7 shadow-sm">
            <p class="text-sm text-blue-600 font-semibold">
                Higher Education
            </p>

            <h2 class="text-xl font-bold text-gray-900 mt-2">
                Universitas Gadjah Mada
            </h2>

            <p class="text-gray-600 mt-2">
                D4 Teknologi Rekayasa Perangkat Lunak
            </p>

            <p class="text-gray-500 text-sm mt-2">
                2025 – Sekarang
            </p>
        </div>
    </main>

    <footer class="border-t border-gray-200 bg-white">
        <div class="max-w-5xl mx-auto px-6 py-6 text-sm text-gray-500">
            © {{ date('Y') }} My Portfolio
        </div>
    </footer>

</body>
</html>
