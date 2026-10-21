@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <div>
        <h1 class="mb-6 text-3xl font-bold text-gray-800">
            Projects
        </h1>

        <a href="{{ route('projects.trash') }}">Trash</a>

        @if (session('success'))
            <div class="mb-6 rounded border border-green-200 bg-green-100 px-4 py-2 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            @php
                $no = $projects->firstItem();
            @endphp

            
            <!-- <form action="{{ route('projects.index') }}" method="GET">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari judul project..."
                    value="{{ $search }}"
                >
                <button type="submit">Cari</button>
            </form> -->

            <form action="{{ route('projects.index') }}" method="GET">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari judul project..."
                    value="{{ $search }}"
                >

                <label for="per_page">Data per halaman:</label>

                <select name="per_page" id="per_page">
                    <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>
                        5
                    </option>
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>
                        10
                    </option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>
                        25
                    </option>
                </select>

                <button type="submit">Terapkan</button>
            </form>

            @foreach ($projects as $project)
                <div class="rounded border border-gray-200 bg-white p-5 shadow-sm">
                    <p class="mb-2 text-sm text-gray-500">
                        No. {{ $no++ }}
                    </p>

                    <h2 class="text-xl font-bold text-gray-800">
                        {{ $project->title }}
                    </h2>

                    <p class="mt-2 text-sm text-gray-600">
                        {{ $project->description }}
                    </p>

                    <div class="mt-3 flex gap-2 text-sm">
                        <a
                            href="{{ route('projects.show', $project->id) }}"
                            class="text-blue-600 hover:text-blue-800 hover:underline"
                        >
                            Lihat Detail
                        </a>

                        <a
                            href="{{ route('projects.edit', $project->id) }}"
                            class="text-blue-600 hover:text-blue-800 hover:underline"
                        >
                            Edit
                        </a>
                    </div>
                </div>
            @endforeach
            {{ $projects->links() }}
        </div>
    </div>
@endsection