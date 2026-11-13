<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Technology;

class PortfolioController extends Controller
{
    public function projects(Request $request)
    {
        $query = Project::with(['category', 'technologies'])
            ->where('status', 'published')

            // Search berdasarkan judul dan deskripsi
            ->when($request->search, fn ($q, $s) =>
                $q->where(function ($w) use ($s) {
                    $w->where('title', 'like', "%{$s}%")
                      ->orWhere('short_description', 'like', "%{$s}%")
                      ->orWhere('description', 'like', "%{$s}%");
                })
            )

            // Filter kategori
            ->when($request->category, fn ($q, $c) =>
                $q->whereHas('category', fn ($w) =>
                    $w->where('slug', $c)
                )
            )

            // Filter technology
            ->when($request->technology, fn ($q, $t) =>
                $q->whereHas('technologies', fn ($w) =>
                    $w->where('slug', $t)
                )
            );

        // Sorting
        switch ($request->query('sort')) {
            case 'terlama':
                $query->oldest();
                break;

            case 'az':
                $query->orderBy('title');
                break;

            case 'tanggal_terbaru':
                $query->orderByRaw('project_date IS NULL')
                      ->orderBy('project_date', 'desc');
                break;

            case 'tanggal_terlama':
                $query->orderByRaw('project_date IS NULL')
                      ->orderBy('project_date', 'asc');
                break;

            default:
                $query->latest();
        }

        // Pagination
        $projects = $query->paginate(9)->withQueryString();

        // Mengambil kategori
        $categories = Category::orderBy('name')->get();

        // Mengambil technology
        $technologies = Technology::orderBy('name')->get();

        // Jumlah hasil pencarian
        $totalResults = $projects->total();

        return view('projects', compact(
            'projects',
            'categories',
            'technologies',
            'totalResults'
        ));
    }
}
