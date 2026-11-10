
@extends('layouts.app')

@section('title', $project->title)

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">

    {{-- Tombol kembali --}}
    <a href="{{ url()->previous() }}"
       class="text-sm text-gray-600 hover:text-gray-900">
        &larr; Kembali
    </a>

    {{-- Informasi project --}}
    <div class="mt-6">
        <h1 class="text-3xl font-bold text-gray-900">
            {{ $project->title }}
        </h1>

        <p class="mt-4 text-gray-600 leading-relaxed">
            {{ $project->description }}
        </p>
    </div>

    {{-- Kategori --}}
    <div class="mt-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">
            Kategori
        </h2>

        @if ($project->category)
            <span class="inline-block px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm">
                {{ $project->category->name }}
            </span>
        @else
            <p class="text-sm text-gray-500">Tidak ada kategori.</p>
        @endif
    </div>

    {{-- Teknologi --}}
    <div class="mt-5">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">
            Teknologi yang Digunakan
        </h2>

        @forelse ($project->technologies as $technology)
            <span class="inline-block px-4 py-2 mr-2 mb-2 bg-gray-100 text-gray-700 rounded-full text-sm">
                {{ $technology->name }}
            </span>
        @empty
            <p class="text-sm text-gray-500">Tidak ada teknologi.</p>
        @endforelse
    </div>

    {{-- Thumbnail --}}
    @if ($project->thumbnail)
        <div class="mt-8">
            <img
                src="{{ asset('storage/' . $project->thumbnail) }}"
                alt="{{ $project->title }}"
                class="w-full max-h-[450px] object-cover rounded-xl"
            >
        </div>
    @endif

    {{-- Gallery --}}
    <div class="mt-10">
        <h2 class="text-2xl font-semibold text-gray-900 mb-5">
            Gallery Project
        </h2>

        @if ($project->images->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($project->images as $image)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <img
                            src="{{ asset('storage/' . $image->image) }}"
                            alt="{{ $image->caption ?? $project->title }}"
                            class="w-full h-56 object-cover"
                        >

                        @if ($image->caption)
                            <div class="p-4">
                                <p class="text-sm text-gray-600">
                                    {{ $image->caption }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">
                Belum ada gambar gallery untuk project ini.
            </p>
        @endif
    </div>

</div>
@endsection
