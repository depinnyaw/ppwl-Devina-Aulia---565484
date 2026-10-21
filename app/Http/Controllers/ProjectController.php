<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $projects = Project::published()
    //     ->orderBy('created_at', 'desc')
    //     ->paginate(10);

    // return view('projects.index', compact('projects'));
    // }

    // public function index()
    // {
    //     $projects = Project::published()
    //     ->orderBy('created_at', 'desc')
    //     ->paginate(5);

    // return view('projects.index', compact('projects'));
    // }

    
// public function index(Request $request)
// {
//     $search = $request->input('search');

//     $projects = Project::published()
//         ->when($search, function ($query, $search) {
//             $query->where('title', 'like', '%' . $search . '%');
//         })
//         ->orderBy('created_at', 'desc')
//         ->paginate(5)
//         ->withQueryString();

//     return view('projects.index', compact('projects', 'search'));
// }

public function index()
{
    $search = request('search');

    $perPage = request()->query('per_page', 5);

    if (!in_array((int) $perPage, [5, 10, 25])) {
        $perPage = 5;
    }

    $projects = Project::query()
        ->when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%");
        })
        ->paginate((int) $perPage)
        ->withQueryString();

    return view('projects.index', compact(
        'projects',
        'search',
        'perPage'
    ));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'title' => 'required|min:5',
        'description' => 'required|min:10',
    ]);

    $validatedData['status'] = 'published';

    Project::create($validatedData);

    return redirect()->route('projects.index')
        ->with('success', 'Project berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validatedData = $request->validate([
        'title' => 'required|min:5',
        'description' => 'required|min:10',
    ]);

    $project = Project::findOrFail($id);
    $project->update($validatedData);

    return redirect()->route('projects.index')
        ->with('success', 'Project berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')
             ->with('success', 'Project berhasil dihapus.');
    }

    //tambahkan method untuk menampilkan daftar project yang dihapus
    public function trash()
    {
        $projects = Project::onlyTrashed()->get();

        return view('projects.trash', compact('projects'));
    }

    //method untuk mengembalikan project yang dihapus
    public function restore($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('projects.trash')
            ->with('success', 'Project berhasil dipulihkan.');
    }

    //method untuk menghapus project secara permanen
    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->forceDelete();

        return redirect()->route('projects.trash')
            ->with('success', 'Project berhasil dihapus secara permanen.');
    }
}
