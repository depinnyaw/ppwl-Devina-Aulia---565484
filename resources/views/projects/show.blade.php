@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <div class="rounded border border-gray-200 bg-white p-5 shadow-sm">

        {{-- Thumbnail Project --}}
        @if ($project->thumbnail)
            <img
                src="{{ asset('storage/' . $project->thumbnail) }}"
                alt="Thumbnail {{ $project->title }}"
                class="mb-5 h-64 w-full rounded object-cover"
            >
        @else
            <div class="mb-5 flex h-64 w-full items-center justify-center rounded bg-gray-100 text-gray-400">
                Belum ada thumbnail
            </div>
        @endif

        {{-- Informasi Project --}}
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $project->title }}
        </h1>

        <p class="mt-3 text-sm text-gray-600">
            {{ $project->description }}
        </p>

        {{-- Kategori --}}
        <div class="mt-4">
            <h2 class="text-sm font-semibold text-gray-700">Kategori</h2>

            @if ($project->category)
                <span class="mt-2 inline-block rounded bg-blue-100 px-3 py-1 text-sm text-blue-700">
                    {{ $project->category->name }}
                </span>
            @else
                <p class="mt-2 text-sm text-gray-500">Belum ada kategori.</p>
            @endif
        </div>

        {{-- Teknologi --}}
        <div class="mt-4">
            <h2 class="text-sm font-semibold text-gray-700">Teknologi</h2>

            <div class="mt-2 flex flex-wrap gap-2">
                @forelse ($project->technologies as $technology)
                    <span class="rounded bg-gray-100 px-3 py-1 text-sm text-gray-700">
                        {{ $technology->name }}
                    </span>
                @empty
                    <p class="text-sm text-gray-500">Belum ada teknologi.</p>
                @endforelse
            </div>
        </div>

        {{-- Status --}}
        <div class="mt-4">
            <h2 class="text-sm font-semibold text-gray-700">Status</h2>
            <span class="mt-2 inline-block rounded bg-green-100 px-3 py-1 text-sm text-green-700">
                {{ ucfirst($project->status) }}
            </span>
        </div>

        {{-- Tombol Aksi Project --}}
        <div class="mt-5 flex items-center gap-3 text-sm">
            <a
                href="{{ route('projects.edit', $project->id) }}"
                class="text-blue-600 hover:text-blue-800 hover:underline"
            >
                Edit
            </a>

            <span class="text-gray-300">|</span>

            <form
                action="{{ route('projects.destroy', $project->id) }}"
                method="POST"
                class="inline"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    onclick="return confirm('Apakah kamu yakin ingin menghapus project ini?')"
                    class="text-red-600 hover:text-red-800 hover:underline"
                >
                    Delete
                </button>
            </form>

            <span class="text-gray-300">|</span>

            <a
                href="{{ route('projects.index') }}"
                class="text-blue-600 hover:text-blue-800 hover:underline"
            >
                Back to List
            </a>
        </div>
    </div>

    {{-- Form Upload Gallery --}}
    <div class="mt-6 rounded border border-gray-200 bg-white p-5 shadow-sm">
        <h2 class="mb-4 text-xl font-bold text-gray-800">
            Upload Gallery Project
        </h2>

        <form
            action="{{ route('projects.gallery.store', $project->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <input
                type="file"
                name="images[]"
                accept="image/jpeg,image/png,image/webp"
                multiple
                required
            >

            @error('images')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            @error('images.*')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <button
                type="submit"
                class="mt-4 rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
            >
                Upload Gambar
            </button>
        </form>
    </div>

    {{-- Daftar Gallery --}}
    <div class="mt-6 rounded border border-gray-200 bg-white p-5 shadow-sm">
        <h2 class="mb-4 text-xl font-bold text-gray-800">
            Gallery Project
        </h2>

        @if ($project->images->count() > 0)
            <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                @foreach ($project->images as $image)
                    <div class="rounded border border-gray-200 p-2">

                        <img
                            src="{{ asset('storage/' . $image->image) }}"
                            alt="Gallery {{ $project->title }}"
                            class="h-40 w-full rounded object-cover"
                        >

                        {{-- Form Edit Caption --}}
                        <form
                            action="{{ route('projects.gallery.updateCaption', [$project->id, $image->id]) }}"
                            method="POST"
                            class="mt-2"
                        >
                            @csrf
                            @method('PUT')

                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Caption Gambar
                            </label>

                            <input
                                type="text"
                                name="caption"
                                value="{{ $image->caption }}"
                                placeholder="Masukkan caption gambar"
                                maxlength="255"
                                class="w-full rounded border border-gray-300 px-3 py-2 text-sm"
                            >

                            <button
                                type="submit"
                                class="mt-2 rounded bg-blue-600 px-3 py-1 text-sm text-white hover:bg-blue-700"
                            >
                                Simpan Caption
                            </button>
                        </form>

                        {{-- Tombol Hapus Gambar --}}
                        <form
                            action="{{ route('projects.gallery.destroy', [$project->id, $image->id]) }}"
                            method="POST"
                            class="mt-2"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus gambar ini?')"
                                class="rounded bg-red-600 px-3 py-1 text-sm text-white hover:bg-red-700"
                            >
                                Hapus Gambar
                            </button>
                        </form>

                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-500">
                Belum ada gambar gallery.
            </p>
        @endif
    </div>
@endsection
