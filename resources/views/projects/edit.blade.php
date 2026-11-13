@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
    <div class="rounded border border-gray-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-bold text-gray-800">
            Edit Project
        </h1>

        @if ($errors->any())
            <div class="mt-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="mb-1 block text-sm font-medium text-gray-700">
                    Title
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $project->title) }}"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none"
                >
            </div>

            <div class="mb-4">
                <label for="description" class="mb-1 block text-sm font-medium text-gray-700">
                    Description
                </label>

                <textarea
                    name="description"
                    id="description"
                    rows="4"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none"
                >{{ old('description', $project->description) }}</textarea>
            </div>

            {{-- Tanggal Project --}}
            <div class="mb-4">
                <label for="project_date"
                    class="mb-1 block text-sm font-medium text-gray-700">
                    Tanggal Project
                </label>

                <input
                    type="date"
                    name="project_date"
                    id="project_date"
                    value="{{ old('project_date', $project->project_date) }}"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm"
                >

                @error('project_date')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div class="mb-4">
                <label for="category_id" class="mb-1 block text-sm font-medium text-gray-700">
                    Kategori
                </label>

                <select name="category_id" id="category_id"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm">
                    <option value="">Pilih Kategori</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Teknologi --}}
            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">
                    Teknologi
                </label>

                <div class="flex flex-wrap gap-3">
                    @foreach ($technologies as $technology)
                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox"
                                name="technologies[]"
                                value="{{ $technology->id }}"
                                {{ in_array(
                                    $technology->id,
                                    old('technologies', $project->technologies->pluck('id')->toArray())
                                ) ? 'checked' : '' }}>
                            {{ $technology->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Thumbnail saat ini --}}
            @if ($project->thumbnail)
                <div class="mb-4">
                    <p class="mb-2 text-sm font-medium text-gray-700">
                        Thumbnail Saat Ini
                    </p>

                    <img
                        src="{{ asset('storage/' . $project->thumbnail) }}"
                        alt="Thumbnail {{ $project->title }}"
                        class="h-40 w-auto rounded border object-cover"
                    >
                </div>
            @endif

            {{-- Ganti Thumbnail --}}
            <div class="mb-4">
                <label for="thumbnail" class="mb-1 block text-sm font-medium text-gray-700">
                    Ganti Thumbnail
                </label>

                <input
                    type="file"
                    name="thumbnail"
                    id="thumbnail"
                    accept="image/*"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm"
                >

                <p class="mt-1 text-xs text-gray-500">
                    Kosongkan jika tidak ingin mengganti thumbnail. Maksimal 2 MB.
                </p>
            </div>

            <button
                type="submit"
                class="rounded bg-blue-500 px-4 py-2 text-sm font-medium text-white hover:bg-blue-600"
            >
                Update
            </button>
        </form>
    </div>
@endsection