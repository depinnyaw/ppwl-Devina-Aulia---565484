
@extends('post.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="mx-auto max-w-7xl space-y-7">

    {{-- Header --}}
    <div class="flex flex-col justify-between gap-2 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm font-medium text-blue-600">
                OVERVIEW
            </p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                Ringkasan Dashboard
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Pantau dan kelola portfolio kamu dari satu tempat.
            </p>
        </div>
    </div>


{{-- Statistics --}}
<div class="grid grid-cols-1 gap-5 md:grid-cols-3">
    <x-stat-card
        title="Total Projects"
        :value="$totalProjects"
        description="Seluruh project tersimpan"
        icon="P"
        color="blue"
    />

    <x-stat-card
        title="Published Projects"
        :value="$publishedProjects"
        description="Project yang sudah dipublikasikan"
        icon="✓"
        color="green"
    />

    <x-stat-card
        title="Draft Projects"
        :value="$draftProjects"
        description="Project yang belum dipublikasikan"
        icon="D"
        color="yellow"
    />

    <x-stat-card
        title="Categories"
        :value="$totalCategories"
        description="Jumlah kategori project"
        icon="C"
        color="blue"
    />

    <x-stat-card
        title="Technologies"
        :value="$totalTechnologies"
        description="Jumlah teknologi"
        icon="T"
        color="green"
    />

    <x-stat-card
        title="Skills"
        :value="$totalSkills"
        description="Jumlah skill"
        icon="S"
        color="yellow"
    />
</div>

{{-- Project per Category --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-7">
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-900">
                Project per Category
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Jumlah project berdasarkan kategori.
            </p>
        </div>

        <div class="space-y-4">
            @forelse ($categories as $category)
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <span class="text-sm font-medium text-gray-700">
                        {{ $category->name }}
                    </span>

                    <span class="text-sm font-semibold text-gray-900">
                        {{ $category->projects_count }} Projects
                    </span>
                </div>
            @empty
                <p class="text-sm text-gray-500">
                    Belum ada kategori yang ditambahkan.
                </p>
            @endforelse
        </div>
    </div>

    
{{-- Top Skills --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-7">
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-900">
                Skill Teratas
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Lima skill terbaru yang ditambahkan.
            </p>
        </div>

        <div class="space-y-4">
            @forelse ($topSkills as $skill)
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <span class="text-sm font-medium text-gray-700">
                        {{ $skill->name }}
                    </span>

                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700">
                        {{ $skill->category ?? 'Tanpa Kategori' }}
                    </span>
                </div>
            @empty
                <p class="text-sm text-gray-500">
                    Belum ada skill yang ditambahkan.
                </p>
            @endforelse
        </div>
    </div>


    {{-- Latest Projects --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="flex flex-col justify-between gap-2 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">
                    Project Terbaru
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Lima project terakhir yang ditambahkan.
                </p>
            </div>

            <a href="{{ route('projects.index') }}"
               class="text-sm font-medium text-blue-600 hover:text-blue-700">
                Lihat semua project →
            </a>
        </div>

        @if ($latestProjects->isEmpty())

            <div class="px-6 py-12 text-center">
                <p class="font-medium text-gray-700">
                    Belum ada project
                </p>
                <p class="mt-1 text-sm text-gray-500">
                    Project yang kamu tambahkan akan muncul di sini.
                </p>
            </div>

        @else

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">

                    <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-6 py-4 font-semibold">No.</th>
                            <th class="px-6 py-4 font-semibold">Judul Project</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 font-semibold">Tanggal Dibuat</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @foreach ($latestProjects as $index => $project)
                            <tr class="transition hover:bg-gray-50">

                                <td class="whitespace-nowrap px-6 py-4 text-gray-500">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $project->title }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($project->status === 'published')
                                        <span class="inline-flex rounded-full bg-green-50 px-3 py-1 text-xs font-medium text-green-700">
                                            Published
                                        </span>
                                    @else
                                        <span class="inline-flex rounded-full bg-amber-50 px-3 py-1 text-xs font-medium text-amber-700">
                                            Draft
                                        </span>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-gray-500">
                                    {{ $project->created_at->format('d M Y') }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        @endif
    </div>

</div>

@endsection
