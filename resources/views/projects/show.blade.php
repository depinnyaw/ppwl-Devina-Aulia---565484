@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <div class="rounded border border-gray-200 bg-white p-5 shadow-sm">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $project->title }}
        </h1>

        <p class="mt-3 text-sm text-gray-600">
            {{ $project->description }}
        </p>

        <div class="mt-4 flex items-center gap-3 text-sm">
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
@endsection