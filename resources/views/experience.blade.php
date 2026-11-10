<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Experience | My Portfolio</title>

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
                <a href="{{ route('experience') }}" class="text-blue-600">Experience</a>
                <a href="{{ route('education') }}" class="text-gray-600 hover:text-blue-600">Education</a>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-16">
        <div class="mb-12">
            <p class="text-blue-600 font-semibold text-sm uppercase tracking-widest">
                My Journey
            </p>

            <h1 class="text-4xl font-bold text-gray-900 mt-3">
                Experience
            </h1>

            <p class="text-gray-600 mt-4 max-w-2xl leading-relaxed">
                Pengalaman organisasi, kepanitiaan, dan kegiatan yang
                menjadi bagian dari perjalanan dan pengembangan diri saya.
            </p>
        </div>

        <div class="space-y-6">

            <div class="bg-white border border-gray-200 rounded-2xl p-7 shadow-sm">
                <p class="text-sm text-blue-600 font-semibold">
                    Organization
                </p>

                <h2 class="text-xl font-bold text-gray-900 mt-2">
                    Humas & Media — UKM Taekwondo UGM
                </h2>

                <p class="text-gray-500 text-sm mt-1">
                    2026 – Sekarang
                </p>

                <p class="text-gray-600 mt-4 leading-relaxed">
                    Berkontribusi dalam kegiatan publikasi dan media,
                    termasuk pembuatan desain visual untuk kebutuhan organisasi.
                </p>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-7 shadow-sm">
                <p class="text-sm text-blue-600 font-semibold">
                    Organization
                </p>

                <h2 class="text-xl font-bold text-gray-900 mt-2">
                    Dokumentasi Desain eDiting (DDD) — UGMTC
                </h2>

                <p class="text-gray-500 text-sm mt-1">
                    2026
                </p>

                <p class="text-gray-600 mt-4 leading-relaxed">
                    Berkontribusi dalam pengerjaan desain untuk kebutuhan
                    dokumentasi dan publikasi kegiatan.
                </p>
            </div>

        </div>
    </main>

    <footer class="border-t border-gray-200 bg-white">
        <div class="max-w-5xl mx-auto px-6 py-6 text-sm text-gray-500">
            © {{ date('Y') }} My Portfolio
        </div>
    </footer>

</body>
</html>