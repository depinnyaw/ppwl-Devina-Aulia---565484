@extends('layouts.app')

@section('content')
    <h1>Trash</h1>

    @forelse ($projects as $project)
        <div>
            <h3>{{ $project->title }}</h3>
            <p>{{ $project->description }}</p>

            <p>Dihapus pada: {{ $project->deleted_at }}</p>

            <form action="{{ route('projects.restore', $project->id) }}" method="POST">
                @csrf
                <button type="submit">Restore</button>
            </form>

            <form action="{{ route('projects.forceDelete', $project->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus Permanen</button>
            </form>
        </div>
    @empty
        <p>Tidak ada project di Trash.</p>
    @endforelse
@endsection