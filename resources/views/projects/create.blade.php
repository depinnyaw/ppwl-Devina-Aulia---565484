@extends('layouts.app')

@section('title', 'Tambah Project')

@section('content')
    <div class="rounded border border-gray-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Project
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

        <form action="{{ route('projects.store') }}" method="POST" class="mt-6">
            @csrf

            <div class="mb-4">
                <label for="title" class="mb-1 block text-sm font-medium text-gray-700">
                    Title
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
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
                >{{ old('description') }}</textarea>
            </div>

            <button
                type="submit"
                class="rounded bg-blue-500 px-4 py-2 text-sm font-medium text-white hover:bg-blue-600"
            >
                Simpan
            </button>
        </form>
    </div>
@endsection