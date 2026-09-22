<h1>Projects</h1>

@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

@foreach ($projects as $project)
    <h2>
        <a href="{{ route('projects.show', $project->id) }}">
            {{ $project->title }}
        </a>
    </h2>

    <p>{{ $project->description }}</p>
@endforeach