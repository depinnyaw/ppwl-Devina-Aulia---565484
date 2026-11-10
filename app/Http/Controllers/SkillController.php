<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SkillController extends Controller
{
    // Menampilkan semua skill
    public function index(): View
    {
        $skills = Skill::latest()->get();

        return view('post.skills.index', compact('skills'));
    }

    // Menampilkan form tambah skill
    public function create(): View
    {
        return view('post.skills.create');
    }

    // Menyimpan skill baru
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
        ]);

        Skill::create($validated);

        return redirect()
            ->route('skills.index')
            ->with('success', 'Skill berhasil ditambahkan.');
    }

    // Menampilkan form edit skill
    public function edit(Skill $skill): View
    {
        return view('post.skills.edit', compact('skill'));
    }

    // Memperbarui skill
    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
        ]);

        $skill->update($validated);

        return redirect()
            ->route('skills.index')
            ->with('success', 'Skill berhasil diperbarui.');
    }

    // Menghapus skill
    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()
            ->route('skills.index')
            ->with('success', 'Skill berhasil dihapus.');
    }
}
