<h1>Tambah Project</h1>

<form action="{{ route('projects.store') }}" method="POST">
    @csrf

    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
    </div>

    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>
    </div>

    <button type="submit">Simpan</button>
</form>