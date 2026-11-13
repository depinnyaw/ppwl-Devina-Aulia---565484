@extends('layouts.app')

@section('title', 'Projects')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    {{-- Header --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        My Projects
    </h1>

    {{-- Search, Filter, dan Sorting --}}
    <form method="GET"
          action="{{ route('projects') }}"
          class="flex flex-wrap gap-3 mb-6">

        {{-- Search --}}
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari project..."
            class="border border-gray-300 rounded-lg px-4 py-2"
        >

        {{-- Filter Kategori --}}
        <select name="category"
                class="border border-gray-300 rounded-lg px-4 py-2">

            <option value="">Semua kategori</option>

            @foreach ($categories as $category)
                <option
                    value="{{ $category->slug }}"
                    @selected(request('category') === $category->slug)
                >
                    {{ $category->name }}
                </option>
            @endforeach

        </select>

        {{-- Filter Technology --}}
        <select name="technology"
                class="border border-gray-300 rounded-lg px-4 py-2">

            <option value="">Semua teknologi</option>

            @foreach ($technologies as $technology)
                <option
                    value="{{ $technology->slug }}"
                    @selected(request('technology') === $technology->slug)
                >
                    {{ $technology->name }}
                </option>
            @endforeach

        </select>

        {{-- Sorting --}}
        <select name="sort"
                class="border border-gray-300 rounded-lg px-4 py-2">

            <option value=""
                @selected(!request('sort'))>
                Terbaru
            </option>

            <option value="terlama"
                @selected(request('sort') === 'terlama')>
                Terlama
            </option>

            <option value="az"
                @selected(request('sort') === 'az')>
                Judul A-Z
            </option>

            <option value="tanggal_terbaru"
                @selected(request('sort') === 'tanggal_terbaru')>
                Tanggal Project Terbaru
            </option>

            <option value="tanggal_terlama"
                @selected(request('sort') === 'tanggal_terlama')>
                Tanggal Project Terlama
            </option>

        </select>

        {{-- Tombol Cari --}}
        <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
            Cari
        </button>

        {{-- Reset --}}
        <a href="{{ route('projects') }}"
           class="border border-gray-300 px-5 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
            Reset
        </a>

    </form>

    {{-- Jumlah Hasil --}}
    <p class="text-sm text-gray-500 mb-5">
        {{ $totalResults }} hasil ditemukan.
    </p>

    {{-- Daftar Project --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse ($projects as $project)

            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">

                {{-- Thumbnail --}}
                @if ($project->thumbnail)
                    <img
                        src="{{ asset('storage/' . $project->thumbnail) }}"
                        alt="{{ $project->title }}"
                        class="w-full h-48 object-cover"
                    >
                @else
                    <div class="flex h-48 items-center justify-center bg-gray-100 text-gray-400">
                        Belum ada thumbnail
                    </div>
                @endif

                {{-- Informasi Project --}}
                <div class="p-5">

                    <h2 class="text-xl font-bold text-gray-800">
                        {{ $project->title }}
                    </h2>

                    <p class="text-gray-600 mt-2">
                        {{ $project->short_description ?? $project->description }}
                    </p>

                    {{-- Tanggal Project --}}
                    @if ($project->project_date)
                        <p class="text-xs text-gray-500 mt-2">
                            Tanggal:
                            {{ $project->project_date }}
                        </p>
                    @endif

                    {{-- Kategori --}}
                    @if ($project->category)
                        <span class="inline-block mt-3 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">
                            {{ $project->category->name }}
                        </span>
                    @endif

                    {{-- Technology --}}
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach ($project->technologies as $technology)
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">
                                {{ $technology->name }}
                            </span>
                        @endforeach
                    </div>

                    {{-- Detail --}}
                    <a
                        href="{{ route('projects.public.show', $project->slug) }}"
                        class="inline-block mt-5 text-blue-600 font-medium hover:underline"
                    >
                        Lihat Detail
                    </a>

                </div>

            </div>

        @empty

            <p class="text-gray-500 col-span-full text-center py-10">
                Tidak ada project yang cocok.
            </p>

        @endforelse

    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $projects->links() }}
    </div>

</div>

@endsection