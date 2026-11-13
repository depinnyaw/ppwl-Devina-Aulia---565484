<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Models\Category;
use App\Models\Technology;

class ProjectController extends Controller
{
    // Menampilkan daftar project
    
public function index()
{
    // Mengambil parameter dari URL
    $search = request('search');
    $status = request()->query('status');
    $perPage = request()->query('per_page', 5);

    // Membatasi pilihan jumlah data per halaman
    if (!in_array((int) $perPage, [5, 10, 25])) {
        $perPage = 5;
    }

    // Memastikan status hanya draft atau published
    if (!in_array($status, ['draft', 'published'], true)) {
        $status = null;
    }

    // Query project
    $projects = Project::query()
        ->with(['category', 'technologies'])

        // Search berdasarkan judul
        ->when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%");
        })

        // Filter berdasarkan status
        ->when($status, function ($query, $status) {
            $query->where('status', $status);
        })

        // Pagination
        ->paginate((int) $perPage)
        ->withQueryString();

    return view('projects.index', compact(
        'projects',
        'search',
        'status',
        'perPage'
    ));
}


    // Menampilkan form tambah project
    public function create()
    {
        $categories = Category::all();
        $technologies = Technology::all();

        return view('projects.create', compact(
            'categories',
            'technologies'
        ));
    }

    // Menyimpan project baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'title' => 'required|string|min:5|max:255',
        'description' => 'required|string|min:10',

        'short_description' => 'nullable|string|max:255',
        'project_date' => 'nullable|date',
        'is_featured' => 'sometimes|boolean',
        'project_url' => 'nullable|url|max:255',
        'repository_url' => 'nullable|url|max:255',

        'category_id' => 'nullable|exists:categories,id',
        'technologies' => 'nullable|array',
        'technologies.*' => 'exists:technologies,id',
        'thumbnail' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
            'dimensions:min_width=400,min_height=300',
        ],
]);

        // Membuat slug otomatis
        $baseSlug = Str::slug($validatedData['title']);
        $slug = $baseSlug;
        $counter = 1;

        while (Project::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $validatedData['slug'] = $slug;
        $validatedData['status'] = 'published';

        // Upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $validatedData['thumbnail'] = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }

        // Memisahkan data teknologi
        $technologyIds = $validatedData['technologies'] ?? [];
        unset($validatedData['technologies']);

        // Menyimpan project
        $project = Project::create($validatedData);

        // Menghubungkan project dengan teknologi
        $project->technologies()->attach($technologyIds);

        return redirect()->route('projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    // Menampilkan detail project admin
    public function show(Project $project)
    {
        $project->load(['category', 'technologies', 'images']);

        return view('projects.show', compact('project'));
    }

    // Menampilkan detail project publik berdasarkan slug
    public function publicShow(string $slug)
    {
        $project = Project::published()
            ->with(['images', 'category', 'technologies'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('projects.public-show', compact('project'));
    }

    // Menampilkan form edit project
    public function edit(Project $project)
    {
        $categories = Category::all();
        $technologies = Technology::all();

        $project->load('technologies');

        return view('projects.edit', compact(
            'project',
            'categories',
            'technologies'
        ));
    }

    // Memperbarui project
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
        'title' => 'required|string|min:5|max:255',
        'description' => 'required|string|min:10',

        'short_description' => 'nullable|string|max:255',
        'project_date' => 'nullable|date',
        'is_featured' => 'sometimes|boolean',
        'project_url' => 'nullable|url|max:255',
        'repository_url' => 'nullable|url|max:255',

        'category_id' => 'nullable|exists:categories,id',
        'technologies' => 'nullable|array',
        'technologies.*' => 'exists:technologies,id',
        'thumbnail' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
            'dimensions:min_width=400,min_height=300',
        ],
    ]);

        $project = Project::findOrFail($id);

        // Membuat slug baru jika judul berubah
        if ($project->title !== $validatedData['title']) {
            $baseSlug = Str::slug($validatedData['title']);
            $slug = $baseSlug;
            $counter = 1;

            while (
                Project::where('slug', $slug)
                    ->where('id', '!=', $project->id)
                    ->exists()
            ) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $validatedData['slug'] = $slug;
        }

        // Mengganti thumbnail jika ada file baru
        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }

            $validatedData['thumbnail'] = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }

        // Memisahkan data teknologi
        $technologyIds = $validatedData['technologies'] ?? [];
        unset($validatedData['technologies']);

        // Memperbarui project
        $project->update($validatedData);

        // Memperbarui relasi teknologi
        $project->technologies()->sync($technologyIds);

        return redirect()->route('projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    // Menghapus project (soft delete)
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);

        // Hapus thumbnail
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        // Hapus gambar gallery
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project beserta seluruh gambarnya berhasil dihapus.');
    }

    // Menampilkan project yang dihapus
    public function trash()
    {
        $projects = Project::onlyTrashed()->get();

        return view('projects.trash', compact('projects'));
    }

    // Memulihkan project
    public function restore($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);

        $project->restore();

        return redirect()->route('projects.trash')
            ->with('success', 'Project berhasil dipulihkan.');
    }

    // Menghapus project secara permanen
    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);

        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        $project->forceDelete();

        return redirect()->route('projects.trash')
            ->with('success', 'Project berhasil dihapus secara permanen.');
    }
}
