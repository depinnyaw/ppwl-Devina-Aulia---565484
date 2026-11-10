<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\Technology;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function index()
    {
        return view('post.dashboard.index', [
            'totalProjects' => Project::count(),
            'publishedProjects' => Project::where('status', 'published')->count(),
            'draftProjects' => Project::where('status', 'draft')->count(),
            

            'totalCategories' => Category::count(),
            'totalTechnologies' => Technology::count(),
            'totalSkills' => Skill::count(),
            'topSkills' => Skill::latest()->take(5)->get(),
            'categories' => Category::withCount('projects')->get(),
            'latestProjects' => Project::with('category')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}