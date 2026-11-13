@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="min-h-screen bg-gray-50 px-6 py-8">
    <div class="mx-auto max-w-7xl">

        {{-- Header --}}
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Projects</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Kelola seluruh project portfolio kamu.
                </p>
            </div>

            <a href="{{ route('projects.trash') }}"
               class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                Trash Projects
            </a>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Search dan Filter --}}
        <form action="{{ route('projects.index') }}"
              method="GET"
              class="mb-6 flex flex-wrap items-center gap-3 rounded-xl border border-gray-200 bg-white p-4">

            {{-- Search --}}
            <input
                type="text"
                name="search"
                placeholder="Cari judul project..."
                value="{{ $search }}"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-blue-500 focus:outline-none sm:w-64"
            >

            {{-- Filter Status --}}
            <select name="status"
                    class="rounded-lg border border-gray-300 px-3 py-2 text-sm">

                <option value="">Semua status</option>

                <option value="draft"
                    @selected($status === 'draft')>
                    Draft
                </option>

                <option value="published"
                    @selected($status === 'published')>
                    Published
                </option>

            </select>

            {{-- Jumlah Data --}}
            <select name="per_page"
                    class="rounded-lg border border-gray-300 px-3 py-2 text-sm">

                <option value="5" @selected((int) $perPage === 5)>5 data</option>
                <option value="10" @selected((int) $perPage === 10)>10 data</option>
                <option value="25" @selected((int) $perPage === 25)>25 data</option>

            </select>

            {{-- Tombol Terapkan --}}
            <button type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Terapkan
            </button>

            {{-- Tombol Reset --}}
            <a href="{{ route('projects.index') }}"
               class="rounded-lg border border-gray-300 bg-white px-5 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                Reset
            </a>

        </form>

        {{-- Jumlah Hasil --}}
        <p class="mb-5 text-sm text-gray-500">
            {{ $projects->total() }} hasil ditemukan.
        </p>

        {{-- Daftar Project --}}
        @php
            $no = $projects->firstItem();
        @endphp

        @if ($projects->count() > 0)
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                @foreach ($projects as $project)
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                        {{-- Thumbnail --}}
                        @if ($project->thumbnail)
                            <img
                                src="{{ asset('storage/' . $project->thumbnail) }}"
                                alt="Thumbnail {{ $project->title }}"
                                class="h-48 w-full object-cover"
                            >
                        @else
                            <div class="flex h-48 items-center justify-center bg-gray-100 text-sm text-gray-400">
                                Belum ada thumbnail
                            </div>
                        @endif

                        {{-- Informasi --}}
                        <div class="p-5">

                            <div class="mb-3 flex items-center justify-between">
                                <span class="text-xs text-gray-400">
                                    Project #{{ $no++ }}
                                </span>

                                <span class="rounded-full px-3 py-1 text-xs font-medium
                                    {{ $project->status === 'published'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </div>

                            <h2 class="truncate text-lg font-bold text-gray-800">
                                {{ $project->title }}
                            </h2>

                            <p class="mt-2 h-10 overflow-hidden text-sm leading-5 text-gray-500">
                                {{ $project->description }}
                            </p>

                            {{-- Kategori --}}
                            @if ($project->category)
                                <p class="mt-2 text-xs text-gray-500">
                                    Kategori: {{ $project->category->name }}
                                </p>
                            @endif

                            <div class="mt-5 flex flex-wrap items-center gap-3 border-t border-gray-100 pt-4">

                                <a href="{{ route('projects.show', $project->id) }}"
                                   class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                    Lihat Detail
                                </a>

                                <a href="{{ route('projects.edit', $project->id) }}"
                                   class="text-sm font-medium text-gray-600 hover:text-gray-900">
                                    Edit
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        @else
            <div class="rounded-xl border border-gray-200 bg-white py-16 text-center">
                <p class="text-gray-500">
                    Project tidak ditemukan.
                </p>
            </div>
        @endif

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $projects->links() }}
        </div>

    </div>
</div>
@endsection