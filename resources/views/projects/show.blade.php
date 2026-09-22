<h1>{{ $project->title }}</h1>

<p>{{ $project->description }}</p>

<a href="{{ route('projects.edit', $project->id) }}">Edit</a>

<form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')

    <button type="submit" onclick="return confirm('Apakah kamu yakin ingin menghapus project ini?')">
    Delete
    </button>
</form>