<h1>Edit Project</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('projects.update', $project->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ $project->title }}">
    </div>

    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description">{{ $project->description }}</textarea>
    </div>

    <button type="submit">Update</button>
</form>